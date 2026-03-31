<script lang="ts">
    import { onDestroy, onMount } from 'svelte';
    import { Editor } from '@tiptap/core';
    import StarterKit from '@tiptap/starter-kit';

    let {
        value = $bindable(''),
        class: className = '',
        onContentChange,
    }: {
        value?: string;
        class?: string;
        onContentChange?: (html: string) => void;
    } = $props();

    let el: HTMLDivElement | undefined = $state();
    let editor: Editor | undefined;

    onMount(() => {
        if (!el) {
            return;
        }

        editor = new Editor({
            element: el,
            extensions: [StarterKit],
            content: value || '<p></p>',
            editorProps: {
                attributes: {
                    class: 'prose prose-sm dark:prose-invert max-w-none min-h-[220px] px-3 py-2 focus:outline-none',
                },
            },
            onUpdate: ({ editor: ed }) => {
                value = ed.getHTML();
                onContentChange?.(value);
            },
        });
    });

    onDestroy(() => {
        editor?.destroy();
    });
</script>

<div class="rounded-md border border-input bg-background {className}">
    <div bind:this={el} class="tiptap-editor min-h-[220px]"></div>
</div>
