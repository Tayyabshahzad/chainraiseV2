<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\PaymentStatusUpdated;
use App\Models\MyEDocument;
use App\Models\User;

class WebhookController extends Controller
{
    public function handle(Request $request, Pusher $pusher)
    {
         // ویب ہک ڈیٹا کو پروسیس کریں
        $data = $request->all();
        $status = "";
        $email = "";
        $findUser = User::where('email',$email)->first();
        if($findUser){

        } 

        
        // وصول شدہ ڈیٹا کو لاگ کریں
        Log::info('ویب ہک ڈیٹا:', $data);

        // پشر چینل میں ایونٹ براڈکاسٹ کریں
        $pusher->trigger('webhook-channel', 'webhook-event', $data);
        return response()->json(['message' => 'ویب ہک وصول کیا گیا اور پروسیس ہوا']);
    // ایک جواب واپس کریں

    }

    public function esignatures(Request $request)
    {
        
        try {
            // Get the raw content of the request
            $rawContent = $request->getContent(); 
            // Find the position where the JSON data starts
            $jsonStartPos = strrpos($rawContent, '{'); 
            // Extract the JSON data
            $jsonData = substr($rawContent, $jsonStartPos);

            // Parse the JSON data
            $data = json_decode($jsonData, true);

            // Log the parsed JSON data
            Log::info('Webhook JSON Data:', $data);

            // Extract relevant information
            if (isset($data['status'])) {
                $status = $data['status'];
            } else {
                Log::error("'status' key is missing in JSON data");
                // Handle the error gracefully
            }

            if (isset($data['data']['contract']['id'])) {
                $contractId = $data['data']['contract']['id'];
            } else {
                Log::error("'contract' or 'id' key is missing in JSON data");
                // Handle the error gracefully
            }

            // ... Process other relevant data ...

            // Return a response
           // return response()->json(['message' => 'Webhook received successfully']);
        } catch (\Exception $e) {
            Log::error('Error processing webhook:', ['message' => $e->getMessage()]);
           // return response()->json(['message' => 'Error processing webhook'], 500);
        }
    }
     
 


    
}
