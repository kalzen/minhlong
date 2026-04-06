<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import contacts from '@/routes/admin/contacts';
    import type { BreadcrumbItem } from '@/types';

    let {
        contacts: contactPaginator,
    }: {
        contacts: {
            data: {
                id: number;
                name: string;
                email: string;
                status: string;
                created_at: string;
            }[];
        };
    } = $props();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Admin', href: toUrl(admin.home()) },
        { title: 'Contact inbox', href: toUrl(contacts.index()) },
    ];
</script>

<AppHead title="Contact inbox" />

<AppLayout {breadcrumbs}>
    <div class="flex flex-col gap-4 p-4">
        <h1 class="text-xl font-semibold">Contact submissions</h1>
        <div class="overflow-x-auto rounded-lg border">
            <table class="w-full text-left text-sm">
                <thead class="bg-muted/50">
                    <tr>
                        <th class="p-2">Name</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Received</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    {#each contactPaginator.data as row (row.id)}
                        <tr class="border-t">
                            <td class="p-2">{row.name}</td>
                            <td class="p-2">{row.email}</td>
                            <td class="p-2">{row.status}</td>
                            <td class="p-2">{row.created_at}</td>
                            <td class="p-2">
                                <Link href={toUrl(contacts.show({ contact: row.id }))} class="text-primary underline">
                                    View
                                </Link>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        </div>
    </div>
</AppLayout>
