<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Accreditation;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{

    public function layout_email(){
        return view('email.transaction.create');
    }
    public function index()
    {   
       
        $offers = Offer::orderBy('id', 'desc')->get();
        return view('frontEnd.offer.index',compact('offers'));
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
    
}
