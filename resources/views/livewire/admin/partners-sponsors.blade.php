<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Partners &amp; Sponsors</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Manage logos shown across the site. Use the arrows to reorder.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add {{ $tab === 'sponsors' ? 'Sponsor' : 'Partner' }}
        </button>
    </div>

    {{-- Tabs --}}
    <div class="flex items-center gap-2 mb-6 border-b border-gray-100 dark:border-neutral-800">
        <button wire:click="switchTab('partners')" class="px-4 py-2.5 text-sm font-semibold border-b-2 transition-colors {{ $tab === 'partners' ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">Partners</button>
        <button wire:click="switchTab('sponsors')" class="px-4 py-2.5 text-sm font-semibold border-b-2 transition-colors {{ $tab === 'sponsors' ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">Sponsors</button>
    </div>

    @if($items->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($items as $index => $item)
        <div wire:key="ps-{{ $tab }}-{{ $item->id }}"
             class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5 group">

            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-1">
                    <button wire:click="moveUp({{ $item->id }})" @disabled($index === 0)
                            class="p-1 text-gray-400 hover:text-red-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors" title="Move up">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </button>
                    <button wire:click="moveDown({{ $item->id }})" @disabled($index === $items->count() - 1)
                            class="p-1 text-gray-400 hover:text-red-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors" title="Move down">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>
                <button wire:click="toggleActive({{ $item->id }})" class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->is_active ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-neutral-800' }}">
                    {{ $item->is_active ? 'Active' : 'Hidden' }}
                </button>
            </div>

            <div class="h-20 flex items-center justify-center bg-gray-50 dark:bg-neutral-800 mb-4 p-3">
                @if($item->logo)
                    <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->name }}" class="max-h-full max-w-full object-contain" loading="lazy">
                @else
                    <span class="text-xs text-gray-400">No logo</span>
                @endif
            </div>

            <p class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ $item->name }}</p>
            @if($tab === 'sponsors' && $item->tier !== 'general')
            <span class="text-xs text-amber-600 capitalize">{{ $item->tier }} tier</span>
            @endif

            <div class="flex items-center gap-1 mt-4 pt-4 border-t border-gray-50 dark:border-neutral-800">
                <button wire:click="edit({{ $item->id }})" class="flex-1 px-3 py-1.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold rounded-md hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Edit</button>
                <button wire:click="delete({{ $item->id }})" wire:confirm="Delete this {{ rtrim($tab, 's') }}?" class="p-1.5 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No {{ $tab }} yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">Add your first {{ rtrim($tab, 's') }}.</p>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">Add {{ $tab === 'sponsors' ? 'Sponsor' : 'Partner' }}</button>
    </div>
    @endif

    {{-- FORM MODAL --}}
    @if($showForm)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="closeForm">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $editingId ? 'Edit' : 'Add' }} {{ $tab === 'sponsors' ? 'Sponsor' : 'Partner' }}</h3>
                <button wire:click="closeForm" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-neutral-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-5">

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Logo</label>
                    @if($logoUrl)
                    <div class="flex items-center gap-4">
                        <div class="w-28 h-20 bg-gray-50 dark:bg-neutral-800 flex items-center justify-center p-2">
                            <img src="{{ $logoUrl }}" alt="Logo" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="flex flex-col gap-2">
                            <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'ps-logo', multiple: false })" class="px-4 py-2 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-xs font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Change</button>
                            <button type="button" wire:click="removeLogo" class="px-4 py-2 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">Remove</button>
                        </div>
                    </div>
                    @else
                    <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'ps-logo', multiple: false })" class="w-full py-8 border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-lg text-center hover:border-red-400 transition-colors">
                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-sm text-gray-500 dark:text-neutral-400">Select logo from library</span>
                    </button>
                    @endif
                    @error('logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Name *</label>
                    <input wire:model="name" type="text" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Website</label>
                    <input wire:model="website" type="url" placeholder="https://..." class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('website') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                @if($tab === 'sponsors')
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Tier</label>
                    <select wire:model="tier" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        <option value="general">General</option>
                        <option value="gold">Gold</option>
                        <option value="silver">Silver</option>
                        <option value="bronze">Bronze</option>
                    </select>
                </div>
                @endif

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Description</label>
                    <textarea wire:model="description" rows="3" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 resize-none"></textarea>
                </div>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="w-4 h-4 rounded" style="accent-color: #8B0000;">
                    <span class="text-sm text-gray-700 dark:text-neutral-300">Show on the public website</span>
                </label>

            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-gray-100 dark:border-neutral-800">
                <button wire:click="closeForm" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Cancel</button>
                <button wire:click="save" class="px-6 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Update' : 'Add' }}</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>

        </div>
    </div>
    @endif

    <livewire:admin.media-picker name="ps-logo" />

</div>