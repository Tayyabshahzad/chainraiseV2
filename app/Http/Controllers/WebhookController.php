<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\PaymentStatusUpdated;
class WebhookController extends Controller
{
    public function handle(Request $request, Pusher $pusher)
    {
         // ویب ہک ڈیٹا کو پروسیس کریں
        $data = $request->all();

        // وصول شدہ ڈیٹا کو لاگ کریں
        Log::info('ویب ہک ڈیٹا:', $data);

        // پشر چینل میں ایونٹ براڈکاسٹ کریں
        $pusher->trigger('webhook-channel', 'webhook-event', $data);
        return response()->json(['message' => 'ویب ہک وصول کیا گیا اور پروسیس ہوا']);
    // ایک جواب واپس کریں

    }

    public function esignatures(Request $request)
    {
         // ویب ہک ڈیٹا کو پروسیس کریں
        $data = $request->all(); 
        Log::info('ویب ہک ڈیٹا:', $data);

     

    }


    
}
