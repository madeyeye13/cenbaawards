<div>

{{-- HERO --}}
<section aria-label="Blog hero" class="relative bg-crimson" style="padding-top: 70px;">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="flex items-center gap-3 mb-5" aria-hidden="true">
            <div class="w-0.5 h-5 bg-gold"></div>
            <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">News &amp; Updates</span>
        </div>
        <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 700px;">
            Blog &amp; Press Releases
        </h1>
        <p class="mt-6 leading-relaxed text-white/75" style="max-width: 560px; font-size: 1rem;">
            Insights, stories, and official announcements from the CenBa Africa Business Excellence Awards.
        </p>
    </div>
</section>

{{-- FILTER TABS --}}
<section class="bg-white border-b border-cream-dark sticky top-[70px] z-30">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20">
        <div class="flex items-center gap-1 py-4">
            <button wire:click="setType('all')" class="px-5 py-2 text-xs font-semibold tracking-wide uppercase rounded-full transition-colors {{ $type === 'all' ? 'bg-crimson text-white' : 'text-ink hover:bg-cream' }}">All</button>
            <button wire:click="setType('blog')" class="px-5 py-2 text-xs font-semibold tracking-wide uppercase rounded-full transition-colors {{ $type === 'blog' ? 'bg-crimson text-white' : 'text-ink hover:bg-cream' }}">Blog</button>
            <button wire:click="setType('press_release')" class="px-5 py-2 text-xs font-semibold tracking-wide uppercase rounded-full transition-colors {{ $type === 'press_release' ? 'bg-crimson text-white' : 'text-ink hover:bg-cream' }}">Press Releases</button>
        </div>
    </div>
</section>

{{-- POSTS --}}
<section class="bg-white" aria-label="Articles">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-16">

        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="group flex flex-col">
                <a href="{{ route('blog.show', $post->slug) }}" wire:navigate class="block overflow-hidden mb-5" style="aspect-ratio: 16/10; background: #F5F0E8;">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             loading="lazy" decoding="async">
                    @endif
                </a>
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-[0.6rem] font-bold uppercase tracking-widest px-2 py-1 {{ $post->type === 'press_release' ? 'bg-gold/15 text-gold-dim' : 'bg-crimson/10 text-crimson' }}">
                        {{ $post->type === 'press_release' ? 'Press' : 'Blog' }}
                    </span>
                    @if($post->category)
                    <span class="text-xs text-[#999999]">{{ $post->category->name }}</span>
                    @endif
                </div>
                <h2 class="font-serif font-semibold text-ink leading-snug mb-3 transition-colors group-hover:text-crimson" style="font-size: 1.35rem;">
                    <a href="{{ route('blog.show', $post->slug) }}" wire:navigate>{{ $post->title }}</a>
                </h2>
                <p class="text-sm leading-relaxed text-[#666666] mb-4 flex-1">{{ $post->excerpt_or_trimmed }}</p>
                <div class="flex items-center gap-3 text-xs text-[#999999]">
                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                    <span aria-hidden="true">·</span>
                    <span>{{ $post->reading_time }} min read</span>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-16">{{ $posts->links() }}</div>
        @else
        <div class="py-20 text-center bg-cream">
            <p class="font-serif text-ink mb-2" style="font-size: 1.5rem;">No posts yet</p>
            <p class="text-sm text-[#666666]">Check back soon for news and updates.</p>
        </div>
        @endif

    </div>
</section>

</div>