<div>

{{-- PAGE HERO --}}
<section aria-label="Award Categories hero" class="relative" style="padding-top: 70px; min-height: 420px;">
    <div class="absolute inset-0" style="top: 70px;">
        <img src="{{ $heroImage ? asset('storage/' . $heroImage) : asset('images/categories-hero.jpg') }}" alt="CenBa Award Categories"
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
                Award Categories
            </h1>
            <p class="mt-6 leading-relaxed text-white/75" style="max-width: 560px; font-size: 1rem;">
                Our awards span across diverse industries and sectors, recognising excellence wherever it thrives across Africa.
            </p>
            <nav aria-label="Breadcrumb" class="mt-10">
                <ol class="flex items-center gap-2 text-xs text-white/55">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-white/55 hover:text-gold transition-colors">Home</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li class="text-gold" aria-current="page">Award Categories</li>
                </ol>
            </nav>
        </div>
    </div>
</section>


{{-- INDUSTRY CATEGORIES --}}
<section id="industry-categories" aria-labelledby="industry-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">By Industry</span>
            </div>
            <h2 id="industry-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Industry Award Categories
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-cream-dark">
            @foreach($industryCategories as $index => $category)
            <article class="flex flex-col p-8 transition-all duration-300 bg-white hover:bg-cream">
                <p class="font-serif font-normal mb-5 leading-none text-crimson/10" style="font-size: 2rem;">
                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                </p>
                <h3 class="font-semibold mb-3 text-ink" style="font-size: 1.05rem;">{{ $category['name'] }}</h3>
                <p class="text-sm leading-relaxed flex-1 mb-6 text-[#666666]" style="line-height: 1.8;">{{ $category['body'] }}</p>
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest uppercase transition-colors duration-200 self-start text-crimson hover:text-gold"
                   aria-label="Fill nomination form for {{ $category['name'] }}">
                    Fill Nomination Form
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- SECTOR CATEGORIES --}}
<section id="sector-categories" aria-labelledby="sector-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">By Sector</span>
            </div>
            <h2 id="sector-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Sector Award Categories
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-cream-dark">
            @foreach($sectorCategories as $index => $category)
            <article class="flex flex-col p-8 transition-all duration-300 bg-white hover:bg-white">
                <div class="w-8 h-0.5 mb-5 bg-gold"></div>
                <h3 class="font-semibold mb-3 text-ink" style="font-size: 1.05rem;">{{ $category['name'] }}</h3>
                <p class="text-sm leading-relaxed flex-1 mb-6 text-[#666666]" style="line-height: 1.8;">
                    <span class="font-semibold text-crimson">Criteria:</span> {{ $category['body'] }}
                </p>
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest uppercase transition-colors duration-200 self-start text-crimson hover:text-gold"
                   aria-label="Fill nomination form for {{ $category['name'] }}">
                    Fill Nomination Form
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- CTA --}}
<section aria-labelledby="categories-cta-heading" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="max-w-3xl">
            <h2 id="categories-cta-heading" class="font-serif font-normal text-white leading-tight mb-4" style="font-size: clamp(2rem, 4vw, 3rem);">
                Found Your Category? Submit a Nomination Today
            </h2>
            <p class="mb-10 leading-relaxed text-white/70" style="font-size: 1rem;">
                Whether you're nominating your own business or recognising another, the process is quick and simple. Submit before 6th November, 2026.
            </p>
            <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-gold text-ink hover:bg-gold-light">
                Nominate Now
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

</div>