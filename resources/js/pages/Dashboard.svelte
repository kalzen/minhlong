<script lang="ts">
    import AppHead from '@/components/AppHead.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { page } from '@inertiajs/svelte';
    import { dashboard as dashboardRoute } from '@/routes';
    import type { BreadcrumbItem } from '@/types';

    type DashboardPayload = {
        totalVisits: number;
        visitsToday: number;
        totalUsers: number;
        recentActivities: {
            id: number;
            action: string;
            created_at: string;
        }[];
    };

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: dashboardRoute(),
        },
    ];

    const dashboardStats = $derived(
        ($page.props as { dashboard: DashboardPayload }).dashboard,
    );
</script>

<AppHead title="Dashboard" />

<AppLayout {breadcrumbs}>
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="rounded-xl border border-sidebar-border/70 bg-background p-4 dark:border-sidebar-border"
            >
                <p class="text-sm text-muted-foreground">Tổng lượt truy cập</p>
                <p class="mt-2 text-2xl font-semibold">
                    {dashboardStats.totalVisits}
                </p>
            </div>
            <div
                class="rounded-xl border border-sidebar-border/70 bg-background p-4 dark:border-sidebar-border"
            >
                <p class="text-sm text-muted-foreground">Lượt truy cập hôm nay</p>
                <p class="mt-2 text-2xl font-semibold">
                    {dashboardStats.visitsToday}
                </p>
            </div>
            <div
                class="rounded-xl border border-sidebar-border/70 bg-background p-4 dark:border-sidebar-border"
            >
                <p class="text-sm text-muted-foreground">Tổng người dùng</p>
                <p class="mt-2 text-2xl font-semibold">
                    {dashboardStats.totalUsers}
                </p>
            </div>
        </div>
        <div
            class="relative flex-1 rounded-xl border border-sidebar-border/70 bg-background md:min-h-min dark:border-sidebar-border"
        >
            <div class="p-4">
                <h2 class="mb-3 text-base font-semibold">
                    Log hoạt động gần đây
                </h2>
                {#if dashboardStats.recentActivities.length === 0}
                    <p class="text-sm text-muted-foreground">
                        Chưa có hoạt động nào.
                    </p>
                {:else}
                    <ul class="space-y-2 text-sm">
                        {#each dashboardStats.recentActivities as activity (activity.id)}
                            <li class="flex items-center justify-between rounded border px-3 py-2 text-xs">
                                <span>{activity.action}</span>
                                <span class="text-muted-foreground">
                                    {new Date(activity.created_at).toLocaleString()}
                                </span>
                            </li>
                        {/each}
                    </ul>
                {/if}
            </div>
        </div>
    </div>
</AppLayout>
