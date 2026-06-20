<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Media;
use App\Models\MediaFolder;
use App\Services\MediaService;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin')]
#[Title('Media Library')]
class MediaLibrary extends Component
{
    use WithFileUploads, WithPagination;

    public $uploads = [];
    public $zipFile;

    public ?int $currentFolder = null;
    public string $search = '';

    public array $selected = [];
    public bool $selectMode = false;

    public bool $showFolderModal = false;
    public string $newFolderName = '';

    public bool $uploading = false;

    protected $listeners = ['refreshMedia' => '$refresh'];

    public function updatedUploads(): void
    {
        $this->uploading = true;
        $service = app(MediaService::class);
        $count = 0;

        foreach ($this->uploads as $upload) {
            if ($service->store($upload, $this->currentFolder)) {
                $count++;
            }
        }

        $this->uploads = [];
        $this->uploading = false;

        $this->dispatch('toast',
            type: 'success',
            title: 'Upload complete',
            message: "{$count} image(s) uploaded successfully."
        );
    }

    public function updatedZipFile(): void
    {
        $this->uploading = true;
        $service = app(MediaService::class);
        $count = $service->storeZip($this->zipFile, $this->currentFolder);

        $this->zipFile = null;
        $this->uploading = false;

        $this->dispatch('toast',
            type: $count > 0 ? 'success' : 'error',
            title: $count > 0 ? 'ZIP extracted' : 'Extraction failed',
            message: $count > 0 ? "{$count} image(s) imported from the archive." : 'No valid images found in the archive.'
        );
    }

    public function createFolder(): void
    {
        $this->validate([
            'newFolderName' => 'required|string|min:2|max:60',
        ]);

        MediaFolder::create([
            'name' => $this->newFolderName,
            'slug' => Str::slug($this->newFolderName) . '-' . Str::random(4),
            'parent_id' => $this->currentFolder,
        ]);

        $this->newFolderName = '';
        $this->showFolderModal = false;

        $this->dispatch('toast', type: 'success', title: 'Folder created', message: 'Your new folder is ready.');
    }

    public function deleteFolder(int $id): void
    {
        $folder = MediaFolder::find($id);
        if ($folder) {
            // Move images out of the folder before deleting
            Media::where('media_folder_id', $id)->update(['media_folder_id' => null]);
            $folder->delete();

            if ($this->currentFolder === $id) {
                $this->currentFolder = null;
            }

            $this->dispatch('toast', type: 'success', title: 'Folder deleted', message: 'Images were moved to "All Media".');
        }
    }

    public function selectFolder(?int $id): void
    {
        $this->currentFolder = $id;
        $this->resetPage();
        $this->selected = [];
    }

    public function toggleSelectMode(): void
    {
        $this->selectMode = !$this->selectMode;
        $this->selected = [];
    }

    public function toggleSelect(int $id): void
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
        } else {
            $this->selected[] = $id;
        }
    }

    public function deleteSelected(): void
    {
        $service = app(MediaService::class);
        $items = Media::whereIn('id', $this->selected)->get();

        foreach ($items as $item) {
            $service->delete($item);
        }

        $count = count($this->selected);
        $this->selected = [];
        $this->selectMode = false;

        $this->dispatch('toast', type: 'success', title: 'Deleted', message: "{$count} image(s) removed.");
    }

    public function deleteSingle(int $id): void
    {
        $media = Media::find($id);
        if ($media) {
            app(MediaService::class)->delete($media);
            $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Image removed.');
        }
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
            ->when(!$this->currentFolder && $this->currentFolder !== null, fn($q) => $q)
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('alt', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(24);

        return view('livewire.admin.media-library', [
            'folders' => $folders,
            'media' => $media,
        ]);
    }
}