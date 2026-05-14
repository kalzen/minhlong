<script lang="ts">
    import { Link, router } from '@inertiajs/svelte';
    import LocaleFlag from '@/components/LocaleFlag.svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { LOCALE_ORDER } from '@/lib/locale-flags';
    import { groupByTranslationGroup } from '@/lib/translation-groups';
    import { cn, toUrl } from '@/lib/utils';
    import { Badge } from '@/components/ui/badge';
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
        updated_at: string;
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

    function maxUpdatedAtMs(group: { posts: PostRow[] }): number {
        return Math.max(...group.posts.map((p) => new Date(p.updated_at).getTime()));
    }

    /** Nhóm có chỉnh sửa gần đây nhất lên trước (đồng bộ với sort backend). */
    const groups = $derived.by(() => {
        const list = groupByTranslationGroup(postPaginator.data);

        return [...list].sort((a, b) => maxUpdatedAtMs(b) - maxUpdatedAtMs(a));
    });

    function formatDateTime(iso: string): string {
        try {
            return new Intl.DateTimeFormat('vi-VN', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            }).format(new Date(iso));
        } catch {
            return iso;
        }
    }

    function groupActivityDisplay(group: { posts: PostRow[] }): string {
        return formatDateTime(new Date(maxUpdatedAtMs(group)).toISOString());
    }
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
    <div class="mx-auto flex max-w-7xl flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Blog posts</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Các bài được nhóm theo <strong>nhóm bản dịch</strong>; cờ thể hiện ngôn ngữ.
                </p>
            </div>
            <Link
                href={toUrl(posts.create())}
                class="inline-flex h-10 cursor-pointer items-center justify-center rounded-md bg-primary px-4 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90"
            >
                New post
            </Link>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-medium text-muted-foreground">Lọc:</span>
            <Link
                href={toUrl(posts.index())}
                class={cn(
                    'inline-flex h-8 cursor-pointer items-center rounded-full border px-3 text-xs font-medium transition-colors',
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
            <div
                class="overflow-hidden rounded-xl border border-border bg-card text-card-foreground shadow-sm"
            >
                <div
                    class="flex flex-col gap-1 border-b border-border bg-muted/30 px-4 py-3 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <h2 class="text-sm font-semibold tracking-tight">Danh sách nhóm bài viết</h2>
                        <p class="text-xs text-muted-foreground">
                            Ưu tiên nhóm có <strong>cập nhật gần nhất</strong>. Bấm cờ để sửa hoặc tạo bản dịch AI.
                        </p>
                    </div>
                    {#if postPaginator.total != null}
                        <span class="text-xs tabular-nums text-muted-foreground">
                            {postPaginator.total} bản ghi
                        </span>
                    {/if}
                </div>
                <Table>
                    <TableHeader
                        class="sticky top-0 z-10 bg-muted/95 shadow-[0_1px_0_hsl(var(--border))] backdrop-blur-sm [&_tr]:border-b [&_tr]:hover:bg-transparent"
                    >
                        <TableRow>
                            <TableHead class="w-[88px] whitespace-nowrap py-3">Nhóm</TableHead>
                            <TableHead class="w-[138px] whitespace-nowrap py-3">Cập nhật</TableHead>
                            <TableHead class="min-w-[12rem] py-3">Tiêu đề</TableHead>
                            <TableHead class="hidden w-[7.5rem] py-3 lg:table-cell">Danh mục</TableHead>
                            <TableHead class="min-w-[11rem] py-3">Ngôn ngữ</TableHead>
                            <TableHead class="w-[6.5rem] whitespace-nowrap py-3">Trạng thái</TableHead>
                            <TableHead class="w-[15rem] py-3 text-right">Thao tác</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {#each groups as group (group.key)}
                            <TableRow
                                class="cursor-default border-b border-border/80 odd:bg-muted/15 transition-colors hover:bg-muted/40"
                            >
                                <TableCell class="align-top font-mono text-xs text-muted-foreground">
                                    {#if group.translation_group_id}
                                        <span title={group.translation_group_id}
                                            >{shortGroupId(group.translation_group_id)}</span
                                        >
                                    {:else}
                                        <span title="Không gộp nhóm">—</span>
                                    {/if}
                                </TableCell>
                                <TableCell
                                    class="align-top text-xs tabular-nums text-muted-foreground"
                                    title="Mới nhất trong nhóm (theo updated_at)"
                                >
                                    {groupActivityDisplay(group)}
                                </TableCell>
                                <TableCell class="align-top">
                                    <span class="line-clamp-2 font-medium leading-snug" title={primaryPost(group).title}
                                        >{primaryPost(group).title}</span
                                    >
                                    <div class="mt-1 font-mono text-[11px] text-muted-foreground">
                                        /{primaryPost(group).slug}
                                    </div>
                                </TableCell>
                                <TableCell
                                    class="hidden align-top text-muted-foreground lg:table-cell lg:max-w-[10rem] lg:truncate"
                                    title={primaryPost(group).category?.name ?? ''}
                                >
                                    {primaryPost(group).category?.name ?? '—'}
                                </TableCell>
                                <TableCell class="align-top">
                                    <div class="flex flex-wrap gap-1.5">
                                        {#each localeColumns as locale (locale)}
                                            {@const localePost = postByLocale(group, locale)}
                                            <button
                                                type="button"
                                                class={cn(
                                                    'inline-flex h-8 cursor-pointer items-center gap-1 rounded-full border px-2 text-xs font-medium transition disabled:cursor-not-allowed disabled:opacity-60',
                                                    localePost
                                                        ? 'border-emerald-200 bg-emerald-50 text-emerald-800 hover:bg-emerald-100'
                                                        : 'border-destructive/25 bg-destructive/5 text-destructive hover:bg-destructive/10',
                                                )}
                                                disabled={processingLocaleByGroup[group.key] != null}
                                                onclick={() => onLocaleClick(group, locale)}
                                            >
                                                <LocaleFlag locale={locale} size="sm" />
                                                <span class="uppercase">{locale}</span>
                                                {#if localePost}
                                                    <Check class="h-3.5 w-3.5 shrink-0" />
                                                {:else}
                                                    <X class="h-3.5 w-3.5 shrink-0" />
                                                {/if}
                                            </button>
                                        {/each}
                                    </div>
                                </TableCell>
                                <TableCell class="align-top">
                                    {#if primaryPost(group).status === 'published'}
                                        <Badge
                                            variant="outline"
                                            class="border-emerald-300/80 bg-emerald-50 text-emerald-900"
                                        >
                                            Xuất bản
                                        </Badge>
                                    {:else}
                                        <Badge
                                            variant="outline"
                                            class="border-amber-300/80 bg-amber-50 text-amber-950"
                                        >
                                            Bản nháp
                                        </Badge>
                                    {/if}
                                </TableCell>
                                <TableCell class="align-top text-right">
                                    <div class="flex flex-wrap justify-end gap-1.5">
                                        <Link
                                            href={toUrl(posts.edit({ post: primaryPost(group).id }))}
                                            class="inline-flex h-8 cursor-pointer items-center rounded-md px-2 text-sm font-medium text-primary underline-offset-4 hover:underline"
                                        >
                                            Sửa
                                        </Link>
                                        {#if missingLocales(group.locales).length > 0}
                                            <button
                                                type="button"
                                                class="inline-flex h-8 cursor-pointer items-center rounded-md border border-primary/40 bg-primary/5 px-2 text-sm font-medium text-primary hover:bg-primary/10 disabled:cursor-not-allowed disabled:opacity-60"
                                                disabled={processingLocaleByGroup[group.key] !== null}
                                                onclick={() => autoTranslateMissing(group)}
                                            >
                                                Dịch tự động
                                            </button>
                                            <select
                                                class="h-8 cursor-pointer rounded-md border border-input bg-background px-2 text-xs"
                                                value={selectedMissingLocale(group)}
                                                onchange={(event) =>
                                                    (selectedLocaleByGroup[group.key] = (
                                                        event.currentTarget as HTMLSelectElement
                                                    ).value)}
                                                disabled={processingLocaleByGroup[group.key] != null}
                                            >
                                                {#each missingLocales(group.locales) as locale (locale)}
                                                    <option value={locale}>{locale.toUpperCase()}</option>
                                                {/each}
                                            </select>
                                            <button
                                                type="button"
                                                class="inline-flex h-8 cursor-pointer items-center rounded-md border border-border px-2 text-sm font-medium hover:bg-muted disabled:cursor-not-allowed disabled:opacity-60"
                                                disabled={processingLocaleByGroup[group.key] != null}
                                                onclick={() => addLocale(group)}
                                            >
                                                Thêm
                                            </button>
                                        {/if}
                                        <button
                                            type="button"
                                            class="inline-flex h-8 cursor-pointer items-center rounded-md px-2 text-sm font-medium text-destructive hover:underline"
                                            onclick={() => remove(primaryPost(group).id)}
                                        >
                                            Xóa
                                        </button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        {/each}
                    </TableBody>
                </Table>
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
                                'inline-flex min-w-9 cursor-pointer items-center justify-center rounded-md border px-2 py-1.5 text-sm transition-colors',
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
