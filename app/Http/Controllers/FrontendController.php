<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Accreditation;
use App\Models\Folder;
use App\Models\IdentityVerification;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\UserDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{

    public function layout_email(){
        return view('email.transaction.create');
    }
    public function index()
    {   
       
        $offers = Offer::orderBy('id', 'desc')->where('status','active')->get();
        $offer_coming_soon = Offer::orderBy('id', 'desc')->where('status','coming-soon')->get();
        return view('frontEnd.offer.index',compact('offers','offer_coming_soon'));
    }

    public function detail($slug)
    {   
       
        $offer = Offer::with('user','user.userDetail','investmentRestrictions','offerDetail')-> 
        where('slug',$slug)->first();
        $slider_images = DB::table('media')
        ->where('model_type', Offer::class)
        ->where('model_id', $offer->id)
        ->where('collection_name', 'offer_slider_images')
        ->get(); 
        return view('frontEnd.offer.detail',compact('offer','slider_images'));
    }


    public function detail_v2($slug)
    {   
       
        $offer = Offer::with('user','user.userDetail','investmentRestrictions','offerDetail')->where('slug',$slug)->first();
        return view('frontEnd.offer.detailv2',compact('offer'));
    }


    
    public function socialLogin()
    {
       
        return view('frontEnd.login');
    }

    function privacy_policy(){
       
        return view('frontEnd.privacy_policy');
    }

    function terms(){
       
        return view('frontEnd.terms');
    }

    function faq(){ 
        return view('frontEnd.faq');
    }

    function contact(){ 
        return view('frontEnd.contact');
    }


    function investors(){ 
        return view('frontEnd.investors');
    }
    function businesses(){ 
        return view('frontEnd.businesses');
    }

    public function sort($order)
    {
        
        if($order == 'default'){
        $offers =  Offer::orderBy('id', 'desc')->get();  
        }else{
            $offers =  Offer::orderBy('name', $order)->get();  
        } 
        return view('frontEnd.offer.index',compact('offers'));
    }
        
    public function my_account(){
        $user = Auth::user();
        return view('frontEnd.myaccount',compact('user'));
    }

    public function my_account_update(Request $request){
        $user = Auth::user();  
        try{   
            $user->name = $request->legal_name;    
            $user->net_worth = $request->net_worth; 
            $user->annual_income = $request->annual_income;  
            $user->are_you_accredited = $request->has('are_you_accredited') ? true : false;  
            if($request->primary_contact_social_security == '999-99-9999'){   
                $ssn = $user->identityVerification->primary_contact_social_security; 
            }else{  
                $ssn = Crypt::encryptString($request->primary_contact_social_security); 
            } 
             
            $identityVerification = IdentityVerification::updateOrCreate(
            ['user_id' => $user->id],
            [
                'primary_contact_social_security' => $ssn,  
                'nationality' => $request->country,
            ]);   
            $userDetail = UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'dob' => $request->dob,
                ]);  



            $user->save();  
            return redirect()->back()->with('success','Your Account has been successfully updated');
        }catch(Exception $error){
            return redirect()->back()->with('error','There is some error while updating account'); 
        }
    }

    public function my_documents(){
        $user = Auth::user();
        $folders = Folder::where('user_id',$user->id)->withCount('documents')->get(); 
        $offers = Offer::get();
        return view('frontEnd.mydocuments',compact('user','folders','offers'));
    }

    public function portfolio(){
        $user = Auth::user();
        $lastInsertedRecord = Transaction::latest()->first();
        if($lastInsertedRecord){
            $lastInsertedDate = $lastInsertedRecord->created_at;
        }else{
            $lastInsertedDate = '--';
        }
         
        $totalInvested = Order::where('investor_id', $user->id)->sum('total');
        $transactions = Transaction::with('offer','user')->where('investor_id',$user->id)->get();
        return view('frontEnd.portfolio',compact('user','transactions','lastInsertedDate','totalInvested'));
    }

    
    
}
