<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import TipTapEditor from '@/components/TipTapEditor.svelte';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import projects from '@/routes/admin/projects';
    import type { BreadcrumbItem } from '@/types';

    let {
        project,
        categories,
        locales,
    }: {
        project: {
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
        category_id: project?.category_id ?? null,
        translation_group_id: project?.translation_group_id ?? '',
        locale: project?.locale ?? 'en',
        title: project?.title ?? '',
        slug: project?.slug ?? '',
        excerpt: project?.excerpt ?? '',
        content: project?.content ?? '',
        status: project?.status ?? 'draft',
        published_at: project?.published_at ?? '',
        meta_title: project?.meta_title ?? '',
        meta_description: project?.meta_description ?? '',
        featured: null as File | null,
    });

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Projects', href: toUrl(projects.index()) },
        { title: project ? 'Edit' : 'Create', href: '#' },
    ];

    function submit(e: Event) {
        e.preventDefault();
        if (project?.id) {
            form
                .transform((data) => ({ ...data, _method: 'put' }))
                .post(projects.update.url({ project: project.id }), { forceFormData: true });
        } else {
            form.post(projects.store.url(), { forceFormData: true });
        }
    }
</script>

<AppHead title={project ? 'Edit project' : 'New project'} />

<AppLayout {breadcrumbs}>
    <form class="mx-auto flex max-w-3xl flex-col gap-4 p-4" onsubmit={submit}>
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{project ? 'Edit project' : 'New project'}</h1>
            <Link href={toUrl(projects.index())} class="text-sm text-muted-foreground underline">
                Back
            </Link>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="locale">Locale</label>
            <select
                id="locale"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.locale}
            >
                {#each locales as loc (loc)}
                    <option value={loc}>{loc}</option>
                {/each}
            </select>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="category_id">Category</label>
            <select
                id="category_id"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.category_id}
            >
                <option value={null}>—</option>
                {#each categories as c (c.id)}
                    <option value={c.id}>{c.name}</option>
                {/each}
            </select>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="translation_group_id">Translation group (UUID)</label>
            <input
                id="translation_group_id"
                type="text"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm font-mono"
                bind:value={$form.translation_group_id}
                placeholder="Leave empty to auto-generate on create"
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="title">Title</label>
            <input
                id="title"
                type="text"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.title}
                required
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="slug">Slug</label>
            <input
                id="slug"
                type="text"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.slug}
                required
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="excerpt">Excerpt</label>
            <textarea
                id="excerpt"
                rows="3"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.excerpt}
            ></textarea>
        </div>

        <div class="grid gap-2">
            <span class="text-sm font-medium">Content</span>
            <TipTapEditor
                value={$form.content ?? ''}
                onContentChange={(html) => form.setStore('content', html)}
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="status">Status</label>
            <select
                id="status"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.status}
            >
                <option value="draft">draft</option>
                <option value="published">published</option>
            </select>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="published_at">Published at</label>
            <input
                id="published_at"
                type="datetime-local"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.published_at}
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="meta_title">Meta title</label>
            <input
                id="meta_title"
                type="text"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.meta_title}
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="meta_description">Meta description</label>
            <textarea
                id="meta_description"
                rows="2"
                class="rounded-md border border-input bg-background px-3 py-2 text-sm"
                bind:value={$form.meta_description}
            ></textarea>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="featured">Featured image</label>
            {#if project?.featured_url}
                <p class="text-xs text-muted-foreground">Current: {project.featured_url}</p>
            {/if}
            <input
                id="featured"
                type="file"
                accept="image/*"
                class="text-sm"
                onchange={(e) => {
                    const f = e.currentTarget.files?.[0];
                    form.setStore('featured', f ?? null);
                }}
            />
        </div>

        {#if $form.errors && Object.keys($form.errors).length > 0}
            <div class="rounded-md border border-destructive/50 bg-destructive/10 p-3 text-sm text-destructive">
                {JSON.stringify($form.errors)}
            </div>
        {/if}

        <button
            type="submit"
            class="inline-flex w-fit rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground disabled:opacity-50"
            disabled={$form.processing}
        >
            Save
        </button>
    </form>
</AppLayout>
