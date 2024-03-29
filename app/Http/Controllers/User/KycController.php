<?php

namespace App\Http\Controllers\User;

use Exception;
use Carbon\Carbon;
use App\Models\KYC;
use App\Models\User;
use App\Mail\UPDATEKYC;
use App\Models\Custodial;
use App\Mail\UploadDocument;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt; 
use Illuminate\Support\Facades\Storage;


class KycController extends Controller
{
    private $baseUrl;
    private $authUrl;
    public function __construct()
    { 
        $environment = config('app.env'); 
        $this->baseUrl = config('credentials.api.' . $environment); 
        $this->authUrl = config('credentials.auth0.' . $environment); 
    } 
    public function updateKycCheck($id){ 
        //dd($this->baseUrl . 'your-endpoint');
        $user = User::find($id);  
        if($user->check_kyc == true){
            $kyc = false;
        }elseif($user->check_kyc == false){
            $kyc = true;
        } 
        $user->check_kyc = $kyc;
        $user->save();
        if($user->check_kyc == true){
            $data = 'Enabled';
        }else{
            $data = 'Disabled';
        }
        return response([
            'data'=>$data,
            'status'=>true
        ]);
    }
    public function checkKyc(Request $request)
    {
      
        $production_auth = 'https://fortress-prod.us.auth0.com/oauth/token'; 
        $fortress_base_url = 'https://api.fortressapi.com/api/trust/v1/'; 
        $request->validate([
            'id' => 'required',
        ]);  
       
        $errors = []; 
        $user = User::with('userDetail')->find($request->id); 
        if($user->profile_status == 0 || $user->identityVerification->primary_contact_social_security == null){
            $errors[] = 'Please complete user profile first';
            return response([
                'status' => 'document',
                'success' => false,
                'errors' => $errors,
            ]);
        } 
        $decodedSsn = Crypt::decryptString($user->identityVerification->primary_contact_social_security);         
        if (!$user->getFirstMediaUrl('kyc_document_collection')) {
            $errors[] = 'Please Upload Document First';
            return response([
                'status' => 'document',
                'success' => false,
                'errors' => $errors,
            ]);
        }
        if ($user->user_type == null) {
            $errors[] = 'Please Update Settings Selected User Type is not Defined';
            return response([
                'status' => 'document',
                'success' => false,
                'errors' => $errors,
            ]);
        }
        // Token Request
      
        try {
            $get_token = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->authUrl['url'], [
                'grant_type' => $this->authUrl['grant_type'],
                'username'   => $this->authUrl['username'],
                'password'   => $this->authUrl['password'],
                'audience'   => $this->authUrl['audience'],
                'client_id'  => $this->authUrl['client_id'],
            ]);
            $token_json =  json_decode((string) $get_token->getBody(), true);  
            if ($get_token->failed()) {
                $errors[] = 'Error While Creating Token';
                return response([
                    'status' => $get_token->status(),
                    'errors' => $errors[] = 'Error',
                ]);
            }
        }catch(Exception $token_error){
                $errors[] = 'Error While Creating Token';
                $errors[] = $token_error; 
                return response([
                    'success'  => false,
                    'errors' => $errors,
                ]);
        }  
        $date_of_birth = $user->userDetail->dob; 
      
        if($user->user_type  == 'individual'){  
                
            if($user->fortress_id == null){    
                try{ 
                    $identity_containers = Http::withToken($token_json['access_token'])->withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post($this->baseUrl.'/api/trust/v1/identity-containers', [
                        'firstName' => $user->name,
                        'middleName' => $user->userDetail->middle_name,
                        'lastName' => $user->userDetail->last_name,
                        'phone' =>  $user->cc.$user->phone,
                        'email' => $user->email,
                        'ssn' => $decodedSsn,
                        'upgradeKYC' => false,
                        "dateOfBirth" => $date_of_birth,
                        'address' => [
                            'street1' => $user->userDetail->address, 
                            'postalCode' => $user->userDetail->zip,
                            'city' => $user->userDetail->city,
                            'state' => $user->userDetail->state,
                            'country' => $user->identityVerification->nationality,
                        ] 
                    ]);
                    $json_identity_containers =  json_decode((string) $identity_containers->getBody(), true);     
                    if ($identity_containers->failed()) { 
                        $status = $identity_containers->status(); 
                        if($status == 409){
                            $errors[] = $identity_containers['title'];   
                        }
                        if($status == 400){  
                            $errors = $json_identity_containers['errors'];
                            return response([
                                'status' => $identity_containers->status(),
                                'success'  => false,
                                'errors' => $errors,
                                'step'=>'individual step 1',
                            ]);
                        } 
                        return response([
                            'status' => $identity_containers->status(),
                            'success'  => false,
                            'errors' => $errors,
                        ]);
                    
                    }else{
                        if ($identity_containers->successful()) { 
                            $errors = 'Personal Identities Has Been Created'; 
                            $user->fortress_id =  $json_identity_containers['id'];
                            $user->fortress_personal_identity =  $json_identity_containers['personalIdentity'];
                            $user->save();
                            
                        }
                    }   
                }catch(Exception $identity_containers_error){  
                    $errors[] = 'Error While Creating Identity Containers';
                    $errors[] = $identity_containers_error;
                    return response([ 
                        'errors' => $errors,
                        'success'  => false,
                        'step'=>'individual step 1 Exception',
                    ]);
                } 
            }
             
        }elseif($user->user_type  == 'entity'){   
            //dump('entity calling');
            // creating container for business 
            if($user->identity_container_id == null){   
                //dump('identity_container_id is null');
                 try{  
                    $identity_containers = Http::withToken($token_json['access_token'])->withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post($this->baseUrl.'/api/compliance/v1/identity-containers', [
                        'firstName' => $user->name,
                        'middleName' => $user->userDetail->middle_name,
                        'lastName' => $user->userDetail->last_name,
                        'phone' =>  $user->cc.$user->phone,
                        'email' => $user->email,
                        'ssn' => $decodedSsn,
                        "upgradeKYC" => false,
                        "dateOfBirth" => $date_of_birth,
                        'address' => [
                            'street1' => $user->userDetail->address, 
                            'postalCode' => $user->userDetail->zip,
                            'city' => $user->userDetail->city,
                            'state' => $user->userDetail->state,
                            'country' => $user->identityVerification->nationality,
                        ] 
                    ]);
                    $json_identity_containers =  json_decode((string) $identity_containers->getBody(), true);      
                    $status = $identity_containers->status(); 
                     
                    if($status == 400){
                        $errors[] = $json_identity_containers['title'];
                        $errors[] = $json_identity_containers['errors'];
                        return response([
                            'status' => $status, 
                            'errors' => $errors,
                            'success'  => false,
                        ]);
                    } 
                    if($status == 409){
                        $errors[] = $json_identity_containers['title'];
                        return response([
                            'status' => $status, 
                            'errors' => $errors,
                            'success'  => false,
                        ]);
                    } 
                    if($identity_containers->failed()) {
                        $errors[] = 'Error While Creating Identity Containers for issuer';
                        $errors[] = $json_identity_containers['errors']; 
                        return response([
                            'status' => $identity_containers->status(), 
                            'errors' => $errors,
                            'success'  => false,
                            'step'=>'entity step 1',
                        ]);
                    }else{
                        if ($identity_containers->successful()) {  
                            $user->identity_container_id =  $json_identity_containers['id']; 
                            $user->fortress_personal_identity =  $json_identity_containers['personalIdentity']; 
                            $user->save();
                        }
                    }
                }catch(Exception $identity_containers_error){ 
                        $errors[] = 'Error While Creating Identity Containers';
                        $errors[] = $identity_containers_error; 
                        return response([ 
                            'errors' => $errors,
                            'success'  => false,
                            'step'=>'entity step 1 exception',
                        ]);
                } 
                // Business  Indentity
            }   
            //dump('Business is calling');
            if($user->business_id == null){  
                try{ 
                    $business_identity_containers = Http::withToken($token_json['access_token'])->withHeaders([
                        'Content-Type' => 'application/json',
                    ])->post($this->baseUrl.'/api/compliance/v1/business-identities', [
                        'identityContainerId' => $user->identity_container_id,
                        'companyName' => $user->userDetail->entity_name,
                        'ein' => $user->userDetail->ein,
                        'website' =>  $user->userDetail->website,
                        'phone' => $user->cc.$user->phone,
                        'email' => $user->email,
                        'address' => [
                            'street1' => $user->userDetail->address, 
                            'postalCode' => $user->userDetail->zip,
                            'city' => $user->userDetail->city,
                            'state' => $user->userDetail->state,
                            'country' => $user->identityVerification->nationality,
                        ],
                        'beneficialOwners'=>[
                            $user->fortress_personal_identity,
                        ],
                        'regionOfFormation' => $user->userDetail->state,
                        'description' => 'Some Company description',
                        'establishedOn' => $user->userDetail->date_incorporation,
                        'legalStructure' => $user->userDetail->legal_formation,
                        'naics' => $user->userDetail->naics,
                        'naicsDescription' => $user->userDetail->naics_description,  
                    ]);
                    $json_business_identity_containers =  json_decode((string) $business_identity_containers->getBody(), true);    
                    $status = $business_identity_containers->status();
                    if ($business_identity_containers->failed()) {    
                        if($status == 400){
                            $errors[] = $json_business_identity_containers['errors'];
                            $errors[] = $json_business_identity_containers['title'];
                            return response([
                                'status' => $status,
                                'success'  => false,
                                'errors' => $errors,
                                'step'=>'entity business 1 on 400 status',
                            ]);   
                        }
                        $errors[] = $json_business_identity_containers['errors'];
                        $errors[] = $json_business_identity_containers['title'];
                        return response([
                            'status' => $status,
                            'success'  => false,
                            'errors' => $errors,
                            'step'=>'entity business 1 failed',
                        ]);
                    }  
                        

                        if(!$business_identity_containers->successful()){
                            if($status == 400){
                                $errors[] = $json_business_identity_containers['errors'];
                                $errors[] = $json_business_identity_containers['title'];
                                return response([
                                    'status' => $status,
                                    'success'  => false,
                                    'errors' => $json_business_identity_containers['errors'],
                                    'step'=>'entity business 1 not successful',
                                ]);   
                            } 
                            if($status == 409){ 
                                $errors[] = $json_business_identity_containers['errors'];
                                $errors[] = $json_business_identity_containers['title'];
                                return response([
                                    'status' => $status,
                                    'success'  => false,
                                    'errors' => $errors,
                                ]);   
                            }
                        }else{
                            $user->business_id =  $json_business_identity_containers['id']; 
                            $user->save();
                        }  

                        
                        
                }catch(Exception $business_identity_containers){ 
                    $errors[] = 'Error While Creating Identity Containers';
                    $errors[] = $business_identity_containers;
                    return response([ 
                        'errors' => $errors,
                        'success'  => false,
                        'step'=>'entity exception',
                    ]);
                }
            }   
        }  

        ///// dump('End KYC');
        if($user->user_type  == 'entity'){
            $id =  $user->business_id;
            $endPoint = $this->baseUrl.'/api/compliance/v1/business-identities/'.$id.'/documents';
        }  else{
            $id =  $user->fortress_personal_identity; 
           //base URL https://api.fortressapi.com/api/trust/v1/
            $endPoint = $this->baseUrl.'/api/trust/v1/personal-identities/'.$id.'/documents';
        } 

        if($user->user_type  == 'entity'){
            //dump('Doc Upload');
            try{  
                $mediaCollection = $user->getFirstMedia('kyc_document_collection');  
                if(env('APP_ENV') == 'sandbox'){
                    $path = "https://mgmotors.com.pk/storage/img/details_4/homepage_models-mg-zs-ev-new.jpg";
                }else{
                    $path =  $mediaCollection?->getFullUrl();
                } 
                $document_path = fopen($path, 'r');   
                $url = $endPoint;
                $upload_document = Http::attach('DocumentType', $user->identityVerification->doc_type)->
                attach('DocumentFront', $document_path)->
                attach('DocumentBack', $document_path)->
                withToken($token_json['access_token'])->
                post($url);
                $json_upload_document =  json_decode((string) $upload_document->getBody(), true);
                $status = $upload_document->status();
                if($status == 400){
                    foreach($json_upload_document['errors'] as $error) {
                        if(is_array($error)) {
                        $errors[] = 'Try to change document type';
                        $errors[] = $error[0];
                        }
                    }
                    $errors[] = 'Error While Uploading '.$user->user_type.' documents';
                    $errors[] = $json_upload_document['errors'];
                    $errors[] = $json_upload_document['title'];    
                    return response([
                        'status' => $upload_document->status(),
                        'success'  => false,
                        'errors' => $errors,
                        'step'=>'entity document upload 400 error',
                    ]);
                }
                if ($upload_document->failed()) {
                    $status = $upload_document->status();
                    if($status == 400){  
                        
                        $errors[] = $json_upload_document['errors'];
                        $errors[] = $json_upload_document['title'];  
                        $errors[] = 'Personal Identity Has Been Created But Error While Uploding Documents';
                        return response([
                            'status' => $upload_document->status(),
                            'success'  => false,
                            'errors' => $errors,
                            'step'=>'entity document  upload 400 error 2',
                        ]);
                    }    
                    return response([
                        'status' => $upload_document->status(),
                        'data'   => $json_upload_document,
                        'errors' => $errors,
                        'success'  => false,
                        'step'=>'entity document failed to upload',
                    ]); 
                }
                if($upload_document->requestTimeout()){
                    $errors[] = 'Request Time OUT';
                    return response([
                        'status' => $upload_document->status(),
                        'data'   => $json_upload_document,
                        'errors' => $errors,
                        'success'  => false,
                        'step'=>'entity document Request Time OUT',
                    ]); 
                } 
            }catch(Exception $upload_document_error){ 
                $errors[] = 'Error While uploading Documents';
                $errors[] = $upload_document_error;
                return response([ 
                    'data'   => $upload_document_error,
                    'success'  => false,
                    'errors' => $errors,
                    'step'=>'entity document exception',
                ]);
            } 
        }
        

        if($user->user_type  == 'entity'){  
            $url_check_kyc =  $this->baseUrl.'/api/trust/v1/business-identities/'.$user->business_id;
        }else{
            $url_check_kyc = $this->baseUrl.'/api/trust/v1/personal-identities/'.$user->fortress_personal_identity ;
        }
        try{ 
            $check_user_kyc_level = Http::withToken($token_json['access_token'])->
            withHeaders(['Content-Type' => 'application/json'])->
            get($url_check_kyc);
            $json_check_user_kyc_level = json_decode((string) $check_user_kyc_level->getBody(), true);  
            $status =  $check_user_kyc_level->status();  
            //dump($json_check_user_kyc_level,$status);
            //dump(count($json_check_user_kyc_level['documents']));
            if(count($json_check_user_kyc_level['documents'])>0){
                $docStatus = $json_check_user_kyc_level['documents'][0]['documentCheckStatus'];
            }else{
                $docStatus = 'Not Uploaded';
            }
            if($status == 200 ){
                KYC::updateOrCreate(
                    ['user_id' => $user->id],
                    ['kyc_level' => $json_check_user_kyc_level['kycLevel'],'doc_status'=>$docStatus]
                );
                Mail::to($user->email)->send(new UPDATEKYC($user)); 
                return response([
                    'status' => $check_user_kyc_level->status(),  
                    'success'  => true,
                    ''
                ]); 
            }else{
                return response([
                    'status' => $check_user_kyc_level->status(), 
                    'errors' => $errors,
                    'success'  => false,
                    'step'=>'entity document updating db status',
                ]); 
            }  
         

        }catch(Exception $check_kyc_error){
            
            return response([ 
                'success'  => false,
                'data'   => $check_kyc_error,
                'step'=>'entity document updating exception',
            ]);
        }
                 
        
    }



    public function re_run_kyc(Request $request)
    {
      
        try{
            $get_token = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->authUrl['url'], [
                'grant_type' => $this->authUrl['grant_type'],
                'username'   => $this->authUrl['username'],
                'password'   => $this->authUrl['password'],
                'audience'   => $this->authUrl['audience'],
                'client_id'  => $this->authUrl['client_id'],
            ]);
            $token_json =  json_decode((string) $get_token->getBody(), true); 
            if($get_token->failed()) {  
                return response([
                    'status' => $get_token->status(),
                    'data'   => $token_json,
                ]);
            }
        }catch(Exception $token_error){
         
            return response([ 
                'success' => false,
                'data'   => $token_error,
            ]);
        } 
        
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::find($request->id); 
        if($user->user_type  == 'entity'){
            if($user->business_id == null){
                return response([
                    'status' => false,
                    'message' =>'Please run KYC Check First then try again for your entity account',
                ]);
            } 
        }else{
            if($user->fortress_personal_identity == null){
                return response([
                    'status' => false,
                    'message' =>'Please run KYC Check First then try again individual account',
                ]);
            } 
        }  
        
        if($user->user_type  == 'entity'){
            $url_check_kyc = $this->baseUrl.'/api/compliance/v1/business-identities/'.$user->business_id ;
        }else{
            $url_check_kyc = $this->baseUrl.'/api/trust/v1/personal-identities/'.$user->fortress_personal_identity ;
        } 
        try {  
            $upgrade_existing_l0 = Http::withToken($token_json['access_token'])->
            withHeaders(['Content-Type' => 'application/json'])->
            get($url_check_kyc);
            $json_upgrade_existing_l0 = json_decode((string) $upgrade_existing_l0->getBody(), true);    
            if ($upgrade_existing_l0->failed()) {
                return response([
                    'status' => $upgrade_existing_l0->status(),
                    'data' => $json_upgrade_existing_l0,
                ]);
            }else{  
                if(empty($json_upgrade_existing_l0['documents'])){
                    $document_status =  "Not Uploaded";
                }else{
                    $document_status =  $json_upgrade_existing_l0['documents'][0]['documentCheckStatus'];
                }
                KYC::updateOrCreate(
                        ['user_id' => $user->id],
                        [   'kyc_level' => $json_upgrade_existing_l0['kycLevel'],
                            'doc_status'=> $document_status
                        ]
                );       
            }
            Mail::to($user->email)->send(new UPDATEKYC($user)); 
            return response([
                'status' => $upgrade_existing_l0->status(),
                'data'=> $json_upgrade_existing_l0,
            ]); 
            
        }catch(Exception $error){ 
            return response([
                'status' => false,
                'error'=>$error,
            ]);
        }

    }
    public function re_run_kyc_2(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $production_auth = 'https://fortress-prod.us.auth0.com/oauth/token'; 
        $user = User::find($request->id);
        $decodedSsn = Crypt::decryptString($user->identityVerification->primary_contact_social_security);  
        try {
            $get_token = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($production_auth, [
                'grant_type' => 'password',
                'username'   => 'Portal@chainraise.io',
                'password'   => '?dm3JeXgkgQNA?ue8sHI',
                'audience'   => 'https://fortressapi.com/api',
                'client_id'  => 'cNjCgEyfVDyBSxCixDEyYesohVwdNICH',
            ]);
            $token_json =  json_decode((string) $get_token->getBody(), true); 
            if($get_token->failed()) {
                return response([
                    'status' => $get_token->status(),
                    'data'   => $token_json,
                ]);
            }
            $update_existing_personal= Http::withToken($token_json['access_token'])->withHeaders([
                'Content-Type' => 'application/json',
            ])->patch('https://api.fortressapi.com/api/trust/v1/personal-identities/'.$user->fortress_personal_identity, [
                'firstName' => $user->name,
                'middleName' => $user->userDetail->middle_name,
                'lastName' => $user->userDetail->last_name,
                'phone' =>  $user->phone,
                'email' => $user->email,
                'dateOfBirth' => "1990-09-02",
                'ssn' => $decodedSsn,
                'address.street1' => $user->userDetail->address,
                'address.street2' => '-',
                'address.postalCode' => $user->userDetail->zip,
                'address.city' => $user->userDetail->city,
                'address.state' => $user->userDetail->state,
                'address.country' => $user->identityVerification->nationality,
                'upgradeKYC'=>true,
            ]); 

        }catch(Exception $error){
            return response([
                'status' => false,
            ]);
        }
    }

    public function kycDocumentUpoad(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
       
        $user = User::find($request->id);
        $mediaCollection = $user->getFirstMedia('kyc_document_collection');  
        if($mediaCollection == null){
            return response([
                'status' => false,
                'message' =>'Please Upload Documents First',
            ]);
        }
        if($user->user_type  == 'entity'){ 
            if($user->identity_container_id == null || $user->business_id == null){
                return response([
                    'status' => false,
                    'message' =>'Please run KYC Process First for your entity/busines account',
                ]);
            } 
            $id =  $user->business_id; 
            $endPoint = $this->baseUrl.'/api/compliance/v1/business-identities/'.$id.'/documents';
        }else{
            if($user->fortress_id == null || $user->fortress_personal_identity == null){
                return response([
                    'status' => false,
                    'message' =>'Please run KYC Process First for your personal/individual account',
                ]);
            }
            $id =  $user->fortress_personal_identity; 
            $endPoint = $this->baseUrl.'/api/trust/v1/personal-identities/'.$id.'/documents';
        }  
        $get_token = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->authUrl['url'], [
            'grant_type' => $this->authUrl['grant_type'],
            'username'   => $this->authUrl['username'],
            'password'   => $this->authUrl['password'],
            'audience'   => $this->authUrl['audience'],
            'client_id'  => $this->authUrl['client_id'],
        ]);
        $token_json =  json_decode((string) $get_token->getBody(), true);    
        try{ 
            $mediaCollection = $user->getFirstMedia('kyc_document_collection');  
            if(env('APP_ENV') == 'sandbox'){
                $path = "https://mgmotors.com.pk/storage/img/details_4/homepage_models-mg-zs-ev-new.jpg";
            }else{
                $path =  $mediaCollection?->getFullUrl();
            }  
            $document_path = fopen($path, 'r');   
            $url = $endPoint;
            $upload_document = Http::attach('DocumentType', $user->identityVerification->doc_type)->
            attach('DocumentFront', $document_path)->
            attach('DocumentBack', $document_path)->
            withToken($token_json['access_token'])->
            post($url);
            
            $json_upload_document =  json_decode((string) $upload_document->getBody(), true); 
            $status = $upload_document->status();
            
            if($status == 400){ 
                foreach($json_upload_document['errors'] as $error) {
                    if(is_array($error)) {
                        $errors[] = 'Try to change document type';
                        $errors[] = $error[0];
                        $errors[] = $json_upload_document['title'];
                    }
                }
               
                $errors[] = 'Error While Uploading '.$user->user_type.' documents';
                $errors[] = $json_upload_document['errors'];
                $errors[] = $json_upload_document['title'];  
                return response([
                    'status' => $upload_document->status(),
                    'success'  => false,
                    'errors' => $errors,
                ]);
            }
            if ($upload_document->failed()) { 
                $status = $upload_document->status();
                if($status == 400){   
                    $errors[] = $json_upload_document['errors'];
                    $errors[] = $json_upload_document['title'];  
                    $errors[] = 'Personal Identity Has Been Created But Error While Uploding Documents';
                    return response([
                        'status' => $upload_document->status(),
                        'success'  => false,
                        'errors' => $errors,
                    ]);
                }
                $errors[] = 'Error While uploading Documents'; 
                return response([
                    'status' => $upload_document->status(),
                    'data'   => $json_upload_document,
                    'errors' => $errors,
                    'success'  => false,
                ]); 
            }
            if($upload_document->requestTimeout()){
                $errors[] = 'Request Time OUT';
                return response([
                    'status' => $upload_document->status(),
                    'data'   => $json_upload_document,
                    'errors' => $errors,
                    'success'  => false,
                ]); 
            } 
        }catch(Exception $upload_document_error){ 
            $errors[] = 'Error While uploading Documents';
            $errors[] = $upload_document_error;
            return response([ 
                'data'   => $upload_document_error,
                'success'  => false,
                'errors' => $errors,
            ]);
        } 

    }


}
