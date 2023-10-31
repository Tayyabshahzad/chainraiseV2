<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
class TransactionController extends Controller
{

    private $baseUrl;
    private $authUrl;
    public function __construct()
    {
        $environment = config('app.env');
        $this->baseUrl = config('credentials.api.' . $environment);
        $this->authUrl = config('credentials.auth0.' . $environment);
    }



    public function index()
    {
        if(Auth::user()->hasRole('issuer')){

            $userId = Auth::user()->id;
            $transactions = Transaction::with('offer','user')->orderBy('id', 'desc')->whereHas('offer', function ($query) use ($userId) {
                $query->where('issuer_id', $userId);
            })->paginate(15);

        }else{
            $transactions = Transaction::with('offer','user')->orderBy('id', 'desc')->paginate(15);
        }

        return view('transaction.index',compact('transactions'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
        ]);
        $transaction = Transaction::find($request->transaction_id);
        if(!$transaction){
            return response([
                    'status' => false,
                    'message' => 'Invalid Record'
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
                return response([
                    'status' => false,
                    'message' => 'Token Error Please Reload the Page'
                ]);
            }
        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Internal Server Error [Token]'.$error);
        }

        $url = $this->baseUrl.'/api/trust/v1/payments/'.$transaction->transaction_id.'/cancel';
        try {
            $transactions_process = Http::withToken($token_json['access_token'])->put($url);
            $transactions_json =  json_decode((string) $transactions_process->getBody(), true);
            if ($transactions_process->failed()) {
                return response([
                    'status' => false,
                    'message' =>  $transactions_json['title']
                ]);
            }
            return response([
                'status' => true,
                'message' =>  $transactions_json['title']
            ]);
        } catch (Exception $error) {
            return response([
                'status' => false,
                'message' =>  $error
            ]);
        }




    }
}
