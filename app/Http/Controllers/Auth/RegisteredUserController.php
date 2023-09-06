<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
        $user = User::find(1);

        //Mail::to('junjuiag@gmail.com')->send(new WelcomeEmail());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'last_name' => '-',
            'email_verified_at' => Carbon::now(),

            'agree_consent_electronic'=>true,
            'status'=>'inactive',
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('investor');
        Mail::to($user->email)->send(new WelcomeEmail($user));
        event(new Registered($user));
        //return redirect()->route('dashboard');
        Auth::login($user);
        return redirect(RouteServiceProvider::PROFILE);
    }
}
