@extends('email.layout')
@section('email_title')
    <strong style="text-transform: uppercase">
        Please Verify Your Email
    </strong> 
@endsection
@section('email_content')
    <p style="padding:25px 20px;background:#fff;font-size:15px">
        Hi ,  <br>

        We&#39;re excited to have you onboard at Chainraise! We are the only investment
        crowdfunding platform focused on helping innovative businesses and startups raise capital.
        You can get started by exploring our <a href="https://invest.chainraise.io/"> Chainraise </a> of investment opportunities to see if there are any
        issuers you would like to support with your investment.
        
        If you need information on how to use the site, or about crowdfunding regulations, check out the
        FAQs page and Knowledge Center to get started.
        
        Remember, any person who promotes an issuer&#39;s offering for compensation, whether past or
        prospective, or who is a founder or an employee of an issuer that engages in promotional
        activities on behalf of the issuer through Test Company, must clearly disclose in all
        communications the receipt of the compensation, and that he or she is engaging in promotional
        activities on behalf of the issuer.
        
        Chainraise is compensated by charging issuers a fee based on a percentage of the
        amount being raised.
        <br> <br>
        Please contact us if you have any questions.
        <br> <br>
        <a href="{{ $actionUrl }}"> VERIFY EMAIL </a>
        <br>
        Thank you,
        The Chainraise Team
    </p>
@endsection

 