<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;
use App\Models\Winner;
use App\Models\Gallery;
use App\Models\Contact;

#[Layout('layouts.admin')]
#[Title('Dashboard')]
class Dashboard extends Component
{
    public int $postCount = 0;
    public int $winnerCount = 0;
    public int $galleryCount = 0;
    public int $unreadContacts = 0;
    public array $actions = [];

    public function mount(): void
    {
        $this->postCount = Post::count();
        $this->winnerCount = Winner::count();
        $this->galleryCount = Gallery::count();
        $this->unreadContacts = Contact::where('is_read', false)->count();

        $this->actions = [
            ['label' => 'New Post', 'route' => 'admin.posts.create', 'color' => '#3B82F6'],
            ['label' => 'Add Winner', 'route' => 'admin.winners.index', 'color' => '#FBA320'],
            ['label' => 'Upload Media', 'route' => 'admin.media.index', 'color' => '#10B981'],
            ['label' => 'Add Judge', 'route' => 'admin.judges.index', 'color' => '#8B5CF6'],
            ['label' => 'Add Partner', 'route' => 'admin.partners-sponsors.index', 'color' => '#F59E0B'],
            ['label' => 'View Contacts', 'route' => 'admin.contacts.index', 'color' => '#EF4444'],
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}