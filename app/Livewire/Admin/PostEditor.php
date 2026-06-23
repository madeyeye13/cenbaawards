<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

#[Layout('components.layouts.admin')]
#[Title('Post Editor')]
class PostEditor extends Component
{
    public ?Post $post = null;
    public bool $editing = false;

    // Fields
    public string $type = 'blog';
    public string $title = '';
    public string $slug = '';
    public string $excerpt = '';
    public string $body = '';
    public ?string $featured_image = null;
    public ?string $featured_image_url = null;
    public ?int $category_id = null;
    public string $newCategory = '';
    public array $selectedTags = [];
    public string $newTag = '';
    public string $status = 'draft';
    public ?string $published_at = null;

    // SEO
    public string $meta_title = '';
    public string $meta_description = '';
    public ?string $og_image = null;
    public ?string $og_image_url = null;

    public bool $slugManuallyEdited = false;

    public function mount($post = null): void
    {
        if ($post) {
            $this->post = Post::with('tags')->findOrFail($post);
            $this->editing = true;
            $this->type = $this->post->type;
            $this->title = $this->post->title;
            $this->slug = $this->post->slug;
            $this->excerpt = $this->post->excerpt ?? '';
            $this->body = $this->post->body;
            $this->featured_image = $this->post->featured_image;
            $this->featured_image_url = $this->post->featured_image ? asset('storage/' . $this->post->featured_image) : null;
            $this->category_id = $this->post->category_id;
            $this->selectedTags = $this->post->tags->pluck('id')->toArray();
            $this->status = $this->post->status;
            $this->published_at = $this->post->published_at?->format('Y-m-d\TH:i');
            $this->meta_title = $this->post->meta_title ?? '';
            $this->meta_description = $this->post->meta_description ?? '';
            $this->og_image = $this->post->og_image;
            $this->og_image_url = $this->post->og_image ? asset('storage/' . $this->post->og_image) : null;
            $this->slugManuallyEdited = true;
        }
    }

    public function updatedTitle($value): void
    {
        if (!$this->slugManuallyEdited) {
            $this->slug = Str::slug($value);
        }
    }

    public function updatedSlug(): void
    {
        $this->slugManuallyEdited = true;
        $this->slug = Str::slug($this->slug);
    }

    // ===== MediaPicker handlers =====
    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if (empty($media)) return;

        if ($name === 'featured-image') {
            $this->featured_image = $media[0]['path'];
            $this->featured_image_url = $media[0]['url'];
        }

        if ($name === 'og-image') {
            $this->og_image = $media[0]['path'];
            $this->og_image_url = $media[0]['url'];
        }

        if ($name === 'inline-image') {
            // send url to the TipTap editor in the browser
            $this->dispatch('insert-editor-image', url: $media[0]['url']);
        }
    }

    public function removeFeaturedImage(): void
    {
        $this->featured_image = null;
        $this->featured_image_url = null;
    }

    public function removeOgImage(): void
    {
        $this->og_image = null;
        $this->og_image_url = null;
    }

    public function addCategory(): void
    {
        $name = trim($this->newCategory);
        if ($name === '') return;

        $category = \App\Models\Category::firstOrCreate(
            ['name' => $name],
            ['slug' => \Illuminate\Support\Str::slug($name), 'is_active' => true]
        );

        $this->category_id = $category->id;
        $this->newCategory = '';
        $this->dispatch('toast', type: 'success', title: 'Category added', message: $category->name);
    }

    // ===== Tags =====
    public function addTag(): void
    {
        $name = trim($this->newTag);
        if ($name === '') return;

        $tag = Tag::firstOrCreate(['name' => $name]);
        if (!in_array($tag->id, $this->selectedTags)) {
            $this->selectedTags[] = $tag->id;
        }
        $this->newTag = '';
    }

    public function removeTag(int $id): void
    {
        $this->selectedTags = array_values(array_diff($this->selectedTags, [$id]));
    }

    // ===== Save =====
    public function save(string $publishAction = 'draft'): void
    {
        $this->validate([
            'title' => 'required|string|max:200',
            'slug'  => 'required|string|max:200',
            'body'  => 'required|string',
            'type'  => 'required|in:blog,press_release',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $status = $publishAction === 'publish' ? 'published' : 'draft';
        $publishedAt = $this->published_at
            ? \Carbon\Carbon::parse($this->published_at)
            : ($status === 'published' ? now() : null);

        $data = [
            'type' => $this->type,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt ?: null,
            'body' => $this->body,
            'featured_image' => $this->featured_image,
            'category_id' => $this->category_id,
            'status' => $status,
            'published_at' => $publishedAt,
            'meta_title' => $this->meta_title ?: null,
            'meta_description' => $this->meta_description ?: null,
            'og_image' => $this->og_image,
            'admin_user_id' => auth('admin')->id(),
        ];

        if ($this->editing) {
            $this->post->update($data);
        } else {
            $data['order'] = (Post::max('order') ?? 0) + 1;
            $this->post = Post::create($data);
            $this->editing = true;
        }

        $this->post->tags()->sync($this->selectedTags);

        $this->dispatch('toast', type: 'success', title: 'Saved', message: 'Post saved successfully.');

        $this->redirect(route('admin.posts.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.post-editor', [
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
            'allTags' => Tag::whereIn('id', $this->selectedTags)->get(),
        ]);
    }
}