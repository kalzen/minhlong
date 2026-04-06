<script lang="ts">
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import {
        Dialog,
        DialogContent,
        DialogDescription,
        DialogFooter,
        DialogTitle,
    } from '@/components/ui/dialog';
    import { getCsrfTokenFromCookie } from '@/lib/csrf';
    import { toUrl } from '@/lib/utils';
    import editorMedia from '@/routes/admin/editor-media';
    import ArrowLeft from 'lucide-svelte/icons/arrow-left';
    import ChevronRight from 'lucide-svelte/icons/chevron-right';
    import Folder from 'lucide-svelte/icons/folder';
    import FolderPlus from 'lucide-svelte/icons/folder-plus';
    import ImageIcon from 'lucide-svelte/icons/image';
    import Loader2 from 'lucide-svelte/icons/loader-2';
    import Upload from 'lucide-svelte/icons/upload';

    let {
        open = $bindable(false),
        onPick,
    }: {
        open?: boolean;
        onPick: (selection: { url: string; mediaId: number }) => void;
    } = $props();

    type MediaRow = {
        id: number;
        url: string;
        thumb_url: string;
        name: string;
    };

    type FolderRow = {
        id: number;
        name: string;
        parent_id: number | null;
    };

    type Crumb = { id: number; name: string };

    let items = $state<MediaRow[]>([]);
    let folders = $state<FolderRow[]>([]);
    let breadcrumbs = $state<Crumb[]>([]);
    let currentFolderId = $state<number | null>(null);
    let loading = $state(false);
    let uploading = $state(false);
    let creatingFolder = $state(false);
    let page = $state(1);
    let lastPage = $state(1);
    let error = $state<string | null>(null);
    let newFolderName = $state('');
    let showNewFolder = $state(false);

    async function loadPage(p: number) {
        loading = true;
        error = null;
        try {
            const params: Record<string, string | number> = { page: p, per_page: 24 };
            if (currentFolderId !== null) {
                params.folder_id = currentFolderId;
            }
            const url = toUrl(editorMedia.index({ query: params }));
            const res = await fetch(url, {
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            if (!res.ok) {
                throw new Error(`HTTP ${res.status}`);
            }
            const json = (await res.json()) as {
                data: MediaRow[];
                folders: FolderRow[];
                breadcrumbs: Crumb[];
                current_folder_id: number | null;
                meta: { current_page: number; last_page: number };
            };
            items = json.data;
            folders = json.folders ?? [];
            breadcrumbs = json.breadcrumbs ?? [];
            currentFolderId = json.current_folder_id ?? null;
            page = json.meta.current_page;
            lastPage = json.meta.last_page;
        } catch (e) {
            error = e instanceof Error ? e.message : 'Load failed';
            items = [];
            folders = [];
        } finally {
            loading = false;
        }
    }

    $effect(() => {
        if (open) {
            currentFolderId = null;
            loadPage(1);
        }
    });

    function enterFolder(id: number) {
        currentFolderId = id;
        loadPage(1);
    }

    function goToRoot() {
        currentFolderId = null;
        loadPage(1);
    }

    function goUp() {
        if (breadcrumbs.length <= 1) {
            currentFolderId = null;
        } else {
            const parent = breadcrumbs[breadcrumbs.length - 2];
            currentFolderId = parent.id;
        }
        loadPage(1);
    }

    function goToCrumb(crumb: Crumb) {
        currentFolderId = crumb.id;
        loadPage(1);
    }

    async function createFolder() {
        const name = newFolderName.trim();
        if (!name) {
            return;
        }
        creatingFolder = true;
        error = null;
        try {
            const res = await fetch(toUrl(editorMedia.folders.store.url()), {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-XSRF-TOKEN': getCsrfTokenFromCookie(),
                },
                body: JSON.stringify({
                    name,
                    parent_id: currentFolderId,
                }),
            });
            const json = (await res.json()) as { message?: string };
            if (!res.ok) {
                throw new Error(json.message ?? 'Không tạo được thư mục');
            }
            newFolderName = '';
            showNewFolder = false;
            await loadPage(1);
        } catch (e) {
            error = e instanceof Error ? e.message : 'Không tạo được thư mục';
        } finally {
            creatingFolder = false;
        }
    }

    async function uploadFile(file: File) {
        uploading = true;
        error = null;
        try {
            const fd = new FormData();
            fd.append('upload', file);
            if (currentFolderId !== null) {
                fd.append('folder_id', String(currentFolderId));
            }
            const res = await fetch(toUrl(editorMedia.store.url()), {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-XSRF-TOKEN': getCsrfTokenFromCookie(),
                },
                body: fd,
            });
            const json = (await res.json()) as { url?: string; id?: number; message?: string };
            if (!res.ok) {
                throw new Error(json.message ?? 'Upload failed');
            }
            if (json.url !== undefined && json.id !== undefined) {
                await loadPage(1);
                onPick({ url: json.url, mediaId: json.id });
                open = false;
            }
        } catch (e) {
            error = e instanceof Error ? e.message : 'Upload failed';
        } finally {
            uploading = false;
        }
    }

    function pick(row: MediaRow) {
        onPick({ url: row.url, mediaId: row.id });
        open = false;
    }
</script>

<Dialog bind:open>
    <DialogContent class="flex max-h-[90vh] max-w-3xl flex-col gap-0 p-0 sm:max-w-3xl">
        <div class="space-y-1 border-b px-6 py-4">
            <DialogTitle class="flex items-center gap-2">
                <ImageIcon class="size-5" />
                Thư viện ảnh
            </DialogTitle>
            <DialogDescription>
                Duyệt theo thư mục (giống WordPress), tạo thư mục mới, tải ảnh lên hoặc chọn ảnh có sẵn.
            </DialogDescription>
        </div>

        <div class="flex flex-1 flex-col gap-3 overflow-hidden px-6 py-4">
            <!-- Breadcrumb -->
            <div class="flex flex-wrap items-center gap-1 text-sm">
                <button
                    type="button"
                    class="rounded px-1.5 py-0.5 font-medium text-primary hover:underline"
                    onclick={goToRoot}
                >
                    Thư viện
                </button>
                {#each breadcrumbs as crumb, i (crumb.id)}
                    <ChevronRight class="size-4 shrink-0 text-muted-foreground" />
                    {#if i < breadcrumbs.length - 1}
                        <button
                            type="button"
                            class="rounded px-1.5 py-0.5 hover:underline"
                            onclick={() => goToCrumb(crumb)}
                        >
                            {crumb.name}
                        </button>
                    {:else}
                        <span class="font-medium">{crumb.name}</span>
                    {/if}
                {/each}
            </div>

            <div class="flex flex-wrap items-center gap-2">
                {#if currentFolderId !== null || breadcrumbs.length > 0}
                    <Button type="button" variant="outline" size="sm" class="gap-1" onclick={goUp}>
                        <ArrowLeft class="size-4" />
                        Lên thư mục cha
                    </Button>
                {/if}
                <label
                    class="inline-flex cursor-pointer items-center gap-2 rounded-md border border-input bg-background px-3 py-2 text-sm font-medium hover:bg-muted/60"
                >
                    <Upload class="size-4" />
                    <span>Tải ảnh lên</span>
                    <input
                        type="file"
                        accept="image/*"
                        class="hidden"
                        disabled={uploading}
                        onchange={(e) => {
                            const f = e.currentTarget.files?.[0];
                            e.currentTarget.value = '';
                            if (f) {
                                uploadFile(f);
                            }
                        }}
                    />
                </label>
                <Button
                    type="button"
                    variant="secondary"
                    size="sm"
                    class="gap-1"
                    onclick={() => (showNewFolder = !showNewFolder)}
                >
                    <FolderPlus class="size-4" />
                    Thư mục mới
                </Button>
                {#if uploading || creatingFolder}
                    <Loader2 class="size-4 animate-spin text-muted-foreground" />
                {/if}
            </div>

            {#if showNewFolder}
                <div class="flex flex-wrap items-end gap-2 rounded-md border border-dashed p-3">
                    <div class="min-w-[12rem] flex-1 space-y-1">
                        <label for="new-folder-name" class="text-xs font-medium text-muted-foreground"
                            >Tên thư mục (trong thư mục hiện tại)</label
                        >
                        <Input
                            id="new-folder-name"
                            type="text"
                            placeholder="Ví dụ: Bài viết 2025"
                            bind:value={newFolderName}
                            onkeydown={(e) => e.key === 'Enter' && (e.preventDefault(), createFolder())}
                        />
                    </div>
                    <Button type="button" size="sm" disabled={creatingFolder} onclick={createFolder}>
                        Tạo
                    </Button>
                </div>
            {/if}

            {#if error}
                <p class="text-sm text-destructive">{error}</p>
            {/if}

            <div
                class="min-h-[200px] flex-1 overflow-y-auto rounded-md border border-dashed border-muted-foreground/30 bg-muted/20 p-2"
            >
                {#if loading}
                    <div class="flex h-40 items-center justify-center gap-2 text-sm text-muted-foreground">
                        <Loader2 class="size-5 animate-spin" />
                        Đang tải…
                    </div>
                {:else}
                    {#if folders.length > 0}
                        <p class="mb-2 text-xs font-medium text-muted-foreground">Thư mục</p>
                        <div class="mb-4 grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4">
                            {#each folders as f (f.id)}
                                <button
                                    type="button"
                                    class="flex min-h-[4.5rem] flex-col items-center justify-center gap-1 rounded-md border border-border bg-background p-3 text-center transition hover:border-primary hover:bg-muted/40 focus:outline-none focus:ring-2 focus:ring-primary"
                                    onclick={() => enterFolder(f.id)}
                                >
                                    <Folder class="size-8 text-amber-600 dark:text-amber-500" />
                                    <span class="line-clamp-2 w-full text-xs font-medium">{f.name}</span>
                                </button>
                            {/each}
                        </div>
                    {/if}

                    <p class="mb-2 text-xs font-medium text-muted-foreground">Ảnh</p>
                    {#if items.length === 0 && folders.length === 0}
                        <div
                            class="flex h-32 flex-col items-center justify-center gap-1 text-center text-sm text-muted-foreground"
                        >
                            <ImageIcon class="size-10 opacity-40" />
                            Chưa có ảnh trong thư mục này. Tải lên hoặc chọn thư mục khác.
                        </div>
                    {:else if items.length === 0}
                        <div class="py-6 text-center text-sm text-muted-foreground">Chưa có ảnh ở đây.</div>
                    {:else}
                        <div class="grid grid-cols-3 gap-2 sm:grid-cols-4">
                            {#each items as row (row.id)}
                                <button
                                    type="button"
                                    class="group relative aspect-square overflow-hidden rounded-md border border-transparent bg-background ring-offset-background transition hover:border-primary hover:ring-2 hover:ring-primary/20 focus:outline-none focus:ring-2 focus:ring-primary"
                                    onclick={() => pick(row)}
                                >
                                    <img
                                        src={row.thumb_url ?? row.url}
                                        alt={row.name}
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    />
                                    <span
                                        class="absolute inset-x-0 bottom-0 truncate bg-background/90 px-1 py-0.5 text-[10px] text-muted-foreground opacity-0 transition group-hover:opacity-100"
                                    >
                                        {row.name}
                                    </span>
                                </button>
                            {/each}
                        </div>
                    {/if}
                {/if}
            </div>
        </div>

        <DialogFooter class="border-t px-6 py-3">
            <div class="flex w-full items-center justify-between gap-2">
                <div class="text-xs text-muted-foreground">
                    Trang {page} / {lastPage || 1}
                </div>
                <div class="flex gap-2">
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        disabled={loading || page <= 1}
                        onclick={() => loadPage(page - 1)}
                    >
                        Trước
                    </Button>
                    <Button
                        type="button"
                        variant="outline"
                        size="sm"
                        disabled={loading || page >= lastPage}
                        onclick={() => loadPage(page + 1)}
                    >
                        Sau
                    </Button>
                    <Button type="button" variant="secondary" size="sm" onclick={() => (open = false)}>
                        Đóng
                    </Button>
                </div>
            </div>
        </DialogFooter>
    </DialogContent>
</Dialog>
