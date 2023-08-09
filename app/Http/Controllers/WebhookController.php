<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\PaymentStatusUpdated;
class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        
        Log::info('API Response:', ['response' => $request->all()]);

    }
}
