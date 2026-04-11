<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import { Badge } from '@/components/ui/badge';
    import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
    import {
        Table,
        TableBody,
        TableCell,
        TableHead,
        TableHeader,
        TableRow,
    } from '@/components/ui/table';
    import admin from '@/routes/admin';
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
        { title: 'Admin', href: toUrl(admin.home()) },
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
    <div class="mx-auto flex max-w-5xl flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Library (Profile & Reports)</h1>
                <p class="mt-1 text-sm text-muted-foreground">Documents available for download on the site.</p>
            </div>
            <Link
                href={toUrl(libraryDocuments.create())}
                class="inline-flex h-10 items-center justify-center rounded-md bg-primary px-4 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90"
            >
                Upload
            </Link>
        </div>

        <Card class="overflow-hidden shadow-sm">
            <CardHeader class="border-b bg-muted/20 py-4">
                <CardTitle class="text-base">Files</CardTitle>
            </CardHeader>
            <CardContent class="p-0">
                <Table>
                    <TableHeader>
                        <TableRow class="hover:bg-transparent">
                            <TableHead>Title</TableHead>
                            <TableHead class="w-[100px]">Type</TableHead>
                            <TableHead class="w-[100px]">Public</TableHead>
                            <TableHead class="hidden sm:table-cell">File</TableHead>
                            <TableHead class="w-[140px] text-right">Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {#if documents.length === 0}
                            <TableRow>
                                <TableCell colspan={5} class="py-10 text-center text-sm text-muted-foreground">
                                    No documents yet. Upload a profile or report file for public download (S-018).
                                </TableCell>
                            </TableRow>
                        {/if}
                        {#each documents as row (row.id)}
                            <TableRow>
                                <TableCell class="max-w-[min(100vw,20rem)] whitespace-normal font-medium">
                                    {row.title}
                                </TableCell>
                                <TableCell>
                                    <Badge variant="outline">{row.library_category}</Badge>
                                </TableCell>
                                <TableCell>
                                    <Badge variant={row.is_public ? 'default' : 'secondary'}>
                                        {row.is_public ? 'yes' : 'no'}
                                    </Badge>
                                </TableCell>
                                <TableCell class="hidden font-mono text-xs text-muted-foreground sm:table-cell">
                                    {row.file_name ?? '—'}
                                </TableCell>
                                <TableCell class="text-right">
                                    <div class="flex flex-wrap justify-end gap-1">
                                        <Link
                                            href={toUrl(libraryDocuments.edit({ library_document: row.id }))}
                                            class="inline-flex h-8 items-center rounded-md px-2 text-sm font-medium text-primary hover:underline"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            type="button"
                                            class="inline-flex h-8 items-center rounded-md px-2 text-sm font-medium text-destructive hover:underline"
                                            onclick={() => remove(row.id)}
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        {/each}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </div>
</AppLayout>
