<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DenunciaTratadaMail extends Mailable
{
    use Queueable, SerializesModels;


    public $mensagem;
    /**
     * Create a new message instance.
     */
    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function build()
    {
        return $this->subject('Atualização sobre sua denúncia')
                    ->view('emails.denuncia-tratada')
                    ->with(['mensagem' => $this->mensagem]);
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Denuncia Tratada Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
