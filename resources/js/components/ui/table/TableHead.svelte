<script lang="ts">
    import { cn } from '@/lib/utils';
    import type { Snippet } from 'svelte';

    let {
        class: className = '',
        children,
    }: {
        class?: string;
        children?: Snippet;
    } = $props();
</script>

<th
    data-slot="table-head"
    class={cn(
        'h-11 px-3 text-left align-middle text-xs font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 md:px-4',
        className,
    )}
>
    {@render children?.()}
</th>
