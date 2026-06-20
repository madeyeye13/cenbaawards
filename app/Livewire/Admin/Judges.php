<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Judge;

#[Layout('components.layouts.admin')]
#[Title('Manage Judges')]
class Judges extends Component
{
    public bool $showForm = false;
    public ?int $editingId = null;

    public string $name = '';
    public string $title = '';
    public string $organization = '';
    public string $location = '';
    public string $bio = '';
    public string $linkedin = '';
    public ?string $photo = null;
    public ?string $photoUrl = null;
    public bool $is_active = true;

    protected function rules(): array
    {
        return [
            'name'         => 'required|string|max:120',
            'title'        => 'required|string|max:160',
            'organization' => 'required|string|max:200',
            'location'     => 'nullable|string|max:160',
            'bio'          => 'required|string',
            'linkedin'     => 'nullable|url|max:255',
            'photo'        => 'nullable|string',
        ];
    }

    public function create(): void
    {
        $this->reset(['editingId', 'name', 'title', 'organization', 'location', 'bio', 'linkedin', 'photo', 'photoUrl']);
        $this->is_active = true;
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $judge = Judge::findOrFail($id);
        $this->editingId    = $judge->id;
        $this->name         = $judge->name;
        $this->title        = $judge->title;
        $this->organization = $judge->organization;
        $this->location     = $judge->location ?? '';
        $this->bio          = $judge->bio;
        $this->linkedin     = $judge->linkedin ?? '';
        $this->photo        = $judge->photo;
        $this->photoUrl     = $judge->photo ? asset('storage/' . $judge->photo) : null;
        $this->is_active    = $judge->is_active;
        $this->showForm     = true;
    }

    /** Receives the image chosen in the MediaPicker */
    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if ($name !== 'judge-photo' || empty($media)) {
            return;
        }
        $this->photo = $media[0]['path'];
        $this->photoUrl = $media[0]['url'];
    }

    public function removePhoto(): void
    {
        $this->photo = null;
        $this->photoUrl = null;
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['is_active'] = $this->is_active;

        if ($this->editingId) {
            $judge = Judge::findOrFail($this->editingId);
            $judge->update($data);
            $msg = 'Judge updated.';
        } else {
            $data['order'] = (Judge::max('order') ?? 0) + 1;
            Judge::create($data);
            $msg = 'Judge added.';
        }

        $this->showForm = false;
        $this->reset(['editingId', 'name', 'title', 'organization', 'location', 'bio', 'linkedin', 'photo', 'photoUrl']);
        $this->dispatch('toast', type: 'success', title: 'Saved', message: $msg);
    }

    public function delete(int $id): void
    {
        Judge::destroy($id);
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Judge removed.');
    }

    public function toggleActive(int $id): void
    {
        $judge = Judge::findOrFail($id);
        $judge->update(['is_active' => !$judge->is_active]);
        $this->dispatch('toast', type: 'success', title: 'Updated', message: 'Status changed.');
    }

    /** Reorder via drag — receives ordered array of IDs */
    public function updateOrder(array $orderedIds): void
    {
        foreach ($orderedIds as $position => $id) {
            Judge::where('id', $id)->update(['order' => $position + 1]);
        }
        $this->dispatch('toast', type: 'success', title: 'Reordered', message: 'Display order saved.');
    }

    public function render()
    {
        return view('livewire.admin.judges', [
            'judges' => Judge::orderBy('order')->get(),
        ]);
    }
}