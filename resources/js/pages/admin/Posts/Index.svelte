<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import LocaleFlag from '@/components/LocaleFlag.svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { LOCALE_ORDER } from '@/lib/locale-flags';
    import { groupByTranslationGroup } from '@/lib/translation-groups';
    import { cn, toUrl } from '@/lib/utils';
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
    import { Check, X } from 'lucide-svelte';
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
    const selectedLocaleByGroup = $state<Record<string, string>>({});
    const localeColumns = LOCALE_ORDER;

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

    function selectedMissingLocale(group: { key: string; locales: string[] }): string {
        const options = missingLocales(group.locales);
        const selected = selectedLocaleByGroup[group.key];

        if (selected && options.includes(selected)) {
            return selected;
        }

        return options[0] ?? '';
    }

    function postByLocale(group: { posts: PostRow[] }, locale: string): PostRow | null {
        return group.posts.find((post) => post.locale === locale) ?? null;
    }

    function primaryPost(group: { posts: PostRow[] }): PostRow {
        return (
            postByLocale(group, 'vi')
            ?? postByLocale(group, 'en')
            ?? postByLocale(group, 'zh')
            ?? group.posts[0]
        );
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

    function onLocaleClick(group: { key: string; posts: PostRow[] }, locale: string): void {
        const localizedPost = postByLocale(group, locale);

        if (localizedPost) {
            router.visit(toUrl(posts.edit({ post: localizedPost.id })));

            return;
        }

        const sourcePost = primaryPost(group);
        translateGroupLocale(group.key, sourcePost.id, locale);
    }

    function addLocale(group: { key: string; posts: PostRow[]; locales: string[] }): void {
        const locale = selectedMissingLocale(group);

        if (!locale) {
            return;
        }

        translateGroupLocale(group.key, primaryPost(group).id, locale);
    }

    function autoTranslateMissing(group: { key: string; posts: PostRow[] }): void {
        processingLocaleByGroup[group.key] = 'all';

        router.post(
            `/admin/posts/${primaryPost(group).id}/translate-missing-locales`,
            {},
            {
                preserveScroll: true,
                preserveState: true,
                only: ['posts', 'filters', 'flash', 'errors'],
                onFinish: () => {
                    processingLocaleByGroup[group.key] = null;
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
        <Card class="overflow-hidden shadow-sm">
            <CardHeader class="border-b bg-muted/20 py-4">
                <CardTitle class="text-base">Danh sách nhóm bài viết</CardTitle>
                <CardDescription>Mỗi nhóm là 1 dòng. Bấm cờ để sửa hoặc tự dịch AI.</CardDescription>
            </CardHeader>
            <CardContent class="p-0">
                <Table>
                    <TableHeader>
                        <TableRow class="hover:bg-transparent">
                            <TableHead class="w-[170px]">Nhóm</TableHead>
                            <TableHead>Tiêu đề đại diện</TableHead>
                            <TableHead class="hidden md:table-cell w-[140px]">Danh mục</TableHead>
                            <TableHead class="w-[320px]">Ngôn ngữ</TableHead>
                            <TableHead class="w-[260px] text-right">Thao tác</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {#each groups as group (group.key)}
                            <TableRow>
                                <TableCell>
                                    {#if group.translation_group_id}
                                        <div class="font-mono text-xs text-muted-foreground">
                                            {shortGroupId(group.translation_group_id)}
                                        </div>
                                    {:else}
                                        <span class="text-xs text-muted-foreground">single</span>
                                    {/if}
                                </TableCell>
                                <TableCell class="max-w-[min(100vw,30rem)] whitespace-normal">
                                    <span class="font-medium">{primaryPost(group).title}</span>
                                    <div class="mt-0.5 font-mono text-[11px] text-muted-foreground">
                                        /{primaryPost(group).slug}
                                    </div>
                                </TableCell>
                                <TableCell class="hidden text-muted-foreground md:table-cell">
                                    {primaryPost(group).category?.name ?? '—'}
                                </TableCell>
                                <TableCell>
                                    <div class="flex flex-wrap items-center gap-2">
                                        {#each localeColumns as locale (locale)}
                                            {@const localePost = postByLocale(group, locale)}
                                            <button
                                                type="button"
                                                class={cn(
                                                    'inline-flex h-8 items-center gap-1.5 rounded-full border px-2.5 text-xs font-medium transition disabled:opacity-60',
                                                    localePost
                                                        ? 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100'
                                                        : 'border-destructive/30 bg-destructive/5 text-destructive hover:bg-destructive/10',
                                                )}
                                                disabled={processingLocaleByGroup[group.key] !== null}
                                                onclick={() => onLocaleClick(group, locale)}
                                            >
                                                <LocaleFlag locale={locale} size="sm" />
                                                <span class="uppercase">{locale}</span>
                                                {#if localePost}
                                                    <Check class="h-3.5 w-3.5" />
                                                {:else}
                                                    <X class="h-3.5 w-3.5" />
                                                {/if}
                                            </button>
                                        {/each}
                                    </div>
                                </TableCell>
                                <TableCell class="text-right">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <Link
                                            href={toUrl(posts.edit({ post: primaryPost(group).id }))}
                                            class="inline-flex h-8 items-center rounded-md px-2 text-sm font-medium text-primary hover:underline"
                                        >
                                            Edit
                                        </Link>
                                        {#if missingLocales(group.locales).length > 0}
                                            <button
                                                type="button"
                                                class="inline-flex h-8 items-center rounded-md border border-primary/40 bg-primary/5 px-2 text-sm font-medium text-primary hover:bg-primary/10 disabled:opacity-60"
                                                disabled={processingLocaleByGroup[group.key] !== null}
                                                onclick={() => autoTranslateMissing(group)}
                                            >
                                                Dịch tự động
                                            </button>
                                            <select
                                                class="h-8 rounded-md border bg-background px-2 text-xs"
                                                value={selectedMissingLocale(group)}
                                                onchange={(event) =>
                                                    (selectedLocaleByGroup[group.key] = (
                                                        event.currentTarget as HTMLSelectElement
                                                    ).value)}
                                                disabled={processingLocaleByGroup[group.key] !== null}
                                            >
                                                {#each missingLocales(group.locales) as locale (locale)}
                                                    <option value={locale}>{locale.toUpperCase()}</option>
                                                {/each}
                                            </select>
                                            <button
                                                type="button"
                                                class="inline-flex h-8 items-center rounded-md border px-2 text-sm font-medium hover:bg-muted disabled:opacity-60"
                                                disabled={processingLocaleByGroup[group.key] !== null}
                                                onclick={() => addLocale(group)}
                                            >
                                                Thêm ngôn ngữ
                                            </button>
                                        {/if}
                                        <button
                                            type="button"
                                            class="inline-flex h-8 items-center rounded-md px-2 text-sm font-medium text-destructive hover:underline"
                                            onclick={() => remove(primaryPost(group).id)}
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
