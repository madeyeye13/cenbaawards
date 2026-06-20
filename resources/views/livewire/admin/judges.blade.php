<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Manage Judges</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Add, edit, and reorder the judging panel. Drag rows to set display order.</p>
        </div>
        <button wire:click="create"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Judge
        </button>
    </div>

    {{-- List --}}
    @if($judges->count() > 0)
    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden"
         x-data="{
            dragId: null,
            order: @js($judges->pluck('id')),
            start(id) { this.dragId = id; },
            over(e, id) {
                e.preventDefault();
                if (this.dragId === id) return;
                const from = this.order.indexOf(this.dragId);
                const to = this.order.indexOf(id);
                this.order.splice(to, 0, this.order.splice(from, 1)[0]);
            },
            drop() {
                $wire.updateOrder(this.order);
                this.dragId = null;
            }
         }">
        @foreach($judges as $judge)
        <div
            draggable="true"
            x-on:dragstart="start({{ $judge->id }})"
            x-on:dragover="over($event, {{ $judge->id }})"
            x-on:drop="drop()"
            wire:key="judge-{{ $judge->id }}"
            class="flex items-center gap-4 p-4 border-b border-gray-50 dark:border-neutral-800 last:border-0 hover:bg-gray-50 dark:hover:bg-neutral-800/50 transition-colors cursor-move">

            {{-- Drag handle --}}
            <svg class="w-5 h-5 text-gray-300 dark:text-neutral-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 6a2 2 0 11-4 0 2 2 0 014 0zM8 12a2 2 0 11-4 0 2 2 0 014 0zM8 18a2 2 0 11-4 0 2 2 0 014 0zM18 6a2 2 0 11-4 0 2 2 0 014 0zM18 12a2 2 0 11-4 0 2 2 0 014 0zM18 18a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>

            {{-- Photo --}}
            <div class="w-14 h-14 flex-shrink-0 bg-gray-100 dark:bg-neutral-800 overflow-hidden">
                @if($judge->photo)
                    <img src="{{ asset('storage/' . $judge->photo) }}" alt="{{ $judge->name }}" class="w-full h-full object-cover" loading="lazy">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 font-bold">{{ strtoupper(substr($judge->name, 0, 1)) }}</div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-900 dark:text-white truncate">{{ $judge->name }}</p>
                <p class="text-sm text-gray-500 dark:text-neutral-400 truncate">{{ $judge->title }} · {{ $judge->organization }}</p>
            </div>

            {{-- Status --}}
            <button wire:click="toggleActive({{ $judge->id }})"
                    class="flex-shrink-0 px-3 py-1 rounded-full text-xs font-semibold
                           {{ $judge->is_active ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-neutral-800 dark:text-neutral-400' }}">
                {{ $judge->is_active ? 'Active' : 'Hidden' }}
            </button>

            {{-- Actions --}}
            <div class="flex items-center gap-1 flex-shrink-0">
                <button wire:click="edit({{ $judge->id }})" class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </button>
                <button wire:click="delete({{ $judge->id }})" wire:confirm="Delete this judge permanently?" class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No judges yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500 mb-4">Add your first judge to get started.</p>
        <button wire:click="create" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">Add Judge</button>
    </div>
    @endif


    {{-- FORM MODAL --}}
    @if($showForm)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="$set('showForm', false)">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">{{ $editingId ? 'Edit Judge' : 'Add Judge' }}</h3>
                <button wire:click="$set('showForm', false)" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-neutral-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-5">

                {{-- Photo --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Photo</label>
                    @if($photoUrl)
                    <div class="flex items-center gap-4">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-neutral-800 overflow-hidden">
                            <img src="{{ $photoUrl }}" alt="Selected photo" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col gap-2">
                            <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'judge-photo', multiple: false })"
                                    class="px-4 py-2 border border-gray-200 dark:border-neutral-700 text-gray-700 dark:text-neutral-300 text-xs font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Change</button>
                            <button type="button" wire:click="removePhoto" class="px-4 py-2 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">Remove</button>
                        </div>
                    </div>
                    @else
                    <button type="button" wire:click="$dispatch('openMediaPicker', { name: 'judge-photo', multiple: false })"
                            class="w-full py-8 border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-lg text-center hover:border-red-400 transition-colors">
                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-sm text-gray-500 dark:text-neutral-400">Select from Media Library</span>
                    </button>
                    @endif
                    @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Name + Title --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Full Name *</label>
                        <input wire:model="name" type="text" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Title / Role *</label>
                        <input wire:model="title" type="text" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Organization + Location --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Organization *</label>
                        <input wire:model="organization" type="text" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                        @error('organization') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Location</label>
                        <input wire:model="location" type="text" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    </div>
                </div>

                {{-- Bio --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">Biography *</label>
                    <textarea wire:model="bio" rows="5" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500 resize-none"></textarea>
                    @error('bio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- LinkedIn --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-2">LinkedIn URL</label>
                    <input wire:model="linkedin" type="url" placeholder="https://linkedin.com/in/..." class="w-full px-4 py-2.5 bg-gray-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-lg text-sm text-gray-900 dark:text-white focus:outline-none focus:border-red-500">
                    @error('linkedin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Active --}}
                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="w-4 h-4 rounded" style="accent-color: #8B0000;">
                    <span class="text-sm text-gray-700 dark:text-neutral-300">Show this judge on the public website</span>
                </label>

            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4 border-t border-gray-100 dark:border-neutral-800">
                <button wire:click="$set('showForm', false)" class="px-4 py-2.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Cancel</button>
                <button wire:click="save" class="px-6 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Update Judge' : 'Add Judge' }}</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>

        </div>
    </div>
    @endif

    {{-- Media Picker (reusable) --}}
    <livewire:admin.media-picker name="judge-photo" />

</div>