<div>

{{-- HERO --}}
<section aria-label="Album hero" class="relative" style="padding-top: 70px; min-height: 380px;">

    @if($album->cover_url)
    <div class="absolute inset-0" style="top: 70px;">
        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}"
             class="w-full h-full object-cover" loading="eager" decoding="async">
    </div>
    @endif
    <div class="absolute inset-0 bg-black/70" style="top: 70px;" aria-hidden="true"></div>

    <div class="relative z-10 max-w-screen-2xl mx-auto px-6 xl:px-20 flex items-center" style="min-height: 380px;">
        <div>
            <div class="flex items-center gap-3 mb-5" aria-hidden="true">
                <div class="w-0.5 h-5 bg-gold"></div>
                <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">{{ $album->year }}</span>
            </div>
            <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2rem, 5vw, 3.75rem); max-width: 700px;">
                {{ $album->title }}
            </h1>
            @if($album->description)
            <p class="mt-4 leading-relaxed text-white/70" style="max-width: 520px; font-size: 0.95rem;">
                {{ $album->description }}
            </p>
            @endif
            <nav aria-label="Breadcrumb" class="mt-8">
                <ol class="flex items-center gap-2 text-xs text-white/55">
                    <li><a href="{{ route('home') }}" wire:navigate class="hover:text-gold transition-colors">Home</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li><a href="{{ route('events.gallery') }}" wire:navigate class="hover:text-gold transition-colors">Gallery</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li class="text-gold truncate" aria-current="page">{{ $album->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

</section>

{{-- PHOTOS --}}
<section class="bg-white" aria-label="Album photos"
    x-data="{
        open: false,
        current: 0,
        images: [],
        scale: 1,

        init() {
            this.images = Array.from(document.querySelectorAll('[data-lightbox]')).map(el => ({
                src: el.dataset.src,
                alt: el.dataset.alt || ''
            }));
        },

        show(index) {
            this.current = index;
            this.scale = 1;
            this.open = true;
            document.body.style.overflow = 'hidden';
        },

        close() {
            this.open = false;
            this.scale = 1;
            document.body.style.overflow = '';
        },

        prev() {
            this.current = (this.current - 1 + this.images.length) % this.images.length;
            this.scale = 1;
        },

        next() {
            this.current = (this.current + 1) % this.images.length;
            this.scale = 1;
        },

        zoomIn()  { this.scale = Math.min(this.scale + 0.5, 4); },
        zoomOut() { this.scale = Math.max(this.scale - 0.5, 1); },

        handleKey(e) {
            if (!this.open) return;
            if (e.key === 'ArrowLeft')  this.prev();
            if (e.key === 'ArrowRight') this.next();
            if (e.key === 'Escape')     this.close();
            if (e.key === '+')          this.zoomIn();
            if (e.key === '-')          this.zoomOut();
        }
    }"
    @keydown.window="handleKey($event)"
>

    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-16">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-12">
            <div>
                <div class="flex items-center gap-3 mb-3" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Photos</span>
                </div>
                <p class="text-sm text-[#999999]">{{ $images->total() }} {{ Str::plural('photo', $images->total()) }} in this album</p>
            </div>
            <a href="{{ route('events.gallery') }}" wire:navigate
               class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest uppercase pb-1 transition-colors text-crimson border-b border-crimson hover:text-gold hover:border-gold self-start">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                All Albums
            </a>
        </div>

        @if($images->count() > 0)

        {{-- Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
            @foreach($images as $index => $image)
            <button
                type="button"
                data-lightbox
                data-src="{{ asset('storage/' . $image->image_path) }}"
                data-alt="{{ $image->caption ?? $album->title }}"
                @click="show({{ $images->firstItem() - 1 + $index }})"
                class="group relative block overflow-hidden bg-cream-dark focus:outline-none focus:ring-2 focus:ring-crimson focus:ring-offset-2"
                style="aspect-ratio: 1/1;"
                aria-label="View photo {{ $images->firstItem() + $index }}{{ $image->caption ? ': ' . $image->caption : '' }}"
            >
                <img src="{{ asset('storage/' . $image->image_path) }}"
                     alt="{{ $image->caption ?? $album->title }}"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                     loading="lazy" decoding="async">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                    <svg class="w-7 h-7 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                    </svg>
                </div>
            </button>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">{{ $images->links() }}</div>

        @else
        <div class="py-20 text-center bg-cream">
            <p class="font-serif text-ink mb-2" style="font-size: 1.5rem;">No photos yet</p>
            <p class="text-sm text-[#666666]">Photos will appear here once added.</p>
        </div>
        @endif

    </div>

    {{-- ============================================================
         LIGHTBOX
         ============================================================ --}}
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[200] flex flex-col"
        style="background: rgba(0,0,0,0.96);"
        role="dialog"
        aria-modal="true"
        aria-label="Image viewer"
        @click.self="close()"
    >

        {{-- Top bar --}}
        <div class="flex items-center justify-between px-5 py-4 flex-shrink-0">
            <span class="text-xs text-white/50 tracking-widest uppercase font-semibold">
                <span x-text="current + 1"></span> / <span x-text="images.length"></span>
            </span>
            <div class="flex items-center gap-2">
                {{-- Zoom out --}}
                <button @click="zoomOut()" :disabled="scale <= 1"
                        class="w-9 h-9 flex items-center justify-center text-white/60 hover:text-white disabled:opacity-30 transition-colors"
                        aria-label="Zoom out">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"/>
                    </svg>
                </button>
                {{-- Zoom level --}}
                <span class="text-xs text-white/40 w-10 text-center" x-text="Math.round(scale * 100) + '%'"></span>
                {{-- Zoom in --}}
                <button @click="zoomIn()" :disabled="scale >= 4"
                        class="w-9 h-9 flex items-center justify-center text-white/60 hover:text-white disabled:opacity-30 transition-colors"
                        aria-label="Zoom in">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                    </svg>
                </button>
                <div class="w-px h-5 bg-white/15 mx-1"></div>
                {{-- Close --}}
                <button @click="close()"
                        class="w-9 h-9 flex items-center justify-center text-white/60 hover:text-white transition-colors"
                        aria-label="Close viewer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Image area --}}
        <div class="flex-1 flex items-center justify-center relative overflow-hidden px-16">

            {{-- Prev --}}
            <button @click="prev()"
                    class="absolute left-4 z-10 w-11 h-11 flex items-center justify-center bg-white/10 hover:bg-white/20 text-white transition-colors"
                    aria-label="Previous photo">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            {{-- Image --}}
            <template x-if="images[current]">
                <img
                    :src="images[current].src"
                    :alt="images[current].alt"
                    :style="'transform: scale(' + scale + '); transition: transform 0.2s ease; max-height: 100%; max-width: 100%; object-fit: contain; cursor: ' + (scale > 1 ? 'grab' : 'default')"
                    @click.stop
                    draggable="false"
                >
            </template>

            {{-- Next --}}
            <button @click="next()"
                    class="absolute right-4 z-10 w-11 h-11 flex items-center justify-center bg-white/10 hover:bg-white/20 text-white transition-colors"
                    aria-label="Next photo">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>

        {{-- Caption --}}
        <div class="flex-shrink-0 px-5 py-4 text-center">
            <p class="text-sm text-white/50" x-text="images[current]?.alt || ''"></p>
        </div>

    </div>

</section>

</div>