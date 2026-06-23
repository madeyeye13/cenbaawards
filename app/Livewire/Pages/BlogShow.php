<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Post;
use App\Models\Comment;
use App\Mail\NewCommentNotification;
use Illuminate\Support\Facades\Mail;

#[Layout('components.layouts.app')]
class BlogShow extends Component
{
    public Post $post;

    // Comment form
    public string $author_name = '';
    public string $author_email = '';
    public string $comment_body = '';

    public function mount(Post $post): void
    {
        // Only show published posts publicly
        if ($post->status !== 'published' || !$post->published_at || $post->published_at->isFuture()) {
            abort(404);
        }
        $this->post = $post->load(['category', 'author', 'tags', 'approvedComments.replies']);
    }

    public function submitComment(): void
    {
        $this->validate([
            'author_name'  => 'required|string|max:100',
            'author_email' => 'required|email|max:150',
            'comment_body' => 'required|string|min:3|max:2000',
        ], [], [
            'author_name'  => 'name',
            'author_email' => 'email',
            'comment_body' => 'comment',
        ]);

        $comment = Comment::create([
            'post_id'      => $this->post->id,
            'author_name'  => $this->author_name,
            'author_email' => $this->author_email,
            'body'         => $this->comment_body,
            'status'       => 'pending',
            'ip_address'   => request()->ip(),
        ]);

        // Queue admin notification email
        try {
            Mail::to(config('mail.admin_notify'))->queue(new NewCommentNotification($comment));
        } catch (\Throwable $e) {
            // fail silently — comment is still saved
        }

        $this->reset(['author_name', 'author_email', 'comment_body']);

        // auto-dismissing flash message
        $this->dispatch('comment-submitted');
    }

    public function render()
    {
        return view('livewire.pages.blog-show', [
            'next' => $this->post->nextPost(),
            'previous' => $this->post->previousPost(),
            'comments' => $this->post->approvedComments()->with('replies')->get(),
        ]);
    }
}