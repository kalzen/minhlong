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

<tr
    data-slot="table-row"
    class={cn(
        'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted',
        className,
    )}
>
    {@render children?.()}
</tr>
