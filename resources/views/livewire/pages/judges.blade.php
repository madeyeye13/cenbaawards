<div>

{{-- PAGE HERO --}}
<section aria-label="Our Judges hero" class="relative" style="padding-top: 70px; min-height: 420px;">
    <div class="absolute inset-0" style="top: 70px;">
        <img src="{{ asset('images/judges-hero.jpg') }}" alt="CenBa Awards Panel of Judges"
             class="w-full h-full object-cover" loading="eager" decoding="async">
    </div>
    <div class="absolute inset-0 bg-black/70" style="top: 70px;" aria-hidden="true"></div>

    <div class="relative z-10 max-w-screen-2xl mx-auto px-6 xl:px-20 flex items-center" style="min-height: 420px;">
        <div>
            <div class="flex items-center gap-3 mb-5" aria-hidden="true">
                <div class="w-0.5 h-5 bg-gold"></div>
                <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">CenBa Africa Business Excellence Awards</span>
            </div>
            <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 700px;">
                Meet Our Judges
            </h1>
            <p class="mt-6 leading-relaxed text-white/75" style="max-width: 560px; font-size: 1rem;">
                A distinguished panel of experts ensuring a fair, rigorous, and credible selection process across all award categories.
            </p>
            <nav aria-label="Breadcrumb" class="mt-10">
                <ol class="flex items-center gap-2 text-xs text-white/55">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-white/55 hover:text-gold transition-colors">Home</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li class="text-gold" aria-current="page">Our Judges</li>
                </ol>
            </nav>
        </div>
    </div>
</section>


{{-- JUDGES GRID --}}
<section id="judges" aria-labelledby="judges-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">The Panel</span>
            </div>
            <h2 id="judges-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Our Distinguished Judges
            </h2>
        </div>

        @if($judges->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($judges as $judge)
            <article class="group">
                {{-- Photo --}}
                <div class="relative overflow-hidden mb-6 bg-cream" style="aspect-ratio: 3/4;">
                    @if($judge->photo)
                        <img src="{{ asset('storage/' . $judge->photo) }}"
                             alt="{{ $judge->name }} — {{ $judge->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                             loading="lazy" decoding="async">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="font-serif font-normal text-crimson/15" style="font-size: 4rem;">
                                {{ strtoupper(substr($judge->name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <div class="absolute bottom-0 left-0 w-full h-1 transition-all duration-300 bg-crimson"></div>
                </div>

                {{-- Info --}}
                <h3 class="font-semibold mb-1 text-ink" style="font-size: 1.15rem;">{{ $judge->name }}</h3>
                <p class="text-sm font-medium mb-1 text-crimson">{{ $judge->title }}</p>
                <p class="text-sm mb-1 text-[#666666]">{{ $judge->organization }}</p>
                @if($judge->location)
                <p class="text-xs mb-4 text-[#999999]">{{ $judge->location }}</p>
                @endif

                @if($judge->bio)
                <p class="text-sm leading-relaxed text-[#666666]" style="line-height: 1.8;">
                    {{ Str::limit($judge->bio, 220) }}
                </p>
                @endif

                @if($judge->linkedin)
                <a href="{{ $judge->linkedin }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 mt-4 text-xs font-semibold tracking-widest uppercase transition-colors text-crimson hover:text-gold"
                   aria-label="{{ $judge->name }} LinkedIn profile">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    Connect
                </a>
                @endif
            </article>
            @endforeach
        </div>
        @else
        {{-- Empty state --}}
        <div class="py-20 text-center bg-cream">
            <p class="font-serif font-normal mb-2 text-ink" style="font-size: 1.5rem;">Judges Coming Soon</p>
            <p class="text-sm text-[#666666]">Our distinguished panel of judges will be announced shortly.</p>
        </div>
        @endif

    </div>
</section>


{{-- CTA --}}
<section aria-labelledby="judges-cta-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20">
        <div class="max-w-3xl">
            <h2 id="judges-cta-heading" class="font-serif font-normal leading-tight mb-4 text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Ready to Have Your Business Evaluated by the Best?
            </h2>
            <p class="mb-10 leading-relaxed text-[#666666]" style="font-size: 1rem;">
                Submit your nomination and let our expert panel recognise your contribution to Africa's business excellence.
            </p>
            <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-10 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-crimson hover:bg-crimson-light">
                Nominate Now
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

</div>