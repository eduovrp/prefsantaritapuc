<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * @var array $user
     */
    protected $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
                    ->greeting('Olá, tudo bem?')
                    ->line('Recebemos sua solicitação para alteração de senha no nosso sistema, é só clicar no botão abaixo e seguir o passo a passo.')
                    ->action('Definir nova Senha', url('/login/reset-password/'.$this->user['remember_token']))
                    ->line('Caso você não tenha solicitado a redefinição, ignore este email e verifique as configurações de sua conta.')
                    ->salutation('Se precisar de ajuda, é só chamar a gente respondendo esse e-mail!')
                    ->replyTo('tecnologia@santaritadoeste.sp.gov.br');
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
