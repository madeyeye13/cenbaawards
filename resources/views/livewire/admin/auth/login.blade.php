<div class="min-h-screen flex flex-col lg:flex-row">

    {{-- LEFT PANEL --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden"
         style="background-color: #8B0000;">

        {{-- Pattern overlay --}}
        <div class="absolute inset-0 opacity-10"
             style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px);
                    background-size: 32px 32px;">
        </div>

        {{-- Gold accent line --}}
        <div class="absolute top-0 right-0 w-1 h-full"
             style="background: linear-gradient(to bottom, #FBA320, transparent, #FBA320);">
        </div>

        {{-- Bottom decorative circle --}}
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full opacity-20"
             style="background: radial-gradient(circle, #FBA320, transparent);">
        </div>
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full opacity-10"
             style="background: radial-gradient(circle, #FCB94D, transparent);">
        </div>

        {{-- Content --}}
        <div class="relative z-10 flex flex-col justify-between p-12 w-full">

            {{-- Logo --}}
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                         style="background: rgba(201,168,76,0.2); border: 1px solid rgba(201,168,76,0.4);">
                        <span class="text-lg" style="color: #FBA320; font-family: 'Fraunces', serif;">C</span>
                    </div>
                    <span class="text-white text-lg font-semibold tracking-wide"
                          style="font-family: 'Fraunces', serif;">CenBa Awards</span>
                </div>
            </div>

            {{-- Main text --}}
            <div>
                <div class="mb-6">
                    <span class="text-xs font-semibold tracking-[0.3em] uppercase"
                          style="color: #FBA320;">Admin Portal</span>
                </div>
                <h1 class="text-white text-4xl xl:text-6xl 2xl:text-7xl leading-tight mb-6"
    style="font-family: 'Fraunces', serif;">
    Managing<br>
    <em style="color: #FCB94D;">African</em><br>
    Excellence
</h1>
                <p class="text-sm leading-relaxed"
                   style="color: rgba(255,255,255,0.6); max-width: 320px;">
                    The central hub for managing the CenBa Africa Business Excellence Awards platform — content, winners, media, and more.
                </p>
            </div>

            {{-- Footer --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-px flex-1" style="background: rgba(201,168,76,0.3);"></div>
                    <span class="text-xs" style="color: rgba(255,255,255,0.3);">EST. 2016</span>
                    <div class="h-px flex-1" style="background: rgba(201,168,76,0.3);"></div>
                </div>
                <p class="text-xs" style="color: rgba(255,255,255,0.3);">
                    © {{ date('Y') }} CenBa Africa Business Excellence Awards
                </p>
            </div>

        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="flex-1 flex items-center justify-center px-6 py-12 bg-white lg:px-12">

        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="lg:hidden text-center mb-10">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl mb-3"
                     style="background: #8B0000;">
                    <span class="text-white text-lg" style="font-family: 'Fraunces', serif;">C</span>
                </div>
                <h1 class="text-gray-900 text-2xl" style="font-family: 'Fraunces', serif;">CenBa Awards</h1>
                <p class="text-gray-400 text-xs mt-1 tracking-widest uppercase">Admin Portal</p>
            </div>

            {{-- Heading --}}
            <div class="mb-8">
                <h2 class="text-gray-900 text-2xl lg:text-3xl font-semibold mb-2"
                    style="font-family: 'Fraunces', serif;">Welcome back</h2>
                <p class="text-gray-500 text-sm">Sign in to your admin account to continue</p>
            </div>

            {{-- Error --}}
            @if($error)
            <div class="mb-6 px-4 py-3 rounded-xl flex items-start gap-3"
                 style="background: #FEF2F2; border: 1px solid #FECACA;">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color: #DC2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm" style="color: #DC2626;">{{ $error }}</p>
            </div>
            @endif

            <form wire:submit="login" class="space-y-5">

                {{-- Email --}}
                <div x-data="{ focused: false }">
                    <label class="block text-xs font-semibold text-gray-500 mb-2 tracking-wider uppercase">
                        Email Address
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none transition-colors duration-200"
                             :style="focused ? 'color: #8B0000' : 'color: #9CA3AF'"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input
                            wire:model="email"
                            type="email"
                            placeholder="sample@gmail.com"
                            autocomplete="email"
                            @focus="focused = true"
                            @blur="focused = false"
                            class="w-full pl-10 pr-4 py-3 rounded-xl text-gray-900 placeholder-gray-300 text-sm transition-all duration-200 focus:outline-none"
                            :style="focused
                                ? 'border: 1.5px solid #8B0000; box-shadow: 0 0 0 3px rgba(139,0,0,0.08); background: #fff;'
                                : 'border: 1.5px solid #E5E7EB; background: #F9FAFB;'"
                        >
                    </div>
                    @if($submitted)
    @error('email')
        <p class="text-xs mt-1.5" style="color: #DC2626;">{{ $message }}</p>
    @enderror
@endif
                </div>

                {{-- Password --}}
                <div x-data="{ focused: false, show: false }">
                    <label class="block text-xs font-semibold text-gray-500 mb-2 tracking-wider uppercase">
                        Password
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none transition-colors duration-200"
                             :style="focused ? 'color: #8B0000' : 'color: #9CA3AF'"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input
                            wire:model="password"
                            :type="show ? 'text' : 'password'"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            @focus="focused = true"
                            @blur="focused = false"
                            class="w-full pl-10 pr-12 py-3 rounded-xl text-gray-900 placeholder-gray-300 text-sm transition-all duration-200 focus:outline-none"
                            :style="focused
                                ? 'border: 1.5px solid #8B0000; box-shadow: 0 0 0 3px rgba(139,0,0,0.08); background: #fff;'
                                : 'border: 1.5px solid #E5E7EB; background: #F9FAFB;'"
                        >
                        <button type="button" @click="show = !show"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 transition-colors"
                            :style="show ? 'color: #8B0000' : 'color: #9CA3AF'">
                            <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @if($submitted)
    @error('password')
        <p class="text-xs mt-1.5" style="color: #DC2626;">{{ $message }}</p>
    @enderror
@endif
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input wire:model="remember" type="checkbox" id="remember"
                            class="w-4 h-4 rounded focus:ring-2 focus:ring-offset-1"
                            style="accent-color: #8B0000;">
                        <span class="text-sm text-gray-500">Remember me</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="login"
                    class="w-full py-4 text-white font-semibold rounded-xl text-sm tracking-wider uppercase transition-all duration-200 flex items-center justify-center gap-2 mt-2"
                    style="background: #8B0000; box-shadow: 0 4px 14px rgba(139,0,0,0.25); min-height: 56px;"
                    onmouseover="this.style.background='#A52020'"
                    onmouseout="this.style.background='#8B0000'"
                >
                    <span wire:loading.remove wire:target="login" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Sign In
                    </span>
                    <span wire:loading wire:target="login" class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                        </svg>
                        Signing in...
                    </span>
                </button>

            </form>

            {{-- Mobile footer --}}
            <p class="lg:hidden text-center text-gray-300 text-xs mt-10">
                © {{ date('Y') }} CenBa Africa Business Excellence Awards
            </p>

        </div>
    </div>

</div>