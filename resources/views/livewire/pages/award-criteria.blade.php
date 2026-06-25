<div>

{{-- PAGE HERO --}}
<section aria-label="Award Criteria hero" class="relative" style="padding-top: 70px; min-height: 420px;">
    <div class="absolute inset-0" style="top: 70px;">
        <img src="{{ $heroImage ? asset('storage/' . $heroImage) : asset('images/criteria-hero.jpg') }}" alt="CenBa Award Criteria"
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
                Award Criteria
            </h1>
            <p class="mt-6 leading-relaxed text-white/75" style="max-width: 560px; font-size: 1rem;">
                Understand how nominations are evaluated and what makes a business eligible for recognition.
            </p>
            <nav aria-label="Breadcrumb" class="mt-10">
                <ol class="flex items-center gap-2 text-xs text-white/55">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-white/55 hover:text-gold transition-colors">Home</a></li>
                    <li aria-hidden="true" class="text-white/30">/</li>
                    <li class="text-gold" aria-current="page">Award Criteria</li>
                </ol>
            </nav>
        </div>
    </div>
</section>


{{-- INTRO --}}
<section aria-labelledby="criteria-intro-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Evaluation</span>
            </div>
            <h2 id="criteria-intro-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                How Nominations Are Evaluated
            </h2>
            <p class="leading-relaxed text-[#444444]" style="font-size: 1.05rem; line-height: 1.9;">
                The criteria for the CABEA award includes factors such as customer experience, innovation, sustainability, marketing management, and corporate social responsibility. A panel of expert judges reviews all submissions to ensure a fair and rigorous selection process.
            </p>
        </div>
    </div>
</section>


{{-- THE FOUR PILLARS --}}
<section id="pillars" aria-labelledby="pillars-heading" class="bg-cream">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Judging Criteria</span>
            </div>
            <h2 id="pillars-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                The Four Pillars of Excellence
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-px bg-cream-dark">
            @foreach($criteria as $index => $item)
            <article class="p-10 transition-all duration-300 bg-white hover:bg-white">
                <div class="flex items-start justify-between mb-6">
                    <p class="font-serif font-normal leading-none text-crimson/10" style="font-size: 2.5rem;">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </p>
                    <div class="w-10 h-10 flex items-center justify-center bg-cream">
                        <div class="w-2 h-2 bg-crimson"></div>
                    </div>
                </div>
                <h3 class="font-semibold mb-3 text-ink" style="font-size: 1.25rem;">{{ $item['title'] }}</h3>
                <p class="text-sm leading-relaxed text-[#666666]" style="line-height: 1.85;">{{ $item['body'] }}</p>
            </article>
            @endforeach
        </div>

    </div>
</section>


{{-- ELIGIBILITY --}}
<section id="eligibility" aria-labelledby="eligibility-heading" class="bg-white">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            <div>
                <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                    <div class="w-8 h-px bg-crimson"></div>
                    <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Eligibility</span>
                </div>
                <h2 id="eligibility-heading" class="font-serif font-normal leading-tight mb-6 text-ink" style="font-size: clamp(2rem, 3vw, 2.75rem);">
                    Who Can Be Nominated
                </h2>
                <p class="leading-relaxed text-[#666666]" style="font-size: 0.95rem; line-height: 1.85;">
                    To be eligible for nomination, businesses must meet specific criteria, including active operation within Africa, adherence to legal requirements, and demonstration of excellence within their sector.
                </p>
            </div>

            <div class="lg:col-span-2 space-y-4">
                @foreach($eligibility as $index => $item)
                <article class="flex items-start gap-6 p-6 bg-cream border-l-[3px] border-crimson">
                    <span class="flex-shrink-0 font-serif font-normal text-crimson leading-none" style="font-size: 1.75rem;">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div>
                        <h3 class="font-semibold mb-2 text-ink" style="font-size: 1.05rem;">{{ $item['title'] }}</h3>
                        <p class="text-sm leading-relaxed text-[#666666]" style="line-height: 1.8;">{{ $item['body'] }}</p>
                    </div>
                </article>
                @endforeach
            </div>

        </div>
    </div>
</section>


{{-- KEY DATES --}}
<section aria-labelledby="dates-heading" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-24 relative z-10">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-gold"></div>
                <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Important Dates</span>
            </div>
            <h2 id="dates-heading" class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2rem, 4vw, 3rem);">
                Key Dates &amp; 2026 Programme
            </h2>
        </div>

        {{-- Nomination window --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div class="p-8 bg-black/25 border border-white/10">
                <p class="text-xs tracking-widest uppercase mb-3 text-white/50">Nominations Open</p>
                <p class="text-white font-serif font-normal" style="font-size: 1.5rem;">12th August</p>
                <p class="text-white/60">2026</p>
            </div>
            <div class="p-8 bg-black/25 border border-white/10">
                <p class="text-xs tracking-widest uppercase mb-3 text-white/50">Entries Close</p>
                <p class="text-white font-serif font-normal" style="font-size: 1.5rem;">6th November</p>
                <p class="text-white/60">2026</p>
            </div>
        </div>

        {{-- 2026 Events --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @php
                $events2026 = [
                    ['date' => '12th November 2026', 'name' => 'CenBa Awards Launch', 'venue' => 'AGI Office, Kumasi', 'time' => '9:00 AM – 12:00 NOON'],
                    ['date' => '26th November 2026', 'name' => 'Business Seminar', 'venue' => 'Live Event Center, Kumasi Mall', 'time' => '9:00 AM – 12:00 PM'],
                    ['date' => '28th November 2026', 'name' => 'Awards & Dinner Night', 'venue' => 'Golden Bean Hotel, Ahodwo Nhyiaeso, Kumasi', 'time' => '6:00 PM – 10:00 PM'],
                ];
            @endphp
            @foreach($events2026 as $event)
            <article class="p-8 bg-black/25 border-t-[3px] border-gold">
                <p class="text-xs tracking-widest uppercase mb-3 text-gold">{{ $event['date'] }}</p>
                <h3 class="text-white font-semibold mb-4" style="font-size: 1.1rem;">{{ $event['name'] }}</h3>
                <p class="flex items-start gap-2 text-sm mb-2 text-white/65">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-gold/80" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $event['venue'] }}
                </p>
                <p class="flex items-center gap-2 text-sm text-white/65">
                    <svg class="w-4 h-4 flex-shrink-0 text-gold/80" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $event['time'] }}
                </p>
            </article>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="mt-12">
            <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-gold text-ink hover:bg-gold-light">
                Submit Nomination
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

</div>