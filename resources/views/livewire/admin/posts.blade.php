<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Posts</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Manage blog articles and press releases. Drag rows to reorder.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" wire:navigate
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Post
        </a>
    </div>

    {{-- Filters --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-5">
        <select wire:model.live="typeFilter" class="px-3 py-2.5 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-700 dark:text-neutral-300 focus:outline-none focus:border-red-500">
            <option value="all">All Types</option>
            <option value="blog">Blog</option>
            <option value="press_release">Press Release</option>
        </select>
        <select wire:model.live="statusFilter" class="px-3 py-2.5 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-700 dark:text-neutral-300 focus:outline-none focus:border-red-500">
            <option value="all">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
        <div class="relative flex-1">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search posts..." class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
        </div>
    </div>

    {{-- List --}}
    @if($posts->count() > 0)
    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden"
         x-data="{
            dragId: null,
            order: @js($posts->pluck('id')),
            start(id) { this.dragId = id; },
            over(e, id) { e.preventDefault(); if (this.dragId === id) return; const from = this.order.indexOf(this.dragId); const to = this.order.indexOf(id); this.order.splice(to, 0, this.order.splice(from, 1)[0]); },
            drop() { $wire.updateOrder(this.order); this.dragId = null; }
         }">
        @foreach($posts as $post)
        <div draggable="true"
             x-on:dragstart="start({{ $post->id }})"
             x-on:dragover="over($event, {{ $post->id }})"
             x-on:drop="drop()"
             wire:key="post-{{ $post->id }}"
             class="flex items-center gap-4 p-4 border-b border-gray-50 dark:border-neutral-800 last:border-0 hover:bg-gray-50 dark:hover:bg-neutral-800/50 transition-colors cursor-move">

            <svg class="w-5 h-5 text-gray-300 dark:text-neutral-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M8 6a2 2 0 11-4 0 2 2 0 014 0zM8 12a2 2 0 11-4 0 2 2 0 014 0zM8 18a2 2 0 11-4 0 2 2 0 014 0zM18 6a2 2 0 11-4 0 2 2 0 014 0zM18 12a2 2 0 11-4 0 2 2 0 014 0zM18 18a2 2 0 11-4 0 2 2 0 014 0z"/></svg>

            <div class="w-16 h-12 flex-shrink-0 bg-gray-100 dark:bg-neutral-800 overflow-hidden rounded">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="" class="w-full h-full object-cover" loading="lazy">
                @endif
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold uppercase tracking-wide px-1.5 py-0.5 rounded {{ $post->type === 'press_release' ? 'bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' }}">
                        {{ $post->type === 'press_release' ? 'Press' : 'Blog' }}
                    </span>
                    <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $post->title }}</p>
                </div>
                <p class="text-xs text-gray-400 dark:text-neutral-500 mt-0.5">
                    {{ $post->category?->name ?? 'Uncategorised' }} ·
                    {{ $post->published_at?->format('M d, Y') ?? 'No date' }}
                </p>
            </div>

            <button wire:click="toggleStatus({{ $post->id }})"
                    class="flex-shrink-0 px-3 py-1 rounded-full text-xs font-semibold {{ $post->status === 'published' ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-neutral-800 dark:text-neutral-400' }}">
                {{ ucfirst($post->status) }}
            </button>

            <div class="flex items-center gap-1 flex-shrink-0">
                <a href="{{ route('admin.posts.edit', $post->id) }}" wire:navigate class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>
                <button wire:click="delete({{ $post->id }})" wire:confirm="Delete this post permanently?" class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $posts->links() }}</div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No posts yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">Create your first blog post or press release.</p>
        <a href="{{ route('admin.posts.create') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">New Post</a>
    </div>
    @endif

</div>