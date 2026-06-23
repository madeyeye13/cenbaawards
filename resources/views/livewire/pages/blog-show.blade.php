<div class="bg-white">

{{-- ===== SEO SCHEMA + META (unchanged) ===== --}}
@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => $post->type === 'press_release' ? 'NewsArticle' : 'Article',
        'headline' => $post->title,
        'description' => $post->meta_description ?: $post->excerpt_or_trimmed,
        'datePublished' => $post->published_at?->toIso8601String(),
        'dateModified' => $post->updated_at?->toIso8601String(),
        'author' => ['@type' => 'Organization', 'name' => $post->author?->name ?? 'CenBa Africa Business Excellence Awards'],
        'publisher' => ['@type' => 'Organization', 'name' => 'CenBa Africa Business Excellence Awards', 'logo' => ['@type' => 'ImageObject', 'url' => asset('images/logo.png')]],
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('blog.show', $post->slug)],
    ];
    if ($post->featured_image) { $schema['image'] = asset('storage/' . $post->featured_image); }
@endphp

@push('head')
    <meta name="description" content="{{ $post->meta_description ?: $post->excerpt_or_trimmed }}">
    <link rel="canonical" href="{{ route('blog.show', $post->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?: $post->excerpt_or_trimmed }}">
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
    @if($post->og_image || $post->featured_image)
    <meta property="og:image" content="{{ asset('storage/' . ($post->og_image ?: $post->featured_image)) }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->meta_title ?: $post->title }}">
    <meta name="twitter:description" content="{{ $post->meta_description ?: $post->excerpt_or_trimmed }}">
    @if($post->og_image || $post->featured_image)
    <meta name="twitter:image" content="{{ asset('storage/' . ($post->og_image ?: $post->featured_image)) }}">
    @endif
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

{{-- ===== HEADER ===== --}}
<header class="bg-cream" style="padding-top: 70px;">
    <div class="max-w-screen-xl mx-auto px-6 xl:px-10 py-14">
        <nav aria-label="Breadcrumb" class="mb-8">
            <ol class="flex items-center gap-2 text-xs text-[#999999]">
                <li><a href="{{ route('home') }}" wire:navigate class="hover:text-crimson transition-colors">Home</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('blog.index') }}" wire:navigate class="hover:text-crimson transition-colors">Blog</a></li>
                <li aria-hidden="true">/</li>
                <li class="text-crimson truncate" aria-current="page">{{ Str::limit($post->title, 40) }}</li>
            </ol>
        </nav>

        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-5">
                <span class="text-[0.6rem] font-bold uppercase tracking-widest px-2.5 py-1 {{ $post->type === 'press_release' ? 'bg-gold/15 text-gold-dim' : 'bg-crimson/10 text-crimson' }}">
                    {{ $post->type === 'press_release' ? 'Press Release' : 'Blog' }}
                </span>
                @if($post->category)
                <span class="text-xs text-[#999999]">{{ $post->category->name }}</span>
                @endif
            </div>

            <h1 class="font-serif font-normal text-ink leading-tight mb-6" style="font-size: clamp(2rem, 5vw, 3.25rem);">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm text-[#666666]">
                <span>{{ $post->author?->name ?? 'CenBa Team' }}</span>
                <span aria-hidden="true">·</span>
                <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('F j, Y') }}</time>
                <span aria-hidden="true">·</span>
                <span>{{ $post->reading_time }} min read</span>
            </div>
        </div>
    </div>
</header>

{{-- ===== TWO-COLUMN LAYOUT ===== --}}
<div class="bg-white">
    <div class="max-w-screen-xl mx-auto px-6 xl:px-10 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- LEFT: ARTICLE --}}
        <article class="lg:col-span-2 min-w-0">

            @if($post->featured_image)
            <div class="mb-10">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                     class="w-full object-cover" style="aspect-ratio: 16/9;" loading="eager" decoding="async">
            </div>
            @endif

            <div class="article-content">
                {!! $post->body !!}
            </div>

            {{-- Tags --}}
            @if($post->tags->count() > 0)
            <div class="flex flex-wrap items-center gap-2 mt-12 pt-8 border-t border-cream-dark">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#999999] mr-2">Tags:</span>
                @foreach($post->tags as $tag)
                <span class="px-3 py-1 bg-cream text-ink text-xs rounded-full">{{ $tag->name }}</span>
                @endforeach
            </div>
            @endif

            {{-- Next / Prev --}}
            @if($next || $previous)
            <nav aria-label="Post navigation" class="mt-12 pt-8 border-t border-cream-dark grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    @if($previous)
                    <a href="{{ route('blog.show', $previous->slug) }}" wire:navigate class="group block">
                        <span class="text-xs uppercase tracking-widest text-[#999999] mb-2 block">← Previous</span>
                        <span class="font-serif text-ink leading-snug transition-colors group-hover:text-crimson" style="font-size: 1.05rem;">{{ $previous->title }}</span>
                    </a>
                    @endif
                </div>
                <div class="sm:text-right">
                    @if($next)
                    <a href="{{ route('blog.show', $next->slug) }}" wire:navigate class="group block">
                        <span class="text-xs uppercase tracking-widest text-[#999999] mb-2 block">Next →</span>
                        <span class="font-serif text-ink leading-snug transition-colors group-hover:text-crimson" style="font-size: 1.05rem;">{{ $next->title }}</span>
                    </a>
                    @endif
                </div>
            </nav>
            @endif

        </article>

        {{-- RIGHT: SIDEBAR --}}
        <aside class="lg:col-span-1 space-y-8">
            <div class="lg:sticky lg:top-24 space-y-8">

                {{-- About --}}
                <div class="bg-cream p-6">
                    <h2 class="font-serif text-ink mb-3" style="font-size: 1.2rem;">About CenBa Awards</h2>
                    <p class="text-sm leading-relaxed text-[#666666] mb-4">
                        The CenBa Africa Business Excellence Awards celebrate outstanding achievements in business across Africa — honouring innovation, leadership, and excellence since 2016.
                    </p>
                    <a href="{{ route('about') }}" wire:navigate class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest uppercase text-crimson hover:text-gold transition-colors">
                        Learn More
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

                {{-- Recent posts --}}
                @if($recentPosts->count() > 0)
                <div>
                    <h2 class="font-serif text-ink mb-4 pb-3 border-b border-cream-dark" style="font-size: 1.2rem;">Recent Posts</h2>
                    <div class="space-y-4">
                        @foreach($recentPosts as $recent)
                        <a href="{{ route('blog.show', $recent->slug) }}" wire:navigate class="group flex gap-3">
                            <div class="flex-shrink-0 w-16 h-16 bg-cream overflow-hidden">
                                @if($recent->featured_image)
                                <img src="{{ asset('storage/' . $recent->featured_image) }}" alt="{{ $recent->title }}" class="w-full h-full object-cover" loading="lazy">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-medium text-ink leading-snug line-clamp-2 transition-colors group-hover:text-crimson">{{ $recent->title }}</h3>
                                <span class="text-xs text-[#999999] mt-1 block">{{ $recent->published_at->format('M d, Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Categories --}}
                @if($categories->count() > 0)
                <div>
                    <h2 class="font-serif text-ink mb-4 pb-3 border-b border-cream-dark" style="font-size: 1.2rem;">Categories</h2>
                    <ul class="space-y-2">
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('blog.index') }}?category={{ $cat->slug }}" wire:navigate class="flex items-center justify-between text-sm text-[#666666] hover:text-crimson transition-colors py-1">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs text-[#999999]">{{ $cat->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Tags --}}
                @if($popularTags->count() > 0)
                <div>
                    <h2 class="font-serif text-ink mb-4 pb-3 border-b border-cream-dark" style="font-size: 1.2rem;">Tags</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                        <span class="px-3 py-1 bg-cream text-ink text-xs rounded-full">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </aside>

    </div>
</div>

{{-- ===== COMMENTS ===== --}}
<section aria-labelledby="comments-heading" class="bg-cream border-t border-cream-dark">
    <div class="max-w-screen-xl mx-auto px-6 xl:px-10 py-16">
        <div class="max-w-3xl">

            <h2 id="comments-heading" class="font-serif font-normal text-ink mb-8" style="font-size: 1.75rem;">
                Comments
                @if($comments->count() > 0)<span class="text-[#999999]" style="font-size: 1.1rem;">({{ $comments->count() }})</span>@endif
            </h2>

            @if($comments->count() > 0)
            <div class="space-y-8 mb-12">
                @foreach($comments as $comment)
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-crimson/10 flex items-center justify-center font-semibold text-crimson text-sm">{{ strtoupper(substr($comment->author_name, 0, 1)) }}</div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-ink text-sm">{{ $comment->author_name }}</span>
                            <span class="text-xs text-[#999999]">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm leading-relaxed text-[#555555]">{{ $comment->body }}</p>
                        @if($comment->replies->count() > 0)
                        <div class="mt-4 pl-5 border-l-2 border-cream-dark space-y-4">
                            @foreach($comment->replies as $reply)
                            <div class="flex gap-3">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gold/15 flex items-center justify-center font-semibold text-gold-dim text-xs">{{ strtoupper(substr($reply->author_name, 0, 1)) }}</div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="font-semibold text-ink text-sm">{{ $reply->author_name }}</span>
                                        <span class="text-xs text-[#999999]">{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm leading-relaxed text-[#555555]">{{ $reply->body }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-sm text-[#999999] mb-12">Be the first to comment.</p>
            @endif

            {{-- Comment form --}}
            <div class="bg-white p-8" x-data="{ showSuccess: false }"
                 x-on:comment-submitted.window="showSuccess = true; setTimeout(() => showSuccess = false, 5000)">

                <h3 class="font-serif font-normal text-ink mb-2" style="font-size: 1.35rem;">Leave a Comment</h3>
                <p class="text-xs text-[#999999] mb-6">Your email will not be published. Comments are reviewed before appearing.</p>

                <div x-show="showSuccess" x-cloak x-transition class="mb-6 p-4 bg-crimson/10 flex items-start gap-3" style="border-left: 3px solid #8B0000;">
                    <svg class="w-5 h-5 flex-shrink-0 text-crimson mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <p class="text-sm text-ink">Thank you! Your comment has been submitted and will appear once approved by our team.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <input wire:model="author_name" type="text" placeholder="Your name *" class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors">
                        @error('author_name') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input wire:model="author_email" type="email" placeholder="Your email *" class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors">
                        @error('author_email') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <textarea wire:model="comment_body" rows="4" placeholder="Your comment *" class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors resize-none"></textarea>
                    @error('comment_body') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button wire:click="submitComment" wire:loading.attr="disabled" wire:target="submitComment"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-crimson hover:bg-crimson-light disabled:opacity-50 text-white text-xs font-bold tracking-widest uppercase transition-colors">
                    <span wire:loading.remove wire:target="submitComment">Post Comment</span>
                    <span wire:loading wire:target="submitComment">Submitting...</span>
                </button>
            </div>

        </div>
    </div>
</section>

</div>