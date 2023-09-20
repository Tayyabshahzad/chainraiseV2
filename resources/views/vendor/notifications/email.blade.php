@extends('email.layout')
@section('email_title')
    <strong style="text-transform: uppercase">
        Password Reset
    </strong>
@endsection
@section('email_content')
    <p style="padding:25px 20px;background:#fff;font-size:15px">
        Hi ,  <br>
        You are receiving this email because we received a password reset request for your account
        <br>
        To reset your password, click the following link:
        <br>
        <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
        <br>
        If you did not request a password reset, no further action is required.

        Regards,<br>
        The Chainraise Team
    </p>
@endsection

