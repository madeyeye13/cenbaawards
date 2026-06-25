<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Winner;

#[Layout('components.layouts.app')]
#[Title('Past Winners — CenBa Africa Business Excellence Awards')]
class Winners extends Component
{
    public string $selectedYear = '';

    public function mount(): void
    {
        $latest = Winner::where('is_active', true)->max('year');
        $this->selectedYear = (string) ($latest ?? date('Y'));
    }

    public function selectYear(string $year): void
    {
        $this->selectedYear = $year;
    }

    public function render()
{
    $hash = '#';
    $years = Winner::where('is_active', true)
        ->selectRaw('year')->distinct()->orderByDesc('year')->pluck('year');

    $winners = Winner::where('is_active', true)
        ->where('year', $this->selectedYear)
        ->with('awardCategory')->orderBy('order')->get();

    $winnerItems = [];
    foreach ($winners as $i => $w) {
        $item = [
            '@type'    => 'Person',
            'name'     => $w->name ?? 'Award Winner',
        ];
        if ($w->company) {
            $item['worksFor'] = ['@type' => 'Organization', 'name' => $w->company];
        }
        if ($w->awardCategory) {
            $item['award'] = 'CenBa ' . $w->awardCategory->name . ' Award ' . $this->selectedYear;
        }
        $winnerItems[] = ['@type' => 'ListItem', 'position' => $i + 1, 'item' => $item];
    }

    $webPageSchema = json_encode([
        '@context' => 'https://schema.org',
        '@type'    => 'WebPage',
        '@id'      => route('winners') . $hash . 'webpage',
        'url'      => route('winners'),
        'name'     => 'Past Winners — CenBa Africa Business Excellence Awards',
        'isPartOf' => ['@id' => url('/') . $hash . 'website'],
        'breadcrumb' => [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Past Winners', 'item' => route('winners')],
            ],
        ],
        'inLanguage' => 'en',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $schema = '<script type="application/ld+json">' . $webPageSchema . '</script>';

    if ($winners->count() > 0) {
        $listSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'name'            => 'CenBa Awards ' . $this->selectedYear . ' Winners',
            'itemListElement' => $winnerItems,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $schema .= '<script type="application/ld+json">' . $listSchema . '</script>';
    }

    return view('livewire.pages.winners', compact('years', 'winners'))->with('schema', $schema);
}
}