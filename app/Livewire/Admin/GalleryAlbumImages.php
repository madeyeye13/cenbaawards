<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;

#[Layout('components.layouts.admin')]
#[Title('Manage Album Photos')]
class GalleryAlbumImages extends Component
{
    public GalleryAlbum $album;

    public function mount(string $slug): void
    {
        $this->album = GalleryAlbum::where('slug', $slug)->firstOrFail();
        $this->normalizeOrder();
    }

    protected function normalizeOrder(): void
    {
        $items = $this->album->images()->orderBy('order')->orderBy('id')->get();
        foreach ($items as $i => $item) {
            if ($item->order !== $i + 1) {
                $item->update(['order' => $i + 1]);
            }
        }
    }

    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if ($name !== 'album-photos' || empty($media)) return;

        $start = (GalleryImage::where('gallery_album_id', $this->album->id)->max('order') ?? 0);

        foreach ($media as $i => $m) {
            GalleryImage::create([
                'gallery_album_id' => $this->album->id,
                'image_path' => $m['path'],
                'order' => $start + $i + 1,
            ]);
        }

        $count = count($media);
        $this->dispatch('toast', type: 'success', title: 'Added', message: "{$count} photo(s) added to the album.");
    }

    public function removeImage(int $id): void
    {
        GalleryImage::where('id', $id)->where('gallery_album_id', $this->album->id)->delete();
        $this->normalizeOrder();
        $this->dispatch('toast', type: 'success', title: 'Removed', message: 'Photo removed from album.');
    }

    public function moveUp(int $id): void
    {
        $items = $this->album->images()->orderBy('order')->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index > 0) {
            $current = $items[$index]; $above = $items[$index - 1];
            $tmp = $current->order;
            $current->update(['order' => $above->order]);
            $above->update(['order' => $tmp]);
        }
    }

    public function moveDown(int $id): void
    {
        $items = $this->album->images()->orderBy('order')->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index !== false && $index < $items->count() - 1) {
            $current = $items[$index]; $below = $items[$index + 1];
            $tmp = $current->order;
            $current->update(['order' => $below->order]);
            $below->update(['order' => $tmp]);
        }
    }

    public function render()
    {
        $images = $this->album->images()->orderBy('order')->paginate(24);
        return view('livewire.admin.gallery-album-images', ['images' => $images]);
    }
}