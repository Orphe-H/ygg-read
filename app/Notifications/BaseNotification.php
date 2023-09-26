<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BaseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly array $channels, private readonly array $data, private readonly mixed $action = null)
    {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage =  (new MailMessage)
            ->subject($this->data['subject'])
            ->greeting($this->data['greeting'] ?? "Hi.");

        if (is_array($this->data['message'])) {
            foreach ($this->data['message'] as $line) {
                $mailMessage->line($line);
            }
        } elseif (is_string($this->data['message'])) {
            $mailMessage->line($this->data['message']);
        }

        if ($this->action) {
            $mailMessage->action($this->action['text'], $this->action['url']);
        }

        return $mailMessage->salutation(__("Merci d'utiliser notre application."));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->data;
    }
}
