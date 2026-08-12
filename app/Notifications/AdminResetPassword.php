<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = url('/admin/change-password') . '?' . http_build_query([
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return (new MailMessage)
            ->subject('Admin Password Reset')
            ->line('A password reset has been requested for your admin account.')
            ->action('Reset Password', $url)
            ->line('If you did not request this password reset, you can safely ignore this email.');
    }
}