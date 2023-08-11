<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\SendInvite;
use App\Models\Document;
use App\Models\Folder;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Exports\UsersExport;
use App\Models\MyEDocument;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



class UpdateBasicDetailController extends Controller
{
    public function updateDocument(Request $request)
    {
       
        
        $request->validate([
            //'document' => 'required',
            'name' => 'required',
            'offer' => 'required',
            'sort' => 'required',
            'user_ids' => 'required',
        ]);
        $users = explode(',', $request->user_ids);
        $user_count = count($users);
        if($request->has('document')) {
            $fileName = time().'.'.$request->document->extension();   
            $request->document->move(public_path('uploads'), $fileName);
        }
        $path = "https://beta.chainraise.info/manage/uploads/".$fileName; 
        try{
            DB::beginTransaction();
            foreach($users as $user){
                $user = User::find($user);
                $folder = new Folder;
                $folder->name =  $request->name;
                $folder->offer_id =  $request->offer;
                $folder->sort =  $request->sort;
                $folder->user_id =  $user->id;
                $folder->save();
                if($request->hasFile('document')) {
                    $document = new Document;
                    $document->name =  $request->name;
                    $document->user_id =  $user->id;
                    $document->folder_id =  $folder->id;
                    $document->offer_id =  $request->offer;
                    $document->description =  $request->description; 
                    $document->save();
                    $document->addMediaFromUrl($path)->toMediaCollection('documents');
                }
            }
            DB::commit();
            return response([
                'status'=>true,
                'message'=>'Folder has been created'
            ]);
        }catch(Exception $error){
            DB::rollBack();
            return response([
                'status'=>false,
                'message'=>'Error while Uploading documents'
            ]);
        }
    }

    
    public function eDocument(Request $request)
    {
        
        
        $request->validate([  
            'user_ids' => 'required',
            'template'=>'required',
            'offer' => 'required',
            'issuer' => 'required',     
        ]);
      
        $issuer = User::find($request->issuer);
        $users = explode(',', $request->user_ids);
        $user_count = count($users);
        $token = env('ESIGN_TOKEN');
        $e_signature_url = "https://esignatures.io/api/contracts?token=".$token; 
        try{
            
            foreach($users as $user){ 
                $user = User::find($user);   
                if($user){   
                    dump($user);
                    $send_template = Http::withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post($e_signature_url, [
                        "template_id" => $request->template,
                        "title" => "Loan Agreement - Saver package",
                        "metadata" => "ID0001",
                        "locale" => "en",
                        "test" => "no",
                        "custom_webhook_url" => "https://google.com",
                        "signers" => [
                            [
                                "name" => $user->name,
                                "email" => $user->email,
                                "mobile" => $user->phone,
                                "company_name" => "Investor Company",
                                "signing_order" => "1",
                                "auto_sign" => "no",
                                "signature_request_delivery_method" => "email",
                                "signed_document_delivery_method" => "email",
                                "required_identification_methods" => [
                                    "email" 
                                ],
                                "redirect_url" => "https://google.com",
                                "embedded_redirect_iframe_only" => "no"
                            ],
                            [
                                "name" => $issuer->name,
                                "email" => $issuer->email,
                                "mobile" => $issuer->phone,
                                "company_name" => "Issuer Company",
                                "signing_order" => "1",
                                "auto_sign" => "no",
                                "signature_request_delivery_method" => "email",
                                "signed_document_delivery_method" => "email",
                                "required_identification_methods" => [
                                    "email"
                                ],
                                "redirect_url" => "https://google.com",
                                "embedded_redirect_iframe_only" => "no"
                            ]
                        ],
                        "placeholder_fields" => [
                            [
                                "api_key" => "interest_rate",
                                "value" => "3.2%"
                            ],
                            [
                                "api_key" => "floor-plan",
                                "document_elements" => [
                                    [
                                        "type" => "image",
                                        "image_base64" => "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P4v5ThPwAG7wKklwQ/bwAAAABJRU5ErkJggg=="
                                    ]
                                ]
                            ]
                        ],
                        "signer_fields" => [
                            [
                                "signer_field_id" => "preferred_term",
                                "default_value" => "15 years"
                            ]
                        ],
                        "emails" => [
                            "signature_request_subject" => "Your document is ready to sign",
                            "signature_request_text" => "Hi __FULL_NAME__, \n\n To review and sign the contract please press the button below \n\n Kind Regards",
                            "final_contract_subject" => "Your document is signed",
                            "final_contract_text" => "Hi __FULL_NAME__, \n\n Your document is signed.\n\nKind Regards",
                            "cc_email_addresses" => [
                                "tom@email.com",
                                "francis@email.com"
                            ],
                            "reply_to" => "support@investchainraise.io"
                        ],
                        "custom_branding" => [
                            "company_name" => "WhiteLabel LLC",
                            "logo_url" => "https://online-logo-store.com/yourclient-logo.png"
                        ]
                    ]);
                    $json_template = json_decode((string) $send_template->getBody(), true); 
                    dd($json_template); 
                    //  
                    if($send_template->successful()){ 
                        $e_document = new MyEDocument;
                        $e_document->investor_id = $user->id;
                        $e_document->offer_id = $request->offer;
                        $e_document->issuer_id = $request->issuer;
                        $e_document->template_name = $request->selectedOptionHtml;
                        $e_document->template_id = $request->template;
                        $e_document->status = 'pending';
                        $e_document->contract_id = $json_template['data']['contract']['id']; 
                        $e_document->save();    
                    }else{
                        return response([
                            'status'=>false,
                            'message'=>$json_template,
                        ]);
                    } 
                }else{
                    return response([
                        'status'=>false,
                        'message'=>'Error while sending request'
                    ]);
                }
            }
            
            return response([
                'status'=>true,
                'message'=>'E-Sign Request has been sent'
            ]);
        }catch(Exception $error){
            
            return response([
                'status'=>false,
                'message'=>'Error while sending request'
            ]);
        }
       
        

    }

    public function inviteEmail(Request $request){
      
        $request->validate([
            //'document' => 'required',
            'subject' => 'required',
            'from_name' => 'required',
            'from_email' => 'required',
            'content' => 'required',
            'user_ids' => 'required',
        ]);
        $users = explode(',', $request->user_ids);
        $user_count = count($users);
        foreach($users as $user){
            $user = User::find($user);
            Mail::to($user)->send(new SendInvite($request->content,$request->from_email,$request->from_email));
        }
        return response([
            'status'=>true,
            'message'=>'Invitation Emails Has Been Sent'
        ]);
       
    }

    public function export() 
    {
          
       return Excel::download(new UsersExport, 'users.xlsx');
        
    }
}
