<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Gallery Albums</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Each album holds the photos from a yearly award. Use arrows to reorder.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Album
        </button>
    </div>

    @if($albums->count() > 0)
    <div class="space-y-3">
        @foreach($albums as $index => $album)
        <div wire:key="album-{{ $album->id }}" class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-4 flex items-center gap-4">

            {{-- Reorder --}}
            <div class="flex flex-col">
                <button wire:click="moveUp({{ $album->id }})" @disabled($index === 0 && $albums->onFirstPage())
                        class="p-0.5 text-gray-400 hover:text-red-700 disabled:opacity-30 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                </button>
                <button wire:click="moveDown({{ $album->id }})"
                        class="p-0.5 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </div>

            {{-- Cover --}}
            <div class="w-20 h-16 flex-shrink-0 bg-gray-100 dark:bg-neutral-800 overflow-hidden rounded">
                @if($album->cover_url)
                    <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover" loading="lazy">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold px-2 py-0.5 bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-300 rounded">{{ $album->year }}</span>
                    <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $album->title }}</p>
                </div>
                <p class="text-xs text-gray-400 dark:text-neutral-500 mt-1">{{ $album->images_count }} {{ Str::plural('image', $album->images_count) }}</p>
            </div>

            {{-- Status --}}
            <button wire:click="toggleActive({{ $album->id }})" class="flex-shrink-0 px-3 py-1 rounded-full text-xs font-semibold {{ $album->is_active ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-neutral-800' }}">
                {{ $album->is_active ? 'Active' : 'Hidden' }}
            </button>

            {{-- Actions --}}
            <div class="flex items-center gap-1 flex-shrink-0">
                <a href="{{ route('admin.gallery.album', $album->slug) }}" wire:navigate class="px-3 py-1.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold rounded-md transition-colors">Manage Photos</a>
                <button wire:click="edit({{ $album->id }})" class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </button>
                <button wire:click="delete({{ $album->id }})" wire:confirm="Delete this album and all its photos?" class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5">{{ $albums->links() }}</div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No albums yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">Create your first yearly award album.</p>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">New Album</button>
    </div>
    @endif

    {{-- FORM MODAL --}}
    @if($showForm)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="$set('showForm', false)">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $editingId ? 'Edit Album' : 'New Album' }}</h3>
                <button wire:click="$set('showForm', false)" class="p-2 text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Album Title *</label>
                    <input wire:model="albumTitle" type="text" placeholder="e.g. CenBa Awards 2025" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('albumTitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Year *</label>
                    <input wire:model="year" type="number" min="2000" max="2100" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Cover Image</label>
                    @if($cover_image_url)
                    <div class="flex items-center gap-4">
                        <img src="{{ $cover_image_url }}" class="w-28 h-20 object-cover rounded" alt="">
                        <div class="flex flex-col gap-2">
                            <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'album-cover', multiple: false })" class="px-4 py-2 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-xs font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800">Change</button>
                            <button type="button" wire:click="removeCover" class="px-4 py-2 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-50">Remove</button>
                        </div>
                    </div>
                    @else
                    <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'album-cover', multiple: false })" class="w-full py-6 border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-lg text-center hover:border-red-400 transition-colors">
                        <span class="text-sm text-gray-500 dark:text-neutral-400">Select cover from library</span>
                    </button>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">Optional — defaults to the first photo if left empty.</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Description</label>
                    <textarea wire:model="description" rows="2" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 resize-none"></textarea>
                </div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="w-4 h-4 rounded" style="accent-color: #8B0000;">
                    <span class="text-sm text-gray-700 dark:text-neutral-300">Show on the public website</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-gray-100 dark:border-neutral-800">
                <button wire:click="$set('showForm', false)" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800">Cancel</button>
                <button wire:click="save" class="px-6 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Update' : 'Create' }}</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <livewire:admin.media-picker name="album-cover" />

</div>