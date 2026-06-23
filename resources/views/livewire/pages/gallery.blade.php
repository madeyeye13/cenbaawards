<div>

{{-- HERO --}}
<section aria-label="Gallery hero" class="relative bg-crimson" style="padding-top: 70px;">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="flex items-center gap-3 mb-5" aria-hidden="true">
            <div class="w-0.5 h-5 bg-gold"></div>
            <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Events</span>
        </div>
        <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 700px;">
            Awards Gallery
        </h1>
        <p class="mt-6 leading-relaxed text-white/75" style="max-width: 540px; font-size: 1rem;">
            Relive the moments from each edition of the CenBa Africa Business Excellence Awards ceremony.
        </p>
        <nav aria-label="Breadcrumb" class="mt-10">
            <ol class="flex items-center gap-2 text-xs text-white/55">
                <li><a href="{{ route('home') }}" wire:navigate class="hover:text-gold transition-colors">Home</a></li>
                <li aria-hidden="true" class="text-white/30">/</li>
                
                <li class="text-gold" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</section>

{{-- ALBUMS --}}
<section class="bg-white" aria-label="Award year albums">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20">

        @if($albums->count() > 0)

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Browse by Year</span>
            </div>
            <h2 class="font-serif font-normal text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                {{ $albums->count() }} {{ Str::plural('Edition', $albums->count()) }}
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-cream-dark">
            @foreach($albums as $album)
            <a href="{{ route('events.gallery.album', $album->slug) }}" wire:navigate
               class="group relative block overflow-hidden bg-ink"
               aria-label="View {{ $album->title }} gallery — {{ $album->images_count }} photos"
               style="aspect-ratio: 4/3;">

                {{-- Cover image --}}
                @if($album->cover_url)
                <img src="{{ $album->cover_url }}"
                     alt="{{ $album->title }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-75 group-hover:opacity-60"
                     loading="lazy" decoding="async">
                @else
                <div class="w-full h-full bg-dark-2 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif

                {{-- Gradient overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute inset-0 bg-crimson/0 group-hover:bg-crimson/20 transition-colors duration-500"></div>

                {{-- Info --}}
                <div class="absolute bottom-0 left-0 right-0 p-7">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-[0.6rem] font-bold tracking-[0.25em] uppercase px-2 py-0.5 bg-gold text-ink">
                            {{ $album->year }}
                        </span>
                    </div>
                    <h3 class="font-serif font-normal text-white leading-tight mb-1" style="font-size: 1.35rem;">
                        {{ $album->title }}
                    </h3>
                    <p class="text-xs text-white/60 tracking-wide">
                        {{ $album->images_count }} {{ Str::plural('photo', $album->images_count) }}
                    </p>
                </div>

                {{-- Arrow on hover --}}
                <div class="absolute top-5 right-5 w-9 h-9 bg-white/0 group-hover:bg-white/15 flex items-center justify-center transition-all duration-300 translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>

            </a>
            @endforeach
        </div>

        @else
        <div class="py-24 text-center bg-cream">
            <p class="font-serif text-ink mb-2" style="font-size: 1.75rem;">No albums yet</p>
            <p class="text-sm text-[#666666]">Gallery photos will appear here once published.</p>
        </div>
        @endif

    </div>
</section>

</div>