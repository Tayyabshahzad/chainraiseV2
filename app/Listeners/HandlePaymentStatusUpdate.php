<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\PaymentStatusUpdated;
use Illuminate\Support\Facades\Log;

class HandlePaymentStatusUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PaymentStatusUpdated $event)
    {
        $newStatus = $event->newStatus;
        \Log::info("Payment status updated to: $newStatus");
        // Handle the payment status update (e.g., log, send notifications, etc.)
    }
}
