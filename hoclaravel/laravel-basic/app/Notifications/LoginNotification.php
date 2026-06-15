<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $client)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Cảnh báo đăng nhập')
            ->greeting('Xin chào: '.$notifiable->name)
            ->line('Bạn đã đăng nhập vào hệ thống vào lúc: '. date('d/m/Y H:i:s'))
            ->line('Nếu không phải là bạn, hãy đổi mật khẩu ngay')
            ->action('Đổi mật khẩu', url('/reset-password'))
            ->action('Đổi mật khẩu 2', url('/change-password'))
            ->line('User Agent: '.$this->client->userAgent)
            ->line('Cảm ơn!');
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
}
