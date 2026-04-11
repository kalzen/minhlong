<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
    import AppHead from '@/components/AppHead.svelte';
    import { toUrl } from '@/lib/utils';
    import { dashboard, login } from '@/routes';

    const auth = $derived($page.props.auth);
</script>

<AppHead title="Minh Long Group">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</AppHead>

<div
    class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
>
    <header
        class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl"
    >
        <nav class="flex items-center justify-end gap-4">
            {#if auth.user}
                <Link
                    href={toUrl(dashboard())}
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
            {:else}
                <Link
                    href={toUrl(login())}
                    class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                >
                    Log in
                </Link>
            {/if}
        </nav>
    </header>
    <div
        class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
    >
        <main
            class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row"
        >
            <div
                class="flex-1 rounded-br-lg rounded-bl-lg bg-white p-6 pb-12 text-[13px] leading-5 shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] lg:rounded-tl-lg lg:rounded-br-none lg:p-20 dark:bg-[#161615] dark:text-[#EDEDEC] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
            >
                <h1 class="mb-1 text-lg font-semibold">Minh Long Group</h1>
                <p class="mb-6 text-[#706f6c] dark:text-[#A1A09A]">
                    Corporate website and administration. Visit the public site or sign in to manage
                    content.
                </p>
                <ul class="flex flex-col gap-3 text-sm leading-normal">
                    <li>
                        <a
                            href="/"
                            class="inline-flex items-center font-medium text-[#f53003] underline underline-offset-4 dark:text-[#FF4433]"
                        >
                            Public website
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="relative -mb-px flex aspect-[335/200] w-full shrink-0 items-center justify-center rounded-t-lg bg-[#fff2f2] lg:-ml-px lg:mb-0 lg:aspect-auto lg:w-[438px] lg:rounded-t-none lg:rounded-r-lg dark:bg-[#1D0002]"
                role="img"
                aria-label="Minh Long Group"
            >
                <p
                    class="text-center text-2xl font-bold tracking-tight text-[#F53003] dark:text-[#F61500]"
                >
                    Minh Long Group
                </p>
                <div
                    class="absolute inset-0 rounded-t-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] lg:rounded-t-none lg:rounded-r-lg dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
                ></div>
            </div>
        </main>
    </div>
    <div class="hidden h-14.5 lg:block"></div>
</div>
