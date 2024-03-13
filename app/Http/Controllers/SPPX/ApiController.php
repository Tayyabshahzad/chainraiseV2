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
                'registerUserRoute'=> route('api.register.api.user')
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
                    'message' => $certifyResponse['status']['reason'] . " / ".  $certifyResponse['status']['memo']
                ]);
            }
            if($certifyResponse['status']['code'] == "200"){ 
                return response([
                    'status' => true,
                    'message' => $certifyResponse['status']['reason'] . " / ".  $certifyResponse['status']['memo']
                ]);
            }

            if (isset($certifyResponse['accreditation']) && $certifyResponse['accreditation']['accredited'] === 'yes') {
                return response([
                    'status' => true,
                    'message' => "Your accreditation process is complete. Please Click on Invest Now Button",
                    'data' => $certifyResponse
                ]);
            } else {

                return response([
                    'status'  => false,
                    'message' => "Your accreditation process is not complete.",
                    'data'    => $certifyResponse
                ]);

            }
        }



    }

    public function pledge($uuid)
    {
        

        $access_token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/issue/'.$uuid.'/pledge');
        $pledgeResponse = json_decode($response->body(), true);


        
       // dd($pledgeResponse);
        return Inertia::render('Sppx/Pledge', [
            'uuid' => $uuid, 
        ]);

        

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
        dd($jsonResponse);
        
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

    //s   dd(session(['is_login']));
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

        $accessToken = $this->login();
        return Inertia::render('Sppx/AccreditationSetup', [
            'accessToken' => $accessToken,
            'saveAccreditation' => route('api.save.accreditation'),
            'uuid' => $uuid,
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
        dd($certifyResponseJson);
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
