<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;
use App\Models\Category;

#[Layout('components.layouts.app')]
#[Title('Blog & News — CenBa Africa Business Excellence Awards')]
class Blog extends Component
{
    use WithPagination;

    public string $type = 'all';
    public ?string $category = null;

    public function setType(string $type): void
    {
        $this->type = $type;
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::query()
            ->with(['category', 'author'])
            ->published()
            ->when($this->type !== 'all', fn($q) => $q->where('type', $this->type))
            ->when($this->category, fn($q) => $q->whereHas('category', fn($c) => $c->where('slug', $this->category)))
            ->ordered()
            ->paginate(9);

        $featured = Post::published()->ordered()->first();

        return view('livewire.pages.blog', [
            'posts' => $posts,
            'featured' => $featured,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}