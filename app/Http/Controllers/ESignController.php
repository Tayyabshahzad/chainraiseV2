<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ESignController extends Controller
{
    public function previewDocument(Request $request){
        $request->validate([
            'user_id' => 'required', 
            'template_id'=>'required'
        ]);
        $token = env('ESIGN_TOKEN');
        $user = User::find($request->user_id);
        $url = "https://esignatures.io/api/contracts?token=".$token; 
        try{    

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                "template_id" => $request->template_id,
                "signers" => [
                    [
                        "name" => $user->name,
                        "email" => $user->email,
                        "signature_request_delivery_method" => "embedded"
                    ],
                ]
            ]); 
            $json_template = json_decode((string) $response->getBody(), true); 
       
            if($response->successful()){
                return response([
                    'status'=>true,
                    'url'=>$json_template['data']['contract']['signers'][0]['sign_page_url']
                ]);
            }

        }catch(Exception $error){
            if($response->successful()){
                return response([
                    'status'=>false,
                    'url'=>null,
                    'message'=>$error. " There is some error while getting data"
                ]);
            }
        }
          
        
    }
}
