@extends('email.layout')
@section('email_title')
    <strong style="text-transform: uppercase">
        KYC Status Updated To <span class="text-danger" style="color:rgb(173, 9, 9)">  {{ ucfirst($data->kyc->kyc_level) }} </span>
    </strong>
   
@endsection
@section('email_content')
<p style="padding:25px 20px;background:#fff;font-size:15px">
    Dear {{  $data->name }}. <br/>
    YOUR KYC STATUS HAS BEEN UPDATED , YOUR CURRENT KYC STATUS IS: <span style="color:rgb(243, 50, 50)">    {{ ucfirst($data->kyc->kyc_level) }} </span>
</p>
@endsection