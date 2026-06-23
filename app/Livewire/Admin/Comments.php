<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Comment;

#[Layout('components.layouts.admin')]
#[Title('Comments')]
class Comments extends Component
{
    use WithPagination;

    public string $filter = 'pending';

    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function approve(int $id): void
    {
        Comment::where('id', $id)->update(['status' => 'approved']);
        $this->dispatch('toast', type: 'success', title: 'Approved', message: 'Comment is now visible.');
    }

    public function unapprove(int $id): void
    {
        Comment::where('id', $id)->update(['status' => 'pending']);
        $this->dispatch('toast', type: 'success', title: 'Hidden', message: 'Comment set back to pending.');
    }

    public function markSpam(int $id): void
    {
        Comment::where('id', $id)->update(['status' => 'spam']);
        $this->dispatch('toast', type: 'success', title: 'Marked as spam', message: 'Comment hidden.');
    }

    public function delete(int $id): void
    {
        Comment::destroy($id);
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Comment removed.');
    }

    public function render()
    {
        $comments = Comment::query()
            ->with('post')
            ->when($this->filter !== 'all', fn($q) => $q->where('status', $this->filter))
            ->latest()
            ->paginate(15);

        $counts = [
            'pending'  => Comment::where('status', 'pending')->count(),
            'approved' => Comment::where('status', 'approved')->count(),
            'spam'     => Comment::where('status', 'spam')->count(),
        ];

        return view('livewire.admin.comments', compact('comments', 'counts'));
    }
}