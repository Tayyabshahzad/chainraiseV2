<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

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
}
