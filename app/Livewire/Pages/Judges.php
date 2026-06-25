<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Judge;
use App\Models\Setting;

#[Layout('components.layouts.app')]
#[Title('Our Judges — CenBa Africa Business Excellence Awards')]
class Judges extends Component
{
    public $judges;
    public ?string $heroImage = null;

    public function mount(): void
    {
        $this->judges = Judge::where('is_active', true)
            ->orderBy('order')
            ->get();

        $this->heroImage = Setting::get('judges_hero_image');
    }

   public function render()
{
    $judges = Judge::where('is_active', true)->orderBy('order')->get();
    $hash = '#';

    $webPageSchema = json_encode([
        '@context' => 'https://schema.org',
        '@type'    => 'WebPage',
        '@id'      => route('award.judges') . $hash . 'webpage',
        'url'      => route('award.judges'),
        'name'     => 'Our Judges — CenBa Africa Business Excellence Awards',
        'isPartOf' => ['@id' => url('/') . $hash . 'website'],
        'breadcrumb' => [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Our Judges', 'item' => route('award.judges')],
            ],
        ],
        'inLanguage' => 'en',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $schema = '<script type="application/ld+json">' . $webPageSchema . '</script>';

    if ($judges->count() > 0) {
        $judgeItems = [];
        foreach ($judges as $i => $j) {
            $item = ['@type' => 'Person', 'name' => $j->name];
            if ($j->title) {
                $item['jobTitle'] = $j->title;
            }
            if ($j->organization) {
                $item['worksFor'] = ['@type' => 'Organization', 'name' => $j->organization];
            }
            if ($j->photo) {
                $item['image'] = asset('storage/' . $j->photo);
            }
            if ($j->linkedin) {
                $item['sameAs'] = $j->linkedin;
            }
            $judgeItems[] = ['@type' => 'ListItem', 'position' => $i + 1, 'item' => $item];
        }

        $listSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'name'            => 'CenBa Africa Business Excellence Awards — Panel of Judges',
            'itemListElement' => $judgeItems,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $schema .= '<script type="application/ld+json">' . $listSchema . '</script>';
    }

    return view('livewire.pages.judges', compact('judges'))->with('schema', $schema);
}
}