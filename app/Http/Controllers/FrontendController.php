<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Accreditation;
use App\Models\Folder;
use App\Models\IdentityVerification;
use App\Models\KYC;
use App\Models\MyEDocument;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\UserDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Mail\UPDATEKYC;
use Illuminate\Support\Facades\Mail;
class FrontendController extends Controller
{

    private $baseUrl;
    private $authUrl;

    public function __construct()
    {
        $environment   = config('app.env');
        $this->baseUrl = config('credentials.api.' . $environment);
        $this->authUrl = config('credentials.auth0.' . $environment);

    }

    public function layout_email(){
        return view('email.transaction.create');
    }
    public function index()
    {

        $offers = Offer::orderBy('id', 'desc')->where('status','active')->get();

        $offer_coming_soon = Offer::orderBy('id', 'desc')->where('status','coming-soon')->get();
        return view('frontEnd.offer.index',compact('offers','offer_coming_soon'));
    }

    public function detail($slug)
    {

        $offer = Offer::with('user','user.userDetail','investmentRestrictions','offerDetail','offerVideos','eDocuments','offerEsing')->
        where('slug',$slug)->first();
        $slider_images = DB::table('media')
        ->where('model_type', Offer::class)
        ->where('model_id', $offer->id)
        ->where('collection_name', 'offer_slider_images')
        ->get();
        //Getting Template Name
        // $token = env('ESIGN_TOKEN');
        // try{
        //     $template = Http::get('https://esignatures.io/api/templates/'.$offer->offerEsing->template_id.'?token='.$token);
        //     $json_e_sign = json_decode((string) $template->getBody(), true);
        //     if($template->successful()){

        //        $temp_name = $json_e_sign['data']['template_name'];
        //        $created_at = $json_e_sign['data']['created_at'];

        //     }else{
        //         $temp_name = 'Not Found';
        //         $created_at = 'Not Found';
        //     }
        // }catch(Exception $error){
        //     $temp_name = 'Not Found';
        //     $created_at = 'Not Found';
        // }
        $temp_name = 'Not Found';
        $created_at = 'Not Found';

        $manual_offer_documents = $offer->getMedia('manual_offer_documents');


        return view('frontEnd.offer.detail',compact('offer','slider_images','temp_name','created_at','manual_offer_documents'));
    }


    public function detail_v2($slug)
    {

        $offer = Offer::with('user','user.userDetail','investmentRestrictions','offerDetail')->where('slug',$slug)->first();
        return view('frontEnd.offer.detailv2',compact('offer'));
    }



    public function socialLogin()
    {

        return view('frontEnd.login');
    }

    function privacy_policy(){

        return view('frontEnd.privacy_policy');
    }

    function terms(){

        return view('frontEnd.terms');
    }

    function faq(){
        return view('frontEnd.faq');
    }

    function contact(){
        return view('frontEnd.contact');
    }


    function investors(){
        return view('frontEnd.investors');
    }
    function businesses(){
        return view('frontEnd.businesses');
    }

    public function sort($order)
    {
        $offer_coming_soon = Offer::orderBy('id', 'desc')->where('status','coming-soon')->get();
        if($order == 'default'){
            $offers =  Offer::orderBy('id', 'desc')->get();
        }else{
            $offers =  Offer::orderBy('name', $order)->get();
        }
        return view('frontEnd.offer.index',compact('offers','offer_coming_soon'));
    }

    public function my_account(){
        $user = Auth::user();
        return view('frontEnd.myaccount',compact('user'));
    }

    public function my_account_update(Request $request){
        $user = Auth::user();
        try{

            $user->name = $request->legal_name;
            $user->net_worth = $request->net_worth;
            $user->annual_income = $request->annual_income;
            $user->are_you_accredited = $request->has('are_you_accredited') ? true : false;
            $user->phone = $request->phone;
            $user->cc = $request->cc;
            $user->save();
            $annualIncome = (int) str_replace(',', '', $user->net_worth);
            $netWorth = (int) str_replace(',', '', $user->annual_income);
            if($user->are_you_accredited == true){

                if (($annualIncome >= 124000) && ($netWorth >= 124000)) {
                    $accreditedInvestment = min(124000, 0.1 * max($annualIncome, $netWorth));
                    $investmentLimit =    $accreditedInvestment;
                }else{
                    return response([
                        'status' => false,
                        'success' => false,
                        'errors' => "If you are a Accredited Member then your Annual Income & Networth must be greater then or equals to ".number_format(124000),
                    ]);
                }
            }else{
                if (($annualIncome < 124000) || ($netWorth < 124000)) {
                    $nonAccreditedInvestment = max(2500, 0.05 * max($annualIncome, $netWorth));
                    $investmentLimit =  $nonAccreditedInvestment;
                }else{
                    return response([
                        'status' => false,
                        'success' => false,
                        'errors' => "If you are not a Accredited Member then your Annual Income & Networth must be less then ".number_format(124000),
                    ]);
                }
            }
            $user->investment_limit = $investmentLimit;
            $user->save();
            if($request->primary_contact_social_security == '999-99-9999'){
                $ssn = $user->identityVerification->primary_contact_social_security;
            }else{
                $ssn = Crypt::encryptString($request->primary_contact_social_security);
            }
            $identityVerification = IdentityVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                'primary_contact_social_security' => $ssn,
                'nationality' => $request->nationality,
                'country_residence' => $request->country_residence,
                'doc_type' => $request->doc_type,
            ]);
            $userDetail = UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => $request->address,
                    'last_name' => $request->last_name,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'dob' => $request->dob,
                ]);
            $user->save();
            if($request->hasFile('user_profile_photo')) {
                $user->addMediaFromRequest('user_profile_photo')->toMediaCollection('user_profile_photo_collection');
            }
        }catch(Exception $error){
            return response([
                'status' => false,
                'success' => false,
                'errors' => "There is some error while updating account - ['.$error.']",
            ]);
        }

        if($request->has('kyc_run')){
            $decodedSsn = Crypt::decryptString($user->identityVerification->primary_contact_social_security);
            $date_of_birth = $user->userDetail->dob;
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
                        'success' => false,
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
                        $errors[] = $upgrade_existing_l0['title'];
                        return response([
                            'status' => $upgrade_existing_l0->status(),
                            'success' => false,
                            'errors' => $errors[] = 'Error',
                        ]);
                    }else{
                        if(empty($json_upgrade_existing_l0['documents'])){
                            $document_status =  "Not Uploaded";
                        }else{
                            $document_status =  $json_upgrade_existing_l0['documents'][0]['documentCheckStatus'];
                        }
                        $update_kyc =  KYC::updateOrCreate(
                                    ['user_id' => $user->id],
                                    [   'kyc_level' => $json_upgrade_existing_l0['kycLevel'],
                                        'doc_status'=> $document_status
                                    ]
                        );
                    }
                    Mail::to($user->email)->send(new UPDATEKYC($user));
                    return response([
                        'status' => $upgrade_existing_l0->status(),
                        'success' => true,
                    ]);

                }catch(Exception $error){
                    return response([
                        'status' => false,
                        'success' => false,
                        'error'=>$error,
                    ]);
                }

            }else{
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
                        $errors[] = $upgrade_existing_l0['title'];
                        dd($errors[]);
                        return response([
                            'status' => $upgrade_existing_l0->status(),
                            'success' => false,
                            'errors' => $errors[] = 'Error',
                        ]);
                    }else{

                        if(empty($json_upgrade_existing_l0['documents'])){
                            $document_status =  "Not Uploaded";
                        }else{
                            $document_status =  $json_upgrade_existing_l0['documents'][0]['documentCheckStatus'];
                        }

                       $update_kyc =  KYC::updateOrCreate(
                                ['user_id' => $user->id],
                                [   'kyc_level' => $json_upgrade_existing_l0['kycLevel'],
                                    'doc_status'=> $document_status
                                ]
                        );

                    }
                    Mail::to($user->email)->send(new UPDATEKYC($user));

                    return response([
                        'status' => $upgrade_existing_l0->status(),
                        'success' => true,
                    ]);

                }catch(Exception $error){
                    return response([
                        'status' => false,
                        'success' => false,
                        'error'=>$error,
                    ]);
                }
            }
        }else{
            return response([
                'status' => true,
                'success' => true,
                'errors' => "Profile Updated",
            ]);
        }






    }

    public function my_documents(){

        $user = Auth::user();
       // $folders = Folder::where('user_id',$user->id)->withCount('documents')->get();
        $e_documents =  MyEDocument::where('investor_id',$user->id)->get();
        $offer_documents =  MyEDocument::where('investor_id',$user->id)->get();
        $offers = Offer::get();
        return view('frontEnd.mydocuments',compact('user','e_documents','offers'));
    }

    public function portfolio(){
        $user = Auth::user();
        $lastInsertedRecord = Transaction::latest()->where('investor_id',$user->id)->first();
        if($lastInsertedRecord){
            $lastInsertedDate = $lastInsertedRecord->created_at;
        }else{
            $lastInsertedDate = '--';
        }

        $totalInvested = Order::where('investor_id', $user->id)->sum('total');
        $transactions = Transaction::with('offer','user')->where('investor_id',$user->id)->get();
        return view('frontEnd.portfolio',compact('user','transactions','lastInsertedDate','totalInvested'));
    }


    public function verify_identity(Request $request){

        $validator = Validator::make($request->all(), [
            'legal_name' => 'required',
            'last_name' => 'required',
            'nationality' => 'required',
            'country_residence' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'dob' => 'required',
            'cc' => 'required',
            'phone' => 'required',
            'doc_type' => $request->input('nationality') !== 'US' ? 'required' : 'nullable',
            'primary_contact_social_security' => $request->input('nationality') === 'US' ? 'required' : 'nullable',
        ]);
        if ($validator->fails()) {
            return response([
                'validation'=>false,
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        $user = Auth::user();
        try{
            $user->name = $request->legal_name;
            $user->phone = $request->phone;
            $user->cc = $request->cc;
            if($request->primary_contact_social_security == '999-99-9999'){
                $ssn = $user->identityVerification->primary_contact_social_security;
            }else{
                $ssn = Crypt::encryptString($request->primary_contact_social_security);
            }
            $identityVerification = IdentityVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                'primary_contact_social_security' => $ssn,
                'nationality' => $request->nationality,
                'country_residence' => $request->country_residence,
                'doc_type' => $request->doc_type,
            ]);
            $userDetail = UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => $request->address,
                    'last_name' => $request->last_name,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'dob' => $request->dob,
                ]);
            $user->save();
        }catch(Exception $error){

            return response([
                'status' => false,
                'success' => false,
                'errors' => "There is some error while updating account - ['.$error.']",
            ]);
        }


        $decodedSsn = Crypt::decryptString($user->identityVerification->primary_contact_social_security);
        $date_of_birth = $user->userDetail->dob;
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
                    'success' => false,
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

        if($user->fortress_id == null){
            try{
                $identity_data = [
                    'firstName' => $user->name,
                    'middleName' => $user->userDetail->middle_name,
                    'lastName' => $user->userDetail->last_name,
                    'phone' =>  $user->cc.$user->phone,
                    'email' => $user->email,
                    'upgradeKYC' => false,
                    "dateOfBirth" => $date_of_birth,
                    'address' => [
                        'street1' => $user->userDetail->address,
                        'postalCode' => $user->userDetail->zip,
                        'city' => $user->userDetail->city,
                        'state' => $user->userDetail->state,
                        'country' => $user->identityVerification->nationality,
                    ]
                ];
                if($request->nationality == 'US'){
                    $identity_data['ssn'] = $decodedSsn;
                }
                $identity_containers = Http::withToken($token_json['access_token'])->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($this->baseUrl.'/api/trust/v1/identity-containers',  $identity_data );
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

            // Uploading documents
            if($request->nationality != 'US'){
                if($user->user_type  == 'entity'){
                    $id =  $user->business_id;
                    $endPoint = $this->baseUrl.'/api/compliance/v1/business-identities/'.$id.'/documents';
                }  else{
                    $id =  $user->fortress_personal_identity;
                   //base URL https://api.fortressapi.com/api/trust/v1/
                    $endPoint = $this->baseUrl.'/api/trust/v1/personal-identities/'.$id.'/documents';
                }
                try{
                    $mediaCollection = $user->getFirstMedia('kyc_document_collection');
                    if(env('APP_ENV') == 'sandbox'){
                        $path = "https://mgmotors.com.pk/storage/img/details_4/homepage_models-mg-zs-ev-new.jpg";
                    }else{
                        $path =  $mediaCollection->getFullUrl();
                    }
                    $document_path = fopen($path, 'r');
                    $upload_document = Http::attach('DocumentType', $request->doc_type)->
                    attach('DocumentFront', $document_path)->
                    attach('DocumentBack', $document_path)->
                    withToken($token_json['access_token'])->
                    post($endPoint);
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


              // Get the latest status
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
                    $errors[] = $upgrade_existing_l0['title'];

                    return response([
                        'status' => $upgrade_existing_l0->status(),
                        'success' => false,
                        'errors' => $errors[] = 'Error',
                    ]);
                }else{
                    if(empty($json_upgrade_existing_l0['documents'])){
                        $document_status =  "Not Uploaded";
                    }else{
                        $document_status =  $json_upgrade_existing_l0['documents'][0]['documentCheckStatus'];
                    }
                    $update_kyc =  KYC::updateOrCreate(
                                ['user_id' => $user->id],
                                [   'kyc_level' => $json_upgrade_existing_l0['kycLevel'],
                                    'doc_status'=> $document_status
                                ]
                    );
                }
                Mail::to($user->email)->send(new UPDATEKYC($user));

                return response([
                    'status' => $upgrade_existing_l0->status(),
                    'success' => true,
                    'data'=> $update_kyc
                ]);

            }catch(Exception $error){

                return response([
                    'status' => false,
                    'success' => false,
                    'error'=>$error,
                ]);
            }


        }else{
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
                    $errors[] = $upgrade_existing_l0['title'];

                    return response([
                        'status' => $upgrade_existing_l0->status(),
                        'success' => false,
                        'errors' => $errors[] = 'Error',
                    ]);
                }else{

                    if(empty($json_upgrade_existing_l0['documents'])){
                        $document_status =  "Not Uploaded";
                    }else{
                        $document_status =  $json_upgrade_existing_l0['documents'][0]['documentCheckStatus'];
                    }

                    $update_kyc =  KYC::updateOrCreate(
                            ['user_id' => $user->id],
                            [   'kyc_level' => $json_upgrade_existing_l0['kycLevel'],
                                'doc_status'=> $document_status
                            ]
                    );

                }
                Mail::to($user->email)->send(new UPDATEKYC($user));

                return response([
                    'status' => $upgrade_existing_l0->status(),
                    'success' => true,
                    'data'=> $update_kyc
                ]);

            }catch(Exception $error){

                return response([
                    'status' => false,
                    'success' => false,
                    'error'=>$error,
                ]);
            }
        }



    }



}
