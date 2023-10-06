<?php

namespace App\Http\Controllers\User;

use App\Models\EmailLog;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Folder;
use App\Mail\WelcomeEmail;
use App\Models\UserDetail;
use App\Models\MyEDocument;
use App\Mail\InvesterUpdate;
use App\Models\Esign;
use App\Models\TrustSetting;
use Illuminate\Http\Request;
use App\Models\Accreditation;
use App\Mail\UserStatusUpdate;
use App\Mail\IssuerSubAcccount;
use App\Models\InvesmentProfile;
use Illuminate\Support\Facades\DB;
use App\Mail\InvestorAccountDelete;
use App\Http\Controllers\Controller;
use App\Models\IdentityVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function custom_login($email,$password)
    {

        $credentials = ([
            'email' => $email,
            'password' => $password,
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            return [
                'status' => true,
                'message' => 'User Verified'
            ];
             // Url  redirect-user/{email}/{password}

       }else{
           return response()->json([
               'status' => true,
               'status_code' => 200,
               'message' => "No user found with given username or email",
           ], 404);
       }

        return $credentials;

    }
    public function redirection($email,$password){

        $credentials = ([
            'email' => $email,
            'password' => $password,
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended('dashboard');
       }else{
          // Url  redirect-user/{email}/{password}
           return response()->json([
               'status' => true,
               'status_code' => 200,
               'message' => "No user found with given username or email",
           ], 404);
       }



    }
    public function index(Request $request)
    {
        

          $offers = Offer::get();
          $users = User::with('userDetail')->where('is_primary','yes')->orderby('id','DESC')->
                  whereHas('roles',function($query){
                        $query->where('name', '!=', 'admin');
                  })->paginate(10);
          $issuers = User::role('issuer')->orderby('id','DESC')->get();
        return view('user.index',compact('users','offers','issuers'));
    }

    public function UpdateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::find($request->id);
        if ($user->status == 'active') {
            $user->status = 'inactive';
        }elseif($user->status == 'inactive'){
            $user->status = 'active';
        }
        $user->save();
        //Mail::to($user)->send(new UserStatusUpdate($user));
        return response([
            'status' => true,
            'message' => 'Status Updated to '.$user->status
        ]);
    }

    public function details($id)
    {

        $id = $id;
        $user = User::with('userDetail','identityVerification','trustSetting','invesmentProfie','accreditation')->find($id);
        $accreditations = Accreditation::get();
        $offers = Offer::get();
        $childs = User::with('userDetail','identityVerification','trustSetting','invesmentProfie')->where('parent_id',$id)->get();
        $folders = Folder::where('user_id',$id)->get();
        $e_documents =  MyEDocument::where('investor_id',$id)->get();
        $e_sign_documents = Esign ::where('issuer_id',$id)->get();
        $investors = User::role('investor')->get();
        $issuers = User::role('issuer')->get();
        return view('user.details',compact('user','accreditations','offers','childs','id','folders','investors','e_documents','issuers','e_sign_documents'));
    }
    public function getChilds(Request $request){

        if($request->ajax()){
            return $request->id;
            $childs = User::with('userDetail','identityVerification','trustSetting','invesmentProfie')->where('parent_id',$id);
            return Datatables::of($childs)
            ->make(true);
        }
    }
    public function list()
    {
        $users = User::get();
        return response([
            'users' => $users,
        ]);
    }
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->status = 'active';
            $user->email_verified_at  = Carbon::now();

            if ($user->save()) {
                return redirect()->back()->with('success', 'User has been created successfully');
            }
        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Error while creating user');
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password =  Hash::make($request->password);
            }
            $user->status = $request->status;
            if ($user->save()) {
                return redirect()->back()->with('success', 'User has been updated successfully');
            }
        } catch (Exception $error) {
            return redirect()->back()->with('error', 'Error while updating user');
        }
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        
        try {
            $user = User::find($request->id);
            Mail::to($user)->send(new InvestorAccountDelete($user));
            $data ="<p>
            Dear  $user->name ,
           Your Account Has Been Deleted
            <br>

            </p>";
            $emailRecord = new EmailLog;
            $emailRecord->type = 'account delete';
            $emailRecord->status = 'send';
            $emailRecord->to = $user->email;
            $emailRecord->from = env('MAIL_FROM_ADDRESS');
            $emailRecord->subject = 'Account deleted';
            $emailRecord->body = $data;
            $emailRecord->save();
            if ($user->delete()) {
                return response([
                    'status' => true,
                    'message' => 'User has been deleted successfully'
                ]);
            }

        } catch (Exception $error) {
//dd($error);
 return response([
                'status' => false,
                'message' => 'Error while deleting user'
            ]);
        }
    }
    public function investor()
    {
        return view('user.investor.create');
    }
    public function save(Request $request)
    {

        $request->validate([
            'email' => 'required|unique:users',
            'first_name' => 'required',
           // 'middle_name' => 'required',
            'last_name' => 'required',
            //'title' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            //'profile_avatar' => 'required',
            'address' => 'required',
            //'suit' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|min:5|max:5',
            'account_type' => 'required|in:investor,issuer',
            //'agree_consent_electronic' => 'required',
            //'password' => 'required',
        ]);

        if($request->agree_consent_electronic  == 'true'){
            $agree_consent_electronic = true;
        }else{
            $agree_consent_electronic =false;
        }

        DB::beginTransaction();
        try{
            $user = new User;
            $user->name  = $request->first_name;
            $user->email  = $request->email;
            $user->email_verified_at  = Carbon::now();
            $user->user_type  = $request->user_type;
            if($request->has('password') && $request->password != null){
                $user->password  =  Hash::make($request->password);
            }
            $user->phone  = $request->phone;
            $user->status  = 'active';
            $user->save();
            if($request->hasFile('photo')) {
                $user->addMediaFromRequest('photo')->toMediaCollection('profile_photo');
            }
            $user_detail = new UserDetail;
            $user_detail->user_id = $user->id;
            $user_detail->middle_name = $request->middle_name;
            $user_detail->last_name = $request->last_name;
            $user_detail->title = $request->title;
            $user_detail->dob = $request->dob;
            $user_detail->address = $request->address;
            $user_detail->suit = $request->suit;
            $user_detail->city = $request->city;
            $user_detail->state = $request->state;
            $user->agree_consent_electronic  = $agree_consent_electronic;
            $user_detail->zip = $request->zip_code;
            // -- This Detail is for issuer
            $user_detail->entity_name = $request->entity_name;
            $user_detail->legal_formation = $request->legal_formation;
            $user_detail->date_incorporation = $request->date_incorporation;
            // -- End Issuer detail
            $user_detail->save();
            if($request->account_type == 'investor'){
                $user->assignRole('investor');
            }elseif($request->account_type == 'issuer') {
                $user->assignRole('issuer');
            }
             event(new Registered($user));
             Mail::to($user)->send(new WelcomeEmail($user));
             $data = " <h4>  Hi  $user->name , </h4>
                <p> We are excited to have you onboard at <b>
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
                Mail::to($user->email)->send(new WelcomeEmail($user));
                $emailRecord = new EmailLog;
                $emailRecord->type = 'user created';
                $emailRecord->status = 'send';
                $emailRecord->to = $user->email;
                $emailRecord->from = env('MAIL_FROM_ADDRESS');
                $emailRecord->subject = 'New User Created';
                $emailRecord->body = $data;
                $emailRecord->save();
             DB::commit();
             return redirect()->route('user.index')->with('success','New investor user has been created');
        }catch(Exception $error){
          //  dd($error);
            DB::rollBack();
            Session::put('error','Error While Creating ');
            return redirect()->back()->with('error','Error while creating investor user'.$error);
        }
    }
    public function issuer()
    {
        return view('user.issuer.create');
    }
    public function issuerSave(Request $request)
    {


        $request->validate([
            'email' => 'required',
            'first_name' => 'required',
           // 'middle_name' => 'required',
            'last_name' => 'required',
            //'title' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            //'profile_avatar' => 'required',
            'address' => 'required',
            //'suit' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|min:5|max:5',
            'agree_consent_electronic' => 'required',
            //'password' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $user = new User;
            $user->name  = $request->first_name;
            $user->email  = $request->email;
            $user->password  =  Hash::make($request->password);
            $user->phone  = $request->phone;
            $user->email_verified_at  = Carbon::now();
            $user->user_type  = $request->user_type;
            $user->agree_consent_electronic  = $request->agree_consent_electronic;
            $user->status  = 'active';
            $user->save();
            $user_detail = new UserDetail;
            $user_detail->user_id = $user->id;
            $user_detail->middle_name = $request->middle_name;
            $user_detail->last_name = $request->last_name;
            $user_detail->title = $request->title;
            $user_detail->dob = $request->dob;
            $user_detail->address = $request->address;
            $user_detail->suit = $request->suite;
            $user_detail->city = $request->city;
            $user_detail->state = $request->state;
            $user_detail->zip = $request->zip_code;
            $user->user_type = $request->user_type;
            $user_detail->save();
            DB::commit();
            return redirect()->route('user.index')->with('success','New investor user has been created');
        }catch(Exception $error){
            DB::rollBack();
            return redirect()->back()->with('error','Error while creating investor user');
        }
    }
    public function issuerAccountUpdate(Request $request)
    {
        

        $request->validate([
            //Users Table
            'id' => 'required',
            'first_name' => 'required',
            'phone' => 'required',
            //'agree_consent_electronic' => 'required',
            // User Detail
           //'middle_name' => 'required',
           'last_name' => 'required',
           //'title' => 'required',
           'dob' => 'required',
            //'profile_avatar' => 'required',
            //'entity_name'=>'required',
            'address' => 'required',
            //'suit' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|min:5|max:5',
            //'legal_formation'=>'required',
            //'date_incorporation'=>'required',
            // Identity Verifiation
            'primary_contact_social_security' => 'required',
            //'tax_entity_type'=>'required',
            //'tax_identification'=>'required',
            'nationality' => 'required',
            'country_residence' => 'required',
            //Trust Settings
            //'bypass_account_setup' => 'required',
            //'bypass_kyc_checkup' => 'required',
            //'bypass_accreditation_checks' => 'required',
            //'bypass_document_restrictions' => 'required',
           // 'view_all_invite_offers' => 'required',
            //'allow_manual_ach_bank_input' => 'required',
        ]);

        $user = User::find($request->id);
        if($user->roles->first()->name == 'issuer'){
            $user->profile_status = true;
        }
        $user->name = $request->first_name;
        $user->phone = $request->phone;
        $user->cc = $request->cc;
        if($request->has('account_status')){
            if($user->status == 'inactive'){
                $user->status = 'active';
                Mail::to($user)->send(new UserStatusUpdate($user));
                $data = " <p> Dear  $user->name ,
                We have reviewed your account and you can now login to Chainraise to browse investment opportunities. Thank you
                <br>
                Your Current Status is : $user->status
                <small>  If you would like to opt out of receiving marketing materials please <a href=''>click here</a>  </small>
                 </p>";
                $emailRecord = new EmailLog;
                $emailRecord->type = 'status-update';
                $emailRecord->status = 'send';
                $emailRecord->to = $user->email;
                $emailRecord->from = env('MAIL_FROM_ADDRESS');
                $emailRecord->subject = 'Account Status Update';
                $emailRecord->body = $data;
                $emailRecord->save();
            }
        }

        $user->save();
        if($request->has('profile_avatar')){
            $user->clearMediaCollection('profile_photo');
            $user->addMediaFromRequest('profile_avatar')->toMediaCollection('profile_photo');
        }
        if($request->has('kyc_document')){

            $user->clearMediaCollection('kyc_document_collection');
            $user->addMediaFromRequest('kyc_document')->toMediaCollection('kyc_document_collection');
        }

        if($request->has('kyc_document_back')){

            $user->clearMediaCollection('kyc_document_collection_back');
            $user->addMediaFromRequest('kyc_document_back')->toMediaCollection('kyc_document_collection_back');
        }

        $userDetails = UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
             'middle_name' => $request->middle_name,
             'last_name' => $request->last_name,
             'title' => $request->title,
             'dob' => $request->dob,
             'city' => $request->city,
             'ein' => $request->ein,
             'naics' => $request->naics,
             'naics_description' => $request->naics_description,
             'website' => $request->website,
             'address' => $request->address, 'suit' => $request->suit,'legal_formation'=>$request->legal_formation,
             'date_incorporation'=>$request->date_incorporation,
             'state'=> $request->state,'zip'=> $request->zip,'entity_name'=>$request->entity_name
            ]
        );
        if($request->primary_contact_social_security == '999-99-9999'){
            $ssn = $user->identityVerification->primary_contact_social_security;
        }else{
            $ssn = Crypt::encryptString($request->primary_contact_social_security);
        }
        $identityVerification = IdentityVerification::updateOrCreate(
            ['user_id' => $request->id],
            [
             'primary_contact_social_security' => $ssn,
             'tax_entity_type' => $request->tax_entity_type,
             'tax_identification' => $request->tax_identification,
             'nationality' => $request->nationality,
             'doc_type' => $request->doc_type,
             'country_residence' => $request->country_residence
            ]
        );
        // $userDetails = UserDetail::where('user_id',$request->id)->first();
        // $userDetails->middle_name = $request->middle_name;
        // $userDetails->last_name = $request->last_name;
        // $userDetails->title = $request->title;
        // $userDetails->dob = $request->dob;
        // if($request->has('profile_avatar')){
        //     $user->clearMediaCollection('profile_photo');
        //     $user->addMediaFromRequest('profile_avatar')->toMediaCollection('profile_photo');
        // }
        // $userDetails->address = $request->address;
        // $userDetails->suit = $request->suit;
        // $userDetails->state = $request->state;
        // $userDetails->zip = $request->zip;
        // $userDetails->save();

        //Mail::to($user)->send(new InvesterUpdate($user));

        $trustSetting = TrustSetting::where('user_id',$request->id)->first();
        if($trustSetting){
            if($request->bypass_account_setup){
                $trustSetting->bypass_account_setup = true;
            }else{
                $trustSetting->bypass_account_setup = false;
            }
            if($request->bypass_kyc_checkup){
                $trustSetting->bypass_kyc_checkup = true;
            }else{
                $trustSetting->bypass_kyc_checkup = false;
            }
            if($request->bypass_accreditation_checks){
                $trustSetting->bypass_accreditation_checks = true;
            }else{
                $trustSetting->bypass_accreditation_checks = false;
            }
            if($request->bypass_document_restrictions){
                $trustSetting->bypass_document_restrictions = true;
            }else{
                $trustSetting->bypass_document_restrictions = false;
            }
            if($request->view_all_invite_offers){
                $trustSetting->view_all_invite_offers = true;
            }else{
                $trustSetting->view_all_invite_offers = false;
            }

            if($request->allow_manual_ach_bank_input){
                $trustSetting->allow_manual_ach_bank_input = true;
            }else{
                $trustSetting->allow_manual_ach_bank_input = false;
            }

            if($request->e_sign_agreement){
                $trustSetting->e_sign_agreement = true;
            }else{
                $trustSetting->e_sign_agreement = false;
            }

            if($request->disclosures){
                $trustSetting->disclosures = true;
            }else{
                $trustSetting->disclosures = false;
            }
            $trustSetting->save();

        }else{
            $trustSetting = new TrustSetting;
            $trustSetting->user_id = $request->id;
            if($request->bypass_account_setup){
                $trustSetting->bypass_account_setup = true;
            }else{
                $trustSetting->bypass_account_setup = false;
            }
            if($request->bypass_kyc_checkup){
                $trustSetting->bypass_kyc_checkup = true;
            }else{
                $trustSetting->bypass_kyc_checkup = false;
            }
            if($request->bypass_accreditation_checks){
                $trustSetting->bypass_accreditation_checks = true;
            }else{
                $trustSetting->bypass_accreditation_checks = false;
            }
            if($request->bypass_document_restrictions){
                $trustSetting->bypass_document_restrictions = true;
            }else{
                $trustSetting->bypass_document_restrictions = false;
            }
            if($request->view_all_invite_offers){
                $trustSetting->view_all_invite_offers = true;
            }else{
                $trustSetting->view_all_invite_offers = false;
            }

            if($request->allow_manual_ach_bank_input){
                $trustSetting->allow_manual_ach_bank_input = true;
            }else{
                $trustSetting->allow_manual_ach_bank_input = false;
            }

            if($request->e_sign_agreement){
                $trustSetting->e_sign_agreement = true;
            }else{
                $trustSetting->e_sign_agreement = false;
            }

            if($request->disclosures){
                $trustSetting->disclosures = true;
            }else{
                $trustSetting->disclosures = false;
            }



        }
        $trustSetting->save();


        return redirect()->back()->with('success','Profile has been updated');

    }
    public function invesmentUpdate(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'type'=>'required',
        ]);
        if ($request->filled('password') && !empty($request->input('password'))) {
           $user = User::find($request->id);
           $user->password  =  Hash::make($request->password);
           $user->save();
        }
        if($request->type == 'investor'){
            $request->validate([
                'net_worth' => 'required',
                'highest_education'=>'required',
                'risk_tolerance'=>'required',
                'investment_experience'=>'required',
                'age'=>'required',
                'gender'=>'required',
                'annual_net_income' => 'required'
            ]);
            $invesment = InvesmentProfile::updateOrCreate(
                ['user_id' => $request->id],
                ['net_worth' => $request->net_worth, 'highest_education' => $request->highest_education,
                 'risk_tolerance' => $request->risk_tolerance, 'investment_experience' => $request->investment_experience,
                 'age' => $request->age, 'gender' => $request->gender,'annual_net_income'=> $request->annual_net_income,]
            );
        }else{


            $data = InvesmentProfile::updateOrCreate(
                ['user_id' => $request->id],
                ['finra_crd' => $request->finra_crd, 'linkedIn' => $request->linkedin_url ,
                 'website' => $request->website_url , 'investment_style' => $request->investment_style,
                 'assets_under_management'=>$request->assets_under_management]
            );

        }


         return redirect()->back()->with('success','invesment Profile has been updated');


    }
    public function childSave(Request $request)
    {

        if($request->has('identification_information')){
           $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'phone_number' => 'required',
                //'title' => 'required',
                'birth_date' => 'required',
                //'linkedIn_url' => 'required',
                //'password' => 'required',
                'address' => 'required',
                'suite_unit' => 'required',
                'city' => 'required',
                'state_region' => 'required',
                'zip_code' => 'required',
                'social_security' => 'required',
                'nationality'=>'required',
                'country_residence'=>'required',
                'parent_id'=>'required|integer'
            ]);
        }else{
           $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'phone_number' => 'required',
                'parent_id'=>'required|integer',
                'birth_date' => 'required',
            ]);
        }
        DB::beginTransaction();
        try{
            $user = new User;
            $user->name  = $request->first_name;
            $user->email  = $request->email;
            $user->phone  = $request->phone_number;
            $user->email_verified_at  = Carbon::now();
            if($request->has('password') && $request->password != null){
                $user->password  =  Hash::make($request->password);
            }
            if($request->has('email_verified')){
                $user->email_verified_at = Carbon::now();
            }
            $user->email_verified_at = Carbon::now();
            $user->phone  = Carbon::now();
            $user->status  = 'active';
            $user->parent_id = $request->parent_id;
            $user->is_primary = 'no';
            $user->save();
            if($request->hasFile('photo')) {
                $user->addMediaFromRequest('photo')->toMediaCollection('profile_photo');
            }
            $parent_email = User::find($request->parent_id)->email;
            Mail::to($user)->send(new IssuerSubAcccount($parent_email));
            $user_detail = new UserDetail;
            $user_detail->user_id = $user->id;
            $user_detail->last_name = $request->last_name;
            $user_detail->title = $request->title;
            $user_detail->dob = Carbon::now()->format('Y-m-d');
            $user_detail->address = $request->address;
            $user_detail->suit = $request->suite_unit;
            $user_detail->city = $request->city;
            $user_detail->state = $request->state_region;
            $user_detail->zip = $request->zip_code;
            $user_detail->save();
            $identity_verification = new IdentityVerification;
            $identity_verification->user_id = $user->id;
            $identity_verification->social_security = $request->social_security;
            $identity_verification->nationality = $request->nationality;
            $identity_verification->country_residence = $request->country_residence;
            $identity_verification->save();
            $invesment_profile = new InvesmentProfile;
            $invesment_profile->user_id = $user->id;
            $invesment_profile->linkedIn = $request->linkedIn_url;
            $invesment_profile->save();
            DB::commit();
            return redirect()->route('user.details',$request->parent_id)->with('success','New user has been created');
        }catch(Exception $error){
            return $error;
            DB::rollBack();
            return redirect()->back()->with('error','Error while creating user');
        }
    }
    public function childDetails(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::with('userDetail','identityVerification','invesmentProfie','accreditation')->find($request->id);
        return response([
            'status' => true,
            'data' => $user,
            'photo' => $user->getFirstMediaUrl('profile_photo', 'thumb'),
        ]);
    }
    public function childUpdate(Request $request)
    {

        if($request->has('identification_information')){

            $request->validate([
                 'id'=>'required|integer',
                 'first_name' => 'required',
                 'last_name' => 'required',
                 'email' => 'required',
                 'phone_number' => 'required',
                 //'title' => 'required',
                 'birth_date' => 'required',
                 //'linkedIn_url' => 'required',
                 //'password' => 'required',
                 'address' => 'required',
                 'suite_unit' => 'required',
                 'city' => 'required',
                 'state_region' => 'required',
                 'zip_code' => 'required',
                 'social_security' => 'required',
                 'nationality'=>'required',
                 'country_residence'=>'required'
             ]);
         }else{

            $request->validate([
                 'first_name' => 'required',
                 'last_name' => 'required',
                 'email' => 'required',
                 'phone_number' => 'required',
                 'id'=>'required|integer',
                 'birth_date' => 'required',
             ]);

         }


         try{
             $user = User::find($request->id);
             $user->name  = $request->first_name;
             $user->email  = $request->email;
             $user->phone  = $request->phone_number;
             if($request->has('password') && $request->password != null){
                 $user->password  =  Hash::make($request->password);
             }
             $user->save();
             if($request->hasFile('photo')) {
                 $user->clearMediaCollection('profile_photo');
                 $user->addMediaFromRequest('photo')->toMediaCollection('profile_photo');
             }

                UserDetail::updateOrCreate(
                ['user_id' => $request->id],
                [
                 'last_name' => $request->last_name,
                 'title' => $request->title,
                 'dob' => $request->birth_date,
                 'address' => $request->address,
                 'suit' => $request->suite_unit,
                 'city' => $request->city,
                 'state'=> $request->state_region,
                 'zip'=> $request->zip_code
                ]);

                IdentityVerification::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                     'social_security' => $request->social_security,
                     'nationality' => $request->nationality,
                     'country_residence' => $request->country_residence
                ]);

                InvesmentProfile::updateOrCreate(
                    ['user_id' => $user->id],
                    ['linkedIn' => $request->linkedIn_url ]);
             DB::commit();
             return redirect()->route('user.details',$user->id)->with('success','New user has been created');
         }catch(Exception $error){
             return $error;
             DB::rollBack();
             return redirect()->back()->with('error','Error while creating user');
         }
    }
    public function childUDelete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        try{
            $user = User::find($request->id);
            if($user->is_primary == 'yes'){
                return response([
                    'status' => false,
                    'message' =>"Unable to delete parent user",
                ]);
            }
            $user->delete();
            return response([
                'status' => true,
                'message' =>"User has been deleted",
            ]);
        }catch(Exception $err){
            return response([
                'status' => false,
                'message' =>"Error while deleting user",
            ]);
        }
    }
    public function account()
    {
        $id = Auth::user()->id;
        $user = User::with('userDetail','identityVerification','trustSetting','invesmentProfie','accreditation')->find($id);
        $accreditations = Accreditation::get();
        $offers = Offer::get();
        $childs = User::with('userDetail','identityVerification','trustSetting','invesmentProfie')->where('parent_id',$id)->get();
        $folders = Folder::where('user_id',$id)->get();
        $investors =User::role('investor')->get();
        return view('user.account_profile',compact('user','accreditations','offers','childs','id','folders','investors'));
    }
    public function template()
    {
        $token = env('ESIGN_TOKEN');
        //$prod_token = "3137a61a-7db9-41f9-b2bd-39a8d7918fb5";
        $e_sign = Http::get('https://esignatures.io/api/templates?token='.$token);
        $json_e_sign = json_decode((string) $e_sign->getBody(), true);
        if($e_sign->successful()){
            return response([
                'status'=> true,
                'data'=>$json_e_sign
            ]);
        }

    }
    public function templateSave(Request $request)
    {

        $request->validate([
            'template' => 'required',
            'offer' => 'required',
            'investor' => 'required',
        ]);
        $investor = User::find($request->investor);
        $issuer =Auth::user();

        try{
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://esignatures.io/api/contracts?token=3137a61a-7db9-41f9-b2bd-39a8d7918fb5',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "template_id":"'.$request->template.'",
            "title":"Loan Agreement - Saver package",
            "metadata":"ID0001",
            "locale":"en",
            "test":"no",
            "custom_webhook_url":"https://google.com",
            "signers":[
                {
                    "name":"'.$investor->name.'",
                    "email":"'.$investor->email.'",
                    "mobile":"'.$investor->phone.'",
                    "company_name":"Investor Company",
                "signing_order":"1",
                "auto_sign":"no",
                "signature_request_delivery_method":"email",
                "signed_document_delivery_method":"email",
                "required_identification_methods":[
                    "email",
                    "sms"
                ],
                    "redirect_url":"https://your-website.com/aftersign",
                    "embedded_redirect_iframe_only":"no"
                },
                {
                    "name":"'.$issuer->name.'",
                    "email":"'.$issuer->email.'",
                    "mobile":"'.$issuer->phone.'",
                    "company_name":"Issuer Company",
                    "signing_order":"1",
                    "auto_sign":"no",
                    "signature_request_delivery_method":"email",
                    "signed_document_delivery_method":"email",
                    "required_identification_methods":[
                        "email",
                        "sms"
                    ],
                "redirect_url":"https://your-website.com/aftersign",
                "embedded_redirect_iframe_only":"no"
            }
            ],
            "placeholder_fields":[
                {
                    "api_key":"interest_rate",
                    "value":"3.2%"
                },
                {
                    "api_key":"floor-plan",
                    "document_elements":[
                        {
                        "type":"image",
                        "image_base64":"iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P4v5ThPwAG7wKklwQ/bwAAAABJRU5ErkJggg=="
                        }
                    ]
                }
            ],
            "signer_fields":[
                {
                    "signer_field_id":"preferred_term",
                    "default_value":"15 years"
                }
            ],
            "emails":{
                "signature_request_subject":"Your document is ready to sign",
                "signature_request_text":"Hi __FULL_NAME__, \\n\\n To review and sign the contract please press the button below \\n\\n Kind Regards",
                "final_contract_subject":"Your document is signed",
                "final_contract_text":"Hi __FULL_NAME__, \\n\\n Your document is signed.\\n\\nKind Regards",
                "cc_email_addresses":[
                    "tom@email.com",
                    "francis@email.com"
                ],
                "reply_to":"support@customdomain.com"
            },
            "custom_branding":{
                "company_name":"WhiteLabel LLC",
                "logo_url":"https://online-logo-store.com/yourclient-logo.png"
            }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return redirect()->back()->with('success','E-Sign request has been sent');
        }catch(Exception $error){
            return redirect()->back()->with('error','Error while sending E-Sign');
        }
        //echo $response;

    }
    public function basicDetailUpdate(Request $request){
        $user = Auth::user();
        try{
            $user->user_type = $request->account_type;
            $user->name = $request->legal_name;
           // $user->country = $request->legal_name;
           // $user->address = $request->legal_name;
            $user->net_worth = $request->net_worth;
            $user->annual_income = $request->annual_income;

            $user->are_you_accredited = $request->has('are_you_accredited') ? true : false;
            $user->agree_consent_electronic = $request->has('electronic_delivery') ? true : false;
            $user->afford_loss =$request->has('afford_loss') ? true : false;
            $user->understand_securities =$request->has('understand_securities') ? true : false;
            $user->investment_advice = $request->has('investment_advice') ? true : false;
            $user->agree_policy =$request->has('agree_policy') ? true : false;
            $user->save();
            $annualIncome = (int) str_replace(',', '', $user->net_worth);
            $netWorth = (int) str_replace(',', '', $user->annual_income);

            if($user->are_you_accredited == true){
                if (($annualIncome >= 124000) && ($netWorth >= 124000)) {
                    $accreditedInvestment = min(124000, 0.1 * max($annualIncome, $netWorth));
                    $investmentLimit =    $accreditedInvestment;
                }else{
                    return redirect()->back()->with('error','If you are a Accredited Member then your Annual Income & Networth must be greater then or equals to '.number_format(124000));
                }
            }else{
              //  dump($annualIncome,$netWorth);
                if (($annualIncome < 124000) || ($netWorth < 124000)) {
                    $nonAccreditedInvestment = max(2500, 0.05 * max($annualIncome, $netWorth));
                    $investmentLimit =  $nonAccreditedInvestment;
                }else{
                    return redirect()->back()->with('error','If you are not a Accredited Member then your Annual Income & Networth must be less then '. number_format(124000));
                }
               // dd($investmentLimit);
            }

            $user->investment_limit = $investmentLimit;
            $user->save();
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                 'last_name' => '',
                 'entity_name'=>  $request->entity_name,
                ]
            );

            $user->profile_status = true;
            $user->save();
            return redirect()->route('index')->with('success','Your Profile has been successfully updated');
        }catch(Exception $error){
           // dd($error);
            return redirect()->back()->with('error','There is some error while updating profile');
        }

    }

    public function uploadDocument(Request $request){

        $request->validate([
            'template_name' => 'required',
            'investor_id' => 'required',
            'offer' => 'required',
            'issuer_id' => 'required',
            'document'=>'required'
        ]);
        if($request->hasFile('document')) {
            $e_document = new MyEDocument;
            $e_document->investor_id = $request->investor_id;
            $e_document->offer_id = $request->offer;
            $e_document->issuer_id = $request->issuer_id;
            $e_document->template_name = $request->template_name;
            $e_document->template_id = null;
            $e_document->status = 'send';
            $e_document->source = 'manual';
            $e_document->contract_id = 123;
            $e_document->save();


            if($request->has('document')){

                $e_document->addMediaFromRequest('document')->toMediaCollection('e_documents');
            }

        }
        return redirect()->back()->with('success','Document Uploaded');

    }



    public function updateUserStatus($id){
        $user = User::find($id);

        if($user->status == 'active'){
            $k = 'active';
        }elseif($user->check_kyc == false){
            $kyc = true;
        }
        $user->status = 'active';
        $user->save();

        try{
            Mail::to($user)->send(new UserStatusUpdate($user));
            $data ="<p>
            Dear  $user->name ,
            We've reviewed your account and you can now login to Chainraise to browse investment opportunities. Thank you
            <br>
            Your Status is $user->status
            <small>
                If you would like to opt out of receiving marketing materials please <a href=''>click here</a>
            </small>
            </p>";
            $emailRecord = new EmailLog;
            $emailRecord->type = 'user status update';
            $emailRecord->status = 'send';
            $emailRecord->to = $user->email;
            $emailRecord->from = env('MAIL_FROM_ADDRESS');
            $emailRecord->subject = 'User Status Update';
            $emailRecord->body = $data;
            $emailRecord->save();
        }catch(Exception $err){

        }

        $data = 'Enabled';
        return response([
            'data'=>$data,
            'status'=>true
        ]);
    }

    public function emailLogs(){

        $emails = EmailLog::get();
        return view('user.emaillog',compact('emails'));
    }
}
