<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import libraryDocuments from '@/routes/admin/library-documents';
    import type { BreadcrumbItem } from '@/types';

    let {
        documents,
    }: {
        documents: {
            id: number;
            title: string;
            library_category: string;
            is_public: boolean;
            sort_order: number;
            file_name: string | undefined;
        }[];
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(libraryDocuments.index()) },
        { title: 'Library', href: toUrl(libraryDocuments.index()) },
    ];

    function remove(id: number) {
        if (!confirm('Delete this document?')) {
            return;
        }
        router.delete(libraryDocuments.destroy.url({ library_document: id }) as string);
    }
</script>

<AppHead title="Library documents" />

<AppLayout {breadcrumbs}>
    <div class="flex flex-col gap-4 p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Library (Profile & Reports)</h1>
            <Link
                href={toUrl(libraryDocuments.create())}
                class="rounded-md bg-primary px-3 py-2 text-sm font-medium text-primary-foreground"
            >
                Upload
            </Link>
        </div>

        <div class="overflow-x-auto rounded-lg border">
            <table class="w-full text-left text-sm">
                <thead class="bg-muted/50">
                    <tr>
                        <th class="p-2">Title</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Public</th>
                        <th class="p-2">File</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    {#each documents as row (row.id)}
                        <tr class="border-t">
                            <td class="p-2">{row.title}</td>
                            <td class="p-2">{row.library_category}</td>
                            <td class="p-2">{row.is_public ? 'yes' : 'no'}</td>
                            <td class="p-2">{row.file_name ?? '—'}</td>
                            <td class="p-2 text-right">
                                <Link
                                    href={toUrl(libraryDocuments.edit({ library_document: row.id }))}
                                    class="text-primary underline"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    class="ml-2 text-destructive underline"
                                    onclick={() => remove(row.id)}
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
</AppLayout>
