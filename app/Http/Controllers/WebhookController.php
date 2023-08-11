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
       

        $rawContent = $request->getContent();

    // Find the position where the JSON data starts
    $jsonStartPos = strrpos($rawContent, '{');

    // Extract the JSON data
    $jsonData = substr($rawContent, $jsonStartPos);

    // Parse the JSON data
    $data = json_decode($jsonData, true);


    $status = $data['status'];
    $contractId = $data['data']['contract']['id'];

    // Log the parsed JSON data
    Log::info('Webhook JSON Data:', $data);

    Log::info('Webhook status:', $status);
    Log::info('Webhook contractId:', $contractId);

    // Now you can access the data as an array
   


     //   $data = json_decode($request->getContent(), true);

        // // Extract the relevant information
        // $status = $data['status'];
        // $userName = $data['data']['signer']['name'];
        // $email = $data['data']['signer']['email'];
         // Log::info('Data: ' . $request);
        // // Log the extracted information
        // Log::info('Status: ' . $status);
        // Log::info('User Name: ' . $userName);
        // Log::info('Email: ' . $email);
        // $findUser = User::where('email',$email)->first();
        // if($findUser){
        //     $document = MyEDocument::where('investor_id',$findUser->id)->first();
        // } 
     

    }


    
}
