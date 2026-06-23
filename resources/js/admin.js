import './bootstrap';

import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';
import Placeholder from '@tiptap/extension-placeholder';

// ===== Dark mode theme management =====
const theme = {
    dark: localStorage.getItem('adminTheme') === 'dark',
    init() { this.applyTheme(); },
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

/// ===== TipTap Editor =====
// Global registry to store editor instances
window._tiptapRegistry = window._tiptapRegistry || {};

document.addEventListener('alpine:init', () => {
    Alpine.data('tiptapEditor', (initialContent, editorId) => {
        // ✅ CRITICAL: Use a local variable, NOT a component property
        // Alpine wraps component properties in Proxies, which breaks TipTap transactions
        // See: https://tiptap.dev/docs/editor/getting-started/install/alpine
        let editor;

        return {
            // Track editor readiness (this CAN be a reactive property)
            isEditorReady: false,
            updatedAt: Date.now(), // For forcing Alpine reactivity
            
            init() {
                // Check if editor already exists in registry
                if (window._tiptapRegistry[editorId]) {
                    editor = window._tiptapRegistry[editorId];
                    this.isEditorReady = true;
                    
                    // Re-attach to the current DOM node
                    const host = this.$refs.editor;
                    if (host && editor.options.element && !host.contains(editor.options.element)) {
                        host.innerHTML = '';
                        host.appendChild(editor.options.element);
                    }
                    return;
                }

                // Create new editor instance
                const host = this.$refs.editor;
                host.innerHTML = '';
                const mount = document.createElement('div');
                host.appendChild(mount);

                const _this = this; // Capture 'this' for use in callbacks

                editor = new Editor({
                    element: mount,
                    extensions: [
                        StarterKit.configure({ heading: { levels: [2, 3, 4] } }),
                        Image.configure({ 
                            HTMLAttributes: { 
                                class: 'editor-image', 
                                loading: 'lazy' 
                            } 
                        }),
                        Placeholder.configure({ 
                            placeholder: 'Start writing your article…' 
                        }),
                    ],
                    content: initialContent || '',
                    editorProps: { 
                        attributes: { class: 'prose-editor' }
                    },
                    onCreate({ editor }) {
                        // Mark editor as ready
                        _this.isEditorReady = true;
                        _this.updatedAt = Date.now();
                    },
                    onUpdate({ editor }) {
                        // Update Livewire component with editor content
                        _this.$wire.set('body', editor.getHTML(), false);
                    },
                    onSelectionUpdate() {
                        // Force Alpine to rerender on selection change (for toolbar isActive states)
                        _this.updatedAt = Date.now();
                    },
                });

                // Store in global registry for reuse
                window._tiptapRegistry[editorId] = editor;

                // Listen for image insertion from media picker
                this.$wire.on('insert-editor-image', (event) => {
                    const url = event.url || (event.detail && event.detail.url) || (event[0] && event[0].url);
                    if (url && editor && editor.isActive) {
                        try {
                            editor.chain().focus().setImage({ src: url }).run();
                        } catch (error) {
                            console.warn('Failed to insert image:', error);
                        }
                    }
                });
            },

            destroy() {
                if (editor) {
                    editor.destroy();
                }
            },

            // ✅ Execute editor commands - uses local editor variable
            toggle(command, ...args) {
                if (!editor || !this.isEditorReady) {
                    return;
                }
                try {
                    editor.chain().focus()[command](...args).run();
                    this.updatedAt = Date.now(); // Force Alpine update
                } catch (error) {
                    console.warn(`Command '${command}' failed:`, error);
                }
            },

            // ✅ Check if format is active - uses local editor variable
            isActive(name, attrs = {}) {
                if (!editor || !editor.isActive) {
                    return false;
                }
                try {
                    return editor.isActive(name, attrs);
                } catch (error) {
                    console.warn(`isActive('${name}') failed:`, error);
                    return false;
                }
            },

            // ✅ Set link - uses local editor variable
            setLink() {
                if (!editor || !this.isEditorReady) {
                    return;
                }
                const url = window.prompt('Enter URL:');
                if (url) {
                    try {
                        editor.chain().focus().setLink({ href: url }).run();
                        this.updatedAt = Date.now();
                    } catch (error) {
                        console.warn('Failed to set link:', error);
                    }
                } else if (url === '') {
                    try {
                        editor.chain().focus().unsetLink().run();
                        this.updatedAt = Date.now();
                    } catch (error) {
                        console.warn('Failed to unset link:', error);
                    }
                }
            },
        };
    });
});