<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {

        $orders = Order::all();

        $transactions = [];
        $lastInsertedDate = [];
        $totalInvested = [];
        if(Auth::user()->hasRole('issuer')){
            $lastInsertedRecord = Transaction::latest()->where('investor_id', Auth::user()->id)->first();
            if ($lastInsertedRecord) {
                $lastInsertedDate = $lastInsertedRecord->created_at;
            } else {
                $lastInsertedDate = '--';
            }
            $totalInvested = Order::where('investor_id', Auth::user()->id)->sum('total');
            $transactions = Transaction::with('offer', 'user')->where('investor_id', Auth::user()->id)->get();
        }
        $offers = Offer::get();
        $users = User::count();
        $investors = User::role('investor')->count();
        $raised_amount = Order::sum('total');
       return view('dashboard',compact('offers','users','investors','raised_amount','transactions','lastInsertedDate','totalInvested'));
    }


    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }


}
