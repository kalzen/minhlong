<script lang="ts">
    import { router } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import siteMedia from '@/routes/admin/site-media';
    import type { BreadcrumbItem } from '@/types';

    type PlacementRow = {
        id: number;
        position_key: string;
        label: string | null;
        preview_url: string;
        upload_url: string | null;
        stored_image_url: string | null;
        section: string;
        section_order: number;
        section_title: string;
    };

    let {
        placements,
    }: {
        placements: PlacementRow[];
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Hình ảnh website', href: toUrl(siteMedia.index()) },
    ];

    let urlDrafts = $state<Record<number, string>>({});
    let lastPlacementSig = $state('');
    let searchTerm = $state('');
    let activeSection = $state('all');

    function isPyramidSliderKey(positionKey: string): boolean {
        return (
            positionKey === 'home.about.image_1' ||
            positionKey === 'home.about.image_2' ||
            /^home\.about\.image_[12]_slide_\d+$/.test(positionKey)
        );
    }

    function sliderOrder(positionKey: string): number {
        if (positionKey === 'home.about.image_1' || positionKey === 'home.about.image_2') {
            return 1;
        }

        const match = positionKey.match(/_slide_(\d+)$/);
        if (!match) {
            return 999;
        }

        return Number.parseInt(match[1], 10);
    }

    $effect(() => {
        const sig = placements
            .map((p) => `${p.id}:${p.stored_image_url ?? ''}`)
            .join('|');
        if (sig === lastPlacementSig) {
            return;
        }
        lastPlacementSig = sig;
        const next: Record<number, string> = {};
        for (const row of placements) {
            next[row.id] = row.stored_image_url ?? '';
        }
        urlDrafts = next;
    });

    const placementSections = $derived.by(() => {
        const sorted = [...placements].sort((a, b) =>
            a.section_order !== b.section_order
                ? a.section_order - b.section_order
                : a.position_key.localeCompare(b.position_key),
        );
        const map = new Map<
            string,
            { title: string; order: number; rows: PlacementRow[] }
        >();
        for (const row of sorted) {
            if (!map.has(row.section)) {
                map.set(row.section, {
                    title: row.section_title,
                    order: row.section_order,
                    rows: [],
                });
            }
            map.get(row.section)!.rows.push(row);
        }
        return [...map.entries()].sort((a, b) => a[1].order - b[1].order);
    });

    const sectionFilters = $derived.by(() => {
        const options = [{ id: 'all', label: 'Tất cả' }];
        for (const [sectionKey, block] of placementSections) {
            options.push({
                id: sectionKey,
                label: `${block.title} (${block.rows.length})`,
            });
        }

        return options;
    });

    const filteredSections = $derived.by(() => {
        const normalizedTerm = searchTerm.trim().toLowerCase();

        return placementSections
            .filter(([sectionKey]) => activeSection === 'all' || sectionKey === activeSection)
            .map(([sectionKey, block]) => {
                const rows = block.rows.filter((row) => {
                    if (normalizedTerm === '') {
                        return true;
                    }

                    const haystack = `${row.position_key} ${row.label ?? ''}`.toLowerCase();

                    return haystack.includes(normalizedTerm);
                });

                return [sectionKey, { ...block, rows }] as const;
            })
            .filter(([, block]) => block.rows.length > 0);
    });

    const pyramidSliderGroups = $derived.by(() => {
        const map = new Map<string, PlacementRow[]>();
        const rows = placements.filter((row) => isPyramidSliderKey(row.position_key));

        for (const row of rows) {
            const groupKey = row.position_key.startsWith('home.about.image_1') ? 'image_1' : 'image_2';
            if (!map.has(groupKey)) {
                map.set(groupKey, []);
            }
            map.get(groupKey)!.push(row);
        }

        return {
            image_1: (map.get('image_1') ?? []).sort((a, b) => sliderOrder(a.position_key) - sliderOrder(b.position_key)),
            image_2: (map.get('image_2') ?? []).sort((a, b) => sliderOrder(a.position_key) - sliderOrder(b.position_key)),
        };
    });

    function upload(id: number, file: File) {
        const fd = new FormData();
        fd.append('image', file);
        router.post(siteMedia.update.url({ site_media_placement: id }), fd);
    }

    function uploadSliderBatch(slots: PlacementRow[], files: FileList | null) {
        if (!files || files.length === 0) {
            return;
        }

        const filesArray = Array.from(files);
        const maxCount = Math.min(slots.length, filesArray.length);

        for (let i = 0; i < maxCount; i += 1) {
            upload(slots[i].id, filesArray[i]);
        }
    }

    function saveUrl(id: number) {
        router.post(siteMedia.update.url({ site_media_placement: id }), {
            image_url: urlDrafts[id] ?? '',
        });
    }
</script>

<AppHead title="Hình ảnh website" />

<AppLayout {breadcrumbs}>
    <div class="flex flex-col gap-6 p-4">
        <h1 class="text-xl font-semibold">Hình ảnh website</h1>
        <p class="text-sm text-muted-foreground">
            Chỉnh ảnh trang chủ, các trang ngành (Land, Host, Power, Minerals), logo và ảnh SEO. Tải file (lưu trong thư
            viện media) hoặc dán URL / đường dẫn public (ví dụ
            <span class="font-mono">frontend/images/logo.png</span>
            hoặc link https). Nếu có cả upload và URL thì upload được ưu tiên.
        </p>

        <div class="rounded-lg border p-4">
            <p class="mb-3 text-sm font-medium">Lọc nhanh theo trang</p>
            <div class="mb-3 flex flex-wrap gap-2">
                {#each sectionFilters as option (option.id)}
                    <Button
                        type="button"
                        variant={activeSection === option.id ? 'default' : 'secondary'}
                        size="sm"
                        onclick={() => (activeSection = option.id)}
                    >
                        {option.label}
                    </Button>
                {/each}
            </div>
            <label class="mb-1 block text-xs font-medium text-muted-foreground" for="site-media-search">
                Tìm theo key / nhãn ảnh
            </label>
            <Input
                id="site-media-search"
                type="text"
                placeholder="Ví dụ: sector.host.projects..."
                bind:value={searchTerm}
            />
        </div>

        <div class="flex flex-col gap-10">
            {#each filteredSections as [sectionKey, block] (sectionKey)}
                <section class="space-y-4">
                    <div class="border-b pb-2">
                        <h2 class="text-lg font-semibold">{block.title}</h2>
                        <p class="text-xs text-muted-foreground">{block.rows.length} vị trí ảnh</p>
                    </div>
                    {#if sectionKey === 'home'}
                        <div class="grid gap-4 lg:grid-cols-2">
                            <div class="rounded-lg border p-4">
                                <h3 class="text-sm font-semibold">Slider THE PYRAMID JOURNEY - Khung ảnh trái</h3>
                                <p class="mt-1 text-xs text-muted-foreground">
                                    Upload nhiều ảnh một lần: hệ thống tự gán theo thứ tự vào các slide.
                                </p>
                                <input
                                    type="file"
                                    accept="image/*"
                                    multiple
                                    class="mt-3 block text-sm"
                                    onchange={(e) => uploadSliderBatch(pyramidSliderGroups.image_1, e.currentTarget.files)}
                                />
                                <div class="mt-3 grid grid-cols-2 gap-3">
                                    {#each pyramidSliderGroups.image_1 as row (row.id)}
                                        <div class="rounded border p-2">
                                            <p class="truncate font-mono text-[11px]">{row.position_key}</p>
                                            {#if row.preview_url}
                                                <img src={row.preview_url} alt="" class="mt-2 h-20 w-full rounded object-cover" />
                                            {/if}
                                            <input
                                                type="file"
                                                accept="image/*"
                                                class="mt-2 block w-full text-xs"
                                                onchange={(e) => {
                                                    const f = e.currentTarget.files?.[0];
                                                    if (f) {
                                                        upload(row.id, f);
                                                    }
                                                }}
                                            />
                                        </div>
                                    {/each}
                                </div>
                            </div>
                            <div class="rounded-lg border p-4">
                                <h3 class="text-sm font-semibold">Slider THE PYRAMID JOURNEY - Khung ảnh phải</h3>
                                <p class="mt-1 text-xs text-muted-foreground">
                                    Upload nhiều ảnh một lần: hệ thống tự gán theo thứ tự vào các slide.
                                </p>
                                <input
                                    type="file"
                                    accept="image/*"
                                    multiple
                                    class="mt-3 block text-sm"
                                    onchange={(e) => uploadSliderBatch(pyramidSliderGroups.image_2, e.currentTarget.files)}
                                />
                                <div class="mt-3 grid grid-cols-2 gap-3">
                                    {#each pyramidSliderGroups.image_2 as row (row.id)}
                                        <div class="rounded border p-2">
                                            <p class="truncate font-mono text-[11px]">{row.position_key}</p>
                                            {#if row.preview_url}
                                                <img src={row.preview_url} alt="" class="mt-2 h-20 w-full rounded object-cover" />
                                            {/if}
                                            <input
                                                type="file"
                                                accept="image/*"
                                                class="mt-2 block w-full text-xs"
                                                onchange={(e) => {
                                                    const f = e.currentTarget.files?.[0];
                                                    if (f) {
                                                        upload(row.id, f);
                                                    }
                                                }}
                                            />
                                        </div>
                                    {/each}
                                </div>
                            </div>
                        </div>
                    {/if}
                    <div class="grid gap-6">
                        {#each block.rows.filter((row) => !isPyramidSliderKey(row.position_key)) as row (row.id)}
                            <div class="rounded-lg border p-4">
                                <p class="font-mono text-sm font-medium">{row.position_key}</p>
                                {#if row.label}
                                    <p class="text-xs text-muted-foreground">{row.label}</p>
                                {/if}
                                {#if row.preview_url}
                                    <img
                                        src={row.preview_url}
                                        alt=""
                                        class="mt-2 max-h-32 rounded border object-contain"
                                    />
                                {/if}
                                <p class="mt-2 text-xs text-muted-foreground">
                                    {#if row.upload_url}
                                        Đang dùng file upload (ghi đè URL bên dưới)
                                    {:else}
                                        Chưa có file upload
                                    {/if}
                                </p>
                                <input
                                    type="file"
                                    accept="image/*"
                                    class="mt-2 block text-sm"
                                    onchange={(e) => {
                                        const f = e.currentTarget.files?.[0];
                                        if (f) {
                                            upload(row.id, f);
                                        }
                                    }}
                                />
                                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-end">
                                    <div class="min-w-0 flex-1">
                                        <label
                                            class="mb-1 block text-xs font-medium text-muted-foreground"
                                            for={`img-url-${row.id}`}>URL hoặc đường dẫn ảnh</label
                                        >
                                        <Input
                                            id={`img-url-${row.id}`}
                                            type="text"
                                            class="font-mono text-sm"
                                            placeholder="https://... hoặc frontend/images/..."
                                            bind:value={urlDrafts[row.id]}
                                        />
                                    </div>
                                    <Button type="button" variant="secondary" onclick={() => saveUrl(row.id)}>
                                        Lưu URL
                                    </Button>
                                </div>
                            </div>
                        {/each}
                    </div>
                </section>
            {/each}
        </div>
    </div>
</AppLayout>
