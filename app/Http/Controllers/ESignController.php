<?php

namespace App\Http\Controllers;

use App\Models\MyEDocument;
use App\Models\OfferEsignTemplate;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                // OfferEsignTemplate
                $doc = OfferEsignTemplate::where('template_id',$request->template_id)->first();
                dd($doc);
                $doc->status = 'open';
                $doc->save();
                return response([
                    'status'=>true,
                    'url'=>$json_template['data']['contract']['signers'][0]['sign_page_url']
                ]);
            }

        }catch(Exception $error){
            return response([
                'status'=>false,
                'url'=>null,
                'message'=>$error. " There is some error while getting data"
            ]);
        }


    }

    public function previewDocumentInvesterFlow($user_id,$template_id){


        $token = env('ESIGN_TOKEN');
        $e_sign = Http::get('https://esignatures.io/api/templates/' . $template_id . '?token='.$token);
        $json_e_sign = json_decode((string) $e_sign->getBody(), true);

        return response([
            'status' => true,
            'data' => $json_e_sign
        ]);

        $token = env('ESIGN_TOKEN');
        $user = User::find($request->user_id);

        //https://esignatures.io/api/contracts/1contr11-2222?token=your-secret-token
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

    public function check_esing_status(Request $request){
        $user = Auth::user();
        $doc = MyEDocument::where('offer_id',$request->offer_id)->where('investor_id',$user->id)->first();
        if($doc->status == 'queued'){
            return response([
                'status'=>false,
            ]);
        }else{
            return response([
                'status'=>true,
            ]);
        }
    }
}
