<div class="p-6">

        {{-- Welcome bar --}}
        <div class="mb-8 p-6 rounded-2xl text-white relative overflow-hidden"
             style="background: #8B0000;">
            <div class="absolute inset-0 opacity-10"
                 style="background-image: radial-gradient(circle, #C9A84C 1px, transparent 1px); background-size: 24px 24px;">
            </div>
            <div class="relative z-10">
                <p class="text-sm mb-1" style="color: rgba(255,255,255,0.7);">Welcome back,</p>
                <h2 class="text-2xl font-semibold" style="font-family: 'DM Serif Display', serif;">
                    {{ auth('admin')->user()->name }} 👋
                </h2>
                <p class="text-sm mt-1" style="color: rgba(255,255,255,0.6);">
                    Here's what's happening with CenBa Awards today.
                </p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            @php
                $stats = [
                    ['label' => 'Blog Posts', 'value' => \App\Models\Post::count(), 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'color' => '#3B82F6'],
                    ['label' => 'Winners', 'value' => \App\Models\Winner::count(), 'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z', 'color' => '#C9A84C'],
                    ['label' => 'Gallery Items', 'value' => \App\Models\Gallery::count(), 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => '#10B981'],
                    ['label' => 'Contacts', 'value' => \App\Models\Contact::where('is_read', false)->count(), 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => '#EF4444', 'suffix' => 'unread'],
                ];
            @endphp

            @foreach($stats as $stat)
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-5 border border-gray-100 dark:border-neutral-800">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                         style="background: {{ $stat['color'] }}18;">
                        <svg class="w-5 h-5" fill="none" stroke="{{ $stat['color'] }}" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">{{ $stat['value'] }}</p>
                <p class="text-xs text-gray-500 dark:text-neutral-500">
                    {{ $stat['label'] }}
                    @if(isset($stat['suffix']))
                        <span class="text-red-500">({{ $stat['suffix'] }})</span>
                    @endif
                </p>
            </div>
            @endforeach

        </div>

        {{-- Quick actions --}}
        <div class="bg-white dark:bg-neutral-900 rounded-2xl border border-gray-100 dark:border-neutral-800 p-6">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                @php
    $stats = [
        ['label' => 'Blog Posts', 'value' => $postCount, 'color' => '#3B82F6',
         'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
        ['label' => 'Winners', 'value' => $winnerCount, 'color' => '#C9A84C',
         'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
        ['label' => 'Gallery Items', 'value' => $galleryCount, 'color' => '#10B981',
         'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['label' => 'Unread Contacts', 'value' => $unreadContacts, 'color' => '#EF4444',
         'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
    ];
@endphp
                @foreach($actions as $action)
                <a href="{{ route($action['route']) }}" wire:navigate
                   class="flex flex-col items-center justify-center p-4 rounded-xl border text-center transition-all hover:scale-105 border-gray-100 dark:border-neutral-800 hover:border-gray-200 dark:hover:border-neutral-700">
                    <div class="w-8 h-8 rounded-lg mb-2 flex items-center justify-center"
                         style="background: {{ $action['color'] }}18;">
                        <div class="w-2 h-2 rounded-full" style="background: {{ $action['color'] }};"></div>
                    </div>
                    <span class="text-xs font-medium text-gray-600 dark:text-neutral-400">{{ $action['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

    </div>