<script lang="ts">
    import { Button } from '@/components/ui/button';
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
    import ImageIcon from 'lucide-svelte/icons/image';
    import Loader2 from 'lucide-svelte/icons/loader-2';
    import Upload from 'lucide-svelte/icons/upload';

    let {
        open = $bindable(false),
        onPick,
    }: {
        open?: boolean;
        onPick: (url: string) => void;
    } = $props();

    type MediaRow = {
        id: number;
        url: string;
        thumb_url: string;
        name: string;
    };

    let items = $state<MediaRow[]>([]);
    let loading = $state(false);
    let uploading = $state(false);
    let page = $state(1);
    let lastPage = $state(1);
    let error = $state<string | null>(null);

    async function loadPage(p: number) {
        loading = true;
        error = null;
        try {
            const url = `${toUrl(editorMedia.index())}?page=${p}&per_page=24`;
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
                meta: { current_page: number; last_page: number };
            };
            items = json.data;
            page = json.meta.current_page;
            lastPage = json.meta.last_page;
        } catch (e) {
            error = e instanceof Error ? e.message : 'Load failed';
            items = [];
        } finally {
            loading = false;
        }
    }

    $effect(() => {
        if (open) {
            loadPage(1);
        }
    });

    async function uploadFile(file: File) {
        uploading = true;
        error = null;
        try {
            const fd = new FormData();
            fd.append('upload', file);
            const res = await fetch(toUrl(editorMedia.store()), {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-XSRF-TOKEN': getCsrfTokenFromCookie(),
                },
                body: fd,
            });
            const json = (await res.json()) as { url?: string; message?: string };
            if (!res.ok) {
                throw new Error(json.message ?? 'Upload failed');
            }
            if (json.url) {
                await loadPage(1);
                onPick(json.url);
                open = false;
            }
        } catch (e) {
            error = e instanceof Error ? e.message : 'Upload failed';
        } finally {
            uploading = false;
        }
    }

    function pick(url: string) {
        onPick(url);
        open = false;
    }
</script>

<Dialog bind:open>
    <DialogContent class="flex max-h-[90vh] max-w-3xl flex-col gap-0 p-0 sm:max-w-3xl">
        <div class="space-y-1 border-b px-6 py-4">
            <DialogTitle class="flex items-center gap-2">
                <ImageIcon class="size-5" />
                Thư viện ảnh (Spatie)
            </DialogTitle>
            <DialogDescription>
                Chọn ảnh có sẵn hoặc tải lên mới. Ảnh được lưu qua Media Library.
            </DialogDescription>
        </div>

        <div class="flex flex-1 flex-col gap-3 overflow-hidden px-6 py-4">
            <div class="flex flex-wrap items-center gap-2">
                <label class="inline-flex cursor-pointer items-center gap-2 rounded-md border border-input bg-background px-3 py-2 text-sm font-medium hover:bg-muted/60">
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
                {#if uploading}
                    <Loader2 class="size-4 animate-spin text-muted-foreground" />
                {/if}
            </div>

            {#if error}
                <p class="text-sm text-destructive">{error}</p>
            {/if}

            <div class="min-h-[200px] flex-1 overflow-y-auto rounded-md border border-dashed border-muted-foreground/30 bg-muted/20 p-2">
                {#if loading}
                    <div class="flex h-40 items-center justify-center gap-2 text-sm text-muted-foreground">
                        <Loader2 class="size-5 animate-spin" />
                        Đang tải…
                    </div>
                {:else if items.length === 0}
                    <div
                        class="flex h-40 flex-col items-center justify-center gap-1 text-center text-sm text-muted-foreground"
                    >
                        <ImageIcon class="size-10 opacity-40" />
                        Chưa có ảnh. Hãy tải lên để bắt đầu.
                    </div>
                {:else}
                    <div class="grid grid-cols-3 gap-2 sm:grid-cols-4">
                        {#each items as row (row.id)}
                            <button
                                type="button"
                                class="group relative aspect-square overflow-hidden rounded-md border border-transparent bg-background ring-offset-background transition hover:border-primary hover:ring-2 hover:ring-primary/20 focus:outline-none focus:ring-2 focus:ring-primary"
                                onclick={() => pick(row.url)}
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
