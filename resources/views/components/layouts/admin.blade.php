<!DOCTYPE html>
<html lang="en"
      x-data="{ sidebarOpen: window.innerWidth >= 768 }"
      x-init="
        if (window.innerWidth < 768) sidebarOpen = false;
        window.addEventListener('resize', () => {
            sidebarOpen = window.innerWidth >= 768;
        });
      ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} — CenBa Awards</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 dark:bg-neutral-950 text-gray-900 dark:text-white antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar backdrop for mobile --}}
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-30 md:hidden"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    {{-- SIDEBAR --}}
    
    <aside
    x-show="sidebarOpen"
    x-cloak
    class="fixed md:static md:w-64 z-40 h-full w-64 flex-shrink-0 flex flex-col transition-all duration-300 ease-in-out md:transition-none md:relative"
    style="background: #8B0000;"
>
        {{-- Gold top border --}}
        <div class="absolute top-0 left-0 right-0 h-0.5" style="background: linear-gradient(to right, #FBA320, transparent);"></div>

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5 border-b" style="border-color: rgba(255,255,255,0.1);">
            {{-- Replace with image: <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto"> --}}
            <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center"
                 style="background: rgba(201,168,76,0.2); border: 1px solid rgba(201,168,76,0.4);">
                <span style="color: #FBA320; font-family: 'Fraunces', serif;" class="text-sm font-bold">C</span>
            </div>
            <span x-show="sidebarOpen" x-transition:enter="transition-opacity duration-200"
                  x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                  class="text-white font-semibold text-sm whitespace-nowrap"
                  style="font-family: 'Fraunces', serif;">
                CenBa Awards
            </span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1"
     @click="if (window.innerWidth < 768) sidebarOpen = false">

            {{-- Main --}}
            <div x-show="sidebarOpen" class="px-2 mb-2">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(255,255,255,0.35);">Main</span>
            </div>

            <a href="{{ route('admin.dashboard') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.dashboard') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('admin.media.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.media.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.media.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Media Library</span>
            </a>

            {{-- Awards --}}
            <div x-show="sidebarOpen" class="px-2 pt-4 mb-2">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(255,255,255,0.35);">Awards</span>
            </div>
            <div x-show="!sidebarOpen" class="border-t my-2" style="border-color: rgba(255,255,255,0.1);"></div>

            <a href="{{ route('admin.award-categories.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.award-categories.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.award-categories.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Award Categories</span>
            </a>

            <a href="{{ route('admin.award-criteria.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.award-criteria.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.award-criteria.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Award Criteria</span>
            </a>

            <a href="{{ route('admin.judges.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.judges.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.judges.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Judges</span>
            </a>

            <a href="{{ route('admin.winners.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.winners.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.winners.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Winners</span>
            </a>

            {{-- Content --}}
            <div x-show="sidebarOpen" class="px-2 pt-4 mb-2">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(255,255,255,0.35);">Content</span>
            </div>
            <div x-show="!sidebarOpen" class="border-t my-2" style="border-color: rgba(255,255,255,0.1);"></div>

            <a href="{{ route('admin.posts.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.posts.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.posts.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Blog Posts</span>
            </a>

            <a href="{{ route('admin.comments.index') }}" wire:navigate
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.comments.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
                style="{{ request()->routeIs('admin.comments.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Comments</span>
            </a>

            <a href="{{ route('admin.gallery.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.gallery.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.gallery.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Gallery</span>
            </a>

            <a href="{{ route('admin.events.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.events.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.events.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Events</span>
            </a>

            {{-- People --}}
            <div x-show="sidebarOpen" class="px-2 pt-4 mb-2">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color: rgba(255,255,255,0.35);">People</span>
            </div>
            <div x-show="!sidebarOpen" class="border-t my-2" style="border-color: rgba(255,255,255,0.1);"></div>

            <a href="{{ route('admin.partners-sponsors.index') }}" wire:navigate
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.partners-sponsors.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
                style="{{ request()->routeIs('admin.partners-sponsors.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Partners &amp; Sponsors</span>
            </a>

            <a href="{{ route('admin.team.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.team.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.team.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Team</span>
            </a>

            <a href="{{ route('admin.contacts.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.contacts.*') ? 'text-white' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ request()->routeIs('admin.contacts.*') ? 'background: rgba(201,168,76,0.2);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Contacts</span>
            </a>

        </nav>

        {{-- Bottom --}}
        <div class="p-3 border-t" style="border-color: rgba(255,255,255,0.1);">
            <a href="{{ route('admin.settings.index') }}" wire:navigate
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 text-white/60 hover:text-white hover:bg-white/10">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span x-show="sidebarOpen" class="text-sm font-medium whitespace-nowrap">Settings</span>
            </a>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOPBAR --}}
        <header class="flex items-center justify-between px-4 md:px-6 py-4 border-b bg-white dark:bg-neutral-900 dark:border-neutral-800"
                style="border-color: #E5E7EB;">
            <div class="flex items-center gap-2 md:gap-4">
                {{-- Sidebar toggle --}}
                <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden p-2 rounded-lg transition-colors text-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-neutral-400 dark:hover:text-white dark:hover:bg-neutral-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- Page title --}}
                <div class="min-w-0">
                    <h1 class="text-xs md:text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $title ?? 'Dashboard' }}</h1>
                    <p class="text-xs text-gray-400 dark:text-neutral-500 hidden sm:block">CenBa Africa Business Excellence Awards</p>
                </div>
            </div>

            <div class="flex items-center gap-2 md:gap-3">

                {{-- Admin user --}}
                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                    <button @click="open = !open" class="flex items-center gap-1.5 md:gap-2.5 pl-2 md:pl-3 pr-1.5 md:pr-2 py-1.5 rounded-xl transition-colors hover:bg-gray-100 dark:hover:bg-neutral-800">
                        <div class="text-right hidden md:block">
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ auth('admin')->user()->name }}</p>
                            <p class="text-xs text-gray-400 dark:text-neutral-500 capitalize">{{ auth('admin')->user()->role }}</p>
                        </div>
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                             style="background: #8B0000;">
                            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="open"
                        x-cloak
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 top-full mt-2 w-48 rounded-xl shadow-lg border overflow-hidden z-50 bg-white dark:bg-neutral-900 dark:border-neutral-800"
                        style="border-color: #E5E7EB;">
                        <div class="p-1">
                            <a href="{{ route('admin.settings.index') }}" wire:navigate
                               class="flex items-center gap-2 px-3 py-2 text-sm rounded-lg transition-colors text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </a>
                            <div class="border-t my-1 dark:border-neutral-800" style="border-color: #F3F4F6;"></div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-2 px-3 py-2 text-sm rounded-lg transition-colors text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-neutral-950 p-4 md:p-6">
            {{ $slot }}
        </main>

    </div>
</div>

{{-- Toast notifications --}}
<div
    x-data="toastManager()"
    x-on:toast.window="add($event.detail)"
    class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-3 w-80"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="toast.show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="flex items-start gap-3 px-4 py-3.5 rounded-xl shadow-lg border"
            :class="{
                'bg-white border-gray-100 dark:bg-neutral-900 dark:border-neutral-800': toast.type === 'info',
                'bg-green-50 border-green-100 dark:bg-green-900/30 dark:border-green-800': toast.type === 'success',
                'bg-red-50 border-red-100 dark:bg-red-900/30 dark:border-red-800': toast.type === 'error',
                'bg-amber-50 border-amber-100 dark:bg-amber-900/30 dark:border-amber-800': toast.type === 'warning',
            }"
        >
            {{-- Icon --}}
            <div class="flex-shrink-0 mt-0.5">
                <svg x-show="toast.type === 'success'" class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <svg x-show="toast.type === 'error'" class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <svg x-show="toast.type === 'warning'" class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <svg x-show="toast.type === 'info'" class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            {{-- Message --}}
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium"
                   :class="{
                       'text-gray-900 dark:text-white': toast.type === 'info',
                       'text-green-800 dark:text-green-300': toast.type === 'success',
                       'text-red-800 dark:text-red-300': toast.type === 'error',
                       'text-amber-800 dark:text-amber-300': toast.type === 'warning',
                   }"
                   x-text="toast.title">
                </p>
                <p x-show="toast.message" class="text-xs mt-0.5 text-gray-500 dark:text-neutral-400" x-text="toast.message"></p>
            </div>
            {{-- Close --}}
            <button @click="remove(toast.id)" class="flex-shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-neutral-300 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>

@livewireScripts

<script data-navigate-once>
    window.toastManager = function () {
        return {
            toasts: [],
            add(detail) {
                const id = Date.now();
                const toast = {
                    id,
                    type: detail.type || 'info',
                    title: detail.title || '',
                    message: detail.message || '',
                    show: true,
                };
                this.toasts.push(toast);
                setTimeout(() => this.remove(id), detail.duration || 4000);
            },
            remove(id) {
                const toast = this.toasts.find(t => t.id === id);
                if (toast) {
                    toast.show = false;
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 300);
                }
            }
        }
    }
</script>

</body>
</html>