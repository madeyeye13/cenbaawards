<div>

{{-- HERO --}}
<section aria-label="Partners hero" class="relative" style="padding-top: 70px; min-height: 420px;">
    <div class="absolute inset-0" style="top: 70px;">
        <img src="{{ $heroImage ? asset('storage/' . $heroImage) : asset('images/partners-hero.jpg') }}" alt="CenBa Partners & Sponsors"
             class="w-full h-full object-cover" loading="eager" decoding="async">
    </div>
    <div class="absolute inset-0 bg-black/70" style="top: 70px;" aria-hidden="true"></div>

    <div class="relative z-10 max-w-screen-2xl mx-auto px-6 xl:px-20 flex items-center" style="min-height: 420px;">
        <div>
            <div class="flex items-center gap-3 mb-5" aria-hidden="true">
                <div class="w-0.5 h-5 bg-gold"></div>
                <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Our Network</span>
            </div>
            <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 700px;">
                Partners &amp; Sponsors
            </h1>
            <p class="mt-6 leading-relaxed text-white/75" style="max-width: 560px; font-size: 1rem;">
                The organisations whose support makes the CenBa Africa Business Excellence Awards possible.
            </p>
            <nav aria-label="Breadcrumb" class="mt-10">
                <ol class="flex items-center gap-2 text-xs text-white/55">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-white/55 hover:text-gold transition-colors">Home</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li class="text-gold" aria-current="page">Partners &amp; Sponsors</li>
                </ol>
            </nav>
        </div>
    </div>
</section>


{{-- PARTNERS --}}
<section id="partners" aria-labelledby="partners-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Strategic Partners</span>
            </div>
            <h2 id="partners-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Our Esteemed Partners
            </h2>
            <p class="mt-4 leading-relaxed text-[#666666]" style="font-size: 0.95rem;">
                We collaborate with organisations that share our vision for growth, innovation, and excellence across Africa.
            </p>
        </div>

        @if($partners->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px bg-cream-dark">
            @foreach($partners as $partner)
            @php $tag = $partner->website ? 'a' : 'div'; @endphp
            <{{ $tag }}
                @if($partner->website) href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer" @endif
                class="group relative flex items-center justify-center p-10 bg-white transition-all duration-300 hover:bg-cream"
                @if($partner->website) aria-label="Visit {{ $partner->name }}" @endif>
                @if($partner->logo)
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                         class="max-h-16 w-auto object-contain grayscale opacity-70 transition-all duration-300 group-hover:grayscale-0 group-hover:opacity-100"
                         loading="lazy" decoding="async">
                @else
                    <span class="text-center text-sm font-medium text-[#666666]">{{ $partner->name }}</span>
                @endif
            </{{ $tag }}>
            @endforeach
        </div>
        @else
        <div class="py-16 text-center bg-cream">
            <p class="text-sm text-[#666666]">Partners will be announced soon.</p>
        </div>
        @endif

    </div>
</section>


{{-- SPONSORS --}}
<section id="sponsors" aria-labelledby="sponsors-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Our Sponsors</span>
            </div>
            <h2 id="sponsors-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Proudly Sponsored By
            </h2>
            <p class="mt-4 leading-relaxed text-[#666666]" style="font-size: 0.95rem;">
                Generous sponsors whose contributions help us celebrate and elevate African business excellence.
            </p>
        </div>

        @if($sponsors->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px bg-cream-dark">
            @foreach($sponsors as $sponsor)
            @php $tag = $sponsor->website ? 'a' : 'div'; @endphp
            <{{ $tag }}
                @if($sponsor->website) href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer" @endif
                class="group relative flex flex-col items-center justify-center p-10 bg-white transition-all duration-300 hover:bg-cream"
                @if($sponsor->website) aria-label="Visit {{ $sponsor->name }}" @endif>
                @if($sponsor->tier !== 'general')
                <span class="absolute top-3 right-3 text-[0.55rem] font-bold uppercase tracking-widest px-2 py-0.5 bg-gold/15 text-gold-dim">{{ $sponsor->tier }}</span>
                @endif
                @if($sponsor->logo)
                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}"
                         class="max-h-16 w-auto object-contain grayscale opacity-70 transition-all duration-300 group-hover:grayscale-0 group-hover:opacity-100"
                         loading="lazy" decoding="async">
                @else
                    <span class="text-center text-sm font-medium text-[#666666]">{{ $sponsor->name }}</span>
                @endif
            </{{ $tag }}>
            @endforeach
        </div>
        @else
        <div class="py-16 text-center bg-white">
            <p class="text-sm text-[#666666]">Sponsors will be announced soon.</p>
        </div>
        @endif

    </div>
</section>


{{-- BECOME A PARTNER CTA --}}
<section aria-labelledby="partner-cta-heading" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="max-w-3xl">
            <h2 id="partner-cta-heading" class="font-serif font-normal text-white leading-tight mb-4" style="font-size: clamp(2rem, 4vw, 3rem);">
                Become a Partner or Sponsor
            </h2>
            <p class="mb-10 leading-relaxed text-white/70" style="font-size: 1rem;">
                Align your brand with excellence. Partner with the CenBa Africa Business Excellence Awards and connect with Africa's most outstanding businesses and leaders.
            </p>
            <a href="{{ route('contact') }}" wire:navigate
               class="inline-flex items-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-gold text-ink hover:bg-gold-light">
                Get in Touch
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

</div>