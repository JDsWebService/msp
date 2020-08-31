<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $replyToEmail;
    public $fromEmail;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $type = null)
    {
        $this->data = $data;

        switch($type) {
            case 'admin':
                $this->replyToEmail = $this->data->email;
                $this->fromEmail = $this->data->email;
                $this->subject = 'Contact Request From: ' . $this->data->name;
                break;
            default:
                $this->replyToEmail = 'info@maineskypixels.com';
                $this->fromEmail = 'info@maineskypixels.com';
                $this->subject = 'Maine Sky Pixels Got Your Request';
                break;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quoterequest')
                    ->replyTo($this->replyToEmail)
                    ->from($this->fromEmail)
                    ->subject($this->subject)
                    ->with('data', $this->data);
    }
}
