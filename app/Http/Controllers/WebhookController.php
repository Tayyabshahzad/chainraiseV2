<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\PaymentStatusUpdated;
use App\Models\Custodial;
use App\Models\IdentityVerification;
use App\Models\KYC;
use App\Models\MyEDocument;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;

class WebhookController extends Controller
{
    private $baseUrl;
    private $authUrl;
    public function __construct()
    {
        $environment   = config('app.env');
        $this->baseUrl = config('credentials.api.' . $environment);
        $this->authUrl = config('credentials.auth0.' . $environment);
	//dd($this->authUrl);
    }




    public function handle(Request $request)
    {
        // Get the JSON data from the request
        $data = $request->json()->all();

        // Check if the data has the expected structure
        if (isset($data['action']) && isset($data['changes'])) {
            // Log the webhook data
            Log::info('Webhook data received', ['data' => $data]);

            // You can access the fields like this:
            $organizationId = $data['organizationId'];
            $action = $data['action'];
            $changes = $data['changes'];

            // For example, if you want to access the "kyc-level" change:
            if (isset($changes['kyc-level'])) {
                $kycLevel = $changes['kyc-level'];
                // Log the kyc-level change
                Log::info('kyc-level change', ['kyc-level' => $kycLevel]);
            }

            // Return a response to the webhook provider, if needed
            return response()->json(['message' => 'Webhook received successfully']);
        } else {
            // Log an error if the data is invalid
            Log::error('Invalid webhook data', ['data' => $data]);
            return response()->json(['error' => 'Invalid webhook data'], 400);
        }
    }




    public function handle111(Request $request)
    {
        // Parse the JSON data from the request

        $data = json_decode($request->getContent());

        // Check if the data has the expected structure
        if (isset($data->action) && isset($data->changes)) {
            // Log the webhook data
            Log::info('Webhook received', ['data' => $data]);

            // You can access the fields like this:
            $organizationId = $data->organizationId;
            $action = $data->action;
            $changes = $data->changes;

            // For example, if you want to access the "kyc-level" change:
            if (isset($changes->{'kyc-level'})) {
                $kycLevel = $changes->{'kyc-level'};
                // Log the kyc-level change
                Log::info('kyc-level change', ['kyc-level' => $kycLevel]);
            }

            // Return a response to the webhook provider, if needed
            return response()->json(['message' => 'Webhook received successfully']);
        } else {
            // Log an error if the data is invalid
            Log::error('Invalid webhook data', ['data' => $data]);
            return response()->json(['error' => 'Invalid webhook data'], 400);
        }
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
        //dump( $this->authUrl);
        // $check_user_kyc_level = Http::withToken($token_json['access_token'])->
        // withHeaders(['Content-Type' => 'application/json'])->
        // get($this->baseUrl."/api/compliance/v1/identities?PageSize=90");
        // $check_user_kyc_level_kson =  json_decode((string) $check_user_kyc_level->getBody(), true);


        //  $check_user_kyc_level = Http::withToken($token_json['access_token'])->
        // withHeaders(['Content-Type' => 'application/json'])->
        // get($this->baseUrl."/api/trust/v1/transactions?PageSize=140");
        // $check_user_kyc_level_kson =  json_decode((string) $check_user_kyc_level->getBody(), true);




        $check_user_kyc_level = Http::withToken($token_json['access_token'])->
        withHeaders(['Content-Type' => 'application/json'])->
        get($this->baseUrl."/api/trust/v1/transactions?identityId=ddfba7da-8e56-4636-9d3e-acbb5b33c27f");
        $check_user_kyc_level_kson =  json_decode((string) $check_user_kyc_level->getBody(), true);


        dd($check_user_kyc_level_kson);


//         $check_user_kyc_level = Http::withToken($token_json['access_token'])->
//         withHeaders(['Content-Type' => 'application/json'])->
//         get($this->baseUrl."/api/trust/v1/business-identities/7832784b-d149-483e-af84-28c1ce851a4a");
//         $check_user_kyc_level_kson =  json_decode((string) $check_user_kyc_level->getBody(), true);


//   dd($check_user_kyc_level_kson);




        // $endPoint = $this->baseUrl."/api/trust/v1/business-identities/4d263eb9-acb2-4291-bb87-bd765b243612";
        // $user_details = Http::withToken($token_json['access_token'])->
        // withHeaders(['Content-Type' => 'application/json'])->
        // get($endPoint);
        // $user_details_json =  json_decode((string) $user_details->getBody(), true);
        // dump('Business Identity ',$user_details_json);


        // $endPoint = $this->baseUrl."/api/trust/v1/personal-identities/55e67ba4-d2a3-4591-bbc4-169cbb935342";
        // $user_details = Http::withToken($token_json['access_token'])->
        // withHeaders(['Content-Type' => 'application/json'])->
        // get($endPoint);
        // $user_details_json =  json_decode((string) $user_details->getBody(), true);
        //   dd('Business Identity benifier owner',$user_details_json);



        // $endPoint = $this->baseUrl."/api/trust/v1/personal-identities/27c60978-c553-4b1c-bb53-9d11d3c9d794";
        // $user_details = Http::withToken($token_json['access_token'])->
        // withHeaders(['Content-Type' => 'application/json'])->
        // get($endPoint);
        // $user_details_json =  json_decode((string) $user_details->getBody(), true);
        // dump('personal Identity with detail',$user_details_json);






        foreach($check_user_kyc_level_kson['data'] as $data){
            if (array_key_exists('destination', $data)) {
                dump($data['destination']);
                $amount = $data['amount'];

                if (array_key_exists('destination', $data)) {

                    if (array_key_exists('custodialAccountId', $data['destination'])) {
                        $custodialAccountId = $data['destination']['custodialAccountId'];
                        $destination_identityId = $data['destination']['identityId'];
                        $identityId = $data['destination']['identityId'];
                        $currency = $data['currency'];
                        $paymentType = $data['paymentType'];
                        $status = $data['status'];
                        if (array_key_exists('source', $data)) {
                            $fortress_personal_identity =  $data['source']['identityId'];
                            $user = User::where('fortress_personal_identity',$fortress_personal_identity)->first();
                            if (array_key_exists('externalAccountId', $data['source'])) {
                                $source_externalAccountId = $data['source']['externalAccountId'];
                            }else{
                                $source_externalAccountId = null;
                            }

                        }else{
                            $fortress_personal_identity =  1;
                            $source_externalAccountId = null;
                        }

                        $transaction_id =  $data['id'];
                        $comment =  $data['comment'];
                        $custodial = Custodial::where('custodial_id',$custodialAccountId)->with('offer')->first();
                        if($custodial){

                            $order = new Order();
                            $order->offer_id = $custodial->offer->id;
                            $order->past12MonthsInvestment = true;
                            $order->investor_id = $user->id;
                            $order->total = $amount;
                            $order->currency = $currency;
                            $order->type = $paymentType;
                            $order->payment_method = $paymentType;
                            $order->e_sign = 'send';
                            $order->status = $status;
                            $order->save();
                            $db_transaction = new Transaction;
                            $db_transaction->order_id = $order->id;
                            $db_transaction->offer_id = $custodial->offer->id;
                            $db_transaction->investor_id = $user->id;
                            $db_transaction->funds = $amount;
                            $db_transaction->kyc_status = '---';
                            $db_transaction->status =$status;
                            $db_transaction->type = $paymentType;
                            $db_transaction->payment_method = $paymentType;
                            $db_transaction->e_sign =   'send';
                            $db_transaction->transaction_id = $transaction_id;
                            $db_transaction->source_identityId = $fortress_personal_identity;
                            $db_transaction->source_externalAccountId =$source_externalAccountId;
                            $db_transaction->destination_identityId = $destination_identityId;
                            $db_transaction->destination_custodialAccountId = $custodialAccountId;
                            $db_transaction->comment = $comment;
                            $db_transaction->currency = $currency;
                            $db_transaction->save();
                        }
                    }
                } else {
                // Code to execute if 'destination' key is not present in $data
                // For example:
                    dump("No destination found");
                }
            }


            //

            // if($data['type'] == 'personal'){
            //     $user_type = "individual";
            //     $endPoint = $this->baseUrl."/api/trust/v1/personal-identities/".$data['id'];
            //     $user_details = Http::withToken($token_json['access_token'])->
            //     withHeaders(['Content-Type' => 'application/json'])->
            //     get($endPoint);
            //     $user_details_json =  json_decode((string) $user_details->getBody(), true);
            //     $getuser_persoanl = User::where('email',$user_details_json['email'])->first();
            //   //  dump($user_details_json);
            //     if(!$getuser_persoanl){
            //         $user = new User;
            //         $user->name = $user_details_json['firstName'];
            //         $user->email_verified_at = Carbon::now();
            //         $user->agree_consent_electronic = true;
            //         $user->email  = $user_details_json['email'];
            //         $user->password =  $user->password =  Hash::make("Google@123");
            //         $user->phone = $user_details_json['phone'];
            //         $user->status = true;
            //         $user->fortress_id = $user_details_json['identityContainerId'];
            //         $user->fortress_personal_identity = $user_details_json['id'];
            //         $user->user_type = $user_type;
            //         $user->check_kyc = true;
            //         $user->profile_status = true;
            //         $user->are_you_accredited = true;
            //         $user->save();
            //         if(isset($user_details_json['middleName'])){
            //             $mid_name = $user_details_json['middleName'];
            //         }else{
            //             $mid_name = '';
            //         }

            //         if(isset($user_details_json['dateOfBirth'])){
            //             $dateOfBirth = $user_details_json['dateOfBirth'];
            //         }else{
            //             $dateOfBirth =null;
            //         }


            //         if(isset($user_details_json['address'])){
            //             $address =  $user_details_json['address']['street1'].' '. $user_details_json['address']['postalCode'].' '. $user_details_json['address']['city'].' '.$user_details_json['address']['state'].' '.$user_details_json['address']['country'];
            //             $city = $user_details_json['address']['city'];
            //             $state = $user_details_json['address']['state'];
            //             $zip =  $user_details_json['address']['postalCode'];
            //             $country =  $user_details_json['address']['country'];
            //         }else{
            //             $address =null;
            //             $city =  null;
            //             $state =  null;
            //             $zip =   null;
            //             $country =   null;
            //         }

            //         $userDetails = UserDetail::updateOrCreate(
            //             ['user_id' => $user->id],
            //             [
            //             'middle_name' => $mid_name,
            //             'last_name' => $user_details_json['lastName'],
            //             'title' => 'Mr',
            //             'dob' => $dateOfBirth,
            //             'address' =>  $address,
            //             'city' => $city ,
            //             'state' => $state,
            //             'zip' => $zip,
            //             ]
            //         );

            //         if(isset($user_details_json['ssn'])){
            //             $ssn = Crypt::encryptString($user_details_json['ssn']);
            //         }else{
            //             $ssn = null;
            //         }

            //         $identityVerification = IdentityVerification::updateOrCreate(
            //             ['user_id' => $user->id],
            //             [
            //             'primary_contact_social_security' => $ssn,
            //             'nationality' => $country,
            //             'country_residence' =>  $country,
            //             ]
            //         );
            //         KYC::updateOrCreate(
            //             ['user_id' => $user->id],
            //             ['kyc_level' => $user_details_json['kycLevel']
            //             ]
            //         );
            //         $user->assignRole('investor');
            //     }
            // }
        }
        dd('Done');

        foreach($check_user_kyc_level_kson['data'] as $data){
            if($data['type'] == 'business'){
                $user_type = "entity";
                $identityContainerId = $data['id'];
                $endPoint_01 = $this->baseUrl."/api/trust/v1/business-identities/".$identityContainerId;
                $user_details_01 = Http::withToken($token_json['access_token'])->
                withHeaders(['Content-Type' => 'application/json'])->
                get($endPoint_01);
                $user_company_detail =  json_decode((string) $user_details_01->getBody(), true);

                if (isset($user_company_detail['beneficialOwners']) && is_array($user_company_detail['beneficialOwners']) && empty($user_company_detail['beneficialOwners'])) {
                    dump('No beneficialOwners');
                }else{
                    $beneficialOwners = $user_company_detail['beneficialOwners'][0];
                    $endPoint2 = $this->baseUrl."/api/trust/v1/personal-identities/".$beneficialOwners;
                    $user_details2 = Http::withToken($token_json['access_token'])->
                    withHeaders(['Content-Type' => 'application/json'])->
                    get($endPoint2);
                    $user_details2_json =  json_decode((string) $user_details2->getBody(), true);
                    $getuser = User::where('email',$user_details2_json['email'])->first();
                    if($getuser){
                        $getuser->identity_container_id = $user_company_detail['identityContainerId'];
                        $getuser->business_id = $user_company_detail['id'];
                        $getuser->user_type = $user_type;
                        $getuser->save();
                        $getuser->assignRole('issuer');

                        if(isset($user_company_detail['website'])){
                            $website =  $user_company_detail['website'];
                        }else{
                            $website =null;

                        }

                        if(isset($user_company_detail['address'])){
                            $address =  $user_company_detail['address']['street1'].' '. $user_company_detail['address']['postalCode'].' '. $user_company_detail['address']['city'].' '.$user_company_detail['address']['state'].' '.$user_company_detail['address']['country'];
                            $city = $user_company_detail['address']['city'];
                            $state = $user_company_detail['address']['state'];
                            $zip =  $user_company_detail['address']['postalCode'];
                        }else{
                            $website =null;
                            $city =  null;
                            $state =  null;
                            $zip =   null;
                        }


                        $userDetails = UserDetail::updateOrCreate(
                        ['user_id' => $getuser->id],
                        [
                        'ein' => $user_company_detail['ein'],
                        'naics' => $user_company_detail['naics'],
                        'naics_description' => 'Mr',
                        'website' => $website,
                        'agree_consent_electronic' => true,
                        'city' => $city ,
                        'zip' => $zip ,
                        'entity_name' => $user_company_detail['companyName'],
                        'legal_formation' => $user_company_detail['legalStructure'],
                        'date_incorporation' => $user_company_detail['establishedOn'],
                        ] );
                        $identityVerification = IdentityVerification::updateOrCreate(
                            ['user_id' => $getuser->id],
                            [
                            'tax_entity_type' => $user_company_detail['legalStructure'],
                            'tax_identification' => $user_company_detail['ein'],
                            'nationality' => $user_company_detail['address']['country'],
                            ]
                        );
                        KYC::updateOrCreate(
                            ['user_id' => $getuser->id],
                            ['kyc_level' => $user_company_detail['kycLevel']
                            ]
                        );
                    }
                }



            }
        }
        // {{fortress_base_url}}/api/compliance/v1/identities?PageSize=90

         //{{fortress_base_url}}/api/trust/v1/personal-identities/{{identityId}}
         //{{fortress_base_url}}/api/trust/v1/business-identities/{{businessidentityId}}


    }




}
