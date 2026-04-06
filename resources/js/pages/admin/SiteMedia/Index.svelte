<script lang="ts">
    import { router } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
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
            url: string | null;
        }[];
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Site images', href: toUrl(siteMedia.index()) },
    ];

    function upload(id: number, file: File) {
        const fd = new FormData();
        fd.append('image', file);
        router.post(siteMedia.update.url({ site_media_placement: id }), fd);
    }
</script>

<AppHead title="Site images" />

<AppLayout {breadcrumbs}>
    <div class="flex flex-col gap-6 p-4">
        <h1 class="text-xl font-semibold">Configurable site images</h1>
        <p class="text-sm text-muted-foreground">
            Upload replaces the current image for each position (see PROJECT_REQUIREMENTS §12.4).
        </p>

        <div class="grid gap-6">
            {#each placements as row (row.id)}
                <div class="rounded-lg border p-4">
                    <p class="font-mono text-sm font-medium">{row.position_key}</p>
                    {#if row.label}
                        <p class="text-xs text-muted-foreground">{row.label}</p>
                    {/if}
                    {#if row.url}
                        <img src={row.url} alt="" class="mt-2 max-h-32 rounded border object-contain" />
                    {/if}
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
                </div>
            {/each}
        </div>
    </div>
</AppLayout>
