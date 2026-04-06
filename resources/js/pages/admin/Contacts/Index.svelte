<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { toUrl } from '@/lib/utils';
    import { Badge } from '@/components/ui/badge';
    import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
    import {
        Table,
        TableBody,
        TableCell,
        TableHead,
        TableHeader,
        TableRow,
    } from '@/components/ui/table';
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
    <div class="mx-auto flex max-w-5xl flex-col gap-6 p-4 md:p-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Contact submissions</h1>
            <p class="mt-1 text-sm text-muted-foreground">Messages from the public contact form.</p>
        </div>

        <Card class="overflow-hidden shadow-sm">
            <CardHeader class="border-b bg-muted/20 py-4">
                <CardTitle class="text-base">Inbox</CardTitle>
            </CardHeader>
            <CardContent class="p-0">
                <Table>
                    <TableHeader>
                        <TableRow class="hover:bg-transparent">
                            <TableHead>Name</TableHead>
                            <TableHead class="hidden sm:table-cell">Email</TableHead>
                            <TableHead class="w-[120px]">Status</TableHead>
                            <TableHead class="hidden md:table-cell w-[180px]">Received</TableHead>
                            <TableHead class="w-[80px] text-right"></TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {#each contactPaginator.data as row (row.id)}
                            <TableRow>
                                <TableCell class="font-medium">{row.name}</TableCell>
                                <TableCell class="hidden text-muted-foreground sm:table-cell">{row.email}</TableCell>
                                <TableCell>
                                    <Badge variant="outline">{row.status}</Badge>
                                </TableCell>
                                <TableCell class="hidden text-sm text-muted-foreground md:table-cell">
                                    {row.created_at}
                                </TableCell>
                                <TableCell class="text-right">
                                    <Link
                                        href={toUrl(contacts.show({ contact: row.id }))}
                                        class="inline-flex h-8 items-center rounded-md px-2 text-sm font-medium text-primary hover:underline"
                                    >
                                        View
                                    </Link>
                                </TableCell>
                            </TableRow>
                        {/each}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </div>
</AppLayout>
