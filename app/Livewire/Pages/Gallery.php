<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\GalleryAlbum;

#[Layout('components.layouts.app')]
#[Title('Gallery — CenBa Africa Business Excellence Awards')]
class Gallery extends Component
{
    public function render()
    {
        $albums = GalleryAlbum::where('is_active', true)
            ->withCount('images')
            ->orderBy('year', 'desc')
            ->orderBy('order')
            ->get();

        return view('livewire.pages.gallery', compact('albums'));
    }
}