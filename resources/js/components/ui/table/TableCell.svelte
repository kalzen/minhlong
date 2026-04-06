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

<td
    data-slot="table-cell"
    class={cn('p-3 align-middle [&:has([role=checkbox])]:pr-0 md:p-4', className)}
>
    {@render children?.()}
</td>
