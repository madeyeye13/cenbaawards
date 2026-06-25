@props(['field', 'label', 'url' => null])

<div class="flex flex-col gap-2">
    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400">{{ $label }}</p>

    @if($url)
    <div class="relative group aspect-video bg-gray-100 dark:bg-neutral-800 overflow-hidden rounded-lg">
        <img src="{{ $url }}" alt="{{ $label }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
            <button type="button"
                    wire:click="openPicker('{{ $field }}')"
                    class="px-3 py-1.5 bg-white text-gray-800 text-xs font-semibold rounded-md hover:bg-gray-100">
                Change
            </button>
            <button type="button"
                    wire:click="removeImage('{{ $field }}')"
                    class="px-3 py-1.5 bg-red-700 text-white text-xs font-semibold rounded-md hover:bg-red-600">
                Remove
            </button>
        </div>
    </div>
    @else
    <button type="button"
            wire:click="openPicker('{{ $field }}')"
            class="aspect-video border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-lg flex flex-col items-center justify-center gap-2 hover:border-red-400 transition-colors">
        <svg class="w-7 h-7 text-gray-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="text-xs text-gray-400 dark:text-neutral-500">Select from library</span>
    </button>
    @endif
</div>