<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Award Table Packages</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Manage the tables shown on the public site. Use the arrows to reorder.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Package
        </button>
    </div>

    {{-- SITE-WIDE NOTE --}}
    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5 mb-6">
        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Site-wide note</label>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-3">Shown alongside the packages on the public site (e.g. "There is no cost in submitting an application form.").</p>
        <div class="flex flex-col sm:flex-row gap-3">
            <input wire:model="note" type="text" class="flex-1 px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
            <button wire:click="saveNote" class="px-5 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-xs font-semibold uppercase tracking-wide rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors whitespace-nowrap">
                <span wire:loading.remove wire:target="saveNote">Save Note</span>
                <span wire:loading wire:target="saveNote">Saving...</span>
            </button>
        </div>
        @error('note') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    @if($packages->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($packages as $index => $package)
        <div wire:key="table-package-{{ $package->id }}"
             class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5 group">

            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-1">
                    <button wire:click="moveUp({{ $package->id }})" @disabled($index === 0)
                            class="p-1 text-gray-400 hover:text-red-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors" title="Move up">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </button>
                    <button wire:click="moveDown({{ $package->id }})" @disabled($index === $packages->count() - 1)
                            class="p-1 text-gray-400 hover:text-red-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors" title="Move down">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>
                <button wire:click="toggleActive({{ $package->id }})" class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $package->is_active ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-neutral-800' }}">
                    {{ $package->is_active ? 'Active' : 'Hidden' }}
                </button>
            </div>

            <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $package->name }}</p>
            <p class="text-xs text-gray-400 dark:text-neutral-500 mt-0.5">{{ $package->seats }} {{ $package->seats === 1 ? 'seat' : 'seats' }}</p>
            <p class="text-lg font-bold text-red-800 dark:text-red-400 mt-2">{{ $package->formatted_price }}</p>

            @if(!empty($package->features))
            <ul class="mt-3 space-y-1">
                @foreach($package->features as $feature)
                <li class="text-xs text-gray-500 dark:text-neutral-400 flex items-start gap-1.5">
                    <span class="text-gray-300 dark:text-neutral-600">&bull;</span>
                    <span>{{ $feature }}</span>
                </li>
                @endforeach
            </ul>
            @endif

            <div class="flex items-center gap-1 mt-4 pt-4 border-t border-gray-50 dark:border-neutral-800">
                <button wire:click="edit({{ $package->id }})" class="flex-1 px-3 py-1.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold rounded-md hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Edit</button>
                <button wire:click="delete({{ $package->id }})" wire:confirm="Delete this package?" class="p-1.5 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No packages yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">Add your first table package.</p>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">Add Package</button>
    </div>
    @endif

    {{-- FORM MODAL --}}
    @if($showForm)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="closeForm">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $editingId ? 'Edit' : 'Add' }} Package</h3>
                <button wire:click="closeForm" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-neutral-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-5">

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Name *</label>
                    <input wire:model="name" type="text" placeholder="e.g. Table for 5" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Seats *</label>
                        <input wire:model="seats" type="number" min="1" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        @error('seats') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Price (GHC) *</label>
                        <input wire:model="price" type="number" step="0.01" min="0" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">What's included</label>

                    @if(!empty($features))
                    <div class="space-y-2 mb-3">
                        @foreach($features as $index => $feature)
                        <div class="flex items-center gap-2" wire:key="feature-{{ $index }}">
                            <span class="flex-1 px-4 py-2 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white">{{ $feature }}</span>
                            <button type="button" wire:click="removeFeature({{ $index }})" class="p-1.5 text-gray-400 hover:text-red-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex items-center gap-2">
                        <input wire:model="newFeature" wire:keydown.enter.prevent="addFeature" type="text" placeholder="e.g. Red carpet interview" class="flex-1 px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        <button type="button" wire:click="addFeature" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-xs font-semibold uppercase rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors whitespace-nowrap">Add</button>
                    </div>
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

</div>
