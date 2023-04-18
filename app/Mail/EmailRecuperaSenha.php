<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailRecuperaSenha extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_content, $email_subject, $email_to, $email_from, $username, $codigo_validacao, $logoplatform, $nameplatform) {
        $this->email_content = $email_content;
        $this->email_subject = $email_subject;
        $this->email_to = $email_to;
        $this->email_from = $email_from;
        $this->username = $username;
        $this->codigo_validacao = $codigo_validacao;
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
            ['content' => $this->email_content, 'emailto' => $this->email_to, 'username' => $this->username, 'codigo_validacao' => $this->codigo_validacao,
                'logoplatform' => $this->logoplatform, 'nameplatform' => $this->nameplatform])
            ->subject($this->email_subject);
    }
}
