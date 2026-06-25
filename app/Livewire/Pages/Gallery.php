<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GalleryAlbum;

#[Layout('components.layouts.app')]
#[Title('Gallery — CenBa Africa Business Excellence Awards')]
class Gallery extends Component
{
 public function render()
{
    $albums = GalleryAlbum::where('is_active', true)
        ->withCount('images')->orderBy('year', 'desc')->orderBy('order')->get();
    $hash = '#';

    $webPageSchema = json_encode([
        '@context'   => 'https://schema.org',
        '@type'      => 'CollectionPage',
        '@id'        => route('events.gallery') . $hash . 'webpage',
        'url'        => route('events.gallery'),
        'name'       => 'Gallery — CenBa Africa Business Excellence Awards',
        'isPartOf'   => ['@id' => url('/') . $hash . 'website'],
        'breadcrumb' => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home',    'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Gallery', 'item' => route('events.gallery')],
            ],
        ],
        'inLanguage' => 'en',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $schema = '<script type="application/ld+json">' . $webPageSchema . '</script>';

    if ($albums->count() > 0) {
        $albumItems = [];
        foreach ($albums as $i => $a) {
            $item = [
                '@type' => 'ImageGallery',
                'name'  => $a->title,
                'url'   => route('events.gallery.album', $a->slug),
            ];
            if ($a->cover_url) {
                $item['thumbnailUrl'] = $a->cover_url;
            }
            $albumItems[] = ['@type' => 'ListItem', 'position' => $i + 1, 'item' => $item];
        }

        $listSchema = json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'name'            => 'CenBa Awards Gallery',
            'itemListElement' => $albumItems,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $schema .= '<script type="application/ld+json">' . $listSchema . '</script>';
    }

    return view('livewire.pages.gallery', compact('albums'))->with('schema', $schema);
}
}