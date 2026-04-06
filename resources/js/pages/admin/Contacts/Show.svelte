<script lang="ts">
    import { Link, useForm } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import contacts from '@/routes/admin/contacts';
    import type { BreadcrumbItem } from '@/types';

    let {
        contact,
    }: {
        contact: {
            id: number;
            name: string;
            email: string;
            phone: string | null;
            message: string | null;
            status: string;
            ip: string | null;
            created_at: string;
        };
    } = $props();

    const form = useForm({
        status: contact.status,
    });

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Inbox', href: toUrl(contacts.index()) },
        { title: contact.name, href: '#' },
    ];

    function submit(e: Event) {
        e.preventDefault();
        form.patch(contacts.update.url({ contact: contact.id }));
    }
</script>

<AppHead title="Contact #{contact.id}" />

<AppLayout {breadcrumbs}>
    <div class="mx-auto flex max-w-2xl flex-col gap-4 p-4">
        <Link href={toUrl(contacts.index())} class="text-sm underline">← Back</Link>

        <h1 class="text-xl font-semibold">Message from {contact.name}</h1>

        <dl class="grid gap-2 text-sm">
            <dt class="text-muted-foreground">Email</dt>
            <dd>{contact.email}</dd>
            <dt class="text-muted-foreground">Phone</dt>
            <dd>{contact.phone ?? '—'}</dd>
            <dt class="text-muted-foreground">IP</dt>
            <dd>{contact.ip ?? '—'}</dd>
            <dt class="text-muted-foreground">Received</dt>
            <dd>{contact.created_at}</dd>
        </dl>

        <div class="rounded-md border p-3">
            <p class="whitespace-pre-wrap">{contact.message ?? '—'}</p>
        </div>

        <form class="flex flex-col gap-2" onsubmit={submit}>
            <label class="text-sm font-medium" for="status">Status</label>
            <select
                id="status"
                class="rounded-md border border-input px-3 py-2 text-sm"
                bind:value={$form.status}
            >
                <option value="new">new</option>
                <option value="processing">processing</option>
                <option value="done">done</option>
            </select>
            <button type="submit" class="w-fit rounded-md bg-primary px-4 py-2 text-sm text-primary-foreground">
                Update status
            </button>
        </form>
    </div>
</AppLayout>
