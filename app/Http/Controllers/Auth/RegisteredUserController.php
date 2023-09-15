<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\EmailLog;
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
        $data = " <h4>  Hi  $user->name , </h4>
                  <p>We are excited to have you onboard at <b>
                  <a href=''> ChainRaise </a>
                  </b>! We are the only investment crowdfunding platform focused on helping innovative businessess and startups raise capital . You can get started ny exploring our <a href=''>Verify Email</a>  of investment opportunities to see if there are any issuers you would like to support with your investment.
                  <br/><br/>
                  If you need information on how to use the site or about crowdfunction regulations check out the FAQs page and Knowlegde Center to get Started.
                  <br/><br/>
                    Remember, any person who promotes an issuer's offering for compensation, whetjer past or prospective, or who is a founder or an employee of an issuer that engages in promotional activities on behaif of the issuers throught Test Company, must clearlu disclose an all communications the receipt of the compensation, and that he or she is engaginf in promotional activities on behalf of the issuer.
                    <br/><br/>
                    ChainRaise is compensated by charging issuers a fee based on a percentage of the amount being raised.
                    <br/><br/>
                    Please contact us if you have any questions.
                    <br/><br/>
                    <a href=''> Verify Email </a>
                    <br/><br/>
                Thank you,
                The ChainRaise Team";

        try{
            Mail::to($user->email)->send(new WelcomeEmail($user));
            $emailRecord = new EmailLog;
            $emailRecord->type = 'user created';
            $emailRecord->status = 'send';
            $emailRecord->to = $user->email;
            $emailRecord->from = env('MAIL_FROM_ADDRESS');
            $emailRecord->subject = 'New User Created';
            $emailRecord->body = $data;
            $emailRecord->save();

        }catch(Exception $e){

        }

        event(new Registered($user));
        //return redirect()->route('dashboard');
        Auth::login($user);
        return redirect(RouteServiceProvider::PROFILE);
    }
}
