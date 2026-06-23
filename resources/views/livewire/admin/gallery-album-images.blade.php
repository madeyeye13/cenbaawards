<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.gallery.index') }}" wire:navigate class="p-2 text-gray-400 hover:text-gray-700 dark:hover:text-neutral-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $album->title }}</h1>
                <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">{{ $album->year }} · Add photos from the library and reorder them.</p>
            </div>
        </div>
        <button wire:click="$dispatch('openMediaPicker', { name: 'album-photos', multiple: true })" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Photos
        </button>
    </div>

    @if($images->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($images as $index => $image)
        <div wire:key="img-{{ $image->id }}" class="group relative bg-gray-100 dark:bg-neutral-800 rounded-lg overflow-hidden" style="aspect-ratio: 1/1;">
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}" class="w-full h-full object-cover" loading="lazy">

            {{-- Controls overlay --}}
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3">
                <div class="flex items-center gap-2">
                    <button wire:click="moveUp({{ $image->id }})" class="w-8 h-8 bg-white/90 rounded-full flex items-center justify-center text-gray-800 hover:bg-white" title="Move earlier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button wire:click="moveDown({{ $image->id }})" class="w-8 h-8 bg-white/90 rounded-full flex items-center justify-center text-gray-800 hover:bg-white" title="Move later">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
                <button wire:click="removeImage({{ $image->id }})" wire:confirm="Remove this photo from the album?" class="px-3 py-1.5 bg-red-700 hover:bg-red-600 text-white text-xs font-semibold rounded-md transition-colors">Remove</button>
            </div>

            <span class="absolute top-2 left-2 w-6 h-6 bg-black/60 text-white text-xs rounded-full flex items-center justify-center">{{ $images->firstItem() + $index }}</span>
        </div>
        @endforeach
    </div>

    <div class="mt-6">{{ $images->links() }}</div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No photos yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">Add photos from the Media Library to this album.</p>
        <button wire:click="$dispatch('openMediaPicker', { name: 'album-photos', multiple: true })" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">Add Photos</button>
    </div>
    @endif

    <livewire:admin.media-picker name="album-photos" />

</div>