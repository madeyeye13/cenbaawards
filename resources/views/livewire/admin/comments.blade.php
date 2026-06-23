<div class="p-6">

    <div class="mb-6">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white">Comments</h1>
        <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Review and moderate comments before they appear publicly.</p>
    </div>

    {{-- Filter tabs --}}
    <div class="flex items-center gap-2 mb-5">
        <button wire:click="setFilter('pending')" class="px-4 py-2 text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors {{ $filter === 'pending' ? 'bg-red-800 text-white' : 'bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300' }}">
            Pending @if($counts['pending'] > 0)<span class="ml-1">({{ $counts['pending'] }})</span>@endif
        </button>
        <button wire:click="setFilter('approved')" class="px-4 py-2 text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors {{ $filter === 'approved' ? 'bg-red-800 text-white' : 'bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300' }}">
            Approved ({{ $counts['approved'] }})
        </button>
        <button wire:click="setFilter('spam')" class="px-4 py-2 text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors {{ $filter === 'spam' ? 'bg-red-800 text-white' : 'bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300' }}">
            Spam ({{ $counts['spam'] }})
        </button>
        <button wire:click="setFilter('all')" class="px-4 py-2 text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors {{ $filter === 'all' ? 'bg-red-800 text-white' : 'bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300' }}">All</button>
    </div>

    @if($comments->count() > 0)
    <div class="space-y-3">
        @foreach($comments as $comment)
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-5" wire:key="comment-{{ $comment->id }}">
            <div class="flex items-start justify-between gap-4 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-red-50 dark:bg-red-900/30 flex items-center justify-center font-semibold text-red-800 dark:text-red-300 text-sm">
                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $comment->author_name }}</p>
                        <p class="text-xs text-gray-400 dark:text-neutral-500">{{ $comment->author_email }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-1 rounded-full font-semibold
                    {{ $comment->status === 'approved' ? 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                    {{ $comment->status === 'pending' ? 'bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                    {{ $comment->status === 'spam' ? 'bg-gray-100 text-gray-500 dark:bg-neutral-800 dark:text-neutral-400' : '' }}">
                    {{ ucfirst($comment->status) }}
                </span>
            </div>

            <p class="text-sm text-gray-600 dark:text-neutral-300 leading-relaxed mb-3">{{ $comment->body }}</p>

            <div class="flex items-center justify-between gap-4 pt-3 border-t border-gray-50 dark:border-neutral-800">
                <p class="text-xs text-gray-400 dark:text-neutral-500">
                    On <span class="font-medium text-gray-600 dark:text-neutral-400">{{ $comment->post?->title ?? 'Deleted post' }}</span> · {{ $comment->created_at->diffForHumans() }}
                </p>
                <div class="flex items-center gap-1">
                    @if($comment->status !== 'approved')
                    <button wire:click="approve({{ $comment->id }})" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-md transition-colors">Approve</button>
                    @else
                    <button wire:click="unapprove({{ $comment->id }})" class="px-3 py-1.5 border border-gray-200 dark:border-neutral-700 text-gray-600 dark:text-neutral-300 text-xs font-semibold rounded-md transition-colors">Unapprove</button>
                    @endif
                    @if($comment->status !== 'spam')
                    <button wire:click="markSpam({{ $comment->id }})" class="px-3 py-1.5 border border-gray-200 dark:border-neutral-700 text-gray-500 text-xs font-semibold rounded-md hover:bg-gray-50 dark:hover:bg-neutral-800 transition-colors">Spam</button>
                    @endif
                    <button wire:click="delete({{ $comment->id }})" wire:confirm="Delete this comment permanently?" class="p-1.5 text-gray-400 hover:text-red-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5">{{ $comments->links() }}</div>
    @else
    <div class="py-16 text-center bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800">
        <p class="text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">No {{ $filter !== 'all' ? $filter : '' }} comments</p>
        <p class="text-xs text-gray-400 dark:text-neutral-500">Comments will appear here for moderation.</p>
    </div>
    @endif

</div>