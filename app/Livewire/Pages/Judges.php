<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Judge;

#[Layout('components.layouts.app')]
#[Title('Our Judges — CenBa Africa Business Excellence Awards')]
class Judges extends Component
{
    public $judges;

    public function mount(): void
    {
        $this->judges = Judge::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.judges');
    }
}