<?php

namespace App\Http\Controllers;

use App\Mail\TransactionCancelled;
use File;
use CURLFile;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Custodial;
use App\Models\MemberGuid;
use App\Models\AccountGUID;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\InvestmentStep;
use App\Models\ExternalAccount;
use App\Mail\TransactionCreated;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MakeInvestmentController extends Controller
{

    // New Updated Code




    private $baseUrl;
    private $authUrl;
    public function __construct()
    {
        $environment = config('app.env');
        $this->baseUrl = config('credentials.api.' . $environment);
        $this->authUrl = config('credentials.auth0.' . $environment);
    }


    public function make()
    {

        $user = User::with('userDetail', 'identityVerification')->find(Auth::user()->id);
        return view('investment.make', compact('user'));
    }
    public function detail($id)
    {
        $key = $_ENV['MAIL_USERNAME'] = 'tayyy';
        $key2 = $_ENV['MAIL_USERNAME'];
        // dd($key2);
        $offer = Offer::with('investmentRestrictions')->find($id);
        return view('investment.detail', compact('offer'));
    }
    public function submitInvestment(Request $request)
    {


       $request->validate([
         	'offer_id' => 'required',
          	'investment_amount' => 'integer|required',
        ]);
        if(Auth::user()->status  == 'inactive'){
            return redirect()->back()->with('error', 'Your account has been inactive, Please Contact System Administrator');
        }
        // if (Auth::user()->kyc  == null || Auth::user()->kyc->kyc_level== null ){
        //     return redirect()->back()->with('error', 'Please Run KYC Check First');
        // }

        if (Auth::user()->user_type  == null   ){
            return redirect()->back()->with('error', 'Selected User Type is not defined');
        }

        if (Auth::user()->hasRole('issuer')){
            return redirect()->back()->with('error', 'Only User With Role Investor Can Invest');
        }
        $investment_amount = $request->investment_amount;
        $offer = Offer::with('user', 'user.userDetail', 'investmentRestrictions', 'offerDetail', 'investmentSteps')->find($request->offer_id);
        $investmentSteps = InvestmentStep::where('offer_id', $offer->id)->orderBy('priority', 'asc')->get();
        $user = User::where('id', Auth::user()->id)->first();
        $manual_offer_documents = $offer->getMedia('manual_offer_documents');

        return view('investment.process', compact('investmentSteps', 'user', 'offer', 'investment_amount','manual_offer_documents'));


        dd(1);
        $url_member = $this->baseUrl . "/financial-institutions/sandbox/members/" . $fortress_personal_identity;
        $member = Http::withToken($token_json['access_token'])->get($url_member);
        $json_member =  json_decode((string) $member->getBody(), true);

        if ($member->failed()) {
            Session::put('error', 'Internal Server Error');
            return redirect()->back()->with('error', 'Internal Server Error');
        }
        if ($member->successful()) {
            foreach ($json_member['data'] as $data) {
                if ($data['connectionStatus'] == 'connected') {
                    MemberGuid::updateOrCreate(
                        ['user_id' => Auth::user()->id, 'offer_id' => $request->offer_id],
                        [
                            'offer_id' => $request->offer_id,
                            'memberGuid' => $data['memberGuid'],
                            'name' => $data['name'],
                            'connectionStatus' => $data['connectionStatus']
                        ]
                    );
                }
            }
        }

        $get_guid = MemberGuid::where('offer_id', $request->offer_id)->where('user_id', Auth::user()->id)->first();
        $connect_guid_url =  $this->baseUrl . "/financial-institutions/members/";
        $connect_guid = Http::withToken($token_json['access_token'])->post(
            $connect_guid_url,
            [
                'identityId' => $fortress_personal_identity,
                'memberGuid' => $get_guid->memberGuid,
            ]
        );
        $json_connect_guid =  json_decode((string) $connect_guid->getBody(), true);
        if ($connect_guid->failed()) {
            if ($connect_guid->status() == 409) {
                $url_account_id =  $this->baseUrl . "/financial-institutions/accounts/" . $fortress_personal_identity . "/" . $get_guid->memberGuid;
                $account_id = Http::withToken($token_json['access_token'])->get($url_account_id);
                $json_account_id =  json_decode((string) $account_id->getBody(), true);
                $account_db =  AccountGUID::updateOrCreate(
                    ['user_id' => Auth::user()->id, 'offer_id' => $request->offer_id],
                    ['offer_id' => $request->offer_id, 'name' => $json_account_id[0]['name'], 'accountNumberLast4' => $json_account_id[0]['name'], 'accountGuid' => $json_account_id[0]['accountGuid'], 'financialInstitutionName' => $json_account_id[0]['financialInstitutionName'], 'accountType' => $json_account_id[0]['accountType'], 'smallLogoUrl' => $json_account_id[0]['smallLogoUrl'], 'mediumLogoUrl' => $json_account_id[0]['mediumLogoUrl']]
                );
            }
        } else {
            $url_account_id =  $this->baseUrl . "/financial-institutions/accounts/" . $fortress_personal_identity . "/" . $get_guid->memberGuid;
            $account_id = Http::withToken($token_json['access_token'])->get($url_account_id);
            $json_account_id =  json_decode((string) $account_id->getBody(), true);
            $account_db =  AccountGUID::updateOrCreate(
                ['user_id' => Auth::user()->id, 'offer_id' => $request->offer_id],
                ['offer_id' => $request->offer_id, 'name' => $json_account_id[0]['name'], 'accountNumberLast4' => $json_account_id[0]['name'], 'accountGuid' => $json_account_id[0]['accountGuid'], 'financialInstitutionName' => $json_account_id[0]['financialInstitutionName'], 'accountType' => $json_account_id[0]['accountType'], 'smallLogoUrl' => $json_account_id[0]['smallLogoUrl'], 'mediumLogoUrl' => $json_account_id[0]['mediumLogoUrl']]
            );
        }

        $url_external_acc =  $this->baseUrl . "/external-accounts/financial";
        $external_acc = Http::withToken($token_json['access_token'])->post(
            $url_external_acc,
            [
                'identityId' => $fortress_personal_identity,
                'financialAccountId' => $account_db->accountGuid,

            ]
        );
        $json_external_acc =  json_decode((string) $external_acc->getBody(), true);
        $external_account =  ExternalAccount::updateOrCreate(
            ['user_id' => Auth::user()->id, 'offer_id' => $request->offer_id],
            [
                'offer_id' => $request->offer_id, 'external_account_id' => $json_external_acc['id'],
                'identityId' => $json_external_acc['identityId'],
                'type' => $json_external_acc['type'],
                'accountNumberLast4' => $json_external_acc['accountNumberLast4']
            ]
        );

        // Check Next Step
        $top_nav =  $offer->investmentSteps;
        if ($investment_step->title == 'Select Account Type') {
            return view('investment.step-1-account-type', compact('top_nav', 'offer', 'user', 'external_account', 'investment_amount'));
        }
        if ($investment_step->title == 'Complete Account Form') {
            return view('investment.step-2-verify-identity', compact('top_nav', 'offer', 'user', 'external_account', 'investment_amount'));
        }
        if ($investment_step->title == 'Accreditation') {
            return view('investment.step-1-account-type', compact('top_nav', 'offer', 'user', 'external_account', 'investment_amount'));
        }
        if ($investment_step->title == 'E-Sign Document') {
            return view('investment.step-1-account-type', compact('top_nav', 'offer', 'user', 'external_account', 'investment_amount'));
        }
        if ($investment_step->title == 'Payment Method') {
            return view('investment.step-1-account-type', compact('top_nav', 'offer', 'user', 'external_account', 'investment_amount'));
        }

        // testying

    }
    public function step_two(Request $request)
    {

        $request->validate([
            'external_account' => 'required',
            'offer_id' => 'required',
            'investment_amount' => 'required',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $external_account = $request->external_account;
        $offer_id = $request->offer_id;
        $investment_amount = $request->investment_amount;
        $offer = Offer::with('user', 'user.userDetail', 'investmentRestrictions', 'offerDetail', 'investmentSteps')->find($request->offer_id);
        $top_nav =  $offer->investmentSteps;
        return view('investment.step-2-verify-identity', compact('external_account', 'offer', 'investment_amount', 'user', 'top_nav'));
    }
    public function step_three(Request $request)
    {

        $request->validate([
            'external_account' => 'required',
            'investment_amount' => 'required',
            'offer_id' => 'required',
        ]);


        $user = User::where('id', Auth::user()->id)->first();
        $external_account = $request->external_account;
        $offer_id = $request->offer_id;
        $investment_amount = $request->investment_amount;

        return view('investment.step-3-investment-limits', compact('external_account', 'offer_id', 'investment_amount', 'user'));
    }

    public function step_four(Request $request)
    {

        $request->validate([
            'external_account' => 'required',
            'investment_amount' => 'required',
            'offer_id' => 'required',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $offer = Offer::where('id', $request->offer_id)->first();
        $external_account = $request->external_account;
        $offer_id = $request->offer_id;
        $investment_amount = $request->investment_amount;
        return view('investment.step-4-payment_method', compact('offer', 'external_account', 'offer_id', 'investment_amount', 'user'));
    }
    public function step_five(Request $request)
    {

        $request->validate([
            'external_account' => 'required',
            'investment_amount' => 'required',
            'offer_id' => 'required',
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $offer = Offer::where('id', $request->offer_id)->first();
        $external_account = $request->external_account;
        $offer_id = $request->offer_id;
        $investment_amount = $request->investment_amount;
        return view('investment.step-5-e-sign', compact('offer', 'external_account', 'offer_id', 'investment_amount', 'user'));
    }
    public function e_template(Request $request)
    {

        $e_sign = Http::get('https://esignatures.io/api/templates?token=3137a61a-7db9-41f9-b2bd-39a8d7918fb5');
        $json_e_sign = json_decode((string) $e_sign->getBody(), true);
        if ($e_sign->successful()) {
            return response([
                'status' => true,
                'data' => $json_e_sign
            ]);
        }
    }
    public function kyc_checking(Request $request)
    {

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->authUrl['url'], [
                'grant_type' => $this->authUrl['grant_type'],
                'username'   => $this->authUrl['username'],
                'password'   => $this->authUrl['password'],
                'audience'   => $this->authUrl['audience'],
                'client_id'  => $this->authUrl['client_id'],
            ]);
            $response_json =  json_decode((string) $response->getBody(), true);
            if ($response->successful()) {
                $url = $this->baseUrl . "/api/trust/v1/personal-identities/" . Auth::user()->fortress_personal_identity;
                $upgrade_existing_l0 = Http::withToken($response_json['access_token'])->withHeaders(['Content-Type' => 'application/json'])->get($url);
                $json_upgrade_existing_l0 = json_decode((string) $upgrade_existing_l0->getBody(), true);
                if ($upgrade_existing_l0->successful()) {
                    //dd($upgrade_existing_l0->status());
                    return response([
                        'status' => $upgrade_existing_l0->status(),
                        'data' => $json_upgrade_existing_l0,
                    ]);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => ucfirst($response_json['error']),
                ]);
            }
        } catch (Exception $error) {
           // dd($error);
            return response([
                'status' => false,
                'message' => 'Internal Server Error',
            ]);
        }
    }
    public function save(Request $request)
    {




        $request->validate([
            'offer_id' => 'required',
            'payment_type'=> 'required|in:wire,ach',
            'user_guid' => 'required_if:payment_type,ach',
            //'account_type'=>'required',
            //'investment_limit'=>'required',
            //'bypass_account_setup'=>'required',
            //'templates' => 'required',
            'investment_amount' => 'required',
        ]);

        $offer = Offer::with('user')->findOrFail($request->offer_id);
        $user = Auth::user();


        $template_id = $offer->offerEsing->template_id;

        if ($request->has('past_12_months_investment')) {
            $past12MonthsInvestment = true;
        } else {
            $past12MonthsInvestment = false;
        }
        $token = env('ESIGN_TOKEN');
        try{
            $e_sign = Http::get('https://esignatures.io/api/templates/' . $template_id . '?token='.$token);
            $json_e_sign = json_decode((string) $e_sign->getBody(), true);

            if(!$e_sign->successful()){
                return redirect()->back()->with('error','Error While Fetching E-Sign Document  Step-1');
            }
        }catch(Exception $esign_error){
          //  dd($esign_error);
            return redirect()->back()->with("error","Server Error While Fetching E-Sign Document Step-1");
        }

        try{
            $signature_name    = $offer->user->name;
            $signature_email   = $offer->user->email;
            $signature_mobile  = $offer->user->phone;
            $signature_company = $offer->name;
            $logo =  $offer->getFirstMediaUrl('offer_image', 'thumb');
            $esign_url = "https://esignatures.io/api/contracts?token=".$token;
            $esign_request = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post($esign_url, [
                "template_id" => $template_id,
                "title" =>$json_e_sign['data']['template_name'],
                "metadata" => "ID0001",
                "locale" => "en",
                "test" => "no",
                "custom_webhook_url" => "https://sublimeservices.org/",
                "signers" => [
                    [
                        "name" => $signature_name,
                        "email" => $signature_email,
                        "mobile" => $signature_mobile,
                        "company_name" => $signature_company,
                        "signing_order" => "1",
                        "auto_sign" => "no",
                        "signature_request_delivery_method" => "email",
                        "signed_document_delivery_method" => "email",
                        "required_identification_methods" => [
                            "email",
                            "sms"
                        ],
                        "redirect_url" => "https://your-website.com/aftersign",
                        "embedded_redirect_iframe_only" => "no"
                    ],
                    [
                        "name" => Auth::user()->name,
                        "email" => Auth::user()->email,
                        "mobile" => Auth::user()->phone,
                        "company_name" => "Issuer Company",
                        "signing_order" => "1",
                        "auto_sign" => "no",
                        "signature_request_delivery_method" => "email",
                        "signed_document_delivery_method" => "email",
                        "required_identification_methods" => [
                            "email",
                            "sms"
                        ],
                        "redirect_url" => "https://your-website.com/aftersign",
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
                    "signature_request_text" => "Hi __FULL_NAME__, \\n\\n To review and sign the contract please press the button below \\n\\n Kind Regards",
                    "final_contract_subject" => "Your document is signed",
                    "final_contract_text" => "Hi __FULL_NAME__, \\n\\n Your document is signed.\\n\\nKind Regards",
                    "reply_to" => "support@sublinmesolition.com"
                ],
                "custom_branding" => [
                    "company_name" => "WhiteLabel LLC",
                    "logo_url" => $logo
                ]
            ]);
            $json_esign_request= json_decode((string) $esign_request->getBody(), true);

            if($esign_request->successful()){
                $esign_contract_status = $json_esign_request['data']['contract']['status'];
            }
            if ($esign_request->failed()) {

                if($esign_request->status() == 402){
                    $esign_payment_error =  $json_esign_request['data']['error_message'];
                    $esign_contract_status =  'Not Completed';
                }else{
                    $esign_payment_error = '';
                    return redirect()->back()->with('error', 'Internal Server Error E-sign');
                }
            }
        }catch(Exception $esign_request_error){

            return redirect()->back()->with("error","Error While Requesting E-Sign Documents");
        }


        //  dd($json_esign_request['data']['contract']['status']);

        // if($request->investment_limit == 'yes'){
        //     $request->validate([
        //         'total_amount_invested_crowdfunding_offerings' => 'required',
        //     ]);
        // }elseif($request->investment_limit == 'no'){
        //     $request->validate([
        //         'net_worth_greater_than_60000' => 'required',
        //         'new_investment_amount' => 'required',
        //     ]);
        // }

        $custodial_account = Custodial::where('offer_id', $request->offer_id)->first();
//dd($request->offer_id,$custodial_account);

        if (!$custodial_account) {
            return redirect()->back()->with('error','Custodial Account Id Not Found for Selected Offer [Step 1]');
        }

        if($request->payment_type == 'ach'){
            $member_id = explode(',', $request->user_guid);
            $filteredArray = array_filter($member_id, function ($value) {
                return $value !== '';
            });
            $member_id = '';
            foreach ($filteredArray as $value) {
                $member_id = $value;
            }
        }
        $identityId = Auth::user()->fortress_personal_identity;

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
            // dd($token_json['access_token']);
        } catch (Exception $error) {
            return redirect()->back()->with('error','Internal Server Error For Token -'.$error);
        }

        if($request->payment_type == 'ach'){
            try {
                $member_identity_url = $this->baseUrl . "/api/trust/v1/financial-institutions/members";
                $member_identity = Http::withToken($token_json['access_token'])->post(
                    $member_identity_url,
                    [
                        'identityId' => $identityId,//Identity object pertaining to the end user
                        'memberGuid' => $member_id, //member_guid returned from successful bank linking in
                    ]
                );
                $member_identity =  json_decode((string) $member_identity->getBody(), true);
            } catch (Exception $error) {
                return redirect()->back()->with('error','Internal Server Error financial-institutions -'.$error);
            }
        }


        //Retrieve any bank accounts that are connected
        if($request->payment_type == 'ach'){
            try {
                $accounts_url =  $this->baseUrl . "/api/trust/v1/financial-institutions/accounts/" . $identityId . '/' . $member_id;
                $accounts = Http::withToken($token_json['access_token'])->get($accounts_url);
                $accounts_Json =  json_decode((string) $accounts->getBody(), true);
                if ($accounts->failed()) {
                    $status = $accounts->status();
                    Session::put('error', $accounts['title']);
                    return redirect()->back()->with('error','Financial Institutions error');
                }
                $accountGuid  = '';
                //dd($accounts_Json);
                foreach ($accounts_Json as $account) {
                    //if($account['accountType'] == 'CHECKING'){
                    //  $accountGuid = $account['accountGuid'];
                    //  }
                    $accountGuid = $account['accountGuid'];
                }
            } catch (Exception $error) {
                return redirect()->back()->with('error','Internal Server Error institutions- accounts [Step 4]-'.$error);
            }
        }


        //Now that you have the accountGuid, you will follow up with one last call to create a persistent object referencing the linked bank.
        if($request->payment_type == 'ach'){
            if (Auth::user()->external_account == null) {
                try {
                    $acc_user = User::find(Auth::user()->id);
                    $externalAccountsURL =  $this->baseUrl . "/api/trust/v1/external-accounts/financial";
                    $externalAccounts = Http::withToken($token_json['access_token'])->post(
                        $externalAccountsURL,
                        [
                            'identityId' => $identityId,
                            'financialAccountId' => $accountGuid,
                        ]
                    );
                    $externalAccountJson =  json_decode((string) $externalAccounts->getBody(), true);
                    $externalAccountId = $externalAccountJson['id'];
                    $acc_user->external_account = $externalAccountId;
                    $acc_user->save();
                } catch (Exception $error) {
                    return redirect()->back()->with('error','Error While Making Payment [Step 5]-'.$error);
                }
            } else {
                $externalAccountId = Auth::user()->external_account;
            }
        }



            try {
                DB::beginTransaction();
                if($request->payment_type == 'ach'){
                    $payment_url =  $this->baseUrl.'/api/trust/v1/payments';
                    $data = [
                        'source' => [
                            'externalAccountId' => $externalAccountId,
                        ],
                        'destination' => [
                            'custodialAccountId' => $custodial_account->custodial_id,
                        ],
                        "useIsa" => false,
                        'comment' => 'Offering Payment',
                        'funds' => $request->investment_amount,
                    ];
                    $payment = Http::withToken($token_json['access_token'])
                    ->withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])->post($payment_url,$data);
                    $json_response_payment =  json_decode((string) $payment->getBody(), true);

                    if ($payment->failed()) {
                        return redirect()->back()->with('error', 'Internal Server Error  on payments [Step 6] '.$json_response_payment['title']);
                    }

                    if($payment->successful()){
                        $order = new Order();
                        $order->offer_id = $offer->id;
                        $order->past12MonthsInvestment = $past12MonthsInvestment;
                        $order->investor_id = Auth::user()->id;
                        $order->total = $request->investment_amount;
                        $order->currency = $json_response_payment['currency'];
                        $order->type = $json_response_payment['type'];
                        $order->payment_method = '--';
                        $order->e_sign = $esign_contract_status;
                        $order->status = $json_response_payment['status'];
                        $order->save();
                        $db_transaction = new Transaction;
                        $db_transaction->order_id = $order->id;
                        $db_transaction->offer_id = $offer->id;
                        $db_transaction->investor_id = Auth::user()->id;
                        $db_transaction->funds = $request->investment_amount;
                        $db_transaction->kyc_status = '---';
                        $db_transaction->status =$json_response_payment['status'];
                        $db_transaction->type =  $json_response_payment['type'];
                        $db_transaction->payment_method = '--';
                        $db_transaction->e_sign =  $esign_contract_status;
                        $db_transaction->transaction_id = $json_response_payment['id'];
                        $db_transaction->source_identityId = $json_response_payment['source']['identityId'];
                        $db_transaction->source_externalAccountId = $json_response_payment['source']['externalAccountId'];
                        $db_transaction->destination_identityId = $json_response_payment['destination']['identityId'];
                        $db_transaction->destination_custodialAccountId = $json_response_payment['destination']['custodialAccountId'];
                        $db_transaction->comment = $json_response_payment['comment'];
                        $db_transaction->funds = $json_response_payment['funds'];
                        $db_transaction->currency = $json_response_payment['currency'];
                        $db_transaction->save();
                        $transaction_details = [
                            'investor'=> Auth::user()->name,
                            'investment_amount' => $request->investment_amount,
                            'type_of_security' => 'Common Shares',
                            'share_price' => $offer->name,
                            'size' => $offer->size,
                            'funding_end_date'=>$offer->funding_end_date,
                            'share_count' => $offer->price_per_unit,
                            'share_sold_date' =>Carbon::now()->format('D-m-Y'),
                            'total_raised' => $offer->base_currency . $offer->size,
                            'offer_name' =>  $offer->name,
                            'trnx_total_raised' => 0,
                            'trnx_last_cancel_date' => $offer->funding_end_date,
                        ];

                    //Mail::to(Auth::user()->email)->send(new TransactionCreated($transaction_details));
                    }

                }elseif($request->payment_type == 'wire'){
                   // dd('wiew');
                        $order = new Order();
                        $order->offer_id = $offer->id;
                        $order->past12MonthsInvestment = $past12MonthsInvestment;
                        $order->investor_id = Auth::user()->id;
                        $order->total = $request->investment_amount;
                        $order->currency = 'usd';
                        $order->type = 'wire';
                        $order->payment_method = 'wire';
                        $order->e_sign = $esign_contract_status;
                        $order->status = 'pending';
                        $order->save();
                        $db_transaction = new Transaction;
                        $db_transaction->order_id = $order->id;
                        $db_transaction->offer_id = $offer->id;
                        $db_transaction->investor_id = Auth::user()->id;
                        $db_transaction->funds = $request->investment_amount;
                        $db_transaction->kyc_status = '---';
                        $db_transaction->status = 'pending';
                        $db_transaction->type =  'wire';
                        $db_transaction->payment_method = 'wire';
                        $db_transaction->e_sign =  $esign_contract_status;
                        $db_transaction->transaction_id = null;
                        $db_transaction->source_identityId = $identityId;
                        $db_transaction->source_externalAccountId =null;
                        $db_transaction->destination_identityId = $offer->user->fortress_personal_identity;
                        $db_transaction->destination_custodialAccountId = $custodial_account->custodial_id;
                        $db_transaction->comment = null;
                        $db_transaction->currency = 'usd';
                        $db_transaction->save();
                        $transaction_details = [
                            'investor'=> Auth::user()->name,
                            'investment_amount' => $request->investment_amount,
                            'type_of_security' => 'Common Shares',
                            'share_price' => $offer->name,
                            'size' => $offer->size,
                            'funding_end_date'=>$offer->funding_end_date,
                            'share_count' => $offer->price_per_unit,
                            'share_sold_date' =>Carbon::now()->format('D-m-Y'),
                            'total_raised' => $offer->base_currency . $offer->size,
                            'offer_name' =>  $offer->name,
                            'trnx_total_raised' => 0,
                            'trnx_last_cancel_date' => $offer->funding_end_date,
                        ];
                    }

                    DB::commit();
                    //dd(1111);
                    Mail::to(Auth::user()->email)->send(new TransactionCreated($transaction_details));
                    //dd(1111);
                    return redirect()->route('my.portfolio')->with('success', 'Investment Has Been Completed [".$esign_payment_error"]');

            } catch (Exception $error) {
                    DB::rollBack();
                    $user = Auth::user();
                    Mail::to(Auth::user()->email)->send(new TransactionCancelled($user,$offer));
                   // dd($error);
                return redirect()->back()->with('error', 'Internal Server Error on roll back [Step 7]'.$error);
            }






    }
    public function verify_identity(Request $request)
    {
        return view('investment.verify_identity');
    }
    public function investment_limits(Request $request)
    {
        return view('investment.account-type');
    }
    public function getTemplate(Request $request)
    {

        $e_sign = Http::get('https://esignatures.io/api/templates/' . $request->id . '?token=3137a61a-7db9-41f9-b2bd-39a8d7918fb5');
        $json_e_sign = json_decode((string) $e_sign->getBody(), true);
        return response([
            'status' => true,
            'data' => $json_e_sign
        ]);
    }

    public function getWidgetUrl(Request $request)
    {


        // $e_sign = Http::get('https://esignatures.io/api/templates?token=3137a61a-7db9-41f9-b2bd-39a8d7918fb5');
        // $json_e_sign_templates = json_decode((string) $e_sign->getBody(), true);
        // if ($e_sign->failed()) {
        //     return redirect()->back()->with('error', 'Internal Server Error [e sign]'.$json_e_sign_templates);
        // }


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

        $fortress_personal_identity = Auth::user()->fortress_personal_identity;
        try {
            $url_widget = $this->baseUrl."/api/trust/v1/external-accounts/financial/widget-url/".$fortress_personal_identity;
            $widget = Http::withToken($token_json['access_token'])->get($url_widget);
            $json_widget =  json_decode((string) $widget->getBody(), true);
            if ($widget->failed()) {
		//dd($url_widget,1,$json_widget);
                $errors[] = 'Error While Creating Widget Url';
                return response([
                    'success'  => false,
                    'errors' => $errors,
                    'url'=> null
                ]);
            }
            if ($widget->successful()) {
                $errors = 'URL has been generated';
                return response([
                    'success'  => true,
                    'errors' => $errors,
                    'url'=> $json_widget['widgetUrl']
                ]);

            }

        } catch (Exception $error) {
            $errors[] = 'Error While Creating Widget Url';
            $errors[] = $error;
	//dd(2,$error);
            return response([
                'success'  => false,
                'errors' => $errors,
                'url'=> null
            ]);
        }


    }

    public function getWire(Request $request)
    {

        $request->validate([
            'offer_id' => 'required',
        ]);

        $offer = Offer::find($request->offer_id);
        if(!$offer){
            $errors[] = 'Error While Getting Offer Data';
            return response([
                'status' => 404,
                'success' => false,
                'errors' => $errors

            ]);
        }
        if($offer->custodialAccount){
            $custodialAccountId = $offer->custodialAccount->custodial_id;
        }else{
            $errors[] = 'Error While Custodial Account Information';
            return response([
                'status' => 404,
                'success' => false,
                'errors' => $errors

            ]);
        }
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

     //  dd($custodialAccountId);
        $url = $this->baseUrl."/api/trust/v1/custodial-accounts/".$custodialAccountId."/fiat-deposit-instructions/usd";

        try {
            $widget = Http::withToken($token_json['access_token'])->get($url);
            $json_widget =  json_decode((string) $widget->getBody(), true);
            if ($widget->failed()) {
                $errors[] = 'Error While Fetching Wire Data';
                return response([
                    'success'  => false,
                    'errors' => $errors,
                    'data'=> null
                ]);
            }
            if ($widget->successful()) {
                $errors = 'Data Has been Fetched';
                return response([
                    'success'  => true,
                    'errors' => $errors,
                    'data'=> $json_widget
                ]);

            }
        } catch (Exception $error) {
            $errors[] = 'Error While Fetching Wire Data';
            $errors[] = $error;
            return response([
                'success'  => false,
                'errors' => $errors,
                'data'=> null
            ]);
        }


    }




}
