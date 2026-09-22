<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Partner;
use App\Models\Sponsor;
use App\Models\Event;
use App\Models\Setting;
use Carbon\Carbon;

#[Layout('components.layouts.app')]
#[Title('CenBa Africa Business Excellence Awards — Celebrating Outstanding Achievement')]
class Home extends Component
{
    public $partners;
    public $sponsors;
    public $events;
    public $latestPosts;

    public bool $editionBannerEnabled = false;
    public string $editionBannerTitle = '';
    public string $editionBannerSubtitle = '';
    public string $editionNominationsOpen = '';
    public string $editionEntriesClose = '';
    public ?string $editionBannerImage = null;

   public function mount(): void
    {
        $this->partners    = Partner::where('is_active', true)->orderBy('order')->get();
        $this->sponsors    = Sponsor::where('is_active', true)->orderBy('order')->get();
        $this->latestPosts = \App\Models\Post::published()->ordered()->take(4)->get();

        // Hero slides
        $this->heroSlides = [
            ['path' => Setting::get('home_hero_slide_1'), 'fallback' => asset('images/hero/slide-1.jpg'), 'alt' => 'CenBa Africa Business Excellence Awards Ceremony'],
            ['path' => Setting::get('home_hero_slide_2'), 'fallback' => asset('images/hero/slide-2.jpg'), 'alt' => 'CenBa Awards Winners Celebration'],
            ['path' => Setting::get('home_hero_slide_3'), 'fallback' => asset('images/hero/slide-3.jpg'), 'alt' => 'CenBa Africa Business Excellence Gala Night'],
        ];
        $this->homeAboutImage = Setting::get('home_about_image');


        // Add to mount():
        $this->editionBannerEnabled = (bool) Setting::get('edition_banner_enabled', false);
        $this->editionBannerTitle = Setting::get('edition_banner_title', 'CABEA 2026 — 8th Edition');
        $this->editionBannerSubtitle = Setting::get('edition_banner_subtitle', 'Coming Soon');
        $this->editionNominationsOpen = Setting::get('edition_nominations_open', '12th August, 2026');
        $this->editionEntriesClose = Setting::get('edition_entries_close', '6th November, 2026');
        $this->editionBannerImage = Setting::get('edition_banner_image');

        // Auto-hide logic
        $autoHideDate = Setting::get('edition_auto_hide_date');
        if ($autoHideDate && Carbon::parse($autoHideDate)->isPast()) {
            $this->editionBannerEnabled = false;
        }

    }

    public array $heroSlides = [];
    public ?string $homeAboutImage = null;

    public function render()
{
    $hash = '#';
    $schema = '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "@id": "' . route('home') . $hash . 'webpage",
    "url": "' . route('home') . '",
    "name": "CenBa Africa Business Excellence Awards",
    "description": "Celebrating Africa\'s finest businesses and entrepreneurs since 2016.",
    "isPartOf": { "@id": "' . url('/') . $hash . 'website" },
    "inLanguage": "en"
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Event",
    "name": "CenBa Africa Business Excellence Awards & Dinner Night 2026",
    "startDate": "2026-11-28T18:00:00",
    "endDate": "2026-11-28T22:00:00",
    "eventStatus": "https://schema.org/EventScheduled",
    "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
    "location": {
        "@type": "Place",
        "name": "Golden Bean Hotel",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Ahodwo Nhyiaeso",
            "addressLocality": "Kumasi",
            "addressCountry": "GH"
        }
    },
    "organizer": { "@id": "' . url('/') . $hash . 'organization" }
}
</script>';

    return view('livewire.pages.home')->with('schema', $schema);
}
}