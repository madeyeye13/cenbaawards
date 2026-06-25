<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                Contact Messages
                @if($unreadCount > 0)
                <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold bg-red-800 text-white rounded-full">{{ $unreadCount }}</span>
                @endif
            </h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Messages submitted through the website contact form.</p>
        </div>
    </div>

    {{-- Filter tabs --}}
    <div class="flex items-center gap-2 mb-6 border-b border-gray-100 dark:border-neutral-800">
        <button wire:click="filterBy('all')" class="px-4 py-2.5 text-sm font-semibold border-b-2 transition-colors {{ $filter === 'all' ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">All</button>
        <button wire:click="filterBy('unread')" class="px-4 py-2.5 text-sm font-semibold border-b-2 transition-colors {{ $filter === 'unread' ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">Unread</button>
        <button wire:click="filterBy('read')" class="px-4 py-2.5 text-sm font-semibold border-b-2 transition-colors {{ $filter === 'read' ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">Read</button>
    </div>

    @if($contacts->count() > 0)
    <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 overflow-hidden">
        @foreach($contacts as $contact)
        <div wire:key="contact-{{ $contact->id }}"
             wire:click="view({{ $contact->id }})"
             class="flex items-start gap-4 px-5 py-4 cursor-pointer border-b border-gray-50 dark:border-neutral-800 last:border-0 hover:bg-gray-50 dark:hover:bg-neutral-800/50 transition-colors {{ !$contact->is_read ? 'bg-red-50/40 dark:bg-red-900/5' : '' }}">

            {{-- Unread dot --}}
            <div class="flex-shrink-0 mt-1.5">
                <div class="w-2 h-2 rounded-full {{ !$contact->is_read ? 'bg-red-800' : 'bg-transparent' }}"></div>
            </div>

            {{-- Avatar --}}
            <div class="flex-shrink-0 w-9 h-9 rounded-full bg-red-800/10 flex items-center justify-center font-semibold text-red-800 text-sm">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2 mb-0.5">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate {{ !$contact->is_read ? 'font-bold' : '' }}">
                        {{ $contact->name }}
                    </p>
                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-neutral-400 truncate mb-0.5">
                    {{ $contact->email }}
                    @if($contact->subject) · {{ $contact->subject }} @endif
                </p>
                <p class="text-xs text-gray-400 dark:text-neutral-500 truncate">{{ Str::limit($contact->message, 80) }}</p>
            </div>

        </div>
        @endforeach
    </div>

    <div class="mt-5">{{ $contacts->links() }}</div>

    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No messages yet</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500">Contact form submissions will appear here.</p>
    </div>
    @endif

    {{-- MESSAGE DETAIL MODAL --}}
    @if($viewing)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5);" wire:click.self="closeView">
        <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-neutral-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Message Detail</h3>
                <button wire:click="closeView" class="p-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-5">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[0.6rem] font-semibold uppercase tracking-widest text-gray-400 mb-1">Name</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $viewing->name }}</p>
                    </div>
                    <div>
                        <p class="text-[0.6rem] font-semibold uppercase tracking-widest text-gray-400 mb-1">Email</p>
                        <a href="mailto:{{ $viewing->email }}" class="text-sm text-red-800 dark:text-red-400 hover:underline">{{ $viewing->email }}</a>
                    </div>
                    @if($viewing->phone)
                    <div>
                        <p class="text-[0.6rem] font-semibold uppercase tracking-widest text-gray-400 mb-1">Phone</p>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $viewing->phone }}</p>
                    </div>
                    @endif
                    @if($viewing->subject)
                    <div>
                        <p class="text-[0.6rem] font-semibold uppercase tracking-widest text-gray-400 mb-1">Subject</p>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $viewing->subject }}</p>
                    </div>
                    @endif
                    <div class="col-span-2">
                        <p class="text-[0.6rem] font-semibold uppercase tracking-widest text-gray-400 mb-1">Received</p>
                        <p class="text-sm text-gray-500">{{ $viewing->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-[0.6rem] font-semibold uppercase tracking-widest text-gray-400 mb-2">Message</p>
                    <div class="bg-gray-50 dark:bg-neutral-800 rounded-lg p-4 text-sm text-gray-700 dark:text-neutral-300 leading-relaxed whitespace-pre-wrap">{{ $viewing->message }}</div>
                </div>

            </div>

            <div class="flex items-center justify-between gap-2 px-6 py-4 border-t border-gray-100 dark:border-neutral-800">
                <div class="flex items-center gap-2">
                    <button wire:click="markUnread({{ $viewing->id }})"
                            class="px-4 py-2 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-800">
                        Mark Unread
                    </button>
                    <button wire:click="delete({{ $viewing->id }})" wire:confirm="Delete this message permanently?"
                            class="px-4 py-2 text-red-700 text-xs font-semibold rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20">
                        Delete
                    </button>
                </div>
                <a href="mailto:{{ $viewing->email }}"
                   class="px-5 py-2 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition-colors">
                    Reply by Email
                </a>
            </div>

        </div>
    </div>
    @endif

</div>