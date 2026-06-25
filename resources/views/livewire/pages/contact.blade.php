<div>

{{-- HERO --}}
<section aria-label="Contact hero" class="relative bg-crimson" style="padding-top: 70px;">
    <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true"
         style="background-image: radial-gradient(circle, #FBA320 1px, transparent 1px); background-size: 28px 28px;"></div>
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20 relative z-10">
        <div class="flex items-center gap-3 mb-5" aria-hidden="true">
            <div class="w-0.5 h-5 bg-gold"></div>
            <span class="text-gold text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Get In Touch</span>
        </div>
        <h1 class="font-serif font-normal text-white leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem); max-width: 700px;">
            Contact Us
        </h1>
        <p class="mt-6 leading-relaxed text-white/75" style="max-width: 540px; font-size: 1rem;">
            Have a question, enquiry, or nomination? We'd love to hear from you.
        </p>
        <nav aria-label="Breadcrumb" class="mt-10">
            <ol class="flex items-center gap-2 text-xs text-white/55">
                <li><a href="{{ route('home') }}" wire:navigate class="hover:text-gold transition-colors">Home</a></li>
                <li aria-hidden="true" class="text-white/30">/</li>
                <li class="text-gold" aria-current="page">Contact Us</li>
            </ol>
        </nav>
    </div>
</section>

{{-- CONTACT SECTION --}}
<section class="bg-white" aria-label="Contact form and info">
    <div class="max-w-screen-2xl mx-auto px-6 xl:px-20 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            {{-- LEFT: INFO --}}
            <div class="lg:col-span-1 space-y-10">

                <div>
                    <div class="flex items-center gap-3 mb-4" aria-hidden="true">
                        <div class="w-8 h-px bg-crimson"></div>
                        <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Our Details</span>
                    </div>
                    <h2 class="font-serif font-normal text-ink mb-6" style="font-size: clamp(1.75rem, 3vw, 2.5rem);">
                        Let's Talk
                    </h2>
                    <p class="text-sm leading-relaxed text-[#666666]">
                        Whether you have a nomination enquiry, partnership proposal, or general question — our team is ready to help.
                    </p>
                </div>

                {{-- Contact details --}}
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-crimson/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-1">Email</p>
                            <a href="mailto:info@cenbabusinessaward.com" class="text-sm text-ink hover:text-crimson transition-colors">info@cenbabusinessaward.com</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-crimson/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-1">Address</p>
                            <p class="text-sm text-ink leading-relaxed">Top Martins Complex, Asokwa<br>AK-240-2707, Greater Kumasi<br>Ghana, West Africa</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-crimson/10 flex items-center justify-center">
                            <svg class="w-4 h-4 text-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-1">Office Hours</p>
                            <p class="text-sm text-ink leading-relaxed">Monday – Friday<br>8:00 AM – 5:00 PM GMT</p>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="w-full h-px bg-cream-dark"></div>

                {{-- Nomination CTA --}}
                <div class="p-6 bg-cream border-l-[3px] border-gold">
                    <p class="text-xs font-semibold uppercase tracking-widest text-[#999999] mb-2">Nominations</p>
                    <p class="text-sm leading-relaxed text-[#555555] mb-4">To nominate a business for the CenBa Africa Business Excellence Awards, use our official nomination form.</p>
                    <a href="https://forms.gle/iDMoH2Qb9oHKLqDTA" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-crimson hover:text-gold transition-colors border-b border-crimson hover:border-gold pb-0.5">
                        Nominate Now
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>

            {{-- RIGHT: FORM --}}
            <div class="lg:col-span-2">

                @if($submitted)
                <div class="flex flex-col items-center justify-center py-20 text-center bg-cream px-8">
                    <div class="w-16 h-16 bg-crimson flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-serif font-normal text-ink mb-3" style="font-size: 1.75rem;">Message Sent</h3>
                    <p class="text-sm leading-relaxed text-[#666666] max-w-md mb-8">
                        Thank you for reaching out. We've received your message and sent a confirmation to <strong>{{ $email }}</strong>. Our team will respond within 2–3 business days.
                    </p>
                    <button wire:click="$set('submitted', false)"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-crimson hover:bg-crimson-light text-white text-xs font-bold tracking-widest uppercase transition-colors">
                        Send Another Message
                    </button>
                </div>

                @else
                <div>
                    <div class="flex items-center gap-3 mb-8" aria-hidden="true">
                        <div class="w-8 h-px bg-crimson"></div>
                        <span class="text-crimson text-[0.65rem] tracking-[0.3em] uppercase font-semibold">Send a Message</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-2">Full Name *</label>
                            <input wire:model="name" type="text" placeholder="Your full name"
                                   class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors">
                            @error('name') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-2">Email Address *</label>
                            <input wire:model="email" type="email" placeholder="your@email.com"
                                   class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors">
                            @error('email') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-2">Phone Number</label>
                            <input wire:model="phone" type="tel" placeholder="+233 xx xxx xxxx"
                                   class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors">
                            @error('phone') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-2">Subject</label>
                            <input wire:model="subject" type="text" placeholder="What is this about?"
                                   class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors">
                            @error('subject') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-[0.65rem] font-semibold uppercase tracking-widest text-[#999999] mb-2">Message *</label>
                        <textarea wire:model="message" rows="6" placeholder="Write your message here..."
                                  class="w-full px-4 py-3 bg-cream border border-cream-dark text-sm text-ink focus:outline-none focus:border-crimson transition-colors resize-none"></textarea>
                        @error('message') <p class="text-crimson text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button wire:click="send" wire:loading.attr="disabled" wire:target="send"
                            class="inline-flex items-center gap-3 px-10 py-4 bg-crimson hover:bg-crimson-light disabled:opacity-60 text-white text-xs font-bold tracking-widest uppercase transition-colors">
                        <span wire:loading.remove wire:target="send">Send Message</span>
                        <span wire:loading wire:target="send">Sending...</span>
                        <svg wire:loading.remove wire:target="send" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

</div>