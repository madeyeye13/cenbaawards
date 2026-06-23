<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Winner;

#[Layout('components.layouts.app')]
#[Title('Past Winners — CenBa Africa Business Excellence Awards')]
class Winners extends Component
{
    public string $selectedYear = '';

    public function mount(): void
    {
        $latest = Winner::where('is_active', true)->max('year');
        $this->selectedYear = (string) ($latest ?? date('Y'));
    }

    public function selectYear(string $year): void
    {
        $this->selectedYear = $year;
    }

    public function render()
    {
        $years = Winner::where('is_active', true)
            ->selectRaw('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        $winners = Winner::where('is_active', true)
            ->where('year', $this->selectedYear)
            ->with('awardCategory')
            ->orderBy('order')
            ->get();

        return view('livewire.pages.winners', compact('years', 'winners'));
    }
}