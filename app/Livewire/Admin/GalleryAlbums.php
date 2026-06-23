<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\GalleryAlbum;

#[Layout('components.layouts.admin')]
#[Title('Gallery Albums')]
class GalleryAlbums extends Component
{
    use WithPagination;

    public bool $showForm = false;
    public ?int $editingId = null;

    public string $albumTitle = '';
    public ?int $year = null;
    public string $description = '';
    public ?string $cover_image = null;
    public ?string $cover_image_url = null;
    public bool $is_active = true;

    public function mount(): void
    {
        $this->normalizeOrder();
        $this->year = (int) date('Y');
    }

    protected function normalizeOrder(): void
    {
        $items = GalleryAlbum::orderBy('order')->orderBy('id')->get();
        foreach ($items as $i => $item) {
            if ($item->order !== $i + 1) {
                $item->update(['order' => $i + 1]);
            }
        }
    }

    public function create(): void
    {
        $this->reset(['editingId', 'albumTitle', 'description', 'cover_image', 'cover_image_url']);
        $this->year = (int) date('Y');
        $this->is_active = true;
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $album = GalleryAlbum::findOrFail($id);
        $this->editingId = $album->id;
        $this->albumTitle = $album->title;
        $this->year = $album->year;
        $this->description = $album->description ?? '';
        $this->cover_image = $album->cover_image;
        $this->cover_image_url = $album->cover_image ? asset('storage/' . $album->cover_image) : null;
        $this->is_active = $album->is_active;
        $this->showForm = true;
    }

    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if ($name !== 'album-cover' || empty($media)) return;
        $this->cover_image = $media[0]['path'];
        $this->cover_image_url = $media[0]['url'];
    }

    public function removeCover(): void
    {
        $this->cover_image = null;
        $this->cover_image_url = null;
    }

    public function save(): void
    {
        $this->validate([
            'albumTitle' => 'required|string|max:160',
            'year' => 'required|integer|min:2000|max:2100',
            'description' => 'nullable|string|max:500',
        ]);

        $data = [
            'title' => $this->albumTitle,
            'year' => $this->year,
            'description' => $this->description ?: null,
            'cover_image' => $this->cover_image,
            'is_active' => $this->is_active,
        ];

        if ($this->editingId) {
            GalleryAlbum::findOrFail($this->editingId)->update($data);
            $msg = 'Album updated.';
        } else {
            $data['order'] = (GalleryAlbum::max('order') ?? 0) + 1;
            GalleryAlbum::create($data);
            $msg = 'Album created.';
        }

        $this->showForm = false;
        $this->reset(['editingId', 'albumTitle', 'description', 'cover_image', 'cover_image_url']);
        $this->dispatch('toast', type: 'success', title: 'Saved', message: $msg);
    }

    public function delete(int $id): void
    {
        GalleryAlbum::destroy($id);
        $this->normalizeOrder();
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Album and its images removed.');
    }

    public function toggleActive(int $id): void
    {
        $album = GalleryAlbum::findOrFail($id);
        $album->update(['is_active' => !$album->is_active]);
        $this->dispatch('toast', type: 'success', title: 'Updated', message: 'Status changed.');
    }

    public function moveUp(int $id): void
    {
        $items = GalleryAlbum::orderBy('order')->get()->values();
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
        $items = GalleryAlbum::orderBy('order')->get()->values();
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
        $albums = GalleryAlbum::withCount('images')->orderBy('order')->paginate(10);
        return view('livewire.admin.gallery-albums', ['albums' => $albums]);
    }
}