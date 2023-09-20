<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
class DashboardController extends Controller
{
    public function index()
    {
        $offers = Offer::get();
        $users = User::count();
        $investors = User::role('investor')->count();
        $raised_amount = Order::sum('total');
       return view('dashboard',compact('offers','users','investors','raised_amount'));
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
