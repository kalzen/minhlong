<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import LocaleFlag from '@/components/LocaleFlag.svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { LOCALE_ORDER, sortLocales } from '@/lib/locale-flags';
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
    import posts from '@/routes/admin/posts';
    import type { BreadcrumbItem } from '@/types';

    type PostRow = {
        id: number;
        title: string;
        slug: string;
        locale: string;
        status: string;
        translation_group_id: string | null;
        category?: { name: string } | null;
    };

    type Paginator = {
        data: PostRow[];
        links?: { url: string | null; label: string; active: boolean }[];
        current_page?: number;
        last_page?: number;
        total?: number;
    };

    let {
        posts: postPaginator,
        filters = { locale: null as string | null },
    }: {
        posts: Paginator;
        filters?: { locale: string | null };
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Posts', href: toUrl(posts.index()) },
    ];

    const groups = $derived(groupByTranslationGroup(postPaginator.data));
    const processingLocaleByGroup = $state<Record<string, string | null>>({});

    function remove(id: number) {
        if (!confirm('Delete this post?')) {
            return;
        }
        router.delete(posts.destroy.url({ post: id }) as string);
    }

    function shortGroupId(uuid: string | null): string {
        if (!uuid) {
            return '';
        }

        return uuid.slice(0, 8);
    }

    function missingLocales(locales: string[]): string[] {
        const set = new Set(locales);

        return LOCALE_ORDER.filter((locale) => !set.has(locale));
    }

    function translateGroupLocale(groupKey: string, sourcePostId: number, locale: string): void {
        processingLocaleByGroup[groupKey] = locale;

        router.post(
            `/admin/posts/${sourcePostId}/translate-locale`,
            { locale },
            {
                preserveScroll: true,
                preserveState: true,
                only: ['posts', 'filters', 'flash', 'errors'],
                onFinish: () => {
                    processingLocaleByGroup[groupKey] = null;
                },
            },
        );
    }
</script>

<AppHead title="Posts" />

<AppLayout {breadcrumbs}>
    <div class="mx-auto flex max-w-6xl flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Blog posts</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Các bài được nhóm theo <strong>nhóm bản dịch</strong>; cờ thể hiện ngôn ngữ.
                </p>
            </div>
            <Link
                href={toUrl(posts.create())}
                class="inline-flex h-10 items-center justify-center rounded-md bg-primary px-4 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90"
            >
                New post
            </Link>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-medium text-muted-foreground">Lọc:</span>
            <Link
                href={toUrl(posts.index())}
                class={cn(
                    'inline-flex h-8 items-center rounded-full border px-3 text-xs font-medium transition',
                    !filters.locale
                        ? 'border-primary bg-primary/10 text-primary'
                        : 'border-border bg-background hover:bg-muted/60',
                )}
            >
                Tất cả
            </Link>
            {#each ['en', 'vi', 'zh'] as loc (loc)}
                <Link
                    href={toUrl(posts.index({ query: { locale: loc } }))}
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
                Chưa có bài viết nào. Tạo bài mới để bắt đầu.
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
                                        Nhóm bản dịch
                                        <span class="ml-1 font-mono text-sm font-normal text-muted-foreground"
                                            >{shortGroupId(group.translation_group_id)}</span
                                        >
                                    {:else}
                                        Bài chưa gộp nhóm
                                    {/if}
                                </CardTitle>
                                <CardDescription class="font-mono text-xs break-all">
                                    {#if group.translation_group_id}
                                        {group.translation_group_id}
                                    {:else}
                                        Mỗi dòng là một bài độc lập (không có translation_group_id).
                                    {/if}
                                </CardDescription>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-xs text-muted-foreground">Ngôn ngữ trong nhóm:</span>
                                <div class="flex flex-wrap items-center gap-1.5">
                                    {#each sortLocales(group.locales) as loc (loc)}
                                        <span class="flex items-center gap-1 rounded-full border bg-background px-2 py-0.5 text-xs shadow-sm">
                                            <LocaleFlag locale={loc} size="sm" />
                                            <span class="uppercase text-muted-foreground">{loc}</span>
                                        </span>
                                    {/each}
                                </div>
                                {#if missingLocales(group.locales).length > 0}
                                    <div class="ml-2 flex flex-wrap items-center gap-1.5">
                                        {#each missingLocales(group.locales) as missingLocale (missingLocale)}
                                            <button
                                                type="button"
                                                class="inline-flex h-7 items-center gap-1 rounded-full border border-primary/40 bg-primary/5 px-2 text-xs font-medium text-primary hover:bg-primary/10 disabled:opacity-60"
                                                disabled={processingLocaleByGroup[group.key] !== null}
                                                onclick={() =>
                                                    translateGroupLocale(
                                                        group.key,
                                                        group.posts[0].id,
                                                        missingLocale,
                                                    )}
                                            >
                                                <LocaleFlag locale={missingLocale} size="sm" />
                                                Translate
                                            </button>
                                        {/each}
                                    </div>
                                {/if}
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent class="p-0">
                        <Table>
                            <TableHeader>
                                <TableRow class="hover:bg-transparent">
                                    <TableHead class="w-[100px]">Locale</TableHead>
                                    <TableHead>Tiêu đề</TableHead>
                                    <TableHead class="hidden md:table-cell">Danh mục</TableHead>
                                    <TableHead class="w-[120px]">Trạng thái</TableHead>
                                    <TableHead class="w-[140px] text-right">Thao tác</TableHead>
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
                                                    href={toUrl(posts.edit({ post: row.id }))}
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

        {#if postPaginator.links && postPaginator.links.length > 0}
            <nav
                class="flex flex-wrap items-center justify-center gap-1 border-t pt-4"
                aria-label="Pagination"
            >
                {#each postPaginator.links as link (link.label + (link.url ?? ''))}
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
