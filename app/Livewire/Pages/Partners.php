<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Partner;
use App\Models\Sponsor;
use App\Models\Setting;

#[Layout('components.layouts.app')]
#[Title('Partners & Sponsors — CenBa Africa Business Excellence Awards')]
class Partners extends Component
{
    public $partners;
    public $sponsors;
    public ?string $heroImage = null;

    public function mount(): void
    {
        $this->partners = Partner::where('is_active', true)->orderBy('order')->get();
        $this->sponsors = Sponsor::where('is_active', true)->orderBy('order')->get();
        $this->heroImage = Setting::get('partners_hero_image');
    }

    public function render()
{
    $partners = Partner::where('is_active', true)->orderBy('order')->get();
    $sponsors = Sponsor::where('is_active', true)->orderBy('order')->get();
    $hash = '#';

    $schema = '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "@id": "' . route('events.partners') . $hash . 'webpage",
    "url": "' . route('events.partners') . '",
    "name": "Partners & Sponsors — CenBa Africa Business Excellence Awards",
    "isPartOf": { "@id": "' . url('/') . $hash . 'website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "' . route('home') . '" },
            { "@type": "ListItem", "position": 2, "name": "Partners & Sponsors", "item": "' . route('events.partners') . '" }
        ]
    },
    "inLanguage": "en"
}
</script>';

    return view('livewire.pages.partners', compact('partners', 'sponsors'))->with('schema', $schema);
}
}