<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
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
        ->subject('Solicitud para recuperar contraseña de Bango Energy Gel')
        ->greeting('Hola!,')
        ->line('Tú estas recibiendo este email porque nosotros recibimos una solicitud de cambio de contraseña desde tu cuenta de Bango Energy Gel.')
        ->action('Cambiar Contraseña', url('password/reset', $this->token))
        ->line('Si tú no realizaste esta petición, por favor ignora este mensaje.')
        ->line('Si tienes alguna pregunta o inquietud escríbenos a: info@bangonerergygel.com')
        ->salutation('¡Saludos!, '. 'El equipo de Bango Energy Gel')
        ->line('ESTA ES UNA COMUNICACIÓN AUTOMÁTICA, POR FAVOR NO RESPONDER.');
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
