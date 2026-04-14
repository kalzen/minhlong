<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import { get } from 'svelte/store';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import libraryDocuments from '@/routes/admin/library-documents';
    import type { BreadcrumbItem } from '@/types';

    const LINK_INTERNAL = 'internal';
    const LINK_EXTERNAL = 'external';

    let {
        document,
    }: {
        document: {
            id: number;
            title: string;
            library_category: string;
            link_type: string;
            is_public: boolean;
            sort_order: number;
            file_name: string | undefined;
            external_url: string | null;
        } | null;
    } = $props();

    const form = useForm({
        title: document?.title ?? '',
        library_category: document?.library_category ?? 'profile',
        link_type: document?.link_type ?? LINK_INTERNAL,
        is_public: document?.is_public ?? true,
        sort_order: document?.sort_order ?? 0,
        external_url: document?.external_url ?? '',
        file: null as File | null,
    });

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Library', href: toUrl(libraryDocuments.index()) },
        { title: document ? 'Edit' : 'Upload', href: '#' },
    ];

    function submit(e: Event) {
        e.preventDefault();
        const withPublicFlag = (data: Record<string, unknown>) => ({
            ...data,
            is_public: data.is_public ? 1 : 0,
        });
        if (document?.id) {
            get(form)
                .transform((data) => ({ ...withPublicFlag(data), _method: 'put' }))
                .post(libraryDocuments.update.url({ library_document: document.id }), {
                    forceFormData: true,
                });
        } else {
            get(form).transform(withPublicFlag).post(libraryDocuments.store.url(), { forceFormData: true });
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

        <fieldset class="grid gap-2">
            <legend class="text-sm font-medium">Download source</legend>
            <div class="flex flex-col gap-2 sm:flex-row sm:gap-6">
                <label class="flex cursor-pointer items-center gap-2 text-sm">
                    <input type="radio" name="link_type" value={LINK_INTERNAL} bind:group={$form.link_type} />
                    Internal — upload file on this site
                </label>
                <label class="flex cursor-pointer items-center gap-2 text-sm">
                    <input type="radio" name="link_type" value={LINK_EXTERNAL} bind:group={$form.link_type} />
                    External — link only (e.g. Google Drive)
                </label>
            </div>
        </fieldset>

        {#if $form.link_type === LINK_INTERNAL}
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
                        get(form).setStore('file', f ?? null);
                    }}
                />
                <p class="text-xs text-muted-foreground">
                    Public pages use the site download URL. Replace the file by choosing a new one and saving.
                </p>
            </div>
        {:else}
            <div class="grid gap-2">
                <label class="text-sm font-medium" for="external_url">External URL</label>
                <input
                    id="external_url"
                    type="url"
                    class="rounded-md border border-input px-3 py-2 text-sm"
                    bind:value={$form.external_url}
                    placeholder="https://..."
                />
                <p class="text-xs text-muted-foreground">
                    The public site will open this link directly (new tab). No file is stored on this server.
                </p>
            </div>
        {/if}

        {#if Object.keys($form.errors).length > 0}
            <ul class="list-inside list-disc text-sm text-destructive">
                {#each Object.entries($form.errors) as [key, messages] (key)}
                    <li>{key}: {Array.isArray(messages) ? messages.join(' ') : String(messages)}</li>
                {/each}
            </ul>
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
