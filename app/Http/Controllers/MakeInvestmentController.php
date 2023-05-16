<?php

namespace App\Http\Controllers;

use App\Models\AccountGUID;
use App\Models\Custodial;
use App\Models\ExternalAccount;
use App\Models\InvestmentStep;
use App\Models\MemberGuid;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use CURLFile;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use  Illuminate\Support\Collection;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MakeInvestmentController extends Controller
{

    // New Updated Code

    protected $productionAuth;
    protected $fortressBaseUrl;

    public function __construct()
    {
        $this->productionAuth = 'https://fortress-prod.us.auth0.com/oauth/token';
        $this->fortressBaseUrl = 'https://api.fortressapi.com/api/trust/v1/';
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
        
        //dump($request->investment_amount);dd(1);
       $request->validate([
         	'offer_id' => 'required',
          	'investment_amount' => 'integer',
        ]);
        if(Auth::user()->status  == 'inactive'){
            return redirect()->back()->with('error', 'Your account has been locked, Please Contact System Administrator');
        }
        if (Auth::user()->kyc  == null || Auth::user()->kyc->kyc_level== null ){ 
            return redirect()->back()->with('error', 'Please Run KYC Check First');
        }  
        
        if (Auth::user()->user_type  == null   ){ 
            return redirect()->back()->with('error', 'Selected User Type is not defined');
        }  
        $production_auth = 'https://fortress-prod.us.auth0.com/oauth/token';
        $investment_amount = $request->investment_amount;
        $offer = Offer::with('user', 'user.userDetail', 'investmentRestrictions', 'offerDetail', 'investmentSteps')->find($request->offer_id);        
        $investmentSteps = InvestmentStep::where('offer_id', $offer->id)->orderBy('priority', 'asc')->get();
        $user = User::where('id', Auth::user()->id)->first();
        $fortress_personal_identity = Auth::user()->fortress_personal_identity;
        $fortress_id = Auth::user()->fortress_id; 
        $user = Auth::user();       
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
            if ($get_token->failed()) {       
                return redirect()->back()->with('error', 'Internal Server Error [Token]'.$token_json);
            }
        } catch (Exception $error) { 
            return redirect()->back()->with('error', 'Internal Server Error [Token]'.$error);
        } 
        try {
            $url_widget =  $this->fortressBaseUrl . "external-accounts/financial/widget-url/" . $fortress_personal_identity;
            $widget = Http::withToken($token_json['access_token'])->get($url_widget);
            $json_widget =  json_decode((string) $widget->getBody(), true);
            if ($widget->failed()) { 
                return redirect()->back()->with('error', 'Internal Server Error [Widget]'.$json_widget);
            }
        } catch (Exception $error) { 
            return redirect()->back()->with('error', 'Internal Server Error [Widget]'.$error);
        }
        $e_sign = Http::get('https://esignatures.io/api/templates?token=3137a61a-7db9-41f9-b2bd-39a8d7918fb5');
        $json_e_sign_templates = json_decode((string) $e_sign->getBody(), true);        
        if ($e_sign->failed()) { 
            return redirect()->back()->with('error', 'Internal Server Error [e sign]'.$json_e_sign_templates);
        }
        return view('investment.process', compact('investmentSteps', 'user', 'offer', 'investment_amount', 'json_widget', 'json_e_sign_templates'));



        $url_member = $this->fortressBaseUrl . "financial-institutions/sandbox/members/" . $fortress_personal_identity;
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
        $connect_guid_url =  $this->fortressBaseUrl . "financial-institutions/members/";
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
                $url_account_id =  $this->fortressBaseUrl . "financial-institutions/accounts/" . $fortress_personal_identity . "/" . $get_guid->memberGuid;
                $account_id = Http::withToken($token_json['access_token'])->get($url_account_id);
                $json_account_id =  json_decode((string) $account_id->getBody(), true);
                $account_db =  AccountGUID::updateOrCreate(
                    ['user_id' => Auth::user()->id, 'offer_id' => $request->offer_id],
                    ['offer_id' => $request->offer_id, 'name' => $json_account_id[0]['name'], 'accountNumberLast4' => $json_account_id[0]['name'], 'accountGuid' => $json_account_id[0]['accountGuid'], 'financialInstitutionName' => $json_account_id[0]['financialInstitutionName'], 'accountType' => $json_account_id[0]['accountType'], 'smallLogoUrl' => $json_account_id[0]['smallLogoUrl'], 'mediumLogoUrl' => $json_account_id[0]['mediumLogoUrl']]
                );
            }
        } else {
            $url_account_id =  $this->fortressBaseUrl . "financial-institutions/accounts/" . $fortress_personal_identity . "/" . $get_guid->memberGuid;
            $account_id = Http::withToken($token_json['access_token'])->get($url_account_id);
            $json_account_id =  json_decode((string) $account_id->getBody(), true);
            $account_db =  AccountGUID::updateOrCreate(
                ['user_id' => Auth::user()->id, 'offer_id' => $request->offer_id],
                ['offer_id' => $request->offer_id, 'name' => $json_account_id[0]['name'], 'accountNumberLast4' => $json_account_id[0]['name'], 'accountGuid' => $json_account_id[0]['accountGuid'], 'financialInstitutionName' => $json_account_id[0]['financialInstitutionName'], 'accountType' => $json_account_id[0]['accountType'], 'smallLogoUrl' => $json_account_id[0]['smallLogoUrl'], 'mediumLogoUrl' => $json_account_id[0]['mediumLogoUrl']]
            );
        }

        $url_external_acc =  $this->fortressBaseUrl . "external-accounts/financial";
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
            ])->post($this->productionAuth, [
                'grant_type' => 'password',
                'username'   => 'Portal@chainraise.io',
                'password'   => '?dm3JeXgkgQNA?ue8sHI',
                'audience'   => 'https://fortressapi.com/api',
                'client_id'  => 'cNjCgEyfVDyBSxCixDEyYesohVwdNICH',
            ]);
            $response_json =  json_decode((string) $response->getBody(), true);
            if ($response->successful()) {
                $upgrade_existing_l0 = Http::withToken($response_json['access_token'])->withHeaders(['Content-Type' => 'application/json'])->get($this->fortressBaseUrl . 'personal-identities/' . Auth::user()->fortress_personal_identity);
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
            'account_type'=>'required',
            'investment_limit'=>'required',
            'bypass_account_setup'=>'required', 
            'user_guid' => 'required',
            'templates' => 'required',
            'investment_amount' => 'required',
        ]);
        if($request->investment_limit == 'yes'){
            $request->validate([
                'total_amount_invested_crowdfunding_offerings' => 'required', 
            ]);
        }elseif($request->investment_limit == 'no'){
            $request->validate([
                'net_worth_greater_than_60000' => 'required', 
                'new_investment_amount' => 'required', 
            ]);
        }
      
        $custodial_account = Custodial::where('offer_id', $request->offer_id)->first();
        if (!$custodial_account) { 
            return redirect()->back()->with('error','Custodial Account Id Not Found for Selected Offer [Step 1]');
        }
       
        $member_id = explode(',', $request->user_guid);
        $filteredArray = array_filter($member_id, function ($value) {
            return $value !== '';
        });
        $member_id = '';
        foreach ($filteredArray as $value) {
            $member_id = $value;
        }
        $identityId = Auth::user()->fortress_personal_identity;
        $offer = Offer::with('user')->findOrFail($request->offer_id); 
        try { 
            $get_token = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://fortress-prod.us.auth0.com/oauth/token', [
                'grant_type' => 'password',
                'username'   => 'Portal@chainraise.io',
                'password'   => '?dm3JeXgkgQNA?ue8sHI',
                'audience'   => 'https://fortressapi.com/api',
                'client_id'  => 'cNjCgEyfVDyBSxCixDEyYesohVwdNICH',
            ]);
            $token_json =  json_decode((string) $get_token->getBody(), true);
            // dd($token_json['access_token']);
        } catch (Exception $error) { 
            return redirect()->back()->with('error','Internal Server Error [Step 2]-'.$error);
        }
       
        try {
            $member_identity_url = $this->fortressBaseUrl . "financial-institutions/members";
            $member_identity = Http::withToken($token_json['access_token'])->post(
                $member_identity_url,
                [
                    'identityId' => $identityId,//Identity object pertaining to the end user
                    'memberGuid' => $member_id, //member_guid returned from successful bank linking in
                ]
            ); 
            $member_identity =  json_decode((string) $member_identity->getBody(), true);  
        } catch (Exception $error) { 
            return redirect()->back()->with('error','Internal Server Error [Step 3]-'.$error);
        }
        //Retrieve any bank accounts that are connected
      
        try {
            $accounts_url =  $this->fortressBaseUrl . "financial-institutions/accounts/" . $identityId . '/' . $member_id;
            $accounts = Http::withToken($token_json['access_token'])->get($accounts_url);
            $accounts_Json =  json_decode((string) $accounts->getBody(), true);  
            if ($accounts->failed()) {
                $status = $accounts->status();
                Session::put('error', $accounts['title']);
                return redirect()->back();
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
            //  dd($error); 
            return redirect()->back()->with('error','Internal Server Error [Step 4]-'.$error);
        }
        //Now that you have the accountGuid, you will follow up with one last call to create a persistent object referencing the linked bank.
        if (Auth::user()->external_account == null) { 
            try {
                $acc_user = User::find(Auth::user()->id);
                $externalAccountsURL =  $this->fortressBaseUrl . "external-accounts/financial";
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
        try {
            DB::beginTransaction(); 
            $payment_url =  $this->fortressBaseUrl . 'payments';
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
            $json_response_ach =  json_decode((string) $payment->getBody(), true);   
            if ($payment->failed()) {
                return redirect()->back()->with('error', 'Internal Server Error  [Step 6]'.$json_response_ach);
            }
            if($payment->successful()){
                $order = new Order();
                $order->offer_id = $offer->id;
                $order->investor_id = Auth::user()->id;
                $order->total = $request->investment_amount; 
                $order->currency = "USD"; 
                $order->type = 'ACH';
                $order->payment_method = 'wire';
                $order->e_sign = 'incomplete';
                $order->status = 'pending';
                $order->save(); 
                $db_transaction = new Transaction;
                $db_transaction->order_id = $order->id;
                $db_transaction->offer_id = $offer->id;
                $db_transaction->investor_id = Auth::user()->id;
                $db_transaction->funds = $request->investment_amount;
                $db_transaction->kyc_status = '---';
                $db_transaction->status = 'will-set'; 
                $db_transaction->type = "ACH";
                $db_transaction->payment_method = 'wire';
                $db_transaction->e_sign = 'incomplete'; 
                $db_transaction->transaction_id = $json_response_ach->id;
                $db_transaction->source_identityId = $json_response_ach->source->identityId;
                $db_transaction->source_externalAccountId = $json_response_ach->source->externalAccountId;
                $db_transaction->destination_identityId = $json_response_ach->destination->identityId;
                $db_transaction->destination_custodialAccountId = $json_response_ach->destination->custodialAccountId;
                $db_transaction->comment = $json_response_ach->comment;
                $db_transaction->funds = $json_response_ach->funds;
                $db_transaction->currency = $json_response_ach->currency; 
                $db_transaction->save();
                DB::commit();
                return redirect()->route('dashboard')->with('success', 'Investment Has Been Completed');
            }    
        } catch (Exception $error) {
            DB::rollBack();   
            return redirect()->back()->with('error', 'Internal Server Error [Step 7]'.$error);
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
}
