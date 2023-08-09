<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PaymentStatusUpdated;
class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        dd($request->all());
    }
}
