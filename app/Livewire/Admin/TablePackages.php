<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\TablePackage;
use App\Models\Setting;

#[Layout('components.layouts.admin')]
#[Title('Award Table Packages')]
class TablePackages extends Component
{
    public bool $showForm = false;
    public ?int $editingId = null;

    public ?string $name = null;
    public ?int $seats = null;
    public ?string $price = null;
    public array $features = [];
    public string $newFeature = '';
    public bool $is_active = true;

    public string $note = '';

    public function mount(): void
    {
        $this->normalizeOrder();
        $this->note = (string) Setting::get('table_packages_note', 'There is no cost in submitting an application form.');
    }

    protected function normalizeOrder(): void
    {
        $items = TablePackage::orderBy('sort_order')->orderBy('id')->get();
        foreach ($items as $i => $item) {
            if ($item->sort_order !== $i + 1) {
                $item->update(['sort_order' => $i + 1]);
            }
        }
    }

    public function create(): void
    {
        $this->reset(['editingId', 'name', 'seats', 'price', 'features', 'newFeature']);
        $this->is_active = true;
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $package = TablePackage::findOrFail($id);
        $this->editingId = $package->id;
        $this->name = $package->name;
        $this->seats = $package->seats;
        $this->price = (string) $package->price;
        $this->features = $package->features ?? [];
        $this->newFeature = '';
        $this->is_active = $package->is_active;
        $this->showForm = true;
    }

    public function addFeature(): void
    {
        $value = trim($this->newFeature);
        if ($value !== '') {
            $this->features[] = $value;
            $this->newFeature = '';
        }
    }

    public function removeFeature(int $index): void
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save(): void
    {
        $this->validate([
            'name'  => 'required|string|max:160',
            'seats' => 'required|integer|min:1|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        $data = [
            'name'      => $this->name,
            'seats'     => $this->seats,
            'price'     => $this->price,
            'features'  => !empty($this->features) ? array_values($this->features) : null,
            'is_active' => $this->is_active,
        ];

        if ($this->editingId) {
            TablePackage::findOrFail($this->editingId)->update($data);
            $msg = 'Package updated.';
        } else {
            $data['sort_order'] = (TablePackage::max('sort_order') ?? 0) + 1;
            TablePackage::create($data);
            $msg = 'Package added.';
        }

        $this->closeForm();
        $this->dispatch('toast', type: 'success', title: 'Saved', message: $msg);
    }

    public function delete(int $id): void
    {
        TablePackage::destroy($id);
        $this->normalizeOrder();
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Package removed.');
    }

    public function toggleActive(int $id): void
    {
        $package = TablePackage::findOrFail($id);
        $package->update(['is_active' => !$package->is_active]);
        $this->dispatch('toast', type: 'success', title: 'Updated', message: 'Status changed.');
    }

    public function moveUp(int $id): void
    {
        $items = TablePackage::orderBy('sort_order')->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index > 0) {
            $current = $items[$index];
            $above   = $items[$index - 1];
            $tmp = $current->sort_order;
            $current->update(['sort_order' => $above->sort_order]);
            $above->update(['sort_order' => $tmp]);
        }
    }

    public function moveDown(int $id): void
    {
        $items = TablePackage::orderBy('sort_order')->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index !== false && $index < $items->count() - 1) {
            $current = $items[$index];
            $below   = $items[$index + 1];
            $tmp = $current->sort_order;
            $current->update(['sort_order' => $below->sort_order]);
            $below->update(['sort_order' => $tmp]);
        }
    }

    public function saveNote(): void
    {
        $this->validate(['note' => 'nullable|string|max:500']);
        Setting::set('table_packages_note', $this->note, 'general');
        $this->dispatch('toast', type: 'success', title: 'Saved', message: 'Note updated.');
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->reset(['editingId', 'name', 'seats', 'price', 'features', 'newFeature']);
    }

    public function render()
    {
        $packages = TablePackage::orderBy('sort_order')->get();
        return view('livewire.admin.table-packages', compact('packages'));
    }
}
