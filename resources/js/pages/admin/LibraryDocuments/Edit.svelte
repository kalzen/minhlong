<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import libraryDocuments from '@/routes/admin/library-documents';
    import type { BreadcrumbItem } from '@/types';

    let {
        document,
    }: {
        document: {
            id: number;
            title: string;
            library_category: string;
            is_public: boolean;
            sort_order: number;
            file_name: string | undefined;
        } | null;
    } = $props();

    const form = useForm({
        title: document?.title ?? '',
        library_category: document?.library_category ?? 'profile',
        is_public: document?.is_public ?? true,
        sort_order: document?.sort_order ?? 0,
        file: null as File | null,
    });

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(libraryDocuments.index()) },
        { title: 'Library', href: toUrl(libraryDocuments.index()) },
        { title: document ? 'Edit' : 'Upload', href: '#' },
    ];

    function submit(e: Event) {
        e.preventDefault();
        if (document?.id) {
            form
                .transform((data) => ({ ...data, _method: 'put' }))
                .post(libraryDocuments.update.url({ library_document: document.id }), {
                    forceFormData: true,
                });
        } else {
            form.post(libraryDocuments.store.url(), { forceFormData: true });
        }
    }
</script>

<AppHead title={document ? 'Edit document' : 'Upload document'} />

<AppLayout {breadcrumbs}>
    <form class="mx-auto flex max-w-lg flex-col gap-4 p-4" onsubmit={submit}>
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{document ? 'Edit document' : 'Upload document'}</h1>
            <Link href={toUrl(libraryDocuments.index())} class="text-sm underline">Back</Link>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="title">Title</label>
            <input
                id="title"
                class="rounded-md border border-input px-3 py-2 text-sm"
                bind:value={$form.title}
                required
            />
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="library_category">Category</label>
            <select
                id="library_category"
                class="rounded-md border border-input px-3 py-2 text-sm"
                bind:value={$form.library_category}
            >
                <option value="profile">profile</option>
                <option value="report">report</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <input id="is_public" type="checkbox" bind:checked={$form.is_public} />
            <label class="text-sm" for="is_public">Public download</label>
        </div>

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="sort_order">Sort order</label>
            <input
                id="sort_order"
                type="number"
                class="rounded-md border border-input px-3 py-2 text-sm"
                bind:value={$form.sort_order}
            />
        </div>

        {#if document?.file_name}
            <p class="text-xs text-muted-foreground">Current file: {document.file_name}</p>
        {/if}

        <div class="grid gap-2">
            <label class="text-sm font-medium" for="file">File (csv, xlsx, doc, pdf)</label>
            <input
                id="file"
                type="file"
                class="text-sm"
                onchange={(e) => {
                    const f = e.currentTarget.files?.[0];
                    form.setStore('file', f ?? null);
                }}
            />
        </div>

        {#if Object.keys($form.errors).length > 0}
            <p class="text-sm text-destructive">{JSON.stringify($form.errors)}</p>
        {/if}

        <button
            type="submit"
            class="w-fit rounded-md bg-primary px-4 py-2 text-sm text-primary-foreground"
            disabled={$form.processing}
        >
            Save
        </button>
    </form>
</AppLayout>
