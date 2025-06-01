<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ArticleAddedMail extends Mailable
{
    use Queueable, SerializesModels;
 public $article;
    /**
     * Create a new message instance.
     */
    public function __construct($article)
    {
          $this->article = $article;
    }

    public function attachments(): array
    {
        return [];
    }
    public function build()
    {
        return $this->subject('Nouvel article ajouté')
                    ->view('emails.article_added');
    }
}
