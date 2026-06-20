<div>

{{-- ============================================================
     PAGE HERO — Image with black overlay
     ============================================================ --}}
<section aria-label="About page hero" class="relative" style="padding-top: 70px; min-height: 480px;">

    <div class="absolute inset-0" style="top: 70px;">
        <img src="{{ asset('images/about-hero.jpg') }}"
             alt="CenBa Africa Business Excellence Awards ceremony"
             class="w-full h-full object-cover" loading="eager" decoding="async">
    </div>

    <div class="absolute inset-0 bg-black/70" style="top: 70px;" aria-hidden="true"></div>

    <div class="relative z-10 max-w-screen-2xl mx-auto px-6 xl:px-20 flex items-center" style="min-height: 480px;">
        <div>
            <div class="flex items-center gap-3 mb-5" aria-hidden="true">
                <div class="w-0.5 h-5 bg-gold"></div>
                <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Our Story</span>
            </div>

            <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 740px;">
                About CenBa Africa Business Excellence Awards
            </h1>

            <p class="mt-6 leading-relaxed text-white/75" style="max-width: 560px; font-size: 1rem;">
                Celebrating Africa's finest businesses since 2016 — backed by global standards of credibility, transparency, and prestige.
            </p>

            <nav aria-label="Breadcrumb" class="mt-10">
                <ol class="flex items-center gap-2 text-xs text-white/55">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-white/55 hover:text-gold transition-colors">Home</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li class="text-gold" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div>

</section>


{{-- ============================================================
     SECTION 1: WHO WE ARE
     ============================================================ --}}
<section id="who-we-are" aria-labelledby="who-we-are-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Get To Know Us</span>
                </div>
                <h2 id="who-we-are-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                    Who We Are
                </h2>
                <p class="leading-relaxed mb-5 text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    The CenBa Africa Business Excellence Awards celebrate outstanding achievements in the African business landscape. Backed by the <strong class="text-ink">Award Trust Mark</strong> (Independent Award Standard Council, UK) to ensure global standards of credibility, transparency, and prestige.
                </p>
                <p class="leading-relaxed mb-8 text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    CABEA aims to recognise businesses that demonstrate innovation, leadership, and a commitment to excellence. With a strong focus on promoting sustainable practices and social responsibility, the award serves as a platform for honoring those who contribute significantly to Africa's economic development.
                </p>

                <div class="flex items-start gap-4 p-5 bg-cream border-l-[3px] border-gold">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-sm mb-1 text-ink">Award Trust Mark Accredited</p>
                        <p class="text-sm leading-relaxed text-[#555555]">Independent Award Standard Council, United Kingdom — ensuring global standards of credibility and prestige.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div style="aspect-ratio: 3/4; overflow: hidden;">
                    <img src="{{ asset('images/about-1.jpg') }}" alt="CenBa Awards ceremony — delegates and attendees"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="mt-10" style="aspect-ratio: 3/4; overflow: hidden;">
                    <img src="{{ asset('images/about-2.jpg') }}" alt="CenBa Awards — business leaders gathering"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 2: HISTORY
     ============================================================ --}}
<section id="history" aria-labelledby="history-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <div class="relative">
                <div style="aspect-ratio: 4/3; overflow: hidden;">
                    <img src="{{ asset('images/history.jpg') }}" alt="CenBa Awards history — founding ceremony 2016"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="absolute bottom-0 left-0 px-8 py-6 text-white bg-crimson">
                    <p class="font-serif font-normal leading-none" style="font-size: 2.5rem;">2016</p>
                    <p class="text-[0.65rem] tracking-[0.2em] uppercase text-white/70 mt-1">Year Founded</p>
                </div>
            </div>

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">How We Started</span>
                </div>
                <h2 id="history-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                    Our History
                </h2>
                <p class="leading-relaxed mb-5 text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    The CenBa Africa Business Excellence Award was established in 2016 to honor exceptional businesses and individuals who contribute to the continent's growth.
                </p>
                <p class="leading-relaxed mb-5 text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    Since our inception, we have celebrated numerous milestones, including partnerships with key stakeholders and expanding into new categories to reflect the evolving business landscape.
                </p>
                <p class="leading-relaxed text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    By highlighting exemplary business practices, the award seeks to inspire and foster a culture of continuous improvement and success in Africa.
                </p>

                <div class="mt-10 space-y-4">
                    @php
                        $milestones = [
                            ['year' => '2016', 'text' => 'CenBa Africa Business Excellence Award established'],
                            ['year' => '2018', 'text' => 'Expanded award categories to reflect growing business landscape'],
                            ['year' => '2021', 'text' => 'Partnership with E4Impact Foundation, Italy'],
                            ['year' => '2024', 'text' => 'Award Trust Mark accreditation secured'],
                            ['year' => '2026', 'text' => '8th Edition — Promoting African Innovations for Sustainable Growth'],
                        ];
                    @endphp
                    @foreach($milestones as $milestone)
                    <div class="flex items-start gap-5">
                        <span class="flex-shrink-0 font-semibold text-sm text-crimson" style="min-width: 40px;">{{ $milestone['year'] }}</span>
                        <div class="flex-1 flex items-start gap-3 pt-0.5">
                            <div class="flex-shrink-0 mt-2 w-1.5 h-1.5 bg-gold"></div>
                            <p class="text-sm leading-relaxed text-[#555555]">{{ $milestone['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: OBJECTIVES
     ============================================================ --}}
<section id="objectives" aria-labelledby="objectives-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Our Objectives</span>
                </div>
                <h2 id="objectives-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 3vw, 2.75rem);">
                    What We Aim to Achieve
                </h2>
                <p class="leading-relaxed text-[#666666]" style="font-size: 0.95rem; line-height: 1.85;">
                    Every award, every ceremony, every recognition is driven by these core objectives that guide everything we do at CenBa.
                </p>
                <div class="mt-8 pt-8 border-t border-cream-dark">
                    <p class="font-serif font-normal text-crimson leading-none" style="font-size: 3rem;">4</p>
                    <p class="text-xs tracking-widest uppercase mt-1 text-[#999999]">Core Objectives</p>
                </div>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-px bg-cream-dark">
                @php
                    $objectives = [
                        ['number' => '01', 'title' => 'Recognise Excellence', 'body' => 'To honor businesses that achieve high performance standards and contribute positively to their industries and communities across Africa.'],
                        ['number' => '02', 'title' => 'Promote Best Practices', 'body' => 'To showcase innovative strategies and practices that lead to business success, encouraging others to adopt similar approaches continent-wide.'],
                        ['number' => '03', 'title' => 'Foster Collaboration', 'body' => 'To create a platform for networking and collaboration among businesses, stakeholders, and industry leaders across Africa.'],
                        ['number' => '04', 'title' => 'Encourage Sustainable Development', 'body' => 'To promote sustainable business practices aligned with SDG 8 (Decent Work & Economic Growth) and SDG 9 (Industry, Innovation & Infrastructure).'],
                    ];
                @endphp
                @foreach($objectives as $obj)
                <article class="p-8 transition-all duration-300 bg-white hover:bg-cream">
                    <p class="font-serif font-normal mb-4 leading-none text-crimson/10" style="font-size: 2.5rem;">{{ $obj['number'] }}</p>
                    <h3 class="font-semibold mb-3 text-ink" style="font-size: 0.95rem;">{{ $obj['title'] }}</h3>
                    <p class="text-sm leading-relaxed text-[#666666]">{{ $obj['body'] }}</p>
                </article>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: VISION & MISSION
     ============================================================ --}}
<section id="vision-mission" aria-labelledby="vision-heading" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 pointer-events-none opacity-5" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>

    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-gold"></div>
                    <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Our Direction</span>
                </div>
                <h2 id="vision-heading" class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2rem, 3vw, 2.75rem);">
                    Vision &amp; Mission
                </h2>
                <div class="mt-8 pt-8 border-t border-white/10">
                    <p class="text-sm leading-relaxed text-white/60">
                        Everything we do is guided by a clear vision for Africa's business future and a mission to make excellence the standard.
                    </p>
                </div>
            </div>

            <div class="p-8 bg-black/20 border-t-[3px] border-gold">
                <div class="w-10 h-10 flex items-center justify-center mb-6 bg-gold/15">
                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-4" style="font-size: 1.1rem;">Our Vision</h3>
                <p class="leading-relaxed text-white/70" style="font-size: 0.95rem; line-height: 1.85;">
                    To be the leading platform for recognizing and promoting excellence in African businesses. We envision a thriving business environment where innovation and sustainability are at the forefront of economic growth.
                </p>
            </div>

            <div class="p-8 bg-black/20 border-t-[3px] border-white/30">
                <div class="w-10 h-10 flex items-center justify-center mb-6 bg-white/10">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-4" style="font-size: 1.1rem;">Our Mission</h3>
                <p class="leading-relaxed text-white/70" style="font-size: 0.95rem; line-height: 1.85;">
                    We strive to promote best practices, inspire future entrepreneurs, and highlight the importance of corporate social responsibility across Africa's diverse and growing business ecosystem.
                </p>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 5: CENBA GRADUATE INSTITUTE
     ============================================================ --}}
<section id="institute" aria-labelledby="institute-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">The Institution</span>
                </div>
                <h2 id="institute-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                    CenBa Graduate Institute
                </h2>
                <p class="leading-relaxed mb-5 text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    The CenBa Graduate Institute is a premium management and entrepreneurship training center dedicated to fostering business excellence and innovation in Africa.
                </p>
                <p class="leading-relaxed mb-8 text-[#444444]" style="font-size: 1rem; line-height: 1.9;">
                    Our commitment to nurturing talent and promoting best practices in the business community drives the creation of the CenBa Africa Business Excellence Awards.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 bg-white border-l-[3px] border-crimson">
                        <p class="font-semibold text-sm mb-2 text-ink">Accra Campus</p>
                        <p class="text-xs leading-relaxed text-[#666666]">1111, Newtown Rd.<br>Greater Accra, Ghana West Africa</p>
                    </div>
                    <div class="p-5 bg-white border-l-[3px] border-gold">
                        <p class="font-semibold text-sm mb-2 text-ink">Kumasi Campus</p>
                        <p class="text-xs leading-relaxed text-[#666666]">Top Martins Complex, Asokwa<br>AK-240-2707, Greater Kumasi</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="https://www.cenbagraduate.com" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 text-sm font-semibold tracking-widest uppercase pb-1 transition-colors duration-200 text-crimson border-b border-crimson hover:text-gold hover:border-gold">
                        Visit Institute Website
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div style="aspect-ratio: 3/4; overflow: hidden;">
                    <img src="{{ asset('images/institute-1.jpg') }}" alt="CenBa Graduate Institute — training session"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
                <div class="mt-10" style="aspect-ratio: 3/4; overflow: hidden;">
                    <img src="{{ asset('images/institute-2.jpg') }}" alt="CenBa Graduate Institute — campus"
                         class="w-full h-full object-cover" loading="lazy" decoding="async">
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 6: STRATEGIC PARTNERSHIPS
     ============================================================ --}}
<section id="partners" aria-labelledby="partners-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Strategic Partnerships</span>
            </div>
            <h2 id="partners-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Our Esteemed Partners
            </h2>
            <p class="mt-4 leading-relaxed text-[#666666]" style="font-size: 0.95rem;">
                We are proud to collaborate with organisations that share our vision for growth and excellence in Ghana and across Africa.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-cream-dark">
            @php
                $partners = [
                    ['name' => 'Otumfuo Osei Tutu II Education Fund', 'description' => 'Supporting our mission to drive entrepreneurship and sustainable development within the Ashanti region and beyond.'],
                    ['name' => 'E4Impact Foundation (Italy)', 'description' => 'Acting in a prestigious partnership to foster international business and educational collaboration across Africa.'],
                    ['name' => 'CenBa Graduate Institute', 'description' => 'Serving as the primary management and entrepreneurship training center dedicated to fostering business excellence in Africa.'],
                    ['name' => 'Wisconsin International University College', 'description' => 'Providing the vital academic framework, research, and capacity-building excellence that fuel innovation across the continent\'s business ecosystem.'],
                    ['name' => 'Association of Ghana Industries (AGI)', 'description' => 'Anchoring our mission in industrial credibility as the leading voice of the private sector to champion market leadership and sustainable economic growth.'],
                    ['name' => 'Ministry of Trade, Agribusiness & Industry', 'description' => 'Providing government-level endorsement and support for our mission to promote business excellence across Ghana.'],
                ];
            @endphp
            @foreach($partners as $partner)
            <article class="p-8 transition-all duration-200 bg-white hover:bg-cream">
                <div class="w-8 h-0.5 mb-5 bg-gold"></div>
                <h3 class="font-semibold mb-3 text-ink" style="font-size: 0.95rem; line-height: 1.4;">{{ $partner['name'] }}</h3>
                <p class="text-sm leading-relaxed text-[#666666]">{{ $partner['description'] }}</p>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 7: FAQs
     ============================================================ --}}
<section id="faqs" aria-labelledby="faqs-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">FAQs</span>
                </div>
                <h2 id="faqs-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 3vw, 2.75rem);">
                    Frequently Asked Questions
                </h2>
                <p class="leading-relaxed mb-8 text-[#666666]" style="font-size: 0.95rem; line-height: 1.85;">
                    Everything you need to know about the CenBa Africa Business Excellence Awards.
                </p>
                <a href="{{ route('contact') }}" wire:navigate
                   class="inline-flex items-center gap-2 px-7 py-3 text-white text-xs font-bold tracking-widest uppercase transition-all duration-200 bg-crimson hover:bg-crimson-light">
                    Ask a Question
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <div class="lg:col-span-2 space-y-2">
                @foreach($faqs as $index => $faq)
                <div class="bg-white">
                    <button wire:click="toggleFaq({{ $index }})"
                        class="w-full flex items-center justify-between p-6 text-left transition-colors duration-200"
                        aria-expanded="{{ $activeFaq === $index ? 'true' : 'false' }}"
                        aria-controls="faq-answer-{{ $index }}">
                        <span class="font-medium text-sm pr-6 leading-relaxed transition-colors duration-200 {{ $activeFaq === $index ? 'text-crimson' : 'text-ink' }}">
                            {{ $faq['question'] }}
                        </span>
                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center transition-all duration-200 {{ $activeFaq === $index ? 'bg-crimson' : 'bg-cream' }}">
                            @if($activeFaq === $index)
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/>
                                </svg>
                            @else
                                <svg class="w-3 h-3 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                                </svg>
                            @endif
                        </span>
                    </button>
                    @if($activeFaq === $index)
                    <div id="faq-answer-{{ $index }}" class="px-6 pb-6">
                        <p class="text-sm leading-relaxed text-[#555555]" style="line-height: 1.85;">
                            {{ $faq['answer'] }}
                        </p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 8: CTA
     ============================================================ --}}
<section aria-labelledby="about-cta-heading" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>

    <div class="max-w-screen-2xl mx-auto px-6 xl:px-16 py-20 relative z-10">
        <div class="max-w-3xl">
            <h2 id="about-cta-heading" class="font-serif font-normal text-white leading-tight mb-4" style="font-size: clamp(2rem, 4vw, 3rem);">
                Ready to Be Part of Africa's Excellence Movement?
            </h2>
            <p class="mb-10 leading-relaxed text-white/70" style="font-size: 1rem;">
                Join hundreds of businesses across Africa who have been recognised for their outstanding contributions to innovation, leadership, and sustainable growth.
            </p>
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-gold text-ink hover:bg-gold-light">
                    Nominate a Business
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('contact') }}" wire:navigate
                   class="inline-flex items-center gap-2 px-10 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200 border border-white/35 hover:border-gold hover:text-gold">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

</div>