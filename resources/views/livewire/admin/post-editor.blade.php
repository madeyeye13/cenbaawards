<div class="p-6" x-data="tiptapEditor(@js($body))" wire:ignore.self>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.posts.index') }}" wire:navigate class="p-2 text-gray-400 hover:text-gray-700 dark:hover:text-neutral-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $editing ? 'Edit Post' : 'New Post' }}</h1>
                <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">{{ $type === 'press_release' ? 'Press Release' : 'Blog Article' }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <button wire:click="save('draft')" class="px-5 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                <span wire:loading.remove wire:target="save">Save Draft</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
            <button wire:click="save('publish')" class="px-6 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                Publish
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ============ MAIN COLUMN ============ --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Title --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">
                <input wire:model.live.debounce.400ms="title" type="text" placeholder="Post title..."
                       class="w-full text-2xl font-bold bg-transparent text-gray-900 dark:text-white placeholder-gray-300 dark:placeholder-neutral-600 focus:outline-none font-serif">
                @error('title') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror

                {{-- Slug --}}
                <div class="flex items-center gap-2 mt-3 text-sm text-gray-400 dark:text-neutral-500">
                    <span class="text-xs">/blog/</span>
                    <input wire:model.blur="slug" type="text" class="flex-1 bg-transparent border-b border-dashed border-gray-200 dark:border-neutral-700 focus:outline-none focus:border-red-500 text-gray-600 dark:text-neutral-400 text-xs py-1">
                </div>
                @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- EDITOR --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">

                {{-- Toolbar --}}
                <div class="flex flex-wrap items-center gap-1 p-2 border-b border-gray-100 dark:border-neutral-800 bg-gray-50 dark:bg-neutral-800/50">
                    <button type="button" @click="toggle('toggleBold')" :class="isActive('bold') ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors font-bold text-sm">B</button>
                    <button type="button" @click="toggle('toggleItalic')" :class="isActive('italic') ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors italic text-sm">I</button>
                    <button type="button" @click="toggle('toggleStrike')" :class="isActive('strike') ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors line-through text-sm">S</button>

                    <div class="w-px h-6 bg-gray-200 dark:bg-neutral-700 mx-1"></div>

                    <button type="button" @click="toggle('toggleHeading', { level: 2 })" :class="isActive('heading', { level: 2 }) ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="px-2 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-xs font-bold">H2</button>
                    <button type="button" @click="toggle('toggleHeading', { level: 3 })" :class="isActive('heading', { level: 3 }) ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="px-2 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-xs font-bold">H3</button>
                    <button type="button" @click="toggle('toggleHeading', { level: 4 })" :class="isActive('heading', { level: 4 }) ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="px-2 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-xs font-bold">H4</button>

                    <div class="w-px h-6 bg-gray-200 dark:bg-neutral-700 mx-1"></div>

                    <button type="button" @click="toggle('toggleBulletList')" :class="isActive('bulletList') ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors" title="Bullet list">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <button type="button" @click="toggle('toggleOrderedList')" :class="isActive('orderedList') ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-xs font-bold">1.</button>
                    <button type="button" @click="toggle('toggleBlockquote')" :class="isActive('blockquote') ? 'bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300' : 'text-gray-600 dark:text-neutral-300'" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-lg">"</button>

                    <div class="w-px h-6 bg-gray-200 dark:bg-neutral-700 mx-1"></div>

                    <button type="button" @click="setLink()" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-gray-600 dark:text-neutral-300" title="Add link">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </button>

                    {{-- Insert image from media library --}}
                    <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'inline-image', multiple: false })" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200 dark:hover:bg-neutral-700 transition-colors text-gray-600 dark:text-neutral-300" title="Insert image">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </button>
                </div>

                {{-- Editor mount point --}}
                <div wire:ignore>
                    <div x-ref="editor"></div>
                </div>
                @error('body') <p class="text-red-500 text-xs p-3">{{ $message }}</p> @enderror
            </div>

            {{-- Excerpt --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Excerpt <span class="font-normal normal-case text-gray-400">(optional — used in listings &amp; meta)</span></label>
                <textarea wire:model="excerpt" rows="3" placeholder="A short summary..." class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 resize-none"></textarea>
                @error('excerpt') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- SEO --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5" x-data="{ open: false }">
                <button type="button" @click="open = !open" class="w-full flex items-center justify-between">
                    <span class="text-sm font-bold text-gray-900 dark:text-white">SEO Settings</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-cloak class="mt-4 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Meta Title</label>
                        <input wire:model="meta_title" type="text" placeholder="Defaults to post title" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Meta Description</label>
                        <textarea wire:model="meta_description" rows="2" placeholder="Defaults to excerpt" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Social Share Image (OG)</label>
                        @if($og_image_url)
                        <div class="flex items-center gap-3">
                            <img src="{{ $og_image_url }}" class="w-24 h-16 object-cover rounded" alt="">
                            <button type="button" wire:click="removeOgImage" class="text-red-600 text-xs font-semibold">Remove</button>
                        </div>
                        @else
                        <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'og-image', multiple: false })" class="px-4 py-2 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800">Select Image</button>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- ============ SIDEBAR ============ --}}
        <div class="space-y-5">

            {{-- Type --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-3">Post Type</label>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" wire:click="$set('type', 'blog')" class="px-3 py-2.5 rounded-lg text-xs font-semibold transition-colors {{ $type === 'blog' ? 'bg-red-800 text-white' : 'bg-gray-50 dark:bg-neutral-800 text-gray-600 dark:text-neutral-400' }}">Blog</button>
                    <button type="button" wire:click="$set('type', 'press_release')" class="px-3 py-2.5 rounded-lg text-xs font-semibold transition-colors {{ $type === 'press_release' ? 'bg-red-800 text-white' : 'bg-gray-50 dark:bg-neutral-800 text-gray-600 dark:text-neutral-400' }}">Press Release</button>
                </div>
            </div>

            {{-- Featured image --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-3">Featured Image</label>
                @if($featured_image_url)
                <div class="relative group">
                    <img src="{{ $featured_image_url }}" class="w-full aspect-video object-cover rounded-lg" alt="">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center gap-2">
                        <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'featured-image', multiple: false })" class="px-3 py-1.5 bg-white text-gray-900 text-xs font-semibold rounded-md">Change</button>
                        <button type="button" wire:click="removeFeaturedImage" class="px-3 py-1.5 bg-red-700 text-white text-xs font-semibold rounded-md">Remove</button>
                    </div>
                </div>
                @else
                <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'featured-image', multiple: false })" class="w-full aspect-video border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-lg flex flex-col items-center justify-center hover:border-red-400 transition-colors">
                    <svg class="w-8 h-8 text-gray-300 dark:text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs text-gray-500 dark:text-neutral-400">Select from library</span>
                </button>
                @endif
            </div>

            {{-- Publish settings --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5 space-y-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Status</label>
                    <select wire:model="status" class="w-full px-3 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Publish Date</label>
                    <input wire:model="published_at" type="datetime-local" class="w-full px-3 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                </div>
            </div>

            {{-- Category --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-3">Category</label>
                <select wire:model="category_id" class="w-full px-3 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    <option value="">— Select —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tags --}}
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-3">Tags</label>
                <div class="flex gap-2 mb-3">
                    <input wire:model="newTag" wire:keydown.enter.prevent="addTag" type="text" placeholder="Add tag..." class="flex-1 px-3 py-2 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    <button type="button" wire:click="addTag" class="px-3 py-2 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold rounded-lg">Add</button>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($allTags as $tag)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 dark:bg-neutral-800 text-gray-700 dark:text-neutral-300 text-xs rounded-full">
                        {{ $tag->name }}
                        <button type="button" wire:click="removeTag({{ $tag->id }})" class="text-gray-400 hover:text-red-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- Media Picker (shared for featured, og, inline) --}}
    <livewire:admin.media-picker name="featured-image" />
    <livewire:admin.media-picker name="og-image" />
    <livewire:admin.media-picker name="inline-image" />

</div>