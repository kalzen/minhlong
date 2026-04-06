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

<div data-slot="table-container" class="relative w-full overflow-x-auto">
    <table data-slot="table" class={cn('w-full caption-bottom text-sm', className)}>
        {@render children?.()}
    </table>
</div>
