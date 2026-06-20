<header
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 60)"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="scrolled ? 'bg-[rgba(10,10,10,0.98)] backdrop-blur-md border-b border-gold/15' : 'bg-transparent'"
>
    <div style="height: 70px;" class="flex items-center justify-between px-6 xl:px-16 gap-8 xl:gap-12">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" wire:navigate class="flex items-center flex-shrink-0">
            <img src="{{ asset('images/logo.png') }}" alt="CenBa Africa Business Excellence Awards" class="h-15 w-auto">
        </a>

        {{-- DESKTOP NAV (CENTERED) --}}
        <nav class="hidden xl:flex items-center gap-1 flex-1 justify-center" aria-label="Main navigation">

            <a href="{{ route('home') }}" wire:navigate
               class="px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 hover:text-gold {{ request()->routeIs('home') ? 'text-gold' : 'text-white/75' }}">
                Home
            </a>

            <a href="{{ route('about') }}" wire:navigate
               class="px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 hover:text-gold {{ request()->routeIs('about') ? 'text-gold' : 'text-white/75' }}">
                About Us
            </a>

            {{-- Award --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 text-white/75 hover:text-gold"
                        :aria-expanded="open.toString()">
                    Award
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-52 bg-[#0D0D0D] border border-gold/15 border-t-2 border-t-crimson">
                    <a href="{{ route('award.categories') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 border-b border-white/5 hover:text-gold hover:pl-6">
                        Award Categories
                    </a>
                    <a href="{{ route('award.criteria') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 border-b border-white/5 hover:text-gold hover:pl-6">
                        Award Criteria
                    </a>
                    <a href="{{ route('award.judges') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 hover:text-gold hover:pl-6">
                        Our Judges
                    </a>
                </div>
            </div>

            {{-- News & Update --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 text-white/75 hover:text-gold"
                        :aria-expanded="open.toString()">
                    News & Update
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-40 bg-[#0D0D0D] border border-gold/15 border-t-2 border-t-crimson">
                    <a href="{{ route('blog.index') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 hover:text-gold hover:pl-6">
                        Blog
                    </a>
                </div>
            </div>

            {{-- Events --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 text-white/75 hover:text-gold"
                        :aria-expanded="open.toString()">
                    Events
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-52 bg-[#0D0D0D] border border-gold/15 border-t-2 border-t-crimson">
                    <a href="{{ route('events.partners') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 border-b border-white/5 hover:text-gold hover:pl-6">
                        Partners & Sponsors
                    </a>
                    <a href="{{ route('events.gallery') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 hover:text-gold hover:pl-6">
                        Gallery
                    </a>
                </div>
            </div>

            {{-- Winners --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 text-white/75 hover:text-gold"
                        :aria-expanded="open.toString()">
                    Winners
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-44 bg-[#0D0D0D] border border-gold/15 border-t-2 border-t-crimson">
                    <a href="{{ route('winners') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-all text-white/70 hover:text-gold hover:pl-6">
                        Past Winners
                    </a>
                </div>
            </div>

            <a href="{{ route('contact') }}" wire:navigate
               class="px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200 hover:text-gold {{ request()->routeIs('contact') ? 'text-gold' : 'text-white/75' }}">
                Contact Us
            </a>

        </nav>

        {{-- CTA + Mobile --}}
        <div class="flex items-center gap-4 flex-shrink-0">
            <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA"
               target="_blank"
               rel="noopener noreferrer"
               class="hidden xl:inline-flex items-center px-7 py-2.5 text-xs font-bold tracking-[0.2em] uppercase transition-all duration-200 whitespace-nowrap bg-crimson border border-crimson text-white hover:bg-transparent hover:border-gold hover:text-gold"
               aria-label="Nominate a business">
                Nominations
            </a>

            <button @click="mobileOpen = !mobileOpen"
                    class="xl:hidden p-1 text-white/80"
                    aria-label="Toggle mobile menu"
                    :aria-expanded="mobileOpen.toString()">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-cloak x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div x-cloak x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="bg-[#0D0D0D] border-t border-gold/10"
         role="navigation"
         aria-label="Mobile navigation">
        <div class="px-8 py-6 space-y-1">

            <a href="{{ route('home') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5 hover:text-gold">Home</a>

            <a href="{{ route('about') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5 hover:text-gold">About Us</a>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5">
                    Award
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pb-2 space-y-1 border-b border-white/5">
                    <a href="{{ route('award.categories') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors text-white/45 hover:text-gold">Award Categories</a>
                    <a href="{{ route('award.criteria') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors text-white/45 hover:text-gold">Award Criteria</a>
                    <a href="{{ route('award.judges') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors text-white/45 hover:text-gold">Our Judges</a>
                </div>
            </div>

            <a href="{{ route('blog.index') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5 hover:text-gold">Blog</a>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5">
                    Events
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pb-2 space-y-1 border-b border-white/5">
                    <a href="{{ route('events.partners') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors text-white/45 hover:text-gold">Partners & Sponsors</a>
                    <a href="{{ route('events.gallery') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors text-white/45 hover:text-gold">Gallery</a>
                </div>
            </div>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5">
                    Winners
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pb-2 border-b border-white/5">
                    <a href="{{ route('winners') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors text-white/45 hover:text-gold">Past Winners</a>
                </div>
            </div>

            <a href="{{ route('contact') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors text-white/75 border-b border-white/5 hover:text-gold">Contact Us</a>

            <div class="pt-4 pb-2">
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="block text-center px-4 py-3.5 text-white text-xs font-bold tracking-[0.2em] uppercase bg-crimson">
                    Nominations
                </a>
            </div>

        </div>
    </div>

</header>