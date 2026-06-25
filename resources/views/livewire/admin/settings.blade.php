<div class="p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Settings</h1>
            <p class="text-sm text-gray-500 dark:text-neutral-400 mt-0.5">Manage page images and site content.</p>
        </div>
        @if($tab !== 'sitemap')
        <button wire:click="save" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-800 hover:bg-red-700 text-white text-xs font-semibold tracking-wide uppercase rounded-lg transition-colors">
            Save Changes
        </button>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="flex items-center gap-1 mb-8 border-b border-gray-100 dark:border-neutral-800 overflow-x-auto pb-px">
        @foreach(['home' => 'Home', 'about' => 'About', 'categories' => 'Categories', 'criteria' => 'Criteria', 'judges' => 'Judges', 'partners' => 'Partners', 'contact' => 'Contact', 'sitemap' => 'Sitemap'] as $key => $label)
        <button wire:click="switchTab('{{ $key }}')"
                class="px-4 py-2.5 text-sm font-semibold border-b-2 whitespace-nowrap transition-colors -mb-px
                       {{ $tab === $key ? 'border-red-800 text-red-800 dark:text-red-400' : 'border-transparent text-gray-500 dark:text-neutral-400' }}">
            {{ $label }}
        </button>
        @endforeach
    </div>

    {{-- HOME TAB --}}
    @if($tab === 'home')
    <div class="space-y-8">
        <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">Hero Slideshow</h2>
            <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">The 3 slides shown in the homepage hero carousel.</p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach(['home_hero_slide_1' => 'Slide 1', 'home_hero_slide_2' => 'Slide 2', 'home_hero_slide_3' => 'Slide 3'] as $field => $label)
                <x-admin.image-setting-card :field="$field" :label="$label" :url="$this->{$field.'_url'}" />
                @endforeach
            </div>
        </div>
        <div class="border-t border-gray-100 dark:border-neutral-800 pt-8">
            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">About Section Image</h2>
            <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">The portrait image shown in the "Who We Are" section on the homepage.</p>
            <div class="max-w-xs">
                <x-admin.image-setting-card field="home_about_image" label="About Image" :url="$home_about_image_url" />
            </div>
        </div>
    </div>
    @endif

    {{-- ABOUT TAB --}}
    @if($tab === 'about')
    <div class="space-y-8">
        <div>
            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">Hero Image</h2>
            <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">Background image for the About page hero section.</p>
            <div class="max-w-xs">
                <x-admin.image-setting-card field="about_hero_image" label="Hero Image" :url="$about_hero_image_url" />
            </div>
        </div>
        <div class="border-t border-gray-100 dark:border-neutral-800 pt-8">
            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">Who We Are — Images</h2>
            <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">Two portrait images in the "Who We Are" section.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-sm">
                <x-admin.image-setting-card field="about_image_1" label="Image 1" :url="$about_image_1_url" />
                <x-admin.image-setting-card field="about_image_2" label="Image 2" :url="$about_image_2_url" />
            </div>
        </div>
        <div class="border-t border-gray-100 dark:border-neutral-800 pt-8">
            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">History Section Image</h2>
            <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">Image shown in the "Our History" section.</p>
            <div class="max-w-xs">
                <x-admin.image-setting-card field="about_history_image" label="History Image" :url="$about_history_image_url" />
            </div>
        </div>
        <div class="border-t border-gray-100 dark:border-neutral-800 pt-8">
            <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">CenBa Graduate Institute — Images</h2>
            <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">Two portrait images in the Institute section.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-sm">
                <x-admin.image-setting-card field="about_institute_image_1" label="Institute Image 1" :url="$about_institute_image_1_url" />
                <x-admin.image-setting-card field="about_institute_image_2" label="Institute Image 2" :url="$about_institute_image_2_url" />
            </div>
        </div>
    </div>
    @endif

    {{-- SINGLE IMAGE TABS --}}
    @foreach(['categories' => ['title' => 'Award Categories', 'field' => 'categories_hero_image', 'url' => $categories_hero_image_url, 'desc' => 'Hero background for the Award Categories page.'],
              'criteria'   => ['title' => 'Award Criteria',    'field' => 'criteria_hero_image',   'url' => $criteria_hero_image_url,   'desc' => 'Hero background for the Award Criteria page.'],
              'judges'     => ['title' => 'Our Judges',        'field' => 'judges_hero_image',     'url' => $judges_hero_image_url,     'desc' => 'Hero background for the Judges page.'],
              'partners'   => ['title' => 'Partners & Sponsors','field' => 'partners_hero_image',  'url' => $partners_hero_image_url,   'desc' => 'Hero background for the Partners & Sponsors page.'],
              'contact'    => ['title' => 'Contact Us',        'field' => 'contact_hero_image',    'url' => $contact_hero_image_url,    'desc' => 'Hero background for the Contact page.']] as $tabKey => $cfg)
    @if($tab === $tabKey)
    <div>
        <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">{{ $cfg['title'] }} — Hero Image</h2>
        <p class="text-xs text-gray-500 dark:text-neutral-400 mb-6">{{ $cfg['desc'] }}</p>
        <div class="max-w-xs">
            <x-admin.image-setting-card :field="$cfg['field']" label="Hero Image" :url="$cfg['url']" />
        </div>
    </div>
    @endif
    @endforeach

    @if($tab !== 'sitemap')
    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-neutral-800 flex justify-end">
        <button wire:click="save" class="px-6 py-2.5 bg-red-800 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors">
            <span wire:loading.remove wire:target="save">Save Changes</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
    @endif

    {{-- SITEMAP TAB --}}
    @if($tab === 'sitemap')
    <div class="max-w-xl">
        <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">Sitemap</h2>
        <p class="text-sm text-gray-500 dark:text-neutral-400 mb-8">
            The sitemap helps search engines discover and index all your public pages. It auto-generates daily but you can regenerate it manually anytime.
        </p>

        {{-- Status card --}}
        <div class="bg-white dark:bg-neutral-900 rounded-xl border border-gray-100 dark:border-neutral-800 p-6 mb-6">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center
                            {{ $sitemapExists ? 'bg-green-50 dark:bg-green-900/20' : 'bg-red-50 dark:bg-red-900/20' }}">
                    @if($sitemapExists)
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white mb-0.5">
                        {{ $sitemapExists ? 'Sitemap exists' : 'No sitemap found' }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-neutral-400">
                        @if($sitemapExists)
                            Last generated {{ $sitemapGeneratedAt }} ·
                            <a href="/sitemap.xml" target="_blank" class="text-red-800 dark:text-red-400 hover:underline">View sitemap.xml</a>
                        @else
                            Click the button below to generate your sitemap for the first time.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- What's included --}}
        <div class="bg-gray-50 dark:bg-neutral-800/50 rounded-xl p-5 mb-6">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-400 mb-3">What gets included</p>
            <ul class="space-y-2">
                @foreach([
                    'Homepage, About, Contact, Winners pages',
                    'Award Categories, Criteria, Judges pages',
                    'Gallery page & all active album pages',
                    'Partners & Sponsors page',
                    'All published blog posts & press releases',
                ] as $item)
                <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-neutral-300">
                    <div class="w-1.5 h-1.5 bg-red-800 rounded-full flex-shrink-0"></div>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Generate button --}}
        <button wire:click="generateSitemap"
                wire:loading.attr="disabled"
                wire:target="generateSitemap"
                class="inline-flex items-center gap-2 px-6 py-3 bg-red-800 hover:bg-red-700 disabled:opacity-60 text-white text-sm font-semibold rounded-lg transition-colors">
            <svg wire:loading.remove wire:target="generateSitemap" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <svg wire:loading wire:target="generateSitemap" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span wire:loading.remove wire:target="generateSitemap">
                {{ $sitemapExists ? 'Regenerate Sitemap' : 'Generate Sitemap' }}
            </span>
            <span wire:loading wire:target="generateSitemap">Generating...</span>
        </button>

        <p class="text-xs text-gray-400 dark:text-neutral-500 mt-3">
            The sitemap also auto-regenerates every day via the scheduler.
        </p>
    </div>
@endif

    <livewire:admin.media-picker name="settings-picker" />
</div>