<div class="p-6" x-data="{ dragging: false }">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Media Library</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Upload, organise, and manage all your images.</p>
        </div>
        <div class="flex items-center gap-2">
            <button wire:click="toggleSelectMode"
                    class="px-4 py-2.5 text-xs font-semibold tracking-wide uppercase rounded-lg border transition-colors
                           {{ $selectMode ? 'bg-red-800 text-white border-red-800' : 'border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                {{ $selectMode ? 'Cancel' : 'Select' }}
            </button>
            <button wire:click="$set('showFolderModal', true)"
                    class="px-4 py-2.5 text-xs font-semibold tracking-wide uppercase rounded-lg border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                + Folder
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- SIDEBAR — Folders --}}
        <aside class="lg:col-span-1">
            <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-4">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 dark:text-neutral-500 mb-3 px-2">Folders</p>

                <button wire:click="selectFolder(null)"
                        class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition-colors mb-1
                               {{ !$currentFolder ? 'bg-red-50 dark:bg-red-900/20 text-red-800 dark:text-red-300 font-medium' : 'text-gray-600 dark:text-neutral-400 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                    </svg>
                    All Media
                </button>

                @foreach($folders as $folder)
                <div class="group flex items-center gap-1">
                    <button wire:click="selectFolder({{ $folder->id }})"
                            class="flex-1 flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm transition-colors
                                   {{ $currentFolder === $folder->id ? 'bg-red-50 dark:bg-red-900/20 text-red-800 dark:text-red-300 font-medium' : 'text-gray-600 dark:text-neutral-400 hover:bg-gray-50 dark:hover:bg-neutral-800' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        <span class="truncate">{{ $folder->name }}</span>
                    </button>
                    <button wire:click="deleteFolder({{ $folder->id }})"
                            wire:confirm="Delete this folder? Images will move to All Media."
                            class="opacity-0 group-hover:opacity-100 p-1.5 text-gray-400 hover:text-red-600 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>
        </aside>

        {{-- MAIN --}}
        <div class="lg:col-span-3 space-y-5">

            {{-- Upload zone --}}
            <div
                @dragover.prevent="dragging = true"
                @dragleave.prevent="dragging = false"
                @drop.prevent="dragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))"
                :class="dragging ? 'border-red-400 bg-red-50 dark:bg-red-900/10' : 'border-gray-200 dark:border-neutral-700'"
                class="relative border-2 border-dashed rounded-xl p-8 text-center transition-colors bg-white dark:bg-neutral-900"
            >
                <div wire:loading.remove wire:target="uploads, zipFile">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">Drag &amp; drop images here</p>
                    <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">JPG, PNG, WEBP, GIF — or a ZIP archive</p>

                    <div class="flex items-center justify-center gap-3">
                        <label class="cursor-pointer px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
                            Choose Images
                            <input type="file" wire:model="uploads" multiple accept="image/*" class="hidden" x-ref="fileInput">
                        </label>
                        <label class="cursor-pointer px-5 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold tracking-wide uppercase rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">
                            Upload ZIP
                            <input type="file" wire:model="zipFile" accept=".zip" class="hidden">
                        </label>
                    </div>
                </div>

                {{-- Uploading state --}}
                <div wire:loading.flex wire:target="uploads, zipFile" class="flex-col items-center justify-center py-2">
                    <svg class="animate-spin w-8 h-8 text-red-700 mb-3" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-700 dark:text-neutral-300">Processing &amp; optimizing...</p>
                </div>
            </div>

            {{-- Bulk action bar --}}
            @if($selectMode && count($selected) > 0)
            <div class="flex items-center justify-between px-4 py-3 bg-red-800 rounded-xl">
                <p class="text-sm text-white font-medium">{{ count($selected) }} selected</p>
                <button wire:click="deleteSelected"
                        wire:confirm="Delete the selected images permanently?"
                        class="px-4 py-2 bg-white text-red-800 text-xs font-bold tracking-wide uppercase rounded-lg hover:bg-red-50 transition-colors">
                    Delete Selected
                </button>
            </div>
            @endif

            {{-- Search --}}
            <div class="relative">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search images..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-500 transition-colors">
            </div>

            {{-- Grid --}}
            @if($media->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($media as $item)
                <div class="group relative aspect-square bg-gray-100 dark:bg-neutral-800 rounded-lg overflow-hidden border-2 transition-all
                            {{ in_array($item->id, $selected) ? 'border-red-600' : 'border-transparent' }}"
                     @if($selectMode) wire:click="toggleSelect({{ $item->id }})" style="cursor: pointer;" @endif>

                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->alt }}"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">

                    {{-- Select checkbox --}}
                    @if($selectMode)
                    <div class="absolute top-2 left-2 w-5 h-5 rounded flex items-center justify-center
                                {{ in_array($item->id, $selected) ? 'bg-red-600' : 'bg-white/80 border border-gray-300' }}">
                        @if(in_array($item->id, $selected))
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @endif
                    </div>
                    @endif

                    {{-- Hover overlay (non-select mode) --}}
                    @if(!$selectMode)
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 p-2">
                        <p class="text-white text-xs text-center truncate w-full px-1">{{ $item->file_name }}</p>
                        <p class="text-white/60 text-xs">{{ $item->formatted_size }}</p>
                        <button wire:click="deleteSingle({{ $item->id }})"
                                wire:confirm="Delete this image permanently?"
                                class="mt-1 px-3 py-1.5 bg-red-700 hover:bg-red-600 text-white text-xs font-semibold rounded-md transition-colors">
                            Delete
                        </button>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="pt-4">
                {{ $media->links() }}
            </div>
            @else
            {{-- Empty --}}
            <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200 dark:text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No images yet</p>
                <p class="text-xs text-gray-400 dark:text-neutral-500">Upload your first images to get started.</p>
            </div>
            @endif

        </div>
    </div>

    {{-- Create Folder Modal --}}
    @if($showFolderModal)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="$set('showFolderModal', false)">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-md p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Create New Folder</h3>
            <input wire:model="newFolderName" wire:keydown.enter="createFolder" type="text" placeholder="Folder name"
                   class="w-full px-4 py-3 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:border-red-500 mb-2"
                   autofocus>
            @error('newFolderName') <p class="text-red-500 text-xs mb-2">{{ $message }}</p> @enderror
            <div class="flex items-center gap-2 mt-4">
                <button wire:click="createFolder" class="flex-1 px-4 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">Create</button>
                <button wire:click="$set('showFolderModal', false)" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Cancel</button>
            </div>
        </div>
    </div>
    @endif

</div>