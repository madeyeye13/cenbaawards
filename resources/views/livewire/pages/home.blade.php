<div>

{{-- ============================================================
     SECTION 1: HERO
     ============================================================ --}}
<section
    id="hero"
    aria-label="CenBa Awards Hero"
    class="relative w-full overflow-hidden mt-16"
    style="height: 100vh; min-height: 640px;"
    x-data="{
        current: 0,
        slides: [
            { image: '{{ asset('images/hero/slide-1.jpg') }}', alt: 'CenBa Africa Business Excellence Awards Ceremony' },
            { image: '{{ asset('images/hero/slide-2.jpg') }}', alt: 'CenBa Awards Winners Celebration' },
            { image: '{{ asset('images/hero/slide-3.jpg') }}', alt: 'CenBa Africa Business Excellence Gala Night' },
        ],
        autoplay: null,
        start() { this.autoplay = setInterval(() => { this.current = (this.current + 1) % this.slides.length; }, 6000); },
        go(index) { this.current = index; clearInterval(this.autoplay); this.start(); }
    }"
    x-init="start()"
>
    {{-- Slides --}}
    <template x-for="(slide, index) in slides" :key="index">
        <div class="absolute inset-0 transition-opacity duration-1000"
             :class="current === index ? 'opacity-100' : 'opacity-0'"
             role="img" :aria-label="slide.alt">
            <img :src="slide.image" :alt="slide.alt" class="w-full h-full object-cover" loading="lazy" decoding="async">
        </div>
    </template>

    {{-- Overlays --}}
    <div class="absolute inset-0 z-10 bg-black/55"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(to right, rgba(139,0,0,0.5) 0%, transparent 60%);"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(to top, rgba(13,13,13,0.8) 0%, transparent 50%);"></div>

    {{-- Content --}}
    <div class="relative z-20 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 xl:px-16 w-full">
            <div class="max-w-3xl">

                <div class="flex items-center gap-3 mb-6" aria-hidden="true">
                    <div class="w-10 h-px bg-gold"></div>
                    <span class="text-xs font-semibold tracking-[0.3em] uppercase text-gold">8th Edition · 2026</span>
                </div>

                <h1 class="font-serif text-white font-medium leading-tight mb-6" style="font-size: clamp(2.25rem, 6vw, 4.25rem);">
                    Celebrating Africa's<br>
                    <em class="italic text-gold-light font-semibold">Finest</em> Brands &amp;<br>
                    Entrepreneurs
                </h1>

                <p class="mb-10 font-light leading-relaxed text-warm-white/75" style="font-size: clamp(1rem, 2vw, 1.125rem); max-width: 520px;">
                    Promoting African Innovations for Sustainable Growth — where excellence meets recognition across the continent.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-8 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-crimson border border-crimson hover:bg-transparent"
                       aria-label="Nominate a business for the CenBa Africa Business Excellence Award">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Nominate Now
                    </a>
                    <a href="{{ route('about') }}" wire:navigate
                       class="inline-flex items-center gap-2 px-8 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200 border border-white/30 hover:border-gold hover:text-gold">
                        Learn More
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- Slide indicators --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3" role="tablist" aria-label="Hero slides">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="go(index)" role="tab" :aria-selected="current === index" :aria-label="'Go to slide ' + (index + 1)"
                class="h-[3px] transition-all duration-300"
                :class="current === index ? 'w-8 bg-gold' : 'w-2 bg-white/35'"></button>
        </template>
    </div>

</section>


{{-- ============================================================
     SECTION 2: STATS BAR
     ============================================================ --}}
<section aria-label="Awards statistics" class="bg-dark-2 border-y border-gold/10">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $stats = [
                    ['number' => '8th', 'label' => 'Edition of the Awards'],
                    ['number' => '2016', 'label' => 'Year Established'],
                    ['number' => '9+', 'label' => 'Award Categories'],
                    ['number' => '5+', 'label' => 'Strategic Partners'],
                ];
            @endphp
            @foreach($stats as $i => $stat)
            <div class="text-center {{ $i < 3 ? 'lg:border-r lg:border-gold/15' : '' }}">
                <p class="font-serif font-normal mb-1 text-gold" style="font-size: clamp(2rem, 4vw, 3rem);">{{ $stat['number'] }}</p>
                <p class="text-xs font-medium tracking-widest uppercase text-warm-white/45">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: ABOUT US
     ============================================================ --}}
<section id="about" aria-labelledby="about-heading" class="bg-white">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div class="relative order-2 lg:order-1">
                <div class="relative overflow-hidden" style="aspect-ratio: 4/5;">
                    <img src="{{ asset('images/about.jpg') }}" alt="CenBa Africa Business Excellence Awards ceremony gathering"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">
                    <div class="absolute bottom-0 right-0 text-white text-center px-8 py-6 bg-crimson">
                        <p class="font-serif font-normal leading-none" style="font-size: 3rem;">9+</p>
                        <p class="text-xs tracking-widest uppercase mt-1 text-white/70">Years of Excellence</p>
                    </div>
                </div>
                <div class="absolute top-6 -left-4 w-1 h-32 hidden lg:block bg-gold"></div>
            </div>

            <div class="order-1 lg:order-2">
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase text-crimson">About Us</span>
                </div>

                <h2 id="about-heading" class="font-serif font-normal mb-6 leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                    Who We Are
                </h2>

                <p class="leading-relaxed mb-5 text-[#444444]" style="line-height: 1.85;">
                    The CenBa Africa Business Excellence Awards celebrate outstanding achievements in the African business landscape. Backed by the <strong class="text-ink">Award Trust Mark</strong> (Independent Award Standard Council, UK) to ensure global standards of credibility, transparency, and prestige.
                </p>

                <p class="leading-relaxed mb-8 text-[#444444]" style="line-height: 1.85;">
                    CABEA aims to recognise businesses that demonstrate innovation, leadership, and a commitment to excellence — serving as a platform for those who contribute significantly to Africa's economic development.
                </p>

                <div class="flex items-start gap-4 p-5 mb-8 bg-cream border-l-[3px] border-gold">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <p class="text-sm leading-relaxed text-[#555555]">
                        Accredited by the <strong class="text-ink">Award Trust Mark</strong> — Independent Award Standard Council, United Kingdom
                    </p>
                </div>

                <a href="{{ route('about') }}" wire:navigate
                   class="inline-flex items-center gap-2 text-sm font-semibold tracking-widest uppercase transition-all duration-200 pb-1 text-crimson border-b border-crimson hover:text-gold hover:border-gold">
                    Read Our Full Story
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: OBJECTIVES
     ============================================================ --}}
<section id="objectives" aria-labelledby="objectives-heading" class="bg-cream">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="max-w-2xl mx-auto text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-xs font-semibold tracking-[0.25em] uppercase text-crimson">Our Objectives</span>
                <div class="w-8 h-px bg-crimson"></div>
            </div>
            <h2 id="objectives-heading" class="font-serif font-normal text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                What We Aim to Achieve
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-black/8">
            @php
                $objectives = [
                    ['number' => '01', 'title' => 'Recognise Excellence', 'body' => 'Honoring businesses that achieve high performance standards and contribute positively to their industries and communities across Africa.'],
                    ['number' => '02', 'title' => 'Promote Best Practices', 'body' => 'Showcasing innovative strategies and practices that lead to business success, encouraging others to adopt similar approaches continent-wide.'],
                    ['number' => '03', 'title' => 'Foster Collaboration', 'body' => 'Creating a platform for networking and collaboration among businesses, stakeholders, and industry leaders across Africa.'],
                    ['number' => '04', 'title' => 'Encourage Sustainable Development', 'body' => 'Promoting sustainable business practices aligned with SDG 8 (Decent Work & Economic Growth) and SDG 9 (Industry, Innovation & Infrastructure).'],
                ];
            @endphp
            @foreach($objectives as $obj)
            <article class="p-10 transition-all duration-300 group bg-white hover:bg-crimson">
                <p class="font-serif font-normal mb-6 leading-none text-crimson/10 transition-colors duration-300 group-hover:text-white/20" style="font-size: 3.5rem;">
                    {{ $obj['number'] }}
                </p>
                <h3 class="font-semibold mb-4 text-base text-ink transition-colors duration-300 group-hover:text-white">
                    {{ $obj['title'] }}
                </h3>
                <p class="text-sm leading-relaxed text-[#666666] transition-colors duration-300 group-hover:text-white/80">
                    {{ $obj['body'] }}
                </p>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 5: AWARD CRITERIA
     ============================================================ --}}
<section id="criteria" aria-labelledby="criteria-heading" class="relative overflow-hidden bg-crimson">

    <div class="absolute inset-0 flex items-center justify-end pointer-events-none" aria-hidden="true">
        <p class="font-serif font-normal select-none text-white/[0.04]" style="font-size: 16rem; line-height: 1; margin-right: -2rem;">CENBA</p>
    </div>

    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-gold"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase text-gold">Award Criteria</span>
                </div>

                <h2 id="criteria-heading" class="font-serif font-normal text-white mb-6 leading-tight" style="font-size: clamp(2rem, 4vw, 3rem);">
                    Built on Four Pillars of Excellence
                </h2>

                <p class="mb-10 leading-relaxed text-white/70">
                    Nominations are evaluated by a panel of expert judges across these core dimensions, ensuring a rigorous and fair selection process.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 bg-black/25 border border-white/10">
                        <p class="text-xs tracking-widest uppercase mb-2 text-white/50">Nominations Open</p>
                        <p class="text-white font-medium">25th September, 2025</p>
                    </div>
                    <div class="p-5 bg-black/25 border border-white/10">
                        <p class="text-xs tracking-widest uppercase mb-2 text-white/50">Entries Close</p>
                        <p class="text-white font-medium">1st December, 2025</p>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('award.criteria') }}" wire:navigate
                       class="inline-flex items-center gap-2 text-sm font-semibold tracking-widest uppercase pb-1 transition-colors duration-200 text-gold border-b border-gold hover:text-white hover:border-white">
                        View Full Criteria
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                @php
                    $pillars = [
                        ['icon' => '★', 'title' => 'Excellence', 'body' => 'Evaluating the level of achievement, quality of work, performance, and contribution to the field.'],
                        ['icon' => '◆', 'title' => 'Innovation', 'body' => 'Recognising novel ideas, methods, or solutions that drive progress and positive change across Africa.'],
                        ['icon' => '●', 'title' => 'Impact', 'body' => 'Significant social, cultural, environmental, or scientific contribution to communities across the continent.'],
                        ['icon' => '▲', 'title' => 'Leadership', 'body' => 'Exceptional leadership qualities — inspiring others, driving change, and achieving notable results.'],
                    ];
                @endphp
                @foreach($pillars as $pillar)
                <div class="flex items-start gap-5 p-6 transition-all duration-200 bg-black/20 border-l-[3px] border-gold/30 hover:border-gold hover:bg-black/35">
                    <span class="flex-shrink-0 text-lg text-gold" aria-hidden="true">{{ $pillar['icon'] }}</span>
                    <div>
                        <h3 class="text-white font-semibold mb-2">{{ $pillar['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-white/65">{{ $pillar['body'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 6: EVENTS 2026
     ============================================================ --}}
<section id="events" aria-labelledby="events-heading" class="bg-white">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-16">
            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase text-crimson">2026 Programme</span>
                </div>
                <h2 id="events-heading" class="font-serif font-normal text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                    Mark Your Calendar
                </h2>
            </div>
        </div>

        <div class="space-y-4">
            @php
                $eventsList = [
                    ['date' => '12th November 2026', 'day' => 'Thursday', 'name' => 'CenBa Awards Launch', 'venue' => 'AGI Office, Kumasi', 'time' => '9:00 AM – 12:00 NOON', 'highlight' => false],
                    ['date' => '26th November 2026', 'day' => 'Thursday', 'name' => 'Business Seminar — Promoting Africa Innovations for Sustainable Growth', 'venue' => 'Live Event Center, Kumasi Mall', 'time' => '9:00 AM – 12:00 PM', 'highlight' => false],
                    ['date' => '28th November 2026', 'day' => 'Saturday', 'name' => 'CenBa Awards & Dinner Night', 'venue' => 'Golden Bean Hotel, Ahodwo Nhyiaeso, Kumasi', 'time' => '6:00 PM – 10:00 PM', 'highlight' => true],
                ];
            @endphp
            @foreach($eventsList as $event)
            <article class="flex flex-col sm:flex-row sm:items-center gap-6 p-8 transition-all duration-200 bg-cream border-l-4 hover:bg-cream-dark/60 hover:border-crimson {{ $event['highlight'] ? 'border-crimson' : 'border-cream-dark' }}">
                <div class="flex-shrink-0 sm:w-48">
                    <p class="font-medium text-sm mb-0.5 text-crimson">{{ $event['day'] }}</p>
                    <p class="font-serif font-normal text-ink" style="font-size: 1.125rem;">{{ $event['date'] }}</p>
                </div>

                <div class="hidden sm:block w-px self-stretch bg-black/10" aria-hidden="true"></div>

                <div class="flex-1">
                    <h3 class="font-semibold mb-1.5 text-ink">{{ $event['name'] }}</h3>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                        <p class="flex items-center gap-2 text-sm text-[#666666]">
                            <svg class="w-4 h-4 flex-shrink-0 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event['venue'] }}
                        </p>
                        <p class="flex items-center gap-2 text-sm text-[#666666]">
                            <svg class="w-4 h-4 flex-shrink-0 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $event['time'] }}
                        </p>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 7: HOW TO NOMINATE
     ============================================================ --}}
<section id="nominate" aria-labelledby="nominate-heading" class="bg-cream">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase text-crimson">Nomination Process</span>
                </div>
                <h2 id="nominate-heading" class="font-serif font-normal mb-6 leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                    How to Nominate a Business
                </h2>
                <p class="leading-relaxed mb-10 text-[#555555]">
                    Nominating a business is simple. Follow these steps to submit your nomination before the deadline.
                </p>
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-8 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-crimson hover:bg-crimson-light"
                   aria-label="Nominate a business for the CenBa Africa Business Excellence Award">
                    Nominate Now
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <div class="space-y-6">
                @php
                    $steps = [
                        ['step' => '01', 'title' => 'Visit the Nomination Page', 'body' => 'Go to our official nomination page on the website.'],
                        ['step' => '02', 'title' => 'Select a Category', 'body' => 'Choose the appropriate award category that best fits the business.'],
                        ['step' => '03', 'title' => 'Complete the Form', 'body' => 'Fill in the nomination form with accurate and complete details.'],
                        ['step' => '04', 'title' => 'Submit Before Deadline', 'body' => 'Submit your nomination before 1st December, 2025.'],
                    ];
                @endphp
                @foreach($steps as $step)
                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center text-white font-bold text-sm bg-crimson">
                        {{ $step['step'] }}
                    </div>
                    <div class="flex-1 pt-2">
                        <h3 class="font-semibold mb-1 text-ink">{{ $step['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-[#666666]">{{ $step['body'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 8: PARTNERS & SPONSORS
     ============================================================ --}}
<section id="partners" aria-labelledby="partners-heading" class="bg-dark">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-gold"></div>
                <span class="text-xs font-semibold tracking-[0.25em] uppercase text-gold">Our Network</span>
                <div class="w-8 h-px bg-gold"></div>
            </div>
            <h2 id="partners-heading" class="font-serif font-normal text-white" style="font-size: clamp(2rem, 4vw, 3rem);">
                Partners &amp; Sponsors
            </h2>
        </div>

        {{-- Partners --}}
        <div class="mb-12">
            <h3 class="text-xs font-semibold tracking-[0.25em] uppercase mb-8 text-center text-white/30">Strategic Partners</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-px bg-white/5">
                @php
                    $partnersList = ['Otumfuo Osei Tutu II Education Fund','Ministry of Trade, Agribusiness & Industry','AGI','E4Impact Foundation','Wisconsin Int. University College','HIPAG Services','Prime Focus Estate'];
                @endphp
                @if($partners->count() > 0)
                    @foreach($partners as $partner)
                    <div class="flex items-center justify-center p-8 transition-all duration-200 bg-dark-2 hover:bg-[#222222]">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                 class="max-h-12 w-auto object-contain grayscale brightness-75 hover:grayscale-0 hover:brightness-100 transition-all"
                                 loading="lazy" decoding="async">
                        @else
                            <p class="text-center text-sm font-medium text-white/40">{{ $partner->name }}</p>
                        @endif
                    </div>
                    @endforeach
                @else
                    @foreach($partnersList as $partner)
                    <div class="flex items-center justify-center p-8 bg-dark-2">
                        <p class="text-center text-xs font-medium text-white/35">{{ $partner }}</p>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Sponsors --}}
        <div>
            <h3 class="text-xs font-semibold tracking-[0.25em] uppercase mb-8 text-center text-white/30">Sponsors</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px bg-white/5">
                @php
                    $sponsorsList = ['Lumax Electricals','Eugenmart Travel & Consult','Seahorse Engine Oil','Mannabel Fast Food','Ray Rock Resource Ghana','Theresa Rice','Yuuyuu Cereal'];
                @endphp
                @if($sponsors->count() > 0)
                    @foreach($sponsors as $sponsor)
                    <div class="flex items-center justify-center p-8 transition-all duration-200 bg-dark-2 hover:bg-[#222222]">
                        @if($sponsor->logo)
                            <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                 class="max-h-12 w-auto object-contain grayscale brightness-75 hover:grayscale-0 hover:brightness-100 transition-all"
                                 loading="lazy" decoding="async">
                        @else
                            <p class="text-center text-xs font-medium text-white/35">{{ $sponsor->name }}</p>
                        @endif
                    </div>
                    @endforeach
                @else
                    @foreach($sponsorsList as $sponsor)
                    <div class="flex items-center justify-center p-8 bg-dark-2">
                        <p class="text-center text-xs font-medium text-white/35">{{ $sponsor }}</p>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 9: NOMINATION CTA
     ============================================================ --}}
<section aria-labelledby="cta-heading" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>

    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-20 relative z-10">
        <div class="max-w-3xl mx-auto text-center">

            <h2 id="cta-heading" class="font-serif font-normal text-white mb-4 leading-tight" style="font-size: clamp(2rem, 4vw, 3rem);">
                Ready to Nominate a Business for Excellence?
            </h2>

            <p class="mb-10 leading-relaxed text-white/70">
                Nominations are open to all businesses operating in Africa — startups, SMEs, and large corporations across all sectors. Submissions must be received before 1st December, 2025.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-gold text-ink hover:bg-gold-light"
                   aria-label="Submit a nomination for the CenBa Africa Business Excellence Award">
                    Submit Nomination
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('award.criteria') }}" wire:navigate
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-10 py-4 font-semibold text-white text-sm tracking-widest uppercase transition-all duration-200 border border-white/35 hover:border-gold hover:text-gold">
                    View Criteria
                </a>
            </div>

        </div>
    </div>
</section>

</div>