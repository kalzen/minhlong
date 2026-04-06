<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import LocaleFlag from '@/components/LocaleFlag.svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { sortLocales } from '@/lib/locale-flags';
    import { groupByTranslationGroup } from '@/lib/translation-groups';
    import { cn, toUrl } from '@/lib/utils';
    import { Badge } from '@/components/ui/badge';
    import {
        Card,
        CardContent,
        CardDescription,
        CardHeader,
        CardTitle,
    } from '@/components/ui/card';
    import {
        Table,
        TableBody,
        TableCell,
        TableHead,
        TableHeader,
        TableRow,
    } from '@/components/ui/table';
    import admin from '@/routes/admin';
    import projects from '@/routes/admin/projects';
    import type { BreadcrumbItem } from '@/types';

    type ProjectRow = {
        id: number;
        title: string;
        slug: string;
        locale: string;
        status: string;
        translation_group_id: string | null;
        category?: { name: string } | null;
    };

    type Paginator = {
        data: ProjectRow[];
        links?: { url: string | null; label: string; active: boolean }[];
    };

    let {
        projects: projectPaginator,
        filters = { locale: null as string | null },
    }: {
        projects: Paginator;
        filters?: { locale: string | null };
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Projects', href: toUrl(projects.index()) },
    ];

    const groups = $derived(groupByTranslationGroup(projectPaginator.data));

    function remove(id: number) {
        if (!confirm('Delete this project?')) {
            return;
        }
        router.delete(projects.destroy.url({ project: id }) as string);
    }

    function shortGroupId(uuid: string | null): string {
        if (!uuid) {
            return '';
        }

        return uuid.slice(0, 8);
    }
</script>

<AppHead title="Projects" />

<AppLayout {breadcrumbs}>
    <div class="mx-auto flex max-w-6xl flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Projects</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Grouped by translation group; flags show locale.
                </p>
            </div>
            <Link
                href={toUrl(projects.create())}
                class="inline-flex h-10 items-center justify-center rounded-md bg-primary px-4 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90"
            >
                New project
            </Link>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-medium text-muted-foreground">Filter:</span>
            <Link
                href={toUrl(projects.index())}
                class={cn(
                    'inline-flex h-8 items-center rounded-full border px-3 text-xs font-medium transition',
                    !filters.locale
                        ? 'border-primary bg-primary/10 text-primary'
                        : 'border-border bg-background hover:bg-muted/60',
                )}
            >
                All
            </Link>
            {#each ['en', 'vi', 'zh'] as loc (loc)}
                <Link
                    href={toUrl(projects.index({ query: { locale: loc } }))}
                    class={cn(
                        'inline-flex h-8 items-center gap-1.5 rounded-full border px-3 text-xs font-medium transition',
                        filters.locale === loc
                            ? 'border-primary bg-primary/10 text-primary'
                            : 'border-border bg-background hover:bg-muted/60',
                    )}
                >
                    <LocaleFlag locale={loc} size="sm" />
                    {loc}
                </Link>
            {/each}
        </div>

        {#if groups.length === 0}
            <div
                class="rounded-xl border border-dashed bg-muted/20 px-6 py-16 text-center text-sm text-muted-foreground"
            >
                No projects yet. Create one to get started.
            </div>
        {:else}
        <div class="flex flex-col gap-5">
            {#each groups as group (group.key)}
                <Card class="overflow-hidden shadow-sm">
                    <CardHeader class="border-b bg-muted/20 py-4">
                        <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                            <div class="space-y-1">
                                <CardTitle class="text-base">
                                    {#if group.translation_group_id}
                                        Translation group
                                        <span class="ml-1 font-mono text-sm font-normal text-muted-foreground"
                                            >{shortGroupId(group.translation_group_id)}</span
                                        >
                                    {:else}
                                        Ungrouped
                                    {/if}
                                </CardTitle>
                                <CardDescription class="font-mono text-xs break-all">
                                    {#if group.translation_group_id}
                                        {group.translation_group_id}
                                    {:else}
                                        Standalone projects (no translation_group_id).
                                    {/if}
                                </CardDescription>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-xs text-muted-foreground">Locales:</span>
                                <div class="flex flex-wrap items-center gap-1.5">
                                    {#each sortLocales(group.locales) as loc (loc)}
                                        <span class="flex items-center gap-1 rounded-full border bg-background px-2 py-0.5 text-xs shadow-sm">
                                            <LocaleFlag locale={loc} size="sm" />
                                            <span class="uppercase text-muted-foreground">{loc}</span>
                                        </span>
                                    {/each}
                                </div>
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent class="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow class="hover:bg-transparent">
                                    <TableHead class="w-[100px]">Locale</TableHead>
                                    <TableHead>Title</TableHead>
                                    <TableHead class="hidden md:table-cell">Category</TableHead>
                                    <TableHead class="w-[120px]">Status</TableHead>
                                    <TableHead class="w-[140px] text-right">Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {#each group.posts as row (row.id)}
                                    <TableRow>
                                        <TableCell>
                                            <div class="flex items-center gap-2">
                                                <LocaleFlag locale={row.locale} size="md" />
                                                <span class="text-xs font-medium uppercase text-muted-foreground"
                                                    >{row.locale}</span
                                                >
                                            </div>
                                        </TableCell>
                                        <TableCell class="max-w-[min(100vw,28rem)] whitespace-normal">
                                            <span class="font-medium">{row.title}</span>
                                            <div class="mt-0.5 font-mono text-[11px] text-muted-foreground">
                                                /{row.slug}
                                            </div>
                                        </TableCell>
                                        <TableCell class="hidden text-muted-foreground md:table-cell">
                                            {row.category?.name ?? '—'}
                                        </TableCell>
                                        <TableCell>
                                            <Badge variant={row.status === 'published' ? 'default' : 'secondary'}>
                                                {row.status}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="text-right">
                                            <div class="flex flex-wrap justify-end gap-1">
                                                <Link
                                                    href={toUrl(projects.edit({ project: row.id }))}
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
            {/each}
        </div>
        {/if}

        {#if projectPaginator.links && projectPaginator.links.length > 0}
            <nav
                class="flex flex-wrap items-center justify-center gap-1 border-t pt-4"
                aria-label="Pagination"
            >
                {#each projectPaginator.links as link (link.label + (link.url ?? ''))}
                    {#if link.url}
                        <Link
                            href={toUrl(link.url)}
                            class={cn(
                                'inline-flex min-w-9 items-center justify-center rounded-md border px-2 py-1.5 text-sm transition',
                                link.active
                                    ? 'border-primary bg-primary text-primary-foreground'
                                    : 'border-transparent bg-background hover:bg-muted',
                            )}
                            preserveScroll
                        >
                            {@html link.label}
                        </Link>
                    {:else}
                        <span
                            class="inline-flex min-w-9 items-center justify-center px-2 py-1.5 text-sm text-muted-foreground"
                            aria-hidden="true"
                        >
                            {@html link.label}
                        </span>
                    {/if}
                {/each}
            </nav>
        {/if}
    </div>
</AppLayout>
