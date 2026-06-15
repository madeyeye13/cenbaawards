<div>

{{-- ============================================================
     SECTION 1: HERO
     Dark background, 3 slides, Alpine.js slider
     ============================================================ --}}
<section
    id="hero"
    aria-label="CenBa Awards Hero"
    class="relative w-full overflow-hidden mt-16"
    style="height: 100vh; min-height: 640px;"
    x-data="{
        current: 0,
        slides: [
            { image: '{{ asset('images/hero/slide-1.jpg') }}', alt: '2025 CenBa Africa Business Excellence Awards Ceremony' },
            { image: '{{ asset('images/hero/slide-2.jpg') }}', alt: 'CenBa Awards Winners Celebration' },
            { image: '{{ asset('images/hero/slide-3.jpg') }}', alt: 'CenBa Africa Business Excellence Gala Night' },
        ],
        autoplay: null,
        start() {
            this.autoplay = setInterval(() => {
                this.current = (this.current + 1) % this.slides.length;
            }, 6000);
        },
        go(index) {
            this.current = index;
            clearInterval(this.autoplay);
            this.start();
        }
    }"
    x-init="start()"
>
    {{-- Slides --}}
    <template x-for="(slide, index) in slides" :key="index">
        <div
            class="absolute inset-0 transition-opacity duration-1000"
            :class="current === index ? 'opacity-100' : 'opacity-0'"
            role="img"
            :aria-label="slide.alt"
        >
            <img
                :src="slide.image"
                :alt="slide.alt"
                class="w-full h-full object-cover"
                loading="lazy"
                decoding="async"
            >
        </div>
    </template>

    {{-- Overlays --}}
    <div class="absolute inset-0 z-10" style="background: rgba(0,0,0,0.55);"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(to right, rgba(139,0,0,0.5) 0%, transparent 60%);"></div>
    <div class="absolute inset-0 z-10" style="background: linear-gradient(to top, rgba(13,13,13,0.8) 0%, transparent 50%);"></div>

    {{-- Content --}}
    <div class="relative z-20 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 xl:px-16 w-full">
            <div class="max-w-3xl">

                {{-- Eyebrow --}}
                <div class="flex items-center gap-3 mb-6" aria-hidden="true">
                    <div class="w-10 h-px" style="background: #C9A84C;"></div>
                    <span class="text-xs font-semibold tracking-[0.3em] uppercase" style="color: #C9A84C;">
                        8th Edition · 2026
                    </span>
                </div>

                {{-- H1 - one per page, SEO critical --}}
                <h1 class="text-white font-normal leading-tight mb-6"
                    style="font-family: 'DM Serif Display', serif; font-size: clamp(2.5rem, 7vw, 5rem);">
                    Celebrating Africa's<br>
                    <em style="color: #E2C27A;">Finest</em> Brands &amp;<br>
                    Entrepreneurs
                </h1>

                <p class="mb-10 font-light leading-relaxed"
                   style="color: rgba(250,250,249,0.75); font-size: clamp(1rem, 2vw, 1.125rem); max-width: 520px;">
                    Promoting African Innovations for Sustainable Growth — where excellence meets recognition across the continent.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-8 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200"
                       style="background: #8B0000; border: 1px solid #8B0000;"
                       onmouseover="this.style.background='transparent'; this.style.color='#fff';"
                       onmouseout="this.style.background='#8B0000'; this.style.color='#fff';"
                       aria-label="Nominate a business for the CenBa Africa Business Excellence Award">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Nominate Now
                    </a>
                    <a href="{{ route('about') }}"
                       wire:navigate
                       class="inline-flex items-center gap-2 px-8 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200"
                       style="border: 1px solid rgba(255,255,255,0.3);"
                       onmouseover="this.style.borderColor='#C9A84C'; this.style.color='#C9A84C';"
                       onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.color='#fff';">
                        Learn More
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- Slide indicators --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3" role="tablist" aria-label="Hero slides">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="go(index)"
                role="tab"
                :aria-selected="current === index"
                :aria-label="'Go to slide ' + (index + 1)"
                class="transition-all duration-300"
                :style="current === index
                    ? 'width: 32px; height: 3px; background: #C9A84C;'
                    : 'width: 8px; height: 3px; background: rgba(255,255,255,0.35);'"
            ></button>
        </template>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 right-8 z-20 hidden md:flex flex-col items-center gap-2" aria-hidden="true">
        <span class="text-xs tracking-[0.2em] uppercase" style="color: rgba(255,255,255,0.35); writing-mode: vertical-rl;">Scroll</span>
        <div class="w-px h-12" style="background: linear-gradient(to bottom, rgba(201,168,76,0.6), transparent);"></div>
    </div>

</section>


{{-- ============================================================
     SECTION 2: STATS BAR
     Dark surface, 4 stats
     ============================================================ --}}
<section aria-label="Awards statistics" style="background: #1A1A1A; border-top: 1px solid rgba(201,168,76,0.1); border-bottom: 1px solid rgba(201,168,76,0.1);">
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
            <div class="text-center {{ $i < 3 ? 'lg:border-r' : '' }}" style="{{ $i < 3 ? 'border-color: rgba(201,168,76,0.15)' : '' }}">
                <p class="font-normal mb-1" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem); color: #C9A84C;">
                    {{ $stat['number'] }}
                </p>
                <p class="text-xs font-medium tracking-widest uppercase" style="color: rgba(250,250,249,0.45);">
                    {{ $stat['label'] }}
                </p>
            </div>
            @endforeach

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: ABOUT US
     White background
     ============================================================ --}}
<section id="about" aria-labelledby="about-heading" style="background: #FFFFFF;">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Image --}}
            <div class="relative order-2 lg:order-1">
                <div class="relative overflow-hidden" style="aspect-ratio: 4/5;">
                    <img
                        src="{{ asset('images/about.jpg') }}"
                        alt="CenBa Africa Business Excellence Awards ceremony gathering"
                        class="w-full h-full object-cover"
                        loading="lazy"
                        decoding="async"
                    >
                    {{-- Year badge --}}
                    <div class="absolute bottom-0 right-0 text-white text-center px-8 py-6" style="background: #8B0000;">
                        <p class="font-normal leading-none" style="font-family: 'DM Serif Display', serif; font-size: 3rem;">9+</p>
                        <p class="text-xs tracking-widest uppercase mt-1" style="color: rgba(255,255,255,0.7);">Years of Excellence</p>
                    </div>
                </div>
                {{-- Gold accent line --}}
                <div class="absolute top-6 -left-4 w-1 h-32 hidden lg:block" style="background: #C9A84C;"></div>
            </div>

            {{-- Text --}}
            <div class="order-1 lg:order-2">
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px" style="background: #8B0000;"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase" style="color: #8B0000;">About Us</span>
                </div>

                <h2 id="about-heading" class="font-normal mb-6 leading-tight" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem); color: #111111;">
                    Who We Are
                </h2>

                <p class="leading-relaxed mb-5" style="color: #444444; font-size: 1rem; line-height: 1.85;">
                    The CenBa Africa Business Excellence Awards celebrate outstanding achievements in the African business landscape. Backed by the <strong style="color: #111111;">Award Trust Mark</strong> (Independent Award Standard Council, UK) to ensure global standards of credibility, transparency, and prestige.
                </p>

                <p class="leading-relaxed mb-8" style="color: #444444; font-size: 1rem; line-height: 1.85;">
                    CABEA aims to recognise businesses that demonstrate innovation, leadership, and a commitment to excellence — serving as a platform for those who contribute significantly to Africa's economic development.
                </p>

                {{-- Trust mark --}}
                <div class="flex items-start gap-4 p-5 mb-8" style="background: #F5F0E8; border-left: 3px solid #C9A84C;">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color: #C9A84C;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <p class="text-sm leading-relaxed" style="color: #555555;">
                        Accredited by the <strong style="color: #111111;">Award Trust Mark</strong> — Independent Award Standard Council, United Kingdom
                    </p>
                </div>

                <a href="{{ route('about') }}"
                   wire:navigate
                   class="inline-flex items-center gap-2 text-sm font-semibold tracking-widest uppercase transition-all duration-200 pb-1"
                   style="color: #8B0000; border-bottom: 1px solid #8B0000;"
                   onmouseover="this.style.color='#C9A84C'; this.style.borderColor='#C9A84C';"
                   onmouseout="this.style.color='#8B0000'; this.style.borderColor='#8B0000';">
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
     Light warm grey background
     ============================================================ --}}
<section id="objectives" aria-labelledby="objectives-heading" style="background: #F5F0E8;">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        {{-- Header --}}
        <div class="max-w-2xl mx-auto text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px" style="background: #8B0000;"></div>
                <span class="text-xs font-semibold tracking-[0.25em] uppercase" style="color: #8B0000;">Our Objectives</span>
                <div class="w-8 h-px" style="background: #8B0000;"></div>
            </div>
            <h2 id="objectives-heading" class="font-normal" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem); color: #111111;">
                What We Aim to Achieve
            </h2>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px" style="background: rgba(0,0,0,0.08);">
            @php
                $objectives = [
                    [
                        'number' => '01',
                        'title' => 'Recognise Excellence',
                        'body' => 'Honoring businesses that achieve high performance standards and contribute positively to their industries and communities across Africa.',
                    ],
                    [
                        'number' => '02',
                        'title' => 'Promote Best Practices',
                        'body' => 'Showcasing innovative strategies and practices that lead to business success, encouraging others to adopt similar approaches continent-wide.',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Foster Collaboration',
                        'body' => 'Creating a platform for networking and collaboration among businesses, stakeholders, and industry leaders across Africa.',
                    ],
                    [
                        'number' => '04',
                        'title' => 'Encourage Sustainable Development',
                        'body' => 'Promoting sustainable business practices aligned with SDG 8 (Decent Work & Economic Growth) and SDG 9 (Industry, Innovation & Infrastructure).',
                    ],
                ];
            @endphp

            @foreach($objectives as $obj)
            <article class="p-10 transition-all duration-300 group" style="background: #FFFFFF;"
                     onmouseover="this.style.background='#8B0000';"
                     onmouseout="this.style.background='#FFFFFF';">
                <p class="font-normal mb-6 transition-colors duration-300 group-hover:text-white"
                   style="font-family: 'DM Serif Display', serif; font-size: 3.5rem; color: rgba(139,0,0,0.12); line-height: 1;">
                    {{ $obj['number'] }}
                </p>
                <h3 class="font-semibold mb-4 text-base transition-colors duration-300 group-hover:text-white" style="color: #111111;">
                    {{ $obj['title'] }}
                </h3>
                <p class="text-sm leading-relaxed transition-colors duration-300 group-hover:text-white/75" style="color: #666666;">
                    {{ $obj['body'] }}
                </p>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 5: AWARD CRITERIA
     Crimson background
     ============================================================ --}}
<section id="criteria" aria-labelledby="criteria-heading" style="background: #8B0000; position: relative; overflow: hidden;">

    {{-- Watermark --}}
    <div class="absolute inset-0 flex items-center justify-end pointer-events-none" aria-hidden="true">
        <p class="font-normal select-none" style="font-family: 'DM Serif Display', serif; font-size: 16rem; color: rgba(255,255,255,0.04); line-height: 1; margin-right: -2rem;">CENBA</p>
    </div>

    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            {{-- Left --}}
            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px" style="background: #C9A84C;"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase" style="color: #C9A84C;">Award Criteria</span>
                </div>

                <h2 id="criteria-heading" class="font-normal text-white mb-6 leading-tight" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem);">
                    Built on Four Pillars of Excellence
                </h2>

                <p class="mb-10 leading-relaxed" style="color: rgba(255,255,255,0.7); font-size: 1rem;">
                    Nominations are evaluated by a panel of expert judges across these core dimensions, ensuring a rigorous and fair selection process.
                </p>

                {{-- Dates --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5" style="background: rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.1);">
                        <p class="text-xs tracking-widest uppercase mb-2" style="color: rgba(255,255,255,0.5);">Nominations Open</p>
                        <p class="text-white font-medium">25th September, 2025</p>
                    </div>
                    <div class="p-5" style="background: rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.1);">
                        <p class="text-xs tracking-widest uppercase mb-2" style="color: rgba(255,255,255,0.5);">Entries Close</p>
                        <p class="text-white font-medium">1st December, 2025</p>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('award.criteria') }}"
                       wire:navigate
                       class="inline-flex items-center gap-2 text-sm font-semibold tracking-widest uppercase pb-1 transition-colors duration-200"
                       style="color: #C9A84C; border-bottom: 1px solid #C9A84C;"
                       onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
                       onmouseout="this.style.color='#C9A84C'; this.style.borderColor='#C9A84C';">
                        View Full Criteria
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Right - Pillars --}}
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
                <div class="flex items-start gap-5 p-6 transition-all duration-200 group"
                     style="background: rgba(0,0,0,0.2); border-left: 3px solid rgba(201,168,76,0.3);"
                     onmouseover="this.style.borderLeftColor='#C9A84C'; this.style.background='rgba(0,0,0,0.35)';"
                     onmouseout="this.style.borderLeftColor='rgba(201,168,76,0.3)'; this.style.background='rgba(0,0,0,0.2)';">
                    <span class="flex-shrink-0 text-lg" style="color: #C9A84C;" aria-hidden="true">{{ $pillar['icon'] }}</span>
                    <div>
                        <h3 class="text-white font-semibold mb-2">{{ $pillar['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: rgba(255,255,255,0.65);">{{ $pillar['body'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 6: EVENTS 2026
     White background
     ============================================================ --}}
<section id="events" aria-labelledby="events-heading" style="background: #FFFFFF;">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-16">
            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px" style="background: #8B0000;"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase" style="color: #8B0000;">2026 Programme</span>
                </div>
                <h2 id="events-heading" class="font-normal" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem); color: #111111;">
                    Mark Your Calendar
                </h2>
            </div>
        </div>

        <div class="space-y-4">
            @php
                $eventsList = [
                    [
                        'date' => '12th November 2026',
                        'day' => 'Thursday',
                        'name' => 'CenBa Awards Launch',
                        'venue' => 'AGI Office, Kumasi',
                        'time' => '9:00 AM – 12:00 NOON',
                    ],
                    [
                        'date' => '26th November 2026',
                        'day' => 'Thursday',
                        'name' => 'Business Seminar — Promoting Africa Innovations for Sustainable Growth',
                        'venue' => 'Live Event Center, Kumasi Mall',
                        'time' => '9:00 AM – 12:00 PM',
                    ],
                    [
                        'date' => '28th November 2026',
                        'day' => 'Saturday',
                        'name' => 'CenBa Awards & Dinner Night',
                        'venue' => 'Golden Bean Hotel, Ahodwo Nhyiaeso, Kumasi',
                        'time' => '6:00 PM – 10:00 PM',
                    ],
                ];
            @endphp

            @foreach($eventsList as $index => $event)
            <article
                class="flex flex-col sm:flex-row sm:items-center gap-6 p-8 transition-all duration-200 group"
                style="background: #F5F0E8; border-left: 4px solid {{ $index === 2 ? '#8B0000' : '#E8E0D0' }};"
                onmouseover="this.style.borderLeftColor='#8B0000'; this.style.background='#F0E8DC';"
                onmouseout="this.style.borderLeftColor='{{ $index === 2 ? '#8B0000' : '#E8E0D0' }}'; this.style.background='#F5F0E8';"
            >
                {{-- Date --}}
                <div class="flex-shrink-0 sm:w-48">
                    <p class="font-medium text-sm mb-0.5" style="color: #8B0000;">{{ $event['day'] }}</p>
                    <p class="font-normal" style="font-family: 'DM Serif Display', serif; font-size: 1.125rem; color: #111111;">{{ $event['date'] }}</p>
                </div>

                {{-- Divider --}}
                <div class="hidden sm:block w-px self-stretch" style="background: rgba(0,0,0,0.1);" aria-hidden="true"></div>

                {{-- Info --}}
                <div class="flex-1">
                    <h3 class="font-semibold mb-1.5" style="color: #111111; font-size: 1rem;">{{ $event['name'] }}</h3>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                        <p class="flex items-center gap-2 text-sm" style="color: #666666;">
                            <svg class="w-4 h-4 flex-shrink-0" style="color: #8B0000;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event['venue'] }}
                        </p>
                        <p class="flex items-center gap-2 text-sm" style="color: #666666;">
                            <svg class="w-4 h-4 flex-shrink-0" style="color: #8B0000;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
     Light warm background
     ============================================================ --}}
<section id="nominate" aria-labelledby="nominate-heading" style="background: #F5F0E8;">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px" style="background: #8B0000;"></div>
                    <span class="text-xs font-semibold tracking-[0.25em] uppercase" style="color: #8B0000;">Nomination Process</span>
                </div>
                <h2 id="nominate-heading" class="font-normal mb-6 leading-tight" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem); color: #111111;">
                    How to Nominate a Business
                </h2>
                <p class="leading-relaxed mb-10" style="color: #555555;">
                    Nominating a business is simple. Follow these steps to submit your nomination before the deadline.
                </p>
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-8 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200"
                   style="background: #8B0000;"
                   onmouseover="this.style.background='#6B0000';"
                   onmouseout="this.style.background='#8B0000';"
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
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center text-white font-bold text-sm" style="background: #8B0000;">
                        {{ $step['step'] }}
                    </div>
                    <div class="flex-1 pt-2">
                        <h3 class="font-semibold mb-1" style="color: #111111;">{{ $step['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color: #666666;">{{ $step['body'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 8: PARTNERS & SPONSORS
     Dark background
     ============================================================ --}}
<section id="partners" aria-labelledby="partners-heading" style="background: #111111;">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px" style="background: #C9A84C;"></div>
                <span class="text-xs font-semibold tracking-[0.25em] uppercase" style="color: #C9A84C;">Our Network</span>
                <div class="w-8 h-px" style="background: #C9A84C;"></div>
            </div>
            <h2 id="partners-heading" class="font-normal text-white" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem);">
                Partners &amp; Sponsors
            </h2>
        </div>

        {{-- Partners --}}
        <div class="mb-12">
            <h3 class="text-xs font-semibold tracking-[0.25em] uppercase mb-8 text-center" style="color: rgba(255,255,255,0.3);">Strategic Partners</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-px" style="background: rgba(255,255,255,0.05);">
                @php
                    $partnersList = [
                        'Otumfuo Osei Tutu II Education Fund',
                        'Ministry of Trade, Agribusiness & Industry',
                        'AGI',
                        'E4Impact Foundation',
                        'Wisconsin Int. University College',
                        'HIPAG Services',
                        'Prime Focus Estate',
                    ];
                @endphp
                @if($partners->count() > 0)
                    @foreach($partners as $partner)
                    <div class="flex items-center justify-center p-8 transition-all duration-200" style="background: #1A1A1A;"
                         onmouseover="this.style.background='#222222';"
                         onmouseout="this.style.background='#1A1A1A';">
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}"
                                 alt="{{ $partner->name }}"
                                 class="max-h-12 w-auto object-contain"
                                 loading="lazy"
                                 decoding="async"
                                 style="filter: grayscale(1) brightness(0.8);"
                                 onmouseover="this.style.filter='grayscale(0) brightness(1)';"
                                 onmouseout="this.style.filter='grayscale(1) brightness(0.8)';">
                        @else
                            <p class="text-center text-sm font-medium" style="color: rgba(255,255,255,0.4);">{{ $partner->name }}</p>
                        @endif
                    </div>
                    @endforeach
                @else
                    @foreach($partnersList as $partner)
                    <div class="flex items-center justify-center p-8" style="background: #1A1A1A;">
                        <p class="text-center text-xs font-medium" style="color: rgba(255,255,255,0.35);">{{ $partner }}</p>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Sponsors --}}
        <div>
            <h3 class="text-xs font-semibold tracking-[0.25em] uppercase mb-8 text-center" style="color: rgba(255,255,255,0.3);">Sponsors</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-px" style="background: rgba(255,255,255,0.05);">
                @php
                    $sponsorsList = [
                        'Lumax Electricals',
                        'Eugenmart Travel & Consult',
                        'Seahorse Engine Oil',
                        'Mannabel Fast Food',
                        'Ray Rock Resource Ghana',
                        'Theresa Rice',
                        'Yuuyuu Cereal',
                    ];
                @endphp
                @if($sponsors->count() > 0)
                    @foreach($sponsors as $sponsor)
                    <div class="flex items-center justify-center p-8 transition-all duration-200" style="background: #1A1A1A;"
                         onmouseover="this.style.background='#222222';"
                         onmouseout="this.style.background='#1A1A1A';">
                        @if($sponsor->logo)
                            <img src="{{ asset('storage/' . $sponsor->logo) }}"
                                 alt="{{ $sponsor->name }}"
                                 class="max-h-12 w-auto object-contain"
                                 loading="lazy"
                                 decoding="async"
                                 style="filter: grayscale(1) brightness(0.8);"
                                 onmouseover="this.style.filter='grayscale(0) brightness(1)';"
                                 onmouseout="this.style.filter='grayscale(1) brightness(0.8)';">
                        @else
                            <p class="text-center text-xs font-medium" style="color: rgba(255,255,255,0.35);">{{ $sponsor->name }}</p>
                        @endif
                    </div>
                    @endforeach
                @else
                    @foreach($sponsorsList as $sponsor)
                    <div class="flex items-center justify-center p-8" style="background: #1A1A1A;">
                        <p class="text-center text-xs font-medium" style="color: rgba(255,255,255,0.35);">{{ $sponsor }}</p>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 9: NOMINATION CTA
     Crimson background
     ============================================================ --}}
<section aria-labelledby="cta-heading" style="background: #8B0000; position: relative; overflow: hidden;">

    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #C9A84C 1px, transparent 1px); background-size: 28px 28px;">
    </div>

    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-20 relative z-10">
        <div class="max-w-3xl mx-auto text-center">

            <h2 id="cta-heading" class="font-normal text-white mb-4 leading-tight" style="font-family: 'DM Serif Display', serif; font-size: clamp(2rem, 4vw, 3rem);">
                Ready to Nominate a Business for Excellence?
            </h2>

            <p class="mb-10 leading-relaxed" style="color: rgba(255,255,255,0.7);">
                Nominations are open to all businesses operating in Africa — startups, SMEs, and large corporations across all sectors. Submissions must be received before 1st December, 2025.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200"
                   style="background: #C9A84C; color: #111111;"
                   onmouseover="this.style.background='#E2C27A';"
                   onmouseout="this.style.background='#C9A84C';"
                   aria-label="Submit a nomination for the CenBa Africa Business Excellence Award">
                    Submit Nomination
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('award.criteria') }}"
                   wire:navigate
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-10 py-4 font-semibold text-white text-sm tracking-widest uppercase transition-all duration-200"
                   style="border: 1px solid rgba(255,255,255,0.35);"
                   onmouseover="this.style.borderColor='#C9A84C'; this.style.color='#C9A84C';"
                   onmouseout="this.style.borderColor='rgba(255,255,255,0.35)'; this.style.color='#fff';">
                    View Criteria
                </a>
            </div>

        </div>
    </div>
</section>

</div>