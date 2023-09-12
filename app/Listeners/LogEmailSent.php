<?php

namespace App\Listeners;

use App\Events\EmailSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class LogEmailSent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info('EmailSent event constructor called', compact('to', 'subject', 'body'));

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EmailSent  $event
     * @return void
     */
    public function handle(EmailSent $event)
    {

        Log::info('EmailSent event fired', [
            'to' => $event->to,
            'subject' => $event->subject,
            'body' => $event->body,
        ]);


        DB::table('email_logs')->insert([
            'to' => $event->to,
            'subject' => $event->subject,
            'body' => $event->body,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
