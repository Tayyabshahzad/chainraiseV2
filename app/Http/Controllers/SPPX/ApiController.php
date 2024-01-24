<?php

namespace App\Http\Controllers\SPPX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
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
        $accessToken = $this->login();
        $listingResponse = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $accessToken,
         ])->get($this->endpoint.'/public/'.$uuid);
        //  https://{{sppx-host}}/api/v0/public/26aa2259-52e9-4b07-8bfc-2cb51db3773f
        $jsonResponse = json_decode($listingResponse->body(), true);

        return Inertia::render('Sppx/Detail', [
            'accessToken' => $accessToken,
            'investUrl' => route('api.invest-now'),
            'offer'=> $jsonResponse,
        ]);
    }


    public function investNow()
    {
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

    public function loginApi()
{
    $response = Http::post('https://crdev.sppx.io/api/v0/user/login/', [
        'grant_type' => 'password',
        'username' => request('username'),
        'password' => request('password'),
    ]);

    $data = json_decode($response->body(), true);
    if ($response->successful()) {
        // If login is successful, store the access token in the session
        session(['access_token' => $data['token']['access_token']]);

        // Redirect to a dashboard or another page
        return "Welcome to Dashboard";
    } else {
        // If login fails, redirect back to the login form with an error message
        return redirect()->back()->with('error', $data['status']['memo'] ?? 'Invalid credentials');
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


}
