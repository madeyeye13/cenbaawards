<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Partner;
use App\Models\Sponsor;

#[Layout('components.layouts.app')]
#[Title('Partners & Sponsors — CenBa Africa Business Excellence Awards')]
class Partners extends Component
{
    public $partners;
    public $sponsors;

    public function mount(): void
    {
        $this->partners = Partner::where('is_active', true)->orderBy('order')->get();
        $this->sponsors = Sponsor::where('is_active', true)->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.pages.partners');
    }
}