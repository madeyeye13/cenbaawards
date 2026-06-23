<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Winner;
use App\Models\AwardCategory;

#[Layout('components.layouts.admin')]
#[Title('Winners')]
class Winners extends Component
{
    public string $selectedYear = 'all';
    public array $years = [];

    public bool $showForm = false;
    public ?int $editingId = null;

    public ?string $name = null;
    public ?string $company = null;
    public ?string $description = null;
    public ?int $award_category_id = null;
    public int $year;
    public ?string $photo = null;
    public ?string $photoUrl = null;
    public bool $is_active = true;

    public function mount(): void
    {
        $this->year = (int) date('Y');
        $this->years = Winner::selectRaw('year')->distinct()->orderByDesc('year')->pluck('year')->toArray();
        $this->normalizeOrder();
    }

    protected function normalizeOrder(): void
    {
        $query = Winner::orderBy('year', 'desc')->orderBy('order')->orderBy('id');
        $items = $query->get();
        foreach ($items as $i => $item) {
            if ($item->order !== $i + 1) {
                $item->update(['order' => $i + 1]);
            }
        }
    }

    public function filterYear(string $year): void
    {
        $this->selectedYear = $year;
    }

    public function create(): void
    {
        $this->reset(['editingId', 'name', 'company', 'description', 'award_category_id', 'photo', 'photoUrl']);
        $this->year = (int) date('Y');
        $this->is_active = true;
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $winner = Winner::findOrFail($id);
        $this->editingId = $winner->id;
        $this->name = $winner->name;
        $this->company = $winner->company;
        $this->description = $winner->description;
        $this->award_category_id = $winner->award_category_id;
        $this->year = $winner->year ?? (int) date('Y');
        $this->photo = $winner->photo;
        $this->photoUrl = $winner->photo ? asset('storage/' . $winner->photo) : null;
        $this->is_active = $winner->is_active;
        $this->showForm = true;
    }
    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if ($name !== 'winner-photo' || empty($media)) return;
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
        $this->validate([
            'name'              => 'nullable|string|max:160',
            'company'           => 'nullable|string|max:160',
            'year'              => 'nullable|integer|min:2000|max:2100',
            'award_category_id' => 'nullable|exists:award_categories,id',
            'description'       => 'nullable|string|max:500',
            'photo'             => 'nullable|string',
        ]);

        $data = [
            'name'              => $this->name ?: null,
            'company'           => $this->company ?: null,
            'year'              => $this->year ?: null,
            'award_category_id' => $this->award_category_id,
            'description'       => $this->description ?: null,
            'photo'             => $this->photo,
            'is_active'         => $this->is_active,
        ];

        if ($this->editingId) {
            Winner::findOrFail($this->editingId)->update($data);
            $msg = 'Winner updated.';
        } else {
            $data['order'] = (Winner::max('order') ?? 0) + 1;
            Winner::create($data);
            $msg = 'Winner added.';
            // Refresh year list
            $this->years = Winner::selectRaw('year')->distinct()->orderByDesc('year')->pluck('year')->toArray();
        }

        $this->closeForm();
        $this->dispatch('toast', type: 'success', title: 'Saved', message: $msg);
    }

    public function delete(int $id): void
    {
        Winner::destroy($id);
        $this->years = Winner::selectRaw('year')->distinct()->orderByDesc('year')->pluck('year')->toArray();
        if ($this->selectedYear !== 'all' && !in_array((int) $this->selectedYear, $this->years)) {
            $this->selectedYear = 'all';
        }
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Winner removed.');
    }

    public function toggleActive(int $id): void
    {
        $winner = Winner::findOrFail($id);
        $winner->update(['is_active' => !$winner->is_active]);
        $this->dispatch('toast', type: 'success', title: 'Updated', message: 'Status changed.');
    }

    public function moveUp(int $id): void
    {
        $items = $this->filteredQuery()->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index > 0) {
            $current = $items[$index];
            $above   = $items[$index - 1];
            $tmp = $current->order;
            $current->update(['order' => $above->order]);
            $above->update(['order' => $tmp]);
        }
    }

    public function moveDown(int $id): void
    {
        $items = $this->filteredQuery()->get()->values();
        $index = $items->search(fn($i) => $i->id === $id);
        if ($index !== false && $index < $items->count() - 1) {
            $current = $items[$index];
            $below   = $items[$index + 1];
            $tmp = $current->order;
            $current->update(['order' => $below->order]);
            $below->update(['order' => $tmp]);
        }
    }

    protected function filteredQuery()
    {
        $query = Winner::orderBy('order');
        if ($this->selectedYear !== 'all') {
            $query->where('year', $this->selectedYear);
        }
        return $query;
    }

    public function closeForm(): void
    {
        $this->showForm = false;
        $this->reset(['editingId', 'name', 'company', 'description', 'award_category_id', 'photo', 'photoUrl']);
    }

    public function render()
    {
        $winners    = $this->filteredQuery()->with('awardCategory')->get();
        $categories = AwardCategory::orderBy('name')->get();

        return view('livewire.admin.winners', compact('winners', 'categories'));
    }
}