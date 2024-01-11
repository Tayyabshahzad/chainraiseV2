<?php

namespace App\Http\Controllers\SPPX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ApiController extends Controller
{

    public function login()
    {
        // Your login API endpoint and credentials
        $loginEndpoint = 'https://crdev.sppx.io/api/v0/user/login/';
        $credentials = [
            "grant_type" => "password",
            "username" => "api.chainraise",
            "password" => "Westridge151!"
        ];

        // Make the login API request
        $loginResponse = Http::post($loginEndpoint, $credentials);

        // Extract the access token
        $accessToken = $loginResponse['token']['access_token'];

        // Use the access token in subsequent requests or store it securely

        return $accessToken;
    }


    public function listing(){
        $accessToken = $this->login();
        $listingEndpoint = 'https://crdev.sppx.io/api/v0/public';
        $listingResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get($listingEndpoint);
        $jsonResponse = json_decode($listingResponse->body(), true);

        return view('sppx.index',compact('jsonResponse'));
    }

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


}
