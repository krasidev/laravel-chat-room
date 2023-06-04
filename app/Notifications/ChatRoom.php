<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ChatRoom extends Notification
{
    use Queueable;

    private $author;
    private $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $author, string $message)
    {
        $this->author = $author;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'author' => $this->author->only(['id', 'name', 'email']),
            'message' => $this->message
        ];
    }
}
