<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentPost extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $post,
        public $commentUser,
        public $comment,
    )
    {
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
           ->subject('New Comment on Your Post')
            ->greeting('Hello ' . $notifiable->name)
            ->line($this->commentUser->name . ' commented on your post.')
            ->line('Comment:')
            ->line('"' . $this->comment->content . '"')
            ->action('View Post', route('student.post.show', $this->post->id))
            ->line('You can reply directly from your dashboard.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
        public function toDatabase($notifiable)
    {
        return [
            'type' => 'student_post_comment',
            'post_id' => $this->post->id,
            'comment_id' => $this->comment->id,
            'user_name' => $this->commentUser->name,
            'message' => $this->commentUser->name . ' commented on your post',
            'url' => route('student.post.show', $this->post->id),
        ];
    }

}
