<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;

#[Layout('components.layouts.admin')]
#[Title('Posts')]
class Posts extends Component
{
    use WithPagination;

    public string $typeFilter = 'all';
    public string $statusFilter = 'all';
    public string $search = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingTypeFilter() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }

    public function delete(int $id): void
    {
        $post = Post::find($id);
        if ($post) {
            // delete featured image file
            if ($post->featured_image) {
                \Storage::disk('public')->delete($post->featured_image);
            }
            $post->delete();
            $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Post removed.');
        }
    }

    public function toggleStatus(int $id): void
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->status === 'published') {
                $post->update(['status' => 'draft']);
            } else {
                $post->update([
                    'status' => 'published',
                    'published_at' => $post->published_at ?? now(),
                ]);
            }
            $this->dispatch('toast', type: 'success', title: 'Updated', message: 'Status changed.');
        }
    }

    public function updateOrder(array $orderedIds): void
    {
        foreach ($orderedIds as $position => $id) {
            Post::where('id', $id)->update(['order' => $position + 1]);
        }
        $this->dispatch('toast', type: 'success', title: 'Reordered', message: 'Display order saved.');
    }

    public function render()
    {
        $posts = Post::query()
            ->with('category')
            ->when($this->typeFilter !== 'all', fn($q) => $q->where('type', $this->typeFilter))
            ->when($this->statusFilter !== 'all', fn($q) => $q->where('status', $this->statusFilter))
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->ordered()
            ->paginate(15);

        return view('livewire.admin.posts', ['posts' => $posts]);
    }
}