<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCommentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Comment $comment) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New comment awaiting approval — ' . $this->comment->post->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-comment',
            with: [
                'comment' => $this->comment,
                'post' => $this->comment->post,
                'moderateUrl' => route('admin.comments.index'),
            ],
        );
    }
}