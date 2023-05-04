<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InitialSetupController extends Controller
{
    public function index(){
        return view('initialsetup');
    }
}
