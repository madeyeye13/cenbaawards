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
        $images = $this->album->images()
            ->orderBy('order')
            ->paginate(24);

        return view('livewire.pages.gallery-album', compact('images'));
    }
}