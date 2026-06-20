import './bootstrap';

import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
import Placeholder from '@tiptap/extension-placeholder';

// ===== Dark mode theme management =====
const theme = {
    dark: localStorage.getItem('adminTheme') === 'dark',

    init() {
        this.applyTheme();
    },

    applyTheme() {
        if (this.dark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    },

    toggle() {
        this.dark = !this.dark;
        localStorage.setItem('adminTheme', this.dark ? 'dark' : 'light');
        this.applyTheme();
    }
};

theme.init();

function setupAlpineStore() {
    if (typeof Alpine !== 'undefined' && typeof Alpine.store === 'function') {
        try {
            Alpine.store('theme', theme);
        } catch (e) {
            console.warn('Alpine store setup failed:', e);
        }
    }
}

setupAlpineStore();
document.addEventListener('alpine:init', setupAlpineStore);

// ===== TipTap Editor =====
document.addEventListener('alpine:init', () => {
    Alpine.data('tiptapEditor', (initialContent) => ({
        editor: null,

        init() {
            const element = this.$refs.editor;

            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit.configure({
                        heading: { levels: [2, 3, 4] },
                    }),
                    Image.configure({
                        HTMLAttributes: { class: 'editor-image', loading: 'lazy' },
                    }),
                    Link.configure({
                        openOnClick: false,
                        HTMLAttributes: { rel: 'noopener noreferrer', target: '_blank' },
                    }),
                    Placeholder.configure({
                        placeholder: 'Start writing your article…',
                    }),
                ],
                content: initialContent || '',
                editorProps: {
                    attributes: { class: 'prose-editor focus:outline-none' },
                },
                onUpdate: ({ editor }) => {
                    this.$wire.set('body', editor.getHTML(), false);
                },
            });

            // Receive images picked from the MediaPicker
            this.$wire.on('insert-editor-image', (event) => {
                const url = event.url || (event.detail && event.detail.url) || (event[0] && event[0].url);
                if (url) {
                    this.editor.chain().focus().setImage({ src: url }).run();
                }
            });

            // Sync if Livewire resets the field (e.g. after edit load)
            this.$wire.on('set-editor-content', (event) => {
                const html = event.html || (event.detail && event.detail.html) || (event[0] && event[0].html);
                if (this.editor && typeof html === 'string') {
                    this.editor.commands.setContent(html);
                }
            });
        },

        destroy() {
            if (this.editor) this.editor.destroy();
        },

        toggle(command, ...args) {
            this.editor.chain().focus()[command](...args).run();
        },
        isActive(name, attrs = {}) {
            return this.editor && this.editor.isActive(name, attrs);
        },
        setLink() {
            const url = window.prompt('Enter URL:');
            if (url) this.editor.chain().focus().setLink({ href: url }).run();
        },
        unsetLink() {
            this.editor.chain().focus().unsetLink().run();
        },
    }));
});