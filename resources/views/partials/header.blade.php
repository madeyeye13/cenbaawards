<header
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 60)"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :style="scrolled
        ? 'background: rgba(10,10,10,0.98); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(201,168,76,0.12);'
        : 'background: transparent;'"
>
    <div style="height: 70px;" class="flex items-center justify-between px-6 xl:px-16 gap-8 xl:gap-12">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 flex-shrink-0">
            {{-- Swap for: <img src="{{ asset('images/logo.png') }}" alt="CenBa Awards" class="h-9 w-auto"> --}}
            <div style="width: 2px; height: 32px; background: #C9A84C;" aria-hidden="true"></div>
            <div>
                <p style="font-family: 'DM Serif Display', serif; color: #FFFFFF; font-size: 1rem; line-height: 1.2; letter-spacing: 0.02em;">CenBa Awards</p>
                <p style="color: #C9A84C; font-size: 0.6rem; letter-spacing: 0.22em; text-transform: uppercase; line-height: 1.2;">Africa Business Excellence</p>
            </div>
        </a>

        {{-- DESKTOP NAV (CENTERED) --}}
        <nav class="hidden xl:flex items-center gap-1 flex-1 justify-center" aria-label="Main navigation">

            <a href="{{ route('home') }}" wire:navigate
               class="px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
               style="color: {{ request()->routeIs('home') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }};"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='{{ request()->routeIs('home') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }}'">
                Home
            </a>

            <a href="{{ route('about') }}" wire:navigate
               class="px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
               style="color: {{ request()->routeIs('about') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }};"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='{{ request()->routeIs('about') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }}'">
                About Us
            </a>

            {{-- Award --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
                        style="color: rgba(255,255,255,0.75);"
                        onmouseover="this.style.color='#C9A84C'"
                        onmouseout="this.style.color='rgba(255,255,255,0.75)'"
                        :aria-expanded="open.toString()">
                    Award
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-52"
                     style="background: #0D0D0D; border: 1px solid rgba(201,168,76,0.15); border-top: 2px solid #8B0000;">
                    <a href="{{ route('award.categories') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7); border-bottom: 1px solid rgba(255,255,255,0.05);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Award Categories
                    </a>
                    <a href="{{ route('award.criteria') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7); border-bottom: 1px solid rgba(255,255,255,0.05);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Award Criteria
                    </a>
                    <a href="{{ route('award.judges') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Our Judges
                    </a>
                </div>
            </div>

            {{-- News & Update --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
                        style="color: rgba(255,255,255,0.75);"
                        onmouseover="this.style.color='#C9A84C'"
                        onmouseout="this.style.color='rgba(255,255,255,0.75)'"
                        :aria-expanded="open.toString()">
                    News & Update
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-40"
                     style="background: #0D0D0D; border: 1px solid rgba(201,168,76,0.15); border-top: 2px solid #8B0000;">
                    <a href="{{ route('blog.index') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Blog
                    </a>
                </div>
            </div>

            {{-- Events --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
                        style="color: rgba(255,255,255,0.75);"
                        onmouseover="this.style.color='#C9A84C'"
                        onmouseout="this.style.color='rgba(255,255,255,0.75)'"
                        :aria-expanded="open.toString()">
                    Events
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-52"
                     style="background: #0D0D0D; border: 1px solid rgba(201,168,76,0.15); border-top: 2px solid #8B0000;">
                    <a href="{{ route('events.partners') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7); border-bottom: 1px solid rgba(255,255,255,0.05);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Partners & Sponsors
                    </a>
                    <a href="{{ route('events.gallery') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Gallery
                    </a>
                </div>
            </div>

            {{-- Winners --}}
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center gap-1 px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
                        style="color: rgba(255,255,255,0.75);"
                        onmouseover="this.style.color='#C9A84C'"
                        onmouseout="this.style.color='rgba(255,255,255,0.75)'"
                        :aria-expanded="open.toString()">
                    Winners
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-cloak
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute top-full left-0 mt-0 w-44"
                     style="background: #0D0D0D; border: 1px solid rgba(201,168,76,0.15); border-top: 2px solid #8B0000;">
                    <a href="{{ route('winners') }}" wire:navigate
                       class="block px-5 py-3.5 text-xs font-medium tracking-widest uppercase whitespace-nowrap transition-colors"
                       style="color: rgba(255,255,255,0.7);"
                       onmouseover="this.style.color='#C9A84C'; this.style.paddingLeft='24px';"
                       onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.paddingLeft='20px';">
                        Past Winners
                    </a>
                </div>
            </div>

            <a href="{{ route('contact') }}" wire:navigate
               class="px-3 py-2 text-[0.7rem] font-medium tracking-wide uppercase whitespace-nowrap transition-colors duration-200"
               style="color: {{ request()->routeIs('contact') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }};"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='{{ request()->routeIs('contact') ? '#C9A84C' : 'rgba(255,255,255,0.75)' }}'">
                Contact Us
            </a>

        </nav>

        {{-- CTA + Mobile --}}
        <div class="flex items-center gap-4 flex-shrink-0">
            <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA"
               target="_blank"
               rel="noopener noreferrer"
               class="hidden xl:inline-flex items-center px-7 py-2.5 text-white text-xs font-bold tracking-[0.2em] uppercase transition-all duration-200 whitespace-nowrap"
               style="background: #8B0000; border: 1px solid #8B0000;"
               onmouseover="this.style.background='transparent'; this.style.borderColor='#C9A84C'; this.style.color='#C9A84C';"
               onmouseout="this.style.background='#8B0000'; this.style.borderColor='#8B0000'; this.style.color='#fff';"
               aria-label="Nominate a business">
                Nominations
            </a>

            <button @click="mobileOpen = !mobileOpen"
                    class="xl:hidden p-1"
                    style="color: rgba(255,255,255,0.8);"
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
    <div x-cloak
         x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="background: #0D0D0D; border-top: 1px solid rgba(201,168,76,0.1);"
         role="navigation"
         aria-label="Mobile navigation">
        <div class="px-8 py-6 space-y-1">

            <a href="{{ route('home') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
               style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='rgba(255,255,255,0.75)'">Home</a>

            <a href="{{ route('about') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
               style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='rgba(255,255,255,0.75)'">About Us</a>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
                        style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    Award
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pb-2 space-y-1" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <a href="{{ route('award.categories') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors" style="color: rgba(255,255,255,0.45);" onmouseover="this.style.color='#C9A84C'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Award Categories</a>
                    <a href="{{ route('award.criteria') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors" style="color: rgba(255,255,255,0.45);" onmouseover="this.style.color='#C9A84C'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Award Criteria</a>
                    <a href="{{ route('award.judges') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors" style="color: rgba(255,255,255,0.45);" onmouseover="this.style.color='#C9A84C'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Our Judges</a>
                </div>
            </div>

            <a href="{{ route('blog.index') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
               style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='rgba(255,255,255,0.75)'">Blog</a>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
                        style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    Events
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pb-2 space-y-1" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <a href="{{ route('events.partners') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors" style="color: rgba(255,255,255,0.45);" onmouseover="this.style.color='#C9A84C'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Partners & Sponsors</a>
                    <a href="{{ route('events.gallery') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors" style="color: rgba(255,255,255,0.45);" onmouseover="this.style.color='#C9A84C'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Gallery</a>
                </div>
            </div>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
                        style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    Winners
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 pb-2" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <a href="{{ route('winners') }}" wire:navigate @click="mobileOpen = false" class="block px-4 py-2 text-xs tracking-widest uppercase transition-colors" style="color: rgba(255,255,255,0.45);" onmouseover="this.style.color='#C9A84C'" onmouseout="this.style.color='rgba(255,255,255,0.45)'">Past Winners</a>
                </div>
            </div>

            <a href="{{ route('contact') }}" wire:navigate @click="mobileOpen = false"
               class="block px-4 py-3.5 text-xs font-semibold tracking-widest uppercase transition-colors"
               style="color: rgba(255,255,255,0.75); border-bottom: 1px solid rgba(255,255,255,0.05);"
               onmouseover="this.style.color='#C9A84C'"
               onmouseout="this.style.color='rgba(255,255,255,0.75)'">Contact Us</a>

            <div class="pt-4 pb-2">
                <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                   class="block text-center px-4 py-3.5 text-white text-xs font-bold tracking-[0.2em] uppercase"
                   style="background: #8B0000;">
                    Nominations
                </a>
            </div>

        </div>
    </div>

</header>