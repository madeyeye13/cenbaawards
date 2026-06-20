<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Media;
use App\Models\MediaFolder;
use App\Services\MediaService;

class MediaPicker extends Component
{
    use WithFileUploads, WithPagination;

    public bool $show = false;
    public bool $multiple = false;

    /** A unique name so multiple pickers on one page don't clash */
    public string $name = 'default';

    public $uploads = [];
    public ?int $currentFolder = null;
    public string $search = '';
    public array $picked = [];
    public bool $uploading = false;

    protected $listeners = ['openMediaPicker' => 'open'];

    public function open(string $name, bool $multiple = false): void
    {
        if ($name !== $this->name) {
            return;
        }
        $this->multiple = $multiple;
        $this->picked = [];
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
        $this->picked = [];
    }

    public function updatedUploads(): void
    {
        $this->uploading = true;
        $service = app(MediaService::class);

        foreach ($this->uploads as $upload) {
            $service->store($upload, $this->currentFolder);
        }

        $this->uploads = [];
        $this->uploading = false;
        $this->resetPage();

        $this->dispatch('toast', type: 'success', title: 'Uploaded', message: 'Image added to library.');
    }

    public function pick(int $id): void
    {
        if ($this->multiple) {
            if (in_array($id, $this->picked)) {
                $this->picked = array_diff($this->picked, [$id]);
            } else {
                $this->picked[] = $id;
            }
        } else {
            $this->picked = [$id];
        }
    }

    public function confirm(): void
    {
        $media = Media::whereIn('id', $this->picked)->get()
            ->map(fn($m) => [
                'id'   => $m->id,
                'url'  => $m->url,
                'path' => $m->path,
                'alt'  => $m->alt,
            ])->values()->toArray();

        // Send selection back to the parent component, tagged with this picker's name
        $this->dispatch('mediaPicked', name: $this->name, media: $media);

        $this->close();
    }

    public function selectFolder(?int $id): void
    {
        $this->currentFolder = $id;
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $folders = MediaFolder::orderBy('name')->get();

        $media = Media::query()
            ->when($this->currentFolder, fn($q) => $q->where('media_folder_id', $this->currentFolder))
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('alt', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(18);

        return view('livewire.admin.media-picker', [
            'folders' => $folders,
            'media' => $media,
        ]);
    }
}