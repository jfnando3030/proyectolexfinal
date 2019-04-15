<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class NotifyLawyers extends Notification
{
    use Queueable;
    public $nombreDepartamento;
    public $idSolicitud;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nd, $ids)
    {
        //
        $this->nombreDepartamento = $nd;
        $this->idSolicitud = $ids;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Nueva solicitud de atención al cliente')
        ->line("Una nueva solicitud de atención al cliente ha sido enviada al departamento de {$this->nombreDepartamento}, por favor revise su bandeja para obtener más información")
        ->action('Ver Caso', url("/administracion/gestionar/casos/{Crypt::encrypt($this->idSolicitud) }"))
        ->line('');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
