<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import { get } from 'svelte/store';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import EditorMediaPicker from '@/components/EditorMediaPicker.svelte';
    import TipTapEditor from '@/components/TipTapEditor.svelte';
    import { Button } from '@/components/ui/button';
    import {
        Card,
        CardContent,
        CardDescription,
        CardHeader,
        CardTitle,
    } from '@/components/ui/card';
    import Sparkles from 'lucide-svelte/icons/sparkles';
    import { Label } from '@/components/ui/label';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import posts from '@/routes/admin/posts';
    import type { BreadcrumbItem } from '@/types';

    let {
        post,
        categories,
        locales,
    }: {
        post: {
            id: number;
            category_id: number | null;
            translation_group_id: string | null;
            locale: string;
            title: string;
            slug: string;
            excerpt: string | null;
            content: string | null;
            status: string;
            published_at: string | null;
            meta_title: string | null;
            meta_description: string | null;
            featured_url: string | null;
        } | null;
        categories: { id: number; name: string; slug: string }[];
        locales: string[];
    } = $props();

    const form = useForm({
        category_id: post?.category_id ?? null,
        translation_group_id: post?.translation_group_id ?? '',
        locale: post?.locale ?? 'en',
        title: post?.title ?? '',
        slug: post?.slug ?? '',
        excerpt: post?.excerpt ?? '',
        content: post?.content ?? '',
        status: post?.status ?? 'draft',
        published_at: post?.published_at ?? '',
        meta_title: post?.meta_title ?? '',
        meta_description: post?.meta_description ?? '',
        featured: null as File | null,
        featured_library_media_id: null as number | null,
    });

    let featuredPickerOpen = $state(false);
    let featuredPreviewFromLibrary = $state<string | null>(null);
    let autoSlugEnabled = $state(!post);
    let seoGenerating = $state(false);
    let seoError = $state<string | null>(null);

    function onFeaturedLibraryPick(sel: { url: string; mediaId: number }) {
        get(form).setStore('featured_library_media_id', sel.mediaId);
        get(form).setStore('featured', null);
        featuredPreviewFromLibrary = sel.url;
    }

    function slugify(input: string): string {
        return input
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    function onTitleInput(value: string) {
        get(form).setStore('title', value);
        if (autoSlugEnabled) {
            get(form).setStore('slug', slugify(value));
        }
    }

    function onSlugInput(value: string) {
        autoSlugEnabled = false;
        get(form).setStore('slug', value);
    }

    async function generateSeoWithAi() {
        seoError = null;
        seoGenerating = true;

        try {
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute('content');

            const response = await fetch('/admin/posts/seo-meta-suggestion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken ?? '',
                    Accept: 'application/json',
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    title: $form.title,
                    excerpt: $form.excerpt,
                    content: $form.content,
                    locale: $form.locale,
                }),
            });

            const payload = await response.json();
            if (!response.ok) {
                seoError = payload?.message ?? 'Không thể tạo SEO bằng AI.';
                return;
            }

            get(form).setStore('meta_title', payload.meta_title ?? '');
            get(form).setStore('meta_description', payload.meta_description ?? '');
        } catch {
            seoError = 'Không thể gọi AI lúc này. Vui lòng thử lại.';
        } finally {
            seoGenerating = false;
        }
    }

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Posts', href: toUrl(posts.index()) },
        { title: post ? 'Edit' : 'Create', href: '#' },
    ];

    function submit(e: Event) {
        e.preventDefault();
        if (post?.id) {
            get(form)
                .transform((data) => ({ ...data, _method: 'put' }))
                .post(posts.update.url({ post: post.id }), { forceFormData: true });
        } else {
            get(form).post(posts.store.url(), { forceFormData: true });
        }
    }
</script>

<AppHead title={post ? 'Edit post' : 'New post'} />

<AppLayout {breadcrumbs}>
    <form class="mx-auto w-full max-w-[min(100%,88rem)] px-4 py-6 md:px-6 lg:px-8" onsubmit={submit}>
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    {post ? 'Chỉnh sửa bài viết' : 'Bài viết mới'}
                </h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Soạn nội dung, chọn ảnh đại diện và SEO. Trong bài có thể chèn ảnh từ thư viện — bấm nút Thư viện ảnh
                    trên thanh công cụ phía trên khung soạn thảo.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <Link
                    href={toUrl(posts.index())}
                    class="inline-flex h-9 items-center rounded-md border border-input bg-background px-4 text-sm font-medium hover:bg-muted/60"
                >
                    Quay lại danh sách
                </Link>
                <Button type="submit" disabled={$form.processing}>
                    {$form.processing ? 'Đang lưu…' : 'Lưu bài viết'}
                </Button>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:items-start">
            <!-- Main column -->
            <div class="flex flex-col gap-6 lg:col-span-8">
                <Card>
                    <CardHeader>
                        <CardTitle>Nội dung chính</CardTitle>
                        <CardDescription>Tiêu đề, đường dẫn và phần mô tả ngắn hiển thị ở danh sách blog.</CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="space-y-2">
                            <Label for="title">Tiêu đề</Label>
                            <input
                                id="title"
                                type="text"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                                value={$form.title}
                                oninput={(e) => onTitleInput(e.currentTarget.value)}
                                required
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="slug">Slug (URL)</Label>
                            <input
                                id="slug"
                                type="text"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm font-mono ring-offset-background focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                                value={$form.slug}
                                oninput={(e) => onSlugInput(e.currentTarget.value)}
                                required
                            />
                            <p class="text-xs text-muted-foreground">
                                {#if autoSlugEnabled}
                                    Slug đang tự cập nhật theo tiêu đề.
                                {:else}
                                    Slug đã chỉnh tay, sẽ không tự đổi theo tiêu đề nữa.
                                {/if}
                            </p>
                        </div>
                        <div class="space-y-2">
                            <Label for="excerpt">Tóm tắt / Excerpt</Label>
                            <textarea
                                id="excerpt"
                                rows="3"
                                class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus-visible:ring-2 focus-visible:ring-ring focus-visible:outline-none"
                                bind:value={$form.excerpt}
                            ></textarea>
                        </div>
                    </CardContent>
                </Card>

                <Card class="overflow-hidden">
                    <CardHeader>
                        <CardTitle>Nội dung bài viết</CardTitle>
                        <CardDescription>
                            Soạn nội dung như trên Word: đoạn văn, tiêu đề, in đậm, liên kết, ảnh minh họa… Bấm
                            <strong>Thư viện ảnh</strong> trên thanh công cụ để chọn ảnh đã có hoặc tải ảnh mới — ảnh
                            được lưu chung để bạn dùng lại cho các bài khác.
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="p-0 sm:p-2">
                        <TipTapEditor
                            value={$form.content ?? ''}
                            onContentChange={(html) => get(form).setStore('content', html)}
                            class="border-0 shadow-none"
                        />
                    </CardContent>
                </Card>
            </div>

            <!-- Sidebar -->
            <div class="flex flex-col gap-6 lg:col-span-4">
                <Card class="lg:sticky lg:top-4">
                    <CardHeader>
                        <CardTitle>Xuất bản & ngôn ngữ</CardTitle>
                        <CardDescription>Trạng thái, thời điểm đăng và ngôn ngữ bài viết.</CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="space-y-2">
                            <Label for="locale">Ngôn ngữ (locale)</Label>
                            <select
                                id="locale"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                                bind:value={$form.locale}
                            >
                                {#each locales as loc (loc)}
                                    <option value={loc}>{loc}</option>
                                {/each}
                            </select>
                        </div>
                        <div class="space-y-2">
                            <Label for="category_id">Danh mục</Label>
                            <select
                                id="category_id"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                                bind:value={$form.category_id}
                            >
                                <option value={null}>— Chưa chọn —</option>
                                {#each categories as c (c.id)}
                                    <option value={c.id}>{c.name}</option>
                                {/each}
                            </select>
                        </div>
                        <div class="space-y-2">
                            <Label for="translation_group_id">Nhóm bản dịch (UUID)</Label>
                            <input
                                id="translation_group_id"
                                type="text"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-xs font-mono"
                                bind:value={$form.translation_group_id}
                                placeholder="Để trống để tự tạo khi thêm mới"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="status">Trạng thái</Label>
                            <select
                                id="status"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                                bind:value={$form.status}
                            >
                                <option value="draft">Bản nháp</option>
                                <option value="published">Đã xuất bản</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <Label for="published_at">Ngày giờ xuất bản</Label>
                            <input
                                id="published_at"
                                type="datetime-local"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                                bind:value={$form.published_at}
                            />
                        </div>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Ảnh đại diện</CardTitle>
                        <CardDescription>
                            Ảnh hiển thị trong danh sách bài trên website và khi bài được chia sẻ (xem trước).
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-3">
                        {#if featuredPreviewFromLibrary ?? post?.featured_url}
                            <div class="overflow-hidden rounded-md border bg-muted/30">
                                <img
                                    src={featuredPreviewFromLibrary ?? post?.featured_url ?? ''}
                                    alt=""
                                    class="max-h-40 w-full object-cover"
                                />
                            </div>
                        {/if}
                        <div class="flex flex-wrap gap-2">
                            <Button type="button" variant="secondary" size="sm" onclick={() => (featuredPickerOpen = true)}>
                                Chọn từ thư viện ảnh
                            </Button>
                        </div>
                        <div class="space-y-2">
                            <Label for="featured">Hoặc tải file từ máy</Label>
                            <input
                                id="featured"
                                type="file"
                                accept="image/*"
                                class="w-full text-sm file:mr-3 file:rounded-md file:border-0 file:bg-primary file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-primary-foreground hover:file:bg-primary/90"
                                onchange={(e) => {
                                    const f = e.currentTarget.files?.[0];
                                    get(form).setStore('featured', f ?? null);
                                    get(form).setStore('featured_library_media_id', null);
                                    featuredPreviewFromLibrary = null;
                                }}
                            />
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Ưu tiên: file tải lên sẽ thay thế ảnh chọn từ thư viện khi lưu.
                        </p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>SEO</CardTitle>
                        <CardDescription>Meta title và mô tả cho công cụ tìm kiếm.</CardDescription>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div class="flex items-center justify-between gap-2 rounded-md border bg-muted/30 p-3">
                            <p class="text-xs text-muted-foreground">Dùng AI để gợi ý thẻ SEO theo title, excerpt, content và locale.</p>
                            <Button
                                type="button"
                                variant="secondary"
                                size="sm"
                                onclick={generateSeoWithAi}
                                disabled={seoGenerating}
                            >
                                <Sparkles class="mr-1 h-4 w-4" />
                                {seoGenerating ? 'Đang tạo...' : 'AI tạo SEO'}
                            </Button>
                        </div>
                        {#if seoError}
                            <p class="text-sm text-red-600">{seoError}</p>
                        {/if}
                        <div class="space-y-2">
                            <Label for="meta_title">Meta title</Label>
                            <input
                                id="meta_title"
                                type="text"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                                bind:value={$form.meta_title}
                                maxlength="255"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="meta_description">Meta description</Label>
                            <textarea
                                id="meta_description"
                                rows="3"
                                class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm"
                                bind:value={$form.meta_description}
                                maxlength="255"
                            ></textarea>
                        </div>
                    </CardContent>
                </Card>

                {#if $form.errors && Object.keys($form.errors).length > 0}
                    <div class="rounded-md border border-destructive/50 bg-destructive/10 p-3 text-sm text-destructive">
                        {JSON.stringify($form.errors)}
                    </div>
                {/if}

                <Button type="submit" class="w-full" size="lg" disabled={$form.processing}>
                    {$form.processing ? 'Đang lưu…' : 'Lưu bài viết'}
                </Button>
            </div>
        </div>
    </form>

    <EditorMediaPicker bind:open={featuredPickerOpen} onPick={onFeaturedLibraryPick} />
</AppLayout>
