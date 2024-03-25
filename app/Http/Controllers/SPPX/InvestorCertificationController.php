<?php

namespace App\Http\Controllers\SPPX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
class InvestorCertificationController extends Controller
{
    public $endpoint;

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

    public function __construct()
    {
        $this->endpoint = "https://crdev.sppx.io/api/v0";

    }
    public function investorCertification($uid){

        $access_token = session('access_token');

        $profileInfo = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/user/profile');
        $profile = json_decode($profileInfo->body(), true);
        $certifyResponse = Http::withHeaders([
        'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/issue/'.$uid.'/certify');
        $certifyResponseJson = json_decode($certifyResponse->body(), true);

        $dataForView = [];
        if ($certifyResponse->successful() &&  $certifyResponseJson['status']['code'] == "200" && $certifyResponseJson['status']['reason'] == "OK") {
            if (isset($certifyResponseJson['accreditation'])) {
                $dataForView['accreditation'] = $certifyResponseJson['accreditation'];
            } else {
                $dataForView['accreditation'] = []; // Set to empty array if accreditation data does not exist
            }
        }
        return Inertia::render('Sppx/Investor/Certification', [
            'accessToken' => $access_token,
            'uuid' => $uid,
            'profile' => $profile,
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


    public function pledgePortfolio($uuid)
    {

        $access_token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/issue/'.$uuid.'/pledge');
        $pledgeResponse = json_decode($response->body(), true);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/issue/'.$uuid.'/certify');
        $certifyResponse = json_decode($response->body(), true);


        $profileInfo = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/user/profile');
        $profileInfoResponse = json_decode($profileInfo->body(), true);

        $data = [
            'accept' => 'yes',
            'initials' => $profileInfoResponse['user']['name']['initials'], // Set your initials here
            'accreditation' => [
                'accredited' => 'yes',
                'income' => $certifyResponse['accreditation']['income'],
                'joint' => 'no',
                'networth' => $certifyResponse['accreditation']['networth'],
                'regcf' => $certifyResponse['accreditation']['regcf'],
                'dno' => 'yes',
                'exam' => 'Series 82'
            ]
        ];
        $certifyPost = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/issue/'.$uuid.'/certify',$data);
        $certifyResponse = json_decode($certifyPost->body(), true);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/investor/portfolio/');
        $portfolioResponse = json_decode($response->body(), true);
        $issues = [];
        $matchingIssue = null;

        if($portfolioResponse != null){
            if ($response->successful() &&  $portfolioResponse['status']['code'] == "200" && $portfolioResponse['status']['reason'] == "OK") {

                if(isset($portfolioResponse['issues'])){
                    $issues = $portfolioResponse['issues'];
                    foreach ($issues as $issue) {
                        if ($issue['uuid'] === $uuid) {
                            $matchingIssue = $issue;
                            break; // Stop searching once the matching issue is found
                        }
                    }
                }else{
                    $issue = $portfolioResponse['issue'];
                    if ($issue['uuid'] === $uuid) {
                        $matchingIssue = $issue;
                    }
                }

            }
        }
        return Inertia::render('Sppx/Investor/PledgePortfolio', [
            'uuid' => $uuid,
            'data' => $matchingIssue,
            'pledge' => $pledgeResponse
        ]);



    }
    public function pledgeSubmit(Request $request)
    {

        $access_token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/issue/'.$request->uuid.'/certify');
        $certifyResponse = json_decode($response->body(), true);

        $profileInfo = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/user/profile');
        $profileInfoResponse = json_decode($profileInfo->body(), true);
        $data = [
            'accept' => 'yes',
            'initials' => $profileInfoResponse['user']['name']['initials'], // Set your initials here
            'accreditation' => [
                'accredited' => 'yes',
                'income' => $certifyResponse['accreditation']['income'],
                'joint' => 'no',
                'networth' => $certifyResponse['accreditation']['networth'],
                'regcf' => $certifyResponse['accreditation']['regcf'],
                'dno' => 'yes',
                'exam' => 'Series 82'
            ]
        ];

        $certifyPost = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/issue/'.$request->uuid.'/certify',$data);
        $certifyResponse = json_decode($certifyPost->body(), true);

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


    public function pledgeCancel($uuid)
    {

        $access_token = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/txn/'.$uuid.'/cancel');
        $cancelResponse = json_decode($response->body(), true);

        if($response->successful()){
            if($cancelResponse['status']['code'] == "200"){
                return response([
                    'status' => true,
                    "massage" => $cancelResponse['status']['memo']
                ]);
            }elseif($cancelResponse['status']['code'] == "403"){
                    return response([
                        'status' => false,
                        "massage" => $cancelResponse['status']['memo']
                    ]);
            }
        }else{
            return response([
                'status' => false,
            ]);
        }

    }


    public function achEnroll($uuid,$txn)
    {


        $access_token = session('access_token');
        //Get Profile
        $profileInfo = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/user/profile');
        $jsonResponse = json_decode($profileInfo->body(), true);
        $requestData = [
            'accept' => "yes",
            'initials' => $jsonResponse['user']['name']['initials']
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/ach/enroll',$requestData);
        $achEnroll = json_decode($response->body(), true);
        return Inertia::render('Sppx/Investor/AchEnroll',[
            'offer_uuid' => $uuid,
            'pledge_txn' => $txn,
        ]);

    }


    public function achAdd(Request $request)
    {
        $access_token = session('access_token');
        $requestData = [
            'bank' => [
                'routing' => $request['formData']['routing'],
                'account' => $request['formData']['account'],
                'type' => $request['formData']['type'],
                'owner' => $request['formData']['owner'],
                'nickname' => $request['formData']['nickname'],
            ],
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/ach/add',$requestData);
        $achAdd = json_decode($response->body(), true);
        // Get Bank Details From Above Endpoint
        if($response->successful()){
           // dd($achAdd);
            if($achAdd['status']['code'] == "200"){
                $requestData = [
                    'bank' => [
                        'thirdparty' => "plaid",
                    ],
                ];
                $uuid = $achAdd['bank']['uuid'];
                $verifyResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $access_token,
                ])->post($this->endpoint.'/ach/'.$uuid.'/verify',$requestData);
                $verifyAch = json_decode($verifyResponse->body(), true);
                if($verifyResponse->successful()){
                    if($verifyAch['status']['code'] == "200"){
                        return response([
                            'status' => true,
                            'message' => $verifyAch['status']['memo'],
                            'pledge_txn' => $request['formData']['pledge_txn']
                        ]);
                    }
                }

                return response([
                    'status' => true,
                    'message' => $achAdd['status']['memo'],
                ]);
            }elseif($achAdd['status']['code'] == "404"){
                return response([
                    'status' => false,
                    'message' => $achAdd['status']['memo'],
                ]);
            }else{

                return response([
                    'status' => false,
                    'message' => $achAdd['status']['memo'],
                ]);
            }
        }



    }

    public function fund($UUID_TXN){

        $access_token = session('access_token');
        $fundRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->get($this->endpoint.'/txn/'.$UUID_TXN.'/fund');
        $response = json_decode($fundRequest->body(), true);
        if($fundRequest->successful()){

            if ($fundRequest['status']['code'] === '200' && isset($response['fund']) && !empty($response['fund'])) {

                return Inertia::render('Sppx/Investor/Fund', [
                    'options' => $response['fund'],
                    'UUID_TXN' =>$UUID_TXN
                ]);
            }
        }
    }

    public function postFund(Request $request){

        $access_token = session('access_token');

         $requestData = [
            'fund' => [
                'method' => [
                    "source" => $request->source,
                    "uuid" => $request->UUID_TXN
                ],
            ],
        ];


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post($this->endpoint.'/txn/'.$request->UUID_TXN.'/fund',$requestData);

        $responseJson = json_decode($response->body(), true);

        if($response->successful()){
            if($responseJson['status']['code'] == "200"){
                return response([
                    'status' => true,
                ]);
            }elseif($responseJson['status']['code'] == "404"){
                return response([
                    'status' => true,
                    'message' => $responseJson['status']['memo']
                ]);
            }
        }
    }


    public function investmentPortfolio(){
        return Inertia::render('Sppx/Investor/InvestmentPortfolio', [
        ]);
    }











}
