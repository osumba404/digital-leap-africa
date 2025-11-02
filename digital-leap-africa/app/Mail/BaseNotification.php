<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title;
    public $message;
    public $actionUrl;
    public $actionText;

    public function __construct(User $user, $title, $message, $actionUrl = null, $actionText = 'View Details')
    {
        $this->user = $user;
        $this->title = $title;
        $this->message = $message;
        $this->actionUrl = $actionUrl;
        $this->actionText = $actionText;
    }

    public function build()
    {
        return $this->subject($this->title)
                    ->view('emails.base-notification');
    }
}