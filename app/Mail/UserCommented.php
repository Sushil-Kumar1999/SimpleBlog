<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Comment;

class UserCommented extends Mailable
{
    use Queueable, SerializesModels;

    private $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment  = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-commented')
                    ->with([
                        'user_name' => $this->comment->profile->user->name,
                        'body' => $this->comment->body,
                        'comment' => $this->comment,
                        'post_title' => $this->comment->post->title,
                        'view_post_url' => route('comments.page', $this->comment->post)
                    ]);
    }
}
