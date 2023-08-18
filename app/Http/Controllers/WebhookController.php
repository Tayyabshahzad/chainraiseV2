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
        $rawContent = $request->getContent(); 
        Log::info('Fotrest Data:',  $rawContent);
    }

    public function esignatures(Request $request)
    {
        

        try {
            // Get the raw content of the request
            $rawContent = $request->getContent(); 
            // Parse the JSON data
            $data = json_decode($rawContent, true); 
            // Extract and log the common "status" field
            $status = isset($data['status']) ? $data['status'] : 'Unknown Status';
            Log::info('Webhook Status:', ['status' => $status]);
    
            // Extract and log the "email" field based on the response type
            if ($status === 'signer-viewed-the-contract' || $status === 'signer-signed') {
                $email = $data['data']['signer']['email'] ?? 'Unknown Email';
                Log::info('Signer Email:', ['email' => $email]);
            } elseif ($status === 'contract-signed') {
                $signerEmail = $data['data']['contract']['signers'][0]['email'] ?? 'Unknown Signer Email';
                Log::info('Contract Signed by Signer Email:', ['email' => $signerEmail]);
            }
            
            //$user = User::where('email',$email)->first();
           // $document = MyEDocument::where('investor_id',$user->id)->first();



            // ... Process the JSON data ...
    
            // Return a response
             
        } catch (\Exception $e) {
            Log::error('Error processing webhook:', ['message' => $e->getMessage()]);
           // return response()->json(['message' => 'Error processing webhook'], 500);
        }
    }

    public function importUsers(){
        dd(1);
    }
    


    
}
