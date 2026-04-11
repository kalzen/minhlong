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

    let {
        placements,
    }: {
        placements: {
            id: number;
            position_key: string;
            label: string | null;
            preview_url: string;
            upload_url: string | null;
            stored_image_url: string | null;
        }[];
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Site images', href: toUrl(siteMedia.index()) },
    ];

    let urlDrafts = $state<Record<number, string>>({});
    let lastPlacementSig = $state('');

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

    function upload(id: number, file: File) {
        const fd = new FormData();
        fd.append('image', file);
        router.post(siteMedia.update.url({ site_media_placement: id }), fd);
    }

    function saveUrl(id: number) {
        router.post(siteMedia.update.url({ site_media_placement: id }), {
            image_url: urlDrafts[id] ?? '',
        });
    }
</script>

<AppHead title="Site images" />

<AppLayout {breadcrumbs}>
    <div class="flex flex-col gap-6 p-4">
        <h1 class="text-xl font-semibold">Configurable site images</h1>
        <p class="text-sm text-muted-foreground">
            Upload a file (stored in media library) or set an image URL / public path (e.g.
            <span class="font-mono">frontend/images/logo.png</span>
            or an https link). Upload takes precedence over the stored URL when both exist.
        </p>

        <div class="grid gap-6">
            {#each placements as row (row.id)}
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
                            Active upload (overrides URL below)
                        {:else}
                            No file upload
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
                                for={`img-url-${row.id}`}>Image URL or path</label
                            >
                            <Input
                                id={`img-url-${row.id}`}
                                type="text"
                                class="font-mono text-sm"
                                placeholder="https://... or frontend/images/..."
                                bind:value={urlDrafts[row.id]}
                            />
                        </div>
                        <Button type="button" variant="secondary" onclick={() => saveUrl(row.id)}>
                            Save URL
                        </Button>
                    </div>
                </div>
            {/each}
        </div>
    </div>
</AppLayout>
