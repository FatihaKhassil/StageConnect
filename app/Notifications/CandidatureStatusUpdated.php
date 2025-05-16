<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CandidatureStatusUpdated extends Notification
{
    use Queueable;

    protected $candidature;

    public function __construct($candidature)
    {
        $this->candidature = $candidature;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Mise à jour de votre candidature')
                    ->line('Le statut de votre candidature pour l\'offre "'.$this->candidature->offre->sujet.'" a été mis à jour.')
                    ->action('Voir le détail', url('/mes-candidatures'))
                    ->line('Merci pour votre confiance !');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Votre candidature pour "'.$this->candidature->offre->sujet.'" a été '.$this->getStatutText(),
            'url' => '/mes-candidatures',
        ];
    }

    protected function getStatutText()
    {
        return $this->candidature->statut === 'acceptee' ? 'acceptée' : 'rejetée';
    }
}