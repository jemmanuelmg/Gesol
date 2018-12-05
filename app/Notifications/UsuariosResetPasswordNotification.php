<?php

namespace app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SellerResetPasswordNotification extends Notification
{
    use Queueable;

    //Token handler
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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
        ->line('Estas recibiendo este email porque se nos ha solicitado un reestablecimiento de contraseña a casua de olvido.')
        ->action('Cambiar contrasena', url('seller_password/reset', $this->token))
        ->line('Si no solicitaste un cambio de contraseña, simplemente ignora este mensaje');
    }

}
