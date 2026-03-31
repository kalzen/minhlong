<script lang="ts">
    import { Link } from '@inertiajs/svelte';
    import BookOpen from 'lucide-svelte/icons/book-open';
    import FolderGit2 from 'lucide-svelte/icons/folder-git-2';
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
            title: 'Site images',
            href: admin.siteMedia.index(),
            icon: ImageIcon,
        },
    ];

    const footerNavItems: NavItem[] = [
        {
            title: 'Repository',
            href: 'https://github.com/laravel/svelte-starter-kit',
            icon: FolderGit2,
        },
        {
            title: 'Documentation',
            href: 'https://laravel.com/docs/starter-kits#svelte',
            icon: BookOpen,
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
