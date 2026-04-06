<script lang="ts">
    import { onDestroy, onMount } from 'svelte';
    import { Editor } from '@tiptap/core';
    import Image from '@tiptap/extension-image';
    import Link from '@tiptap/extension-link';
    import StarterKit from '@tiptap/starter-kit';
    import { Button } from '@/components/ui/button';
    import EditorMediaPicker from '@/components/EditorMediaPicker.svelte';
    import Bold from 'lucide-svelte/icons/bold';
    import Heading2 from 'lucide-svelte/icons/heading-2';
    import ImageIcon from 'lucide-svelte/icons/image';
    import Italic from 'lucide-svelte/icons/italic';
    import List from 'lucide-svelte/icons/list';
    import ListOrdered from 'lucide-svelte/icons/list-ordered';
    import Quote from 'lucide-svelte/icons/quote';
    import Redo from 'lucide-svelte/icons/redo';
    import Strikethrough from 'lucide-svelte/icons/strikethrough';
    import Undo from 'lucide-svelte/icons/undo';

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
    let editor: Editor | undefined = $state();
    let mediaPickerOpen = $state(false);

    onMount(() => {
        if (!el) {
            return;
        }

        editor = new Editor({
            element: el,
            extensions: [
                StarterKit.configure({
                    link: false,
                }),
                Link.configure({
                    openOnClick: false,
                    HTMLAttributes: {
                        class: 'text-primary underline underline-offset-2',
                    },
                }),
                Image.configure({
                    HTMLAttributes: {
                        class: 'max-h-[480px] max-w-full rounded-md border border-border object-contain',
                    },
                }),
            ],
            content: value || '<p></p>',
            editorProps: {
                attributes: {
                    class:
                        'prose prose-sm dark:prose-invert max-w-none min-h-[min(60vh,520px)] px-4 py-3 focus:outline-none',
                },
            },
            onUpdate: ({ editor: ed }) => {
                const html = ed.getHTML();
                value = html;
                onContentChange?.(html);
            },
        });
    });

    onDestroy(() => {
        editor?.destroy();
    });

    function insertImageFromLibrary(url: string) {
        editor?.chain().focus().setImage({ src: url }).run();
    }

    function setLink() {
        const previous = editor?.getAttributes('link').href;
        const next = window.prompt('URL liên kết', previous ?? 'https://');
        if (next === null) {
            return;
        }
        if (next === '') {
            editor?.chain().focus().extendMarkRange('link').unsetLink().run();

            return;
        }
        editor?.chain().focus().extendMarkRange('link').setLink({ href: next }).run();
    }
</script>

<div
    class="overflow-hidden rounded-lg border border-input bg-background shadow-sm {className}"
>
    <div
        class="flex flex-wrap items-center gap-0.5 border-b border-border bg-muted/30 p-2"
        role="toolbar"
        aria-label="Định dạng nội dung"
    >
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleBold().run()}
            aria-label="Bold"
        >
            <Bold class="size-4" />
        </Button>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleItalic().run()}
            aria-label="Italic"
        >
            <Italic class="size-4" />
        </Button>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleStrike().run()}
            aria-label="Strikethrough"
        >
            <Strikethrough class="size-4" />
        </Button>
        <span class="mx-1 h-6 w-px bg-border" aria-hidden="true"></span>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleHeading({ level: 2 }).run()}
            aria-label="Heading 2"
        >
            <Heading2 class="size-4" />
        </Button>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleBulletList().run()}
            aria-label="Bullet list"
        >
            <List class="size-4" />
        </Button>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleOrderedList().run()}
            aria-label="Ordered list"
        >
            <ListOrdered class="size-4" />
        </Button>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().toggleBlockquote().run()}
            aria-label="Quote"
        >
            <Quote class="size-4" />
        </Button>
        <span class="mx-1 h-6 w-px bg-border" aria-hidden="true"></span>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={setLink}
            aria-label="Link"
        >
            <span class="text-xs font-semibold">Link</span>
        </Button>
        <Button
            type="button"
            variant="secondary"
            size="sm"
            class="h-8 gap-1 px-2"
            onclick={() => (mediaPickerOpen = true)}
            aria-label="Chèn ảnh từ thư viện"
        >
            <ImageIcon class="size-4" />
            <span class="hidden sm:inline">Thư viện ảnh</span>
        </Button>
        <span class="mx-1 h-6 w-px bg-border" aria-hidden="true"></span>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().undo().run()}
            aria-label="Undo"
        >
            <Undo class="size-4" />
        </Button>
        <Button
            type="button"
            variant="ghost"
            size="sm"
            class="h-8 px-2"
            onclick={() => editor?.chain().focus().redo().run()}
            aria-label="Redo"
        >
            <Redo class="size-4" />
        </Button>
    </div>
    <div bind:this={el} class="tiptap-editor bg-background"></div>
</div>

<EditorMediaPicker bind:open={mediaPickerOpen} onPick={insertImageFromLibrary} />
