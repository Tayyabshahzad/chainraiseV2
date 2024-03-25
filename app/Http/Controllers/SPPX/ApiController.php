<?php

namespace App\Http\Controllers\SPPX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
class ApiController extends Controller
{

    public $endpoint;
    public function __construct()
    {
        $this->endpoint = "https://crdev.sppx.io/api/v0";

    }

    public function login()
    {
        // Your login API endpoint and credentials
        $loginEndpoint = $this->endpoint.'/user/login/';
        $credentials = [
            "grant_type" => "password",
            "username"   => "api.chainraise",
            "password"   => "ChangeMe24!"
        ];
        $loginResponse = Http::post($loginEndpoint, $credentials);
        $accessToken = $loginResponse['token']['access_token'];
        return $accessToken;
    }


    public function refreshToken()
    {
        $refresh_token = session('refresh_token');
        $refresh_token_url = $this->endpoint.'/user/refresh/'.$refresh_token;
        $refreshResponse = Http::get($refresh_token_url);
        $jsonResponse = json_decode($refreshResponse->body(), true);

        $accessToken = $jsonResponse['token']['access_token'];

        session(['access_token' => $jsonResponse['token']['access_token']]);
        session(['refresh_token' => $jsonResponse['token']['refresh_token']]);

        return $accessToken;
    }


    public function listing()
    {
        $accessToken = $this->login();
        return Inertia::render('Sppx/Listing', [
            'accessToken' => $accessToken,
            'profileUrl' => route('api.profile'),
        ]);
    }

    public function details($uuid)
    {

        $access_token = session('access_token');

        $cachedData = Cache::get('offer_' . $uuid);
        if ($cachedData) {
            return Inertia::render('Sppx/Detail', [
                'investUrl' => route('api.invest-now'),
                'certifyUrl'  => route('api.certify.Url'),
                'pledge'  => route('api.pledge'),
                'offer' => $cachedData,
                'loginRoute' => route('api.loginApi'),
                'checkAuthRoute' => route('api.check.auth'),
                'logOut'=> route('api.log.out'),
                'accreditation'=> route('api.setup.accreditation'),
                'registerUserRoute'=> route('api.register.api.user'),
                'profile'=> route('api.profile')
            ]);
        }
        $listingResponse = Http::get($this->endpoint.'/public/'.$uuid);
        $jsonResponse = json_decode($listingResponse->body(), true);
        Cache::put('offer_' . $uuid, $jsonResponse, 1800);
        return Inertia::render('Sppx/Detail', [
            'investUrl' => route('api.invest-now'),
            'offer' => $jsonResponse,
            'loginRoute' => route('api.loginApi')
        ]);
    }


    public function investNow(Request $request)
    {

        $uuid = $request->data;
        $access_token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/issue/'.$uuid.'/certify');
        $certifyResponse = json_decode($response->body(), true);

        if($response->successful()){
            if($certifyResponse['status']['code'] == "401"){
                return response([
                    'status' => false,
                    "initials" => false,
                    'message' => $certifyResponse['status']['reason'] . " / ".  $certifyResponse['status']['memo']
                ]);
            }


            if ($certifyResponse['status']['code'] == "200" &&   $certifyResponse['status']['memo'] == "You Must Read and Accept this Caveat" && isset($certifyResponse['accreditation']) && $certifyResponse['accreditation']['accredited'] === 'yes') {
                    return response()->json([
                        'status' => true,
                        "initials" => true,
                        "accreditation" => true, // Set accreditation to true if it's 'yes'
                        'message' => $certifyResponse['status']['reason'] . " / ".  $certifyResponse['status']['memo']
                    ]);
            }

            if($certifyResponse['status']['code'] == "200" && $certifyResponse['status']['memo'] == "You Must Read and Accept this Caveat" ){

                return response([
                    'status' => false,
                    "initials" => true,
                    "accreditation" => false,
                    'message' => $certifyResponse['status']['reason'] . " / ".  $certifyResponse['status']['memo']
                ]);
            }


            return response([
                'status'  => false,
                'message' => "Your accreditation process is not complete.",
                'data'    => $certifyResponse
            ]);
        }



    }

    public function pledge($uuid)
    {



// url = "https://" + host + "/api/v0/investor/portfolio/"

        $access_token = session('access_token');


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/investor/portfolio/');
        $portfolioResponse = json_decode($response->body(), true);
        dd("portfolio",$portfolioResponse);


            // array:2 [▼ // app\Http\Controllers\SPPX\ApiController.php:136
            // "status" => array:3 [▼
            // "code" => "200"
            // "reason" => "OK"
            // "memo" => "Count = 1"
            // ]
            // "issue" => array:4 [▼
            // "uuid" => "26aa2259-52e9-4b07-8bfc-2cb51db3773f"
            // "id" => "CR-BLOCKCOFFEE"
            // "name" => "Block Heads Coffee Shop"
            // "txn" => array:5 [▼
            // "uuid" => "6ebf35d6-57f6-44f7-a7eb-cf671e0fefeb"
            // "timestamp" => "2024-03-18 12:48:22"
            // "txid" => "20240318-1787"
            // "amount" => "10250.00"
            // "status" => "Approved"
            // ]
            // ]
            // ]


        // //ach/enroll  Get
        //  $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->get($this->endpoint.'/ach/enroll');
        // $achEnroll = json_decode($response->body(), true);

        // dd($achEnroll);


        //ach/enroll  Post
        //Get Profile
        // $profileInfo = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->get($this->endpoint.'/user/profile');
        // $jsonResponse = json_decode($profileInfo->body(), true);
        // $requestData = [
        //     'accept' => "yes",
        //     'initials' => $jsonResponse['user']['name']['initials']
        // ];
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->post($this->endpoint.'/ach/enroll',$requestData);
        // $achEnroll = json_decode($response->body(), true);


        //ach/Add
        // $requestData = [
        //     'bank' => [
        //         'routing' => "021000021",
        //         'account' => "344751051239",
        //         'type' => "checking",
        //         'owner' => "Team FlowerBot",
        //         'nickname' => "Test Bonk Account",
        //     ],
        // ];

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->post($this->endpoint.'/ach/add',$requestData);
        // $achAdd = json_decode($response->body(), true);

        // $requestData = [
        //     'bank' => [
        //         'thirdparty' => "plaid",
        //     ],
        // ];

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->post($this->endpoint.'/ach/efdc4074-4f17-477e-996c-db933d7a6185/verify',$requestData);
        // $verifyAch = json_decode($response->body(), true);

        // dd($verifyAch);

        /// response

//         array:1 [▼ // app\Http\Controllers\SPPX\ApiController.php:196
//   "status" => array:3 [▼
//     "code" => "200"
//     "reason" => "Ok"
//     "memo" => "Bank account is verified"
//   ]
// ]



        // Got Detail When bank was connected
        // "uuid" => "efdc4074-4f17-477e-996c-db933d7a6185"
        // "status" => "Unconfirmed"
        // "routing" => "021000021"
        // "account" => "344751051239"
        // "type" => "checking"
        // "owner" => "Team FlowerBot"
        // "nickname" => "Test Bonk Account"

      //  dd($achAdd);



        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->get($this->endpoint.'/issue/'.$uuid.'/pledge');
        // $pledgeResponse = json_decode($response->body(), true);



         //dd($pledgeResponse);
            // ach enroll
        // $requestData = [
        //     'accept' => "yes",
        //     'initials' => "MSJ"
        // ];
        // $achEnroll = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->post($this->endpoint.'/ach/enroll', $requestData);

        // $achEnrollResponse = json_decode($achEnroll->body(), true);

        // dd($achEnrollResponse);
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->get($this->endpoint.'/ach/enroll');
        // $achEnroll = json_decode($response->body(), true);
           //dd($pledgeResponse);




       //  #10 Get Fund Plege : "https://" + host + "/api/v0/txn/{UUID_TXN}/fund"


        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->get($this->endpoint.'/txn/6ebf35d6-57f6-44f7-a7eb-cf671e0fefeb/fund');
        // $txnFund = json_decode($response->body(), true);


        // dd($txnFund);

    //  #11 Get Fund

        // $requestData = [
        //     'fund' => [
        //         'method' => [
        //             "source" => "ach",
        //             "uuid" => "efdc4074-4f17-477e-996c-db933d7a6185"
        //         ],
        //     ],
        // ];
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->post($this->endpoint.'/txn/6ebf35d6-57f6-44f7-a7eb-cf671e0fefeb/fund',$requestData);
        // $txnFund = json_decode($response->body(), true);


        // dd($txnFund);


        /// response

    //         array:2 [▼ // app\Http\Controllers\SPPX\ApiController.php:295
    //   "status" => array:2 [▼
    //     "code" => "200"
    //     "reason" => "OK"
    //   ]
    //   "txn" => array:6 [▼
    //     "uuid" => "6ebf35d6-57f6-44f7-a7eb-cf671e0fefeb"
    //     "timestamp" => "2024-03-19 14:52:29"
    //     "txid" => "20240318-1787"
    //     "amount" => "1025000"
    //     "status" => "Funding"
    //     "issue" => array:3 [▼
    //       "uuid" => "26aa2259-52e9-4b07-8bfc-2cb51db3773f"
    //       "id" => "CR-BLOCKCOFFEE"
    //       "name" => "Block Heads Coffee Shop"
    //     ]
    //   ]
    // ]


        // Check if the status code is a temporary redirect (307)
        if (isset($pledgeResponse['status']['code']) && $pledgeResponse['status']['code'] == "307") {
            // Pass the redirect message to the view
            $redirectMessage = $pledgeResponse['status']['memo'];
            return Inertia::render('Sppx/Pledge', [
                'uuid' => $uuid,
                'submitPledge' => route('api.pledge.submit'),
                'redirectMessage' => $redirectMessage,
            ]);
        }

        // Pass pledge details to the view if available
        return Inertia::render('Sppx/Pledge', [
            'uuid' => $uuid,
            'submitPledge' => route('api.pledge.submit'),
            'pledgeResponse' => $pledgeResponse,
        ]);



    }
    public function pledgeSubmit(Request $request)
    {

        $access_token = session('access_token');
        $requestData = [
            'pledge' => $request->pledge,
            'affirm' => [
                'ustaxpayer' => $request->affirm['ustaxpayer'],
                'education' => $request->affirm['education'],
                'risk' => $request->affirm['risk'],
                'cancel' => $request->affirm['cancel'],
                'resale' => $request->affirm['resale'],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/issue/'.$request->uuid.'/pledge', $requestData);
        $pledgeResponse = json_decode($response->body(), true);
        if($response->successful()){
            if($pledgeResponse['status']['code'] == "200"){
                return response([
                    'status' => true,
                    'txid' => $pledgeResponse['txn']['txid']
                ]);
            }
        }else{
            return response([
                'status' => false,
            ]);
        }



    }


    public function pledgePortfolio(Request $request){

        return Inertia::render('Sppx/PledgePortfolio');


    }










    // public function listing(){


    //     // $accessToken = $this->login();
    //     // $listingEndpoint = 'https://crdev.sppx.io/api/v0/public';
    //     // $listingResponse = Http::withHeaders([
    //     //     'Authorization' => 'Bearer ' . $accessToken,
    //     // ])->get($listingEndpoint);
    //     // $jsonResponse = json_decode($listingResponse->body(), true);
    //     return view('sppx.index',compact('jsonResponse'));
    // }

    public function loginApi(Request $request)
    {

        $sessionId = $request->session()->getId();
        $cachedToken = Cache::get('access_token_' . $request->username);
        if ($cachedToken) {
            return response([
                'status' => true,
                'code' => 200,
                'message' => 'Token already exists in cache',
                'token' => $cachedToken

            ]);
        }

        $response = Http::post('https://crdev.sppx.io/api/v0/user/login/', [
            'grant_type' => 'password',
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $data = json_decode($response->body(), true);
        if ($response->successful()) {
            $expiresIn = $data['token']['expires_in'] ?? 1800;
           // Cache::put('access_token_' . $request->username, $data['token']['access_token'], $expiresIn);
            // Cache::put('access_session_token_' . $sessionId, $data['token']['access_token'], $expiresIn);
            session(['access_token' => $data['token']['access_token']]);
            session(['refresh_token' => $data['token']['refresh_token']]);
            $access_token = session('access_token');



            return response([
                'status' => true,
                'code' => $data['status']['code'],
                'message' => $data['status']['memo'],
                'token'=> $data['token']['access_token']
            ]);
        } else {
            return response([
                'status' => false,
                'code' => $data['status']['code'],
                'message' => $data['status']['memo'],
            ]);
        }
    }

    public function register()
    {
        $accessToken = $this->login();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post('https://crdev.sppx.io/api/v0/user/register', [
            'user' => [
                'username' => request('username'),
                'email' => request('email'),
                'password' => request('password'),
            ],
        ]);

        $data = json_decode($response->body(), true);

        if ($response->successful()) {
            // If registration is successful, redirect to a dashboard or another page
            return "Registration successful";
        } elseif ($response->status() == 307 && $data['status']['memo'] == 'User mail already exists') {
            // If user email already exists, redirect to the login page with an error message
            return redirect()->back()->with('error', 'User email already exists. Please login.');
        } else {
            // If registration fails for other reasons, redirect back to the registration form with an error message
            return redirect()->back()->with('error', $data['status']['memo'] ?? 'Registration failed');
        }
    }

    public function ProfilePage(){

        $access_token = session('access_token');
        $profileInfo = Http::withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/user/profile');
        $jsonResponse = json_decode($profileInfo->body(), true);
      //  dd($jsonResponse);
        return Inertia::render('Sppx/Profile', [
            'accessToken' => $access_token,
            'profileDetail'=> $jsonResponse,
            'profileUrl' => route('api.profile'),
            'updateProfileUrl' => route('api.profile.update')
        ]);

    }

    public function ProfileUpdate(Request $request){

        $userData = $request->input('user');
        $access_token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/user/profile', [
            'user' => [
                'name' => [
                    'first' => $userData['name']['first'],
                    'middle' => $userData['name']['middle'],
                    'last' => $userData['name']['last'],
                    'initials' => $userData['name']['initials'],
                    'email' => $userData['email'], // Moved email here
                ],
                'address' => [
                    'name' => $userData['address']['name'],
                    'street' => $userData['address']['street'],
                    'unit' => $userData['address']['unit'],
                    'city' => $userData['address']['city'],
                    'state' => $userData['address']['state'],
                    'zipcode' => $userData['address']['zipcode'],
                    'country' => $userData['address']['country'],
                ],
                'phone' => [
                    'name' => $userData['phone']['name'], // Assuming 'name' should be part of the phone details
                    'number' => $userData['phone']['number'],
                    'type' => $userData['phone']['type'],
                ],
            ],
        ]);
        $jsonResponse = json_decode($response->body(), true);

        if ($response->successful()) {
            if($jsonResponse['status']['code'] == "200"){
                return response([
                    'status' => true,
                    'message' => $jsonResponse['status']['reason']
                ]);
            }
        }


    }




    public function checkAuth(Request $request){
        $isLogin = session('access_token');
        if ($isLogin ==  true) {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Token exists in cache',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'Token does not exist in cache'
            ]);
        }

    }

    public function logOut(Request $request){

        $token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($this->endpoint.'/user/logout');
        $jsonResponse = json_decode($response->body(), true);
        if ($response->successful()) {
            $forget = session()->forget('access_token');
            return response()->json([
                'status' => true,
            ]);
        }

    }


    public function accreditationSetup($uuid){



            $access_token = session('access_token');
            $certifyResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            ])->get($this->endpoint.'/issue/'.$uuid.'/certify');

            $certifyResponseJson = json_decode($certifyResponse->body(), true);


            // Get User Profile


            $profileInfo = Http::withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
            ])->get($this->endpoint.'/user/profile');
            $profile = json_decode($profileInfo->body(), true);

            $dataForView = [];
            if ($certifyResponse->successful() &&  $certifyResponseJson['status']['code'] == "200" && $certifyResponseJson['status']['reason'] == "OK") {

                if (isset($certifyResponseJson['accreditation'])) {
                    $dataForView['accreditation'] = $certifyResponseJson['accreditation'];
                } else {
                    $dataForView['accreditation'] = []; // Set to empty array if accreditation data does not exist
                }
            }
            return Inertia::render('Sppx/AccreditationSetup', [
                'accessToken' => $access_token,
                'saveAccreditation' => route('api.save.accreditation'),
                'uuid' => $uuid,
                'profile' =>$profile,
                'dataForView' => $dataForView // Pass data to view
            ]);



    }

    public function accreditationSetupSave(Request $request){
        $data = [
            'accept' => 'yes',
            'initials' => $request->initials, // Set your initials here
            'accreditation' => [
                'accredited' => 'yes',
                'income' => $request->income,
                'joint' => 'no',
                'networth' => $request->networth,
                'regcf' => $request->regcf,
                'dno' => 'yes',
                'exam' => 'Series 82'
            ]
        ];

        $access_token = session('access_token');
        $certifyResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/issue/'.$request->uuid.'/certify',$data);
        $certifyResponseJson = json_decode($certifyResponse->body(), true);

        if ($certifyResponse->successful()) {
            if($certifyResponseJson['status']['code'] == "200"){
                return response([
                    'status' => true,
                    'message' => $certifyResponseJson['status']['reason'] . " / ".  $certifyResponseJson['status']['memo']
                ]);
            }

            if($certifyResponseJson['status']['code'] == "401"){
                return response([
                    'status' => false,
                    'message' => $certifyResponseJson['status']['reason'] . " / ".  $certifyResponseJson['status']['memo']
                ]);
            }

        } else {

            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Error saving accreditation. Please try again later.',
                // You can include any additional data you want to send back to the client
            ], 500);
        }



    }


    public function registerModel(Request $request)
    {

        $accessToken = $this->login();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post('https://crdev.sppx.io/api/v0/user/register', [
            'user' => [
                'username' => request('reg_username'),
                'email' => request('reg_email'),
                'password' => request('reg_password'),
            ],
        ]);

        $data = json_decode($response->body(), true);

        if ($response->successful()) {
            if($data['status']['code'] == "403" ){
                return response()->json([
                    'status' => false,
                    'message'=> $data['status']['memo']
                ]);
            }

            // If registration is successful, redirect to a dashboard or another page
            return response()->json([
                'status' => true,
                'message'=>"Registration successful"
            ]);

        } elseif ($response->status() == 422 && isset($data['errors']) && $data['errors']['email']) {
            // If user email already exists, redirect to the login page with an error message

            return response()->json([
                'status' => false,
                'message'=>"User email already exists. Please login."
            ]);

        } else {
            // If registration fails for other reasons, redirect back to the registration form with an error message

            return response()->json([
                'status' => false,
                'message'=>$data['status']['memo'] ?? 'Registration failed'
            ]);


        }
    }








}
