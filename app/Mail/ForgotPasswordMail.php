<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_content, $email_subject, $email_to, $email_from, $username, $email_url, $email_token, $logoplatform, $nameplatform) {
        $this->email_content = $email_content;
        $this->email_subject = $email_subject;
        $this->email_to = $email_to;
        $this->email_from = $email_from;
        $this->username = $username;
        $this->email_url = $email_url;
        $this->email_token = $email_token;
        $this->logoplatform = $logoplatform;
        $this->nameplatform = $nameplatform;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from($this->email_from, config('app.name'))->view('emails.forgot_email',
            ['content' => $this->email_content, 'emailto' => $this->email_to, 'username' => $this->username, 'email_url' => $this->email_url, 'token' => $this->email_token,
                'logoplatform' => $this->logoplatform, 'nameplatform' => $this->nameplatform])
            ->subject($this->email_subject);
    }
}
