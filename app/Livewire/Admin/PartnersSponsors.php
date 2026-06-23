<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Partner;
use App\Models\Sponsor;

#[Layout('components.layouts.admin')]
#[Title('Partners & Sponsors')]
class PartnersSponsors extends Component
{
    public string $tab = 'partners';

    public bool $showForm = false;
    public ?int $editingId = null;

    public string $name = '';
    public string $website = '';
    public string $description = '';
    public string $tier = 'general';
    public ?string $logo = null;
    public ?string $logoUrl = null;
    public bool $is_active = true;

    public function mount(): void
    {
        $this->normalizeOrder(Partner::class);
        $this->normalizeOrder(Sponsor::class);
    }

    protected function normalizeOrder(string $model): void
    {
        $items = $model::orderBy('order')->orderBy('id')->get();
        foreach ($items as $i => $item) {
            if ($item->order !== $i + 1) {
                $item->update(['order' => $i + 1]);
            }
        }
    }

    public function switchTab(string $tab): void
    {
        $this->tab = $tab;
        $this->closeForm();
    }

    public function create(): void
    {
        $this->reset(['editingId', 'name', 'website', 'description', 'logo', 'logoUrl']);
        $this->tier = 'general';
        $this->is_active = true;
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $item = $this->model()::findOrFail($id);
        $this->editingId = $item->id;
        $this->name = $item->name;
        $this->website = $item->website ?? '';
        $this->description = $item->description ?? '';
        $this->tier = $item->tier ?? 'general';
        $this->logo = $item->logo;
        $this->logoUrl = $item->logo ? asset('storage/' . $item->logo) : null;
        $this->is_active = $item->is_active;
        $this->showForm = true;
    }

    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if ($name !== 'ps-logo' || empty($media)) return;
        $this->logo = $media[0]['path'];
        $this->logoUrl = $media[0]['url'];
    }

    public function removeLogo(): void
    {
        $this->logo = null;
        $this->logoUrl = null;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:160',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:500',
            'logo' => 'nullable|string',
        ]);

        $data = [
            'name' => $this->name,
            'website' => $this->website ?: null,
            'description' => $this->description ?: null,
            'logo' => $this->logo,
            'is_active' => $this->is_active,
        ];

        if ($this->tab === 'sponsors') {
            $data['tier'] = $this->tier;
        }

        if ($this->editingId) {
            $this->model()::findOrFail($this->editingId)->update($data);
            $msg = 'Updated.';
        } else {
            $data['order'] = ($this->model()::max('order') ?? 0) + 1;
            $this->model()::create($data);
            $msg = 'Added.';
        }

        $this->closeForm();
        $this->dispatch('toast', type: 'success', title: 'Saved', message: $msg);
    }

    public function delete(int $id): void
    {
        $this->model()::destroy($id);
        $this->normalizeOrder($this->model());
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Removed.');
    }

    public function toggleActive(int $id): void
    {
        $item = $this->model()::findOrFail($id);
        $item->update(['is_active' => !$item->is_active]);
        $this->dispatch('toast', type: 'success', title: 'Updated', message: 'Status changed.');
    }

    public function moveUp(int $id): void
    {
        $items = $this->model()::orderBy('order')->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index > 0) {
            $current = $items[$index];
            $above = $items[$index - 1];
            $tmp = $current->order;
            $current->update(['order' => $above->order]);
            $above->update(['order' => $tmp]);
        }
    }

    public function moveDown(int $id): void
    {
        $items = $this->model()::orderBy('order')->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index !== false && $index < $items->count() - 1) {
            $current = $items[$index];
            $below = $items[$index + 1];
            $tmp = $current->order;
            $current->update(['order' => $below->order]);
            $below->update(['order' => $tmp]);
        }
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->reset(['editingId', 'name', 'website', 'description', 'logo', 'logoUrl']);
    }

    protected function model(): string
    {
        return $this->tab === 'sponsors' ? Sponsor::class : Partner::class;
    }

    public function render()
    {
        $items = $this->model()::orderBy('order')->get();
        return view('livewire.admin.partners-sponsors', ['items' => $items]);
    }
}