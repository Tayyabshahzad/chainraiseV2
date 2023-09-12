<?php

namespace App\Mail;

use Illuminate\Mail\Transport\Transport;
use Illuminate\Support\Facades\DB;

class DatabaseMailTransport extends Transport
{
    public function send($message)
    {
        // Extract email data
        $to = implode(', ', array_keys($message->getTo()));
        $subject = $message->getSubject();
        $body = $message->getBody();

        // Save email data to the database
        DB::table('email_logs')->insert([
            'to' => $to,
            'subject' => $subject,
            'body' => $body,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
