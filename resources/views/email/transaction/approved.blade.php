@extends('email.layout')
@section('email_title')
    <strong style="text-transform: uppercase">
        Transaction Approved
    </strong>
@endsection
@section('custom_css')  
    <style>
        .table{
            padding: 40px;
            background:#fff;
            width:100%
        }
        .table tr td,.table tr th {
            border:1px solid #ddd;
            text-align: center;
            padding: 10px;
        }
    </style>
@endsection
@section('email_content')
<p style="background:#fff;padding:25px">
    Your investment in the offer {{$data['offer_name']}} has been approved. Please view your confirmation page to review any next steps.
</p>
    
@endsection
