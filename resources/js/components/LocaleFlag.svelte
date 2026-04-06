<script lang="ts">
    import { cn } from '@/lib/utils';
    import { localeFlagSrc, localeTitle } from '@/lib/locale-flags';

    let {
        locale,
        size = 'md',
        class: className = '',
    }: {
        locale: string;
        size?: 'sm' | 'md' | 'lg';
        class?: string;
    } = $props();

    const src = $derived(localeFlagSrc(locale));
    const sizeClass = $derived(
        size === 'sm' ? 'size-5' : size === 'lg' ? 'size-8' : 'size-6',
    );
</script>

{#if src}
    <img
        src={src}
        alt=""
        title={localeTitle(locale)}
        class={cn(
            'shrink-0 rounded-full object-cover ring-1 ring-border shadow-sm',
            sizeClass,
            className,
        )}
    />
{:else}
    <span
        class={cn(
            'inline-flex shrink-0 items-center justify-center rounded-full bg-muted font-semibold uppercase ring-1 ring-border',
            size === 'sm' ? 'size-5 text-[9px]' : size === 'lg' ? 'size-8 text-xs' : 'size-6 text-[10px]',
            className,
        )}
        title={localeTitle(locale)}
    >
        {locale.slice(0, 2)}
    </span>
{/if}
