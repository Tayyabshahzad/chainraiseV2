@extends('layouts.master')
@section('page_title','Market Listing')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('vue/css/style-listing.css') }}">
    <style>
        .hero-play{
            background-image: url("{{ asset('vue/images/image-3.png') }}");
        }
        .tab-content li {
           color: #fff!important;
        }
    </style>
@endsection
@section('page_content')

<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div class="row">
            <h3 class="px-lg-0">Investing Platform for</h3>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-6 px-lg-0">
                <h1 class="display-1">Next-Gen Companies</h1>
                <h6 class="my-lg-3 pe-lg-4">Screened Investments in Artificial Intelligence,
                    Blockchain
                    companies, Real
                    Estate, and more.</h6>
                <div class="d-grid gap-2 d-md-block pt-lg-3 py-3">
                    <a class="btn color_btn px-lg-5" href="{{ route('marketplace') }}">
                        <img src="{{  asset('vue/images/Group.png') }}"> Explore Offerings
                    </a>
                    {{-- <a class="btn transparent_btn px-l ms-lg-3"  href="https://chainraise.io/">
                        <img src="{{  asset('vue/images/Group.png') }}">
                        Explore
                        Real
                        Estate
                    </a> --}}

                    <h6 class="text-white py-4 my-lg-3 pe-lg-4 " style="font-size:15px!important;line-height:25px!important">
                        ChainRaise Portal LLC is a SEC registered Funding Portal and member of FINRA. Investing involves risks, including the risk of loss and liquidity risk
                    </h6>


                </div>
            </div>
            <div class="col-lg-6 my-auto">
                <img src="{{ asset('vue/images/image-3.png') }}" class="img-fluid" alt="">
            </div>
        </div>

    </div>
</section>

<!-- Hero Section End -->
<!-- 2nd Section Start -->
{{--
<section class="p-lg-5 p-3 section-bg">
    <div class=" container">
        <div class="row">
            <div class="col-12 text-lg-center">
                <h1 class="second">We
                    collaborate with 200+ leading companies
                </h1>
                <h6 class="second px-lg-5 mx-lg-5 text-center ">Lorem Ipsum has been the
                    industry's
                    standard
                    dummy text ever
                    since the 1500s,
                    when
                    an unknown
                    been the industry's standard dummy </h6>
                <hr class="horizontal-line-bar">
                <img src="{{  asset('vue/images/Group 877.png')}}" class="img-fluid mt-5" alt="Hero Video">
            </div>
        </div>
    </div>
</section> --}}


<section class="bg-dark-color p-lg-5 p-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9 position-relative">
                <hr class="verticle-line-bar" style="width: 90px !important;">
                <h1 class="second">Explore startups raising Capital</h1>
                <h6 class="third">Explore all of our offerings and become a fractional owner of a startup company.</h6>
            </div>
            <div class="col-lg-3 text-end">
                <a href="{{ route('marketplace') }}" class="btn color_btn px-lg-5">View all</a>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark-color p-lg-5 p-3">
    <div class="container">
        <div class="row">
            <div class="col-12 d-lg-block d-none">
                <div id="carouselExample" class="" data-bs-ride="carousel">
                    <div class="">
                        <div class=" ">
                            <div class="row">
                                @foreach ($activeOffers as $active)
                                <div class="col-lg-4" style="margin-bottom: 10px">
                                    <div class="card bg-dark">

                                        <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                                        <div class="card-body ">
                                            <div class="d-flex justify-content-end">
                                                <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}"  style="width: 100px;height:100px" class="img-fluid shield">
                                            </div>

                                            <h5 class="card-title text-white">{{ $active->name }}</h5>
                                            <div style="height: 70px">
                                                <p class="card-text text-white h-50">{{  substr($active->short_description, 0, 80); }}</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="title mb-0 pb-0">Min Investment</p>
                                                    <b class="price">${{  number_format(  $active->investmentRestrictions->min_invesment)  }}</b>
                                                </div>
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="title mb-0 pb-0">Total Valuation</p>
                                                    <b class="price">${{  number_format($active->total_valuation)  }}</b>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="title mb-0 pb-0">Offer Type</p>
                                                    <b class="price">{{  $active->offer_type  }}</b>
                                                </div>
                                            </div>
                                            <span class="  text-wrap col-12 my-3 mx-auto py-2 px-3"   style="text-align: left !important;"> </span>
                                            <div class="d-grid gap-2 col-12 mx-auto">

                                                @if($active->ext_url != null)
                                                    <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" ><b> Learn  More </b></a>
                                                @else
                                                    <button class="btn color_btn" type="button" disabled><b>Coming Soon</b> </button>
                                                @endif
                                                {{-- <button class="btn transparent_btn"   type="button" disabled><b> Learn  More </b></button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                @endforeach

                            </div>
                        </div>

                    </div>
                    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> --}}
                </div>
            </div>
            <div class="col-12 d-lg-none d-block">
                <div class="row">
                    @foreach ($activeOffers as $active)
                    <div class="col-lg-4 py-2">
                        <div class="card bg-dark">

                            <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                            <div class="card-body ">
                                <div class="d-flex justify-content-end">
                                    <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}"  style="width: 100px;height:100px" class="img-fluid shield">
                                </div>

                                <h5 class="card-title text-white">{{ $active->name }}</h5>
                                <p class="card-text text-white h-50">{{  substr($active->short_description, 0, 80); }}</p>
                                <div class="row">
                                    <div class="col-4 border-end pe-0"
                                        style="border-color: #959595 !important;">
                                        <p class="title mb-0 pb-0">Min Investment</p>
                                        <b class="price">${{  number_format(  $active->investmentRestrictions->min_invesment)  }}</b>
                                    </div>
                                    <div class="col-4 border-end"
                                        style="border-color: #959595 !important;">
                                        <p class="title mb-0 pb-0">Total Valuation</p>
                                        <b class="price">${{  number_format($active->total_valuation)  }}</b>
                                    </div>
                                    <div class="col-4">
                                        <p class="title mb-0 pb-0">Offer Type</p>
                                        <b class="price">{{  $active->offer_type  }}</b>
                                    </div>
                                </div>
                                <span class="badge text-wrap col-12 my-3 mx-auto py-2 px-3"
                                    style="text-align: left !important;">
                                    Due to our escrow partner switch, this offering will be be back online
                                    soon.</span>
                                    <div class="d-grid gap-2 col-12 mx-auto">

                                        @if($active->ext_url != null)
                                            <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" ><b> Learn  More </b></a>
                                        @else
                                            <button class="btn color_btn" type="button" disabled><b>Coming Soon</b> </button>
                                        @endif
                                        {{-- <button class="btn transparent_btn"   type="button" disabled><b> Learn  More </b></button> --}}
                                    </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>


<section class="bg-dark-color p-lg-5 p-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 position-relative">
                <hr class="verticle-line-bar">
                <h1 class="third">How to Invest</h1>
                <h6 class="third">Create an account, find your favorite offering, become a fractional owner.</h6>
            </div>
        </div>
        <div class="row align-items-center p-lg-5">
            <div class="col-lg-5 pb-lg-0 pb-5">
                <img src="{{  asset('vue/images/mob.png')}}" class="img-fluid" alt="Hero Video">
            </div>
            <div class="col-lg-7 ps-lg-4 order-lg-last order-first">
                <h1 class="third">SIGN UP</h1>
                <h6 class="third">
                    New users will be prompted to create an account and provide initial information for a customized
                    setup.
                </h6>
            </div>
        </div>
        <div class="row align-items-center p-lg-5">
            <div class="col-lg-7">
                <h1 class="third">EXPLORE</h1>
                <h6 class="third">
                    Explore our marketplace for investment opportunities after creating your account.
                </h6>
            </div>
            <div class="col-lg-5 text-end mb-lg-0 pb-5">
                <img src="{{  asset('vue/images/mob-2.png')}}" class="img-fluid" alt="Hero Video">
            </div>

        </div>
        <div class="row align-items-center p-lg-5">
            <div class="col-lg-5">
                <img src="{{  asset('vue/images/mob3.png') }}" class="img-fluid" alt="Hero Video">
            </div>
            <div class="col-lg-7  order-lg-last order-first">
                <h1 class="third">INVEST</h1>
                <h6 class="third">Once you've identified the right
                    opportunity, you'll initiate the KCY (Know Your Customer) process to verify your identity and
                    complete the required investor documents.</h6>
            </div>
        </div>
    </div>
</section>

@endsection
