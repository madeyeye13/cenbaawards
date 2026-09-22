<section id="table-packages" aria-labelledby="table-packages-heading" class="bg-white">
    <div class="max-w-7xl mx-auto px-6 xl:px-16 py-24">

        <div class="max-w-2xl mb-16">
            <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                <div class="w-8 h-px bg-crimson"></div>
                <span class="text-xs font-semibold tracking-[0.25em] uppercase text-crimson">Awards &amp; Dinner Night</span>
            </div>
            <h2 id="table-packages-heading" class="font-serif font-normal leading-tight text-ink" style="font-size: clamp(2rem, 4vw, 3rem);">
                Award Table Packages
            </h2>
            <p class="mt-4 leading-relaxed text-[#666666]" style="font-size: 0.95rem;">
                Reserve a table at the CenBa Awards &amp; Dinner Night and celebrate Africa's finest businesses in style.
            </p>
        </div>

        @if($packages->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packages as $package)
            <div wire:key="table-package-{{ $package->id }}" class="flex flex-col p-8 bg-cream border-l-4 border-crimson">
                <h3 class="font-serif font-normal text-ink mb-1" style="font-size: 1.5rem;">{{ $package->name }}</h3>
                <p class="text-xs uppercase tracking-[0.25em] text-[#666666] mb-6">{{ $package->seats }} {{ $package->seats == 1 ? 'Seat' : 'Seats' }}</p>

                <p class="font-serif font-normal text-crimson mb-6" style="font-size: 2rem;">
                    {{ $package->formatted_price }}
                </p>

                @if(!empty($package->features))
                <ul class="space-y-2">
                    @foreach($package->features as $feature)
                    <li class="flex items-start gap-2 text-sm text-[#555555]">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="py-16 text-center bg-cream">
            <p class="text-sm text-[#666666]">Table packages will be announced soon.</p>
        </div>
        @endif

        @if($note)
        <p class="mt-10 text-sm text-[#666666] italic">{{ $note }}</p>
        @endif

    </div>
</section>
