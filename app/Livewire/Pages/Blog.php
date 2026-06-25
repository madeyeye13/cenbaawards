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

    $featured    = Post::published()->ordered()->first();
    $categories  = Category::where('is_active', true)->orderBy('name')->get();
    $hash        = '#';

    $schema = '<script type="application/ld+json">' . json_encode([
        '@context'   => 'https://schema.org',
        '@type'      => 'Blog',
        '@id'        => route('blog.index') . $hash . 'webpage',
        'url'        => route('blog.index'),
        'name'       => 'Blog & Press Releases — CenBa Africa Business Excellence Awards',
        'description'=> 'Insights, stories, and official announcements from the CenBa Africa Business Excellence Awards.',
        'isPartOf'   => ['@id' => url('/') . $hash . 'website'],
        'publisher'  => ['@id' => url('/') . $hash . 'organization'],
        'breadcrumb' => [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
            ],
        ],
        'inLanguage' => 'en',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

    return view('livewire.pages.blog', compact('posts', 'featured', 'categories'))
        ->with('schema', $schema);
}
}