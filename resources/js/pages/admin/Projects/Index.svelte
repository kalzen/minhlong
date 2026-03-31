<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import projects from '@/routes/admin/projects';
    import type { BreadcrumbItem } from '@/types';

    let {
        posts: postPaginator,
    }: {
        projects: {
            data: {
                id: number;
                title: string;
                slug: string;
                locale: string;
                status: string;
                category?: { name: string } | null;
            }[];
            links: unknown;
        };
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(projects.index()) },
        { title: 'Projects', href: toUrl(projects.index()) },
    ];

    function remove(id: number) {
        if (!confirm('Delete this project?')) {
            return;
        }
        router.delete(projects.destroy.url({ project: id }) as string);
    }
</script>

<AppHead title="Projects" />

<AppLayout {breadcrumbs}>
    <div class="flex flex-col gap-4 p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Blog posts</h1>
            <Link
                href={toUrl(posts.create())}
                class="rounded-md bg-primary px-3 py-2 text-sm font-medium text-primary-foreground"
            >
                New post
            </Link>
        </div>

        <div class="overflow-x-auto rounded-lg border">
            <table class="w-full text-left text-sm">
                <thead class="bg-muted/50">
                    <tr>
                        <th class="p-2">Title</th>
                        <th class="p-2">Locale</th>
                        <th class="p-2">Category</th>
                        <th class="p-2">Status</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    {#each projectPaginator.data as row (row.id)}
                        <tr class="border-t">
                            <td class="p-2">{row.title}</td>
                            <td class="p-2">{row.locale}</td>
                            <td class="p-2">{row.category?.name ?? '—'}</td>
                            <td class="p-2">{row.status}</td>
                            <td class="p-2 text-right">
                                <Link
                                    href={toUrl(projects.edit({ project: row.id }))}
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
