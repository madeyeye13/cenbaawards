<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GalleryAlbum as GalleryAlbumModel;

#[Layout('components.layouts.app')]
#[Title('Gallery')]
class GalleryAlbum extends Component
{
    use WithPagination;

    public GalleryAlbumModel $album;

    public function mount(string $slug): void
    {
        $this->album = GalleryAlbumModel::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function render()
{
    $images = $this->album->images()->orderBy('order')->paginate(24);
    $hash = '#';

    $schema = '<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ImageGallery",
    "@id": "' . route('events.gallery.album', $this->album->slug) . $hash . 'webpage",
    "url": "' . route('events.gallery.album', $this->album->slug) . '",
    "name": "' . addslashes($this->album->title) . ' — CenBa Africa Business Excellence Awards",
    "description": "' . addslashes($this->album->description ?? 'Photos from the ' . $this->album->title . ' edition of the CenBa Awards.') . '",
    "isPartOf": { "@id": "' . url('/') . $hash . 'website" },
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "' . route('home') . '" },
            { "@type": "ListItem", "position": 2, "name": "Gallery", "item": "' . route('events.gallery') . '" },
            { "@type": "ListItem", "position": 3, "name": "' . addslashes($this->album->title) . '", "item": "' . route('events.gallery.album', $this->album->slug) . '" }
        ]
    },
    "inLanguage": "en"
}
</script>';

    return view('livewire.pages.gallery-album', compact('images'))->with('schema', $schema);
}
}