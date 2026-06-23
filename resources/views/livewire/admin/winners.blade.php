<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Winners</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Manage past award winners by year.</p>
        </div>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Winner
        </button>
    </div>

    {{-- Year filter tabs --}}
    <div class="flex items-center gap-2 mb-6 border-b border-gray-100 dark:border-neutral-800 overflow-x-auto pb-px">
        <button wire:click="filterYear('all')"
                class="px-4 py-2.5 text-sm font-semibold border-b-2 whitespace-nowrap transition-colors {{ $selectedYear === 'all' ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">
            All Years
        </button>
        @foreach($years as $y)
        <button wire:click="filterYear('{{ $y }}')"
                class="px-4 py-2.5 text-sm font-semibold border-b-2 whitespace-nowrap transition-colors {{ $selectedYear == $y ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">
            {{ $y }}
        </button>
        @endforeach
    </div>

    @if($winners->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($winners as $index => $winner)
        <div wire:key="winner-{{ $winner->id }}"
             class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5">

            {{-- Top row: reorder + status --}}
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-1">
                    <button wire:click="moveUp({{ $winner->id }})" @disabled($index === 0)
                            class="p-1 text-gray-400 hover:text-red-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors" title="Move up">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </button>
                    <button wire:click="moveDown({{ $winner->id }})" @disabled($index === $winners->count() - 1)
                            class="p-1 text-gray-400 hover:text-red-700 disabled:opacity-30 disabled:cursor-not-allowed transition-colors" title="Move down">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold px-2 py-0.5 bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-300 rounded">{{ $winner->year }}</span>
                    <button wire:click="toggleActive({{ $winner->id }})"
                            class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $winner->is_active ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-neutral-800' }}">
                        {{ $winner->is_active ? 'Active' : 'Hidden' }}
                    </button>
                </div>
            </div>

            {{-- Photo --}}
            <div class="h-24 w-24 mx-auto mb-4 rounded-full overflow-hidden bg-gray-100 dark:bg-neutral-800 flex items-center justify-center">
                @if($winner->photo)
                    <img src="{{ asset('storage/' . $winner->photo) }}" alt="{{ $winner->name }}"
                         class="w-full h-full object-cover" loading="lazy">
                @else
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                @endif
            </div>

            {{-- Info --}}
            <div class="text-center mb-4">
                <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $winner->name }}</p>
                <p class="text-xs text-gray-500 dark:text-neutral-400 mt-0.5">{{ $winner->company }}</p>
                @if($winner->awardCategory)
                <span class="inline-block mt-1.5 text-[0.6rem] font-semibold uppercase tracking-wider px-2 py-0.5 bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 rounded">
                    {{ $winner->awardCategory->name }}
                </span>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-1 pt-4 border-t border-gray-50 dark:border-neutral-800">
                <button wire:click="edit({{ $winner->id }})" class="flex-1 px-3 py-1.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold rounded-md hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Edit</button>
                <button wire:click="delete({{ $winner->id }})" wire:confirm="Delete this winner?" class="p-1.5 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>

        </div>
        @endforeach
    </div>

    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No winners yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">
            {{ $selectedYear !== 'all' ? 'No winners recorded for ' . $selectedYear . '.' : 'Add your first award winner.' }}
        </p>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">Add Winner</button>
    </div>
    @endif

    {{-- FORM MODAL --}}
    @if($showForm)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="closeForm">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $editingId ? 'Edit' : 'Add' }} Winner</h3>
                <button wire:click="closeForm" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-neutral-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-5">

                {{-- Photo --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Photo</label>
                    @if($photoUrl)
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 dark:bg-neutral-800 flex-shrink-0">
                            <img src="{{ $photoUrl }}" alt="Photo" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col gap-2">
                            <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'winner-photo', multiple: false })" class="px-4 py-2 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-xs font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800">Change</button>
                            <button type="button" wire:click="removePhoto" class="px-4 py-2 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-50">Remove</button>
                        </div>
                    </div>
                    @else
                    <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'winner-photo', multiple: false })" class="w-full py-6 border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-lg text-center hover:border-red-400 transition-colors">
                        <span class="text-sm text-gray-500 dark:text-neutral-400">Select photo from library</span>
                    </button>
                    @endif
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Winner Name</label>
                    <input wire:model="name" type="text" placeholder="e.g. John Mensah" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Company --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Company / Business</label>
                    <input wire:model="company" type="text" placeholder="e.g. Acme Ghana Ltd" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('company') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Year --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Award Year</label>
                    <input wire:model="year" type="number" min="2000" max="2100" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                {{-- Category --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Award Category</label>
                    <select wire:model="award_category_id" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        <option value="">— None —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('award_category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Short Description</label>
                    <textarea wire:model="description" rows="2" placeholder="Brief note about the winner or their achievement..." class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 resize-none"></textarea>
                </div>

                {{-- Active --}}
                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="w-4 h-4 rounded" style="accent-color: #8B0000;">
                    <span class="text-sm text-gray-700 dark:text-neutral-300">Show on the public website</span>
                </label>

            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-gray-100 dark:border-neutral-800">
                <button wire:click="closeForm" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800">Cancel</button>
                <button wire:click="save" class="px-6 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Update' : 'Add' }}</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>

        </div>
    </div>
    @endif

    <livewire:admin.media-picker name="winner-photo" />

</div>