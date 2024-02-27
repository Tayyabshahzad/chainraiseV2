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
            "username" => "zideqyxij",
            "password" => "123123123"
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
                'offer' => $cachedData,
                'loginRoute' => route('api.loginApi'),
                'checkAuthRoute' => route('api.check.auth')
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
        dd($request);
        return Inertia::render('Sppx/Invest');
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
            session(['is_login' => true]);

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


        $accessToken = $this->login();
        $profileInfo = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
        ])->get($this->endpoint.'/user/profile');
        $jsonResponse = json_decode($profileInfo->body(), true);
        return Inertia::render('Sppx/Profile', [
            'accessToken' => $accessToken,
            'profileDetail'=> $jsonResponse,
            'profileUrl' => route('api.profile'),
        ]);

    }

    public function checkAuth(Request $request){

    //s   dd(session(['is_login']));
        $isLogin = session('is_login');
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


}
