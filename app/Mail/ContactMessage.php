<?php

namespace Raffles\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The request data.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array $data The request data.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'])
            ->markdown('emails.contact-message')
            ->with('data', $this->data);
    }
}
