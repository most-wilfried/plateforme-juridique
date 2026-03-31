<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LawyerApprovedNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre compte avocat a été validé')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre compte avocat a été validé par l’administrateur.')
            ->line('Vous pouvez maintenant accéder à votre espace avocat et recevoir des demandes de clients.')
            ->action('Accéder à mon espace', url('/dashboard'))
            ->line('Merci d’utiliser notre plateforme.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Votre compte avocat a été validé par l’administrateur.',
        ];
    }
}
