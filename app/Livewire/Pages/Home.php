<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Partner;
use App\Models\Sponsor;
use App\Models\Event;

#[Layout('components.layouts.app')]
#[Title('CenBa Africa Business Excellence Awards — Celebrating Outstanding Achievement')]
class Home extends Component
{
    public $partners;
    public $sponsors;
    public $events;

    public function mount(): void
    {
        $this->partners = Partner::where('is_active', true)->orderBy('order')->get();
        $this->sponsors = Sponsor::where('is_active', true)->orderBy('order')->get();
        $this->events   = Event::where('is_active', true)->orderBy('event_date')->take(3)->get();
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}