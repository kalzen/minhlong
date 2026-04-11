<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import Globe from 'lucide-svelte/icons/globe';
    import LayoutGrid from 'lucide-svelte/icons/layout-grid';
    import type { Snippet } from 'svelte';
    import AppLogo from '@/components/AppLogo.svelte';
    import NavFooter from '@/components/NavFooter.svelte';
    import NavMain from '@/components/NavMain.svelte';
    import NavUser from '@/components/NavUser.svelte';
    import {
        Sidebar,
        SidebarContent,
        SidebarFooter,
        SidebarHeader,
        SidebarMenu,
        SidebarMenuButton,
        SidebarMenuItem,
    } from '@/components/ui/sidebar';
    import { toUrl } from '@/lib/utils';
    import admin from '@/routes/admin';
    import { dashboard } from '@/routes';
    import FileStack from 'lucide-svelte/icons/file-stack';
    import ImageIcon from 'lucide-svelte/icons/image';
    import Inbox from 'lucide-svelte/icons/inbox';
    import Newspaper from 'lucide-svelte/icons/newspaper';
    import PanelsTopLeft from 'lucide-svelte/icons/panels-top-left';
    import Settings from 'lucide-svelte/icons/settings';
    import type { NavItem } from '@/types';

    let {
        children,
    }: {
        children?: Snippet;
    } = $props();

    const mainNavItems: NavItem[] = [
        {
            title: 'Dashboard',
            href: dashboard(),
            icon: LayoutGrid,
        },
        {
            title: 'Posts',
            href: admin.posts.index(),
            icon: Newspaper,
        },
        {
            title: 'Projects',
            href: admin.projects.index(),
            icon: PanelsTopLeft,
        },
        {
            title: 'Library',
            href: admin.libraryDocuments.index(),
            icon: FileStack,
        },
        {
            title: 'Contacts',
            href: admin.contacts.index(),
            icon: Inbox,
        },
        {
            title: 'Hình ảnh website',
            href: admin.siteMedia.index(),
            icon: ImageIcon,
        },
        {
            title: 'Site settings',
            href: '/settings/general',
            icon: Settings,
        },
    ];

    const footerNavItems: NavItem[] = [
        {
            title: 'Minh Long Group',
            href: '/',
            icon: Globe,
            openInNewTab: false,
        },
    ];
</script>

<Sidebar collapsible="icon" variant="inset">
    <SidebarHeader>
        <SidebarMenu>
            <SidebarMenuItem>
                <SidebarMenuButton size="lg" asChild>
                    {#snippet children(props)}
                        <Link
                            {...props}
                            href={toUrl(dashboard())}
                            class={props.class}
                        >
                            <AppLogo />
                        </Link>
                    {/snippet}
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarHeader>

    <SidebarContent>
        <NavMain items={mainNavItems} />
    </SidebarContent>

    <SidebarFooter>
        <NavFooter items={footerNavItems} />
        <NavUser />
    </SidebarFooter>
</Sidebar>
{@render children?.()}
