<div>

{{-- HERO --}}
<section aria-label="Winners hero" class="relative bg-crimson" style="padding-top: 70px;">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="flex items-center gap-3 mb-5" aria-hidden="true">
            <div class="w-0.5 h-5 bg-gold"></div>
            <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Hall of Fame</span>
        </div>
        <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 700px;">
            Past Winners
        </h1>
        <p class="mt-6 leading-relaxed text-white/75" style="max-width: 540px; font-size: 1rem;">
            Celebrating the outstanding businesses and entrepreneurs recognised at each edition of the CenBa Africa Business Excellence Awards.
        </p>
        <nav aria-label="Breadcrumb" class="mt-10">
            <ol class="flex items-center gap-2 text-xs text-white/55">
                <li><a href="{{ route('home') }}" wire:navigate class="hover:text-gold transition-colors">Home</a></li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-gold" aria-current="page">Past Winners</li>
            </ol>
        </nav>
    </div>
</section>

{{-- YEAR SELECTOR + WINNERS --}}
<section class="bg-white" aria-label="Winners by year">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20">

        @if($years->count() > 0)

        {{-- Year tabs --}}
        <div class="flex items-center gap-2 mb-16 border-b border-cream-dark overflow-x-auto pb-px">
            @foreach($years as $year)
            <button wire:click="selectYear('{{ $year }}')"
                    class="px-6 py-3 text-sm font-semibold whitespace-nowrap border-b-2 transition-colors -mb-px
                           {{ $selectedYear == $year
                               ? 'border-crimson text-crimson'
                               : 'border-transparent text-[#666666] hover:text-ink' }}">
                {{ $year }}
            </button>
            @endforeach
        </div>

        {{-- Section label --}}
        <div class="flex items-center gap-3 mb-12" aria-hidden="true">
            <div class="w-8 h-px bg-crimson"></div>
            <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">
                {{ $selectedYear }} Edition
            </span>
        </div>

        @if($winners->count() > 0)

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-px bg-cream-dark">
            @foreach($winners as $winner)
            <article class="bg-white p-8 flex flex-col items-center text-center transition-all duration-200 hover:bg-cream group">

                {{-- Photo --}}
                <div class="w-24 h-24 rounded-full overflow-hidden mb-5 flex-shrink-0 bg-cream-dark ring-2 ring-gold/20 group-hover:ring-gold/50 transition-all duration-300">
                    @if($winner->photo)
                        <img src="{{ asset('storage/' . $winner->photo) }}"
                             alt="{{ $winner->name }}"
                             class="w-full h-full object-cover"
                             loading="lazy" decoding="async">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-crimson/10">
                            <svg class="w-8 h-8 text-crimson/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Category badge --}}
                @if($winner->awardCategory)
                <span class="inline-block mb-3 text-[0.55rem] font-bold uppercase tracking-[0.2em] px-2.5 py-1 bg-gold/15 text-[#8a6a00]">
                    {{ $winner->awardCategory->name }}
                </span>
                @endif

                {{-- Name & company --}}
                <h2 class="font-serif font-semibold text-ink leading-snug mb-1" style="font-size: 1.1rem;">
                    {{ $winner->name }}
                </h2>
                <p class="text-xs font-medium text-crimson tracking-wide mb-3">{{ $winner->company }}</p>

                {{-- Description --}}
                @if($winner->description)
                <p class="text-xs leading-relaxed text-[#777777]">{{ $winner->description }}</p>
                @endif

                {{-- Trophy icon --}}
                <div class="mt-5 text-gold/40 group-hover:text-gold transition-colors duration-300">
                    <svg class="w-5 h-5 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l1.5 4.5H18l-3.75 2.75 1.5 4.5L12 11l-3.75 2.75 1.5-4.5L6 6.5h4.5L12 2z"/>
                        <path fill-rule="evenodd" d="M8 17h8v1a2 2 0 01-2 2h-4a2 2 0 01-2-2v-1zm-1-1h10v-1H7v1z" clip-rule="evenodd"/>
                    </svg>
                </div>

            </article>
            @endforeach
        </div>

        @else
        <div class="py-20 text-center bg-cream">
            <p class="font-serif text-ink mb-2" style="font-size: 1.5rem;">No winners recorded</p>
            <p class="text-sm text-[#666666]">Winners for {{ $selectedYear }} will appear here once published.</p>
        </div>
        @endif

        @else
        <div class="py-24 text-center bg-cream">
            <p class="font-serif text-ink mb-2" style="font-size: 1.75rem;">Coming Soon</p>
            <p class="text-sm text-[#666666]">Winners will be published after each award ceremony.</p>
        </div>
        @endif

    </div>
</section>

{{-- CTA --}}
<section aria-labelledby="winners-cta" class="relative overflow-hidden bg-crimson">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="max-w-2xl">
            <h2 id="winners-cta" class="font-serif font-normal text-white leading-tight mb-4" style="font-size: clamp(2rem, 4vw, 3rem);">
                Could Your Business Be Next?
            </h2>
            <p class="mb-10 leading-relaxed text-white/70">
                Nominations are open to businesses across Africa. Submit your nomination before the deadline and join our growing hall of excellence.
            </p>
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-10 py-4 font-semibold text-sm tracking-widest uppercase transition-all duration-200 bg-gold text-ink hover:bg-gold-light">
                    Nominate Now
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('award.criteria') }}" wire:navigate
                   class="inline-flex items-center gap-2 px-10 py-4 text-white font-semibold text-sm tracking-widest uppercase transition-all duration-200 border border-white/35 hover:border-gold hover:text-gold">
                    View Criteria
                </a>
            </div>
        </div>
    </div>
</section>

</div>