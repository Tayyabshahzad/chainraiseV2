<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB; // Import DB facade for database access

class SendInvite extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $from_address;
    public $subject;

    public function __construct($content, $from_address, $subject)
    {
        $this->content = $content;
        $this->from_address = $from_address;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->from($this->from_address)
            ->subject($this->subject)
            ->view('email.invite')
            ->with([
                'content' => $this->content,
            ])
            ->withSwiftMessage(function ($message) {
                $message->transport('database'); // Set the transport to 'database'
            });
    }
}
