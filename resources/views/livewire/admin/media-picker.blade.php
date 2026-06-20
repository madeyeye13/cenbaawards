<div>
    @if($show)
    <div class="fixed inset-0 z-[200] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.6);" wire:click.self="close">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-4xl max-h-[85vh] flex flex-col overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <div>
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Select Media</h3>
                    <p class="text-xs text-gray-400 dark:text-neutral-500">{{ $multiple ? 'Pick one or more images' : 'Pick an image' }}</p>
                </div>
                <button wire:click="close" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-neutral-300 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Toolbar --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 px-6 py-3 border-b border-gray-100 dark:border-neutral-800">
                {{-- Folder filter --}}
                <select wire:model.live="currentFolder"
                        class="px-3 py-2 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-700 dark:text-neutral-300 focus:outline-none focus:border-red-500">
                    <option value="">All Media</option>
                    @foreach($folders as $folder)
                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                    @endforeach
                </select>

                {{-- Search --}}
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search..."
                           class="w-full pl-9 pr-4 py-2 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-500">
                </div>

                {{-- Upload --}}
                <label class="cursor-pointer px-4 py-2 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors text-center whitespace-nowrap">
                    Upload New
                    <input type="file" wire:model="uploads" multiple accept="image/*" class="hidden">
                </label>
            </div>

            {{-- Grid --}}
            <div class="flex-1 overflow-y-auto p-6">

                <div wire:loading.flex wire:target="uploads" class="items-center justify-center py-4 mb-4">
                    <svg class="animate-spin w-6 h-6 text-red-700 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-neutral-400">Uploading...</span>
                </div>

                @if($media->count() > 0)
                <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-3">
                    @foreach($media as $item)
                    <button wire:click="pick({{ $item->id }})"
                            class="group relative aspect-square bg-gray-100 dark:bg-neutral-800 rounded-lg overflow-hidden border-2 transition-all
                                   {{ in_array($item->id, $picked) ? 'border-red-600 ring-2 ring-red-200 dark:ring-red-900' : 'border-transparent hover:border-gray-300 dark:hover:border-neutral-600' }}">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->alt }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                        @if(in_array($item->id, $picked))
                        <div class="absolute top-1.5 right-1.5 w-5 h-5 bg-red-600 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        @endif
                    </button>
                    @endforeach
                </div>

                <div class="pt-4">{{ $media->links() }}</div>
                @else
                <div class="py-16 text-center">
                    <p class="text-sm text-gray-400 dark:text-neutral-500">No images found. Upload some to get started.</p>
                </div>
                @endif

            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 dark:border-neutral-800">
                <p class="text-xs text-gray-400 dark:text-neutral-500">{{ count($picked) }} selected</p>
                <div class="flex items-center gap-2">
                    <button wire:click="close" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Cancel</button>
                    <button wire:click="confirm" @disabled(count($picked) === 0)
                            class="px-5 py-2.5 bg-red-800 hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-semibold rounded-lg transition-colors">
                        Use Selected
                    </button>
                </div>
            </div>

        </div>
    </div>
    @endif
</div>