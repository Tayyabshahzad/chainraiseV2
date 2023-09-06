@extends('email.layout')
@section('email_title')
    <strong style="text-transform: uppercase">
        YOUR ACCOUNT STATUS HAS BEEN   @if($data->status == 'active') <span style="color:rgb(119, 236, 119)">APPROVED</span>  @else <span style="color:rgb(140, 10, 51)">REJECTED</span> @endif
    </strong>
@endsection
@section('email_content')

    @if($data->status == 'active')
        <p style="padding:25px 20px;background:#fff;font-size:15px">
            Dear {{ $data->name }},
            We've reviewed your account and you can now login to Chainraise to browse investment opportunities. Thank you
            <br>
            <small>
                If you would like to opt out of receiving marketing materials please <a href="">click here</a>

            </small>
        </p>
    @else
    <p style="padding:25px 20px;background:#fff;font-size:15px">
        Dear {{ $data->name }},
        Thank you for your interest in the platform. We have rejected your account on the basis that it does not meet our platform compliance requirements.
        <br>

        Thank you, <br>
        Manager ChainRaise Portal

    </p>
    @endif
@endsection
