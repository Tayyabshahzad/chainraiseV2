@extends('layouts.master')
@section('page_title','Market Listing')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('vue/css/style-listing.css') }}">
    <style>
        .hero-play{
            background-image: url("{{ asset('vue/images/image-3.png') }}");
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
                    <button class="btn color_btn px-lg-5" type="button"><img src="{{  asset('vue/images/Group.png') }}"> Explore
                        Tech</button>
                    <button class="btn transparent_btn px-lg-4 ms-lg-3" type="button"><img src="{{  asset('vue/images/Group.png') }}">
                        Explore
                        Real
                        Estate</button>
                </div>
            </div>
            <div class="col-lg-6 hero-play d-flex justify-content-center align-items-center">
                <a type="button" data-bs-toggle="modal" data-src="https://player.vimeo.com/video/235215203"
                    data-bs-target="#myModal">
                    <img src="{{ asset('vue/images/Group 12576.png') }}" alt="">
                </a>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item"
                                        src="https://player.vimeo.com/video/235215203?autoplay=1&amp;playsinline=1&amp;color&amp;autopause=0&amp;loop=1&amp;muted=1&amp;title=0&amp;portrait=0&amp;byline=0#t="
                                        id="video" allowscriptaccess="always" allow="autoplay"></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <hr class="verticle-line-bar">
                <h1 class="second">Explore startups raising Capital</h1>
                <h6 class="third">Explore all of our offerings and become a fractional owner of a startup company.</h6>
            </div>
            <div class="col-lg-3 text-end">
                <button type="button" class="btn color_btn px-lg-5">View all</button>
            </div>
        </div>
    </div>
</section>
<section class="bg-dark-color p-lg-5 p-3">
    <div class="container">
        <div class="row">
            <div class="col-12 d-lg-block d-none">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                @foreach ($activeOffers as $active)

                                <div class="col-lg-4">
                                    <div class="card bg-dark">
                                        <div class="position-absolute bg-orange p-1 px-lg-4 rotate-div">
                                            <p class="trend text-white text-lg-end mb-0">
                                                <img src="{{  asset('vue/images/flame.svg')}}"
                                                    class="img-fluid me-2">
                                            </p>
                                        </div>
                                        <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                                        <div class="card-body ">
                                            <div class="d-flex justify-content-end">
                                                <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}"  style="width: 100px;height:100px" class="img-fluid shield">
                                            </div>

                                            <h5 class="card-title text-white">{{ $active->name }}</h5>
                                            <p class="card-text text-white h-50">{{  substr($active->short_description, 0, 80); }}</p>
                                            <div class="row">
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="text-white mb-0 pb-0">Min Invesment</p>
                                                    <b class="text-white">${{  number_format(  $active->investmentRestrictions->min_invesment)  }}</b>
                                                </div>
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="text-white mb-0 pb-0">Total Valuation</p>
                                                    <b class="text-white">${{  number_format($active->total_valuation)  }}</b>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="text-white mb-0 pb-0">Offer Type</p>
                                                    <b class="text-white">{{  $active->offer_type  }}</b>
                                                </div>
                                            </div>
                                            <span class="badge text-wrap col-12 my-3 mx-auto py-2 px-3"
                                                style="text-align: left !important;">
                                                Due to our escrow partner switch, this offering with be back online
                                                soon.</span>
                                            <div class="d-grid gap-2 col-12 mx-auto">
                                                <button class="btn color_btn" type="button" disabled><b>Coming Soon</b> </button>
                                                <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" type="button"><b> Learn  More </b></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                @endforeach

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                @foreach ($remainingOffers as $active)

                                <div class="col-lg-4">
                                    <div class="card bg-dark">
                                        <div class="position-absolute bg-orange p-1 px-lg-4 rotate-div">
                                            <p class="trend text-white text-lg-end mb-0">
                                                <img src="{{  asset('vue/images/flame.svg')}}"
                                                    class="img-fluid me-2">
                                            </p>
                                        </div>
                                        <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                                        <div class="card-body ">
                                            <div class="d-flex justify-content-end">
                                                <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}"  style="width: 100px;height:100px" class="img-fluid shield">
                                            </div>

                                            <h5 class="card-title text-white">{{ $active->name }}</h5>
                                            <p class="card-text text-white h-50">{{  substr($active->short_description, 0, 80); }}</p>
                                            <div class="row">
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="text-white mb-0 pb-0">Min Invesment</p>
                                                    <b class="text-white">${{  number_format(  $active->investmentRestrictions->min_invesment)  }}</b>
                                                </div>
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="text-white mb-0 pb-0">Total Valuation</p>
                                                    <b class="text-white">${{  number_format($active->total_valuation)  }}</b>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="text-white mb-0 pb-0">Offer Type</p>
                                                    <b class="text-white">{{  $active->offer_type  }}</b>
                                                </div>
                                            </div>
                                            <span class="badge text-wrap col-12 my-3 mx-auto py-2 px-3"
                                                style="text-align: left !important;">
                                                Due to our escrow partner switch, this offering with be back online
                                                soon.</span>
                                            <div class="d-grid gap-2 col-12 mx-auto">
                                                <button class="btn color_btn fw-bold" type="button" disabled>Coming Soon</button>
                                                <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" type="button"><b> Learn  More </b></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 d-lg-none d-block">
                <div class="row">
                    @foreach ($activeOffers as $active)
                    <div class="col-lg-4 py-2">
                        <div class="card bg-dark">
                            <div class="position-absolute bg-orange p-1 px-lg-4 rotate-div">
                                <p class="trend text-white text-lg-end mb-0">
                                    <img src="{{  asset('vue/images/flame.svg')}}"
                                        class="img-fluid me-2">
                                </p>
                            </div>
                            <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                            <div class="card-body ">
                                <div class="d-flex justify-content-end">
                                    <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}"  style="width: 100px;height:100px" class="img-fluid shield">
                                </div>

                                <h5 class="card-title text-white">{{ $active->name }}</h5>
                                <p class="card-text text-white h-50">{{  substr($active->short_description, 0, 80); }}</p>
                                <div class="row">
                                    <div class="col-lg-4 border-end"
                                        style="border-color: #959595 !important;">
                                        <p class="text-white mb-0 pb-0">Min Invesment</p>
                                        <b class="text-white">${{  number_format(  $active->investmentRestrictions->min_invesment)  }}</b>
                                    </div>
                                    <div class="col-lg-4 border-end"
                                        style="border-color: #959595 !important;">
                                        <p class="text-white mb-0 pb-0">Total Valuation</p>
                                        <b class="text-white">${{  number_format($active->total_valuation)  }}</b>
                                    </div>
                                    <div class="col-lg-4">
                                        <p class="text-white mb-0 pb-0">Offer Type</p>
                                        <b class="text-white">{{  $active->offer_type  }}</b>
                                    </div>
                                </div>
                                <span class="badge text-wrap col-12 my-3 mx-auto py-2 px-3"
                                    style="text-align: left !important;">
                                    Due to our escrow partner switch, this offering with be back online
                                    soon.</span>
                                <div class="d-grid gap-2 col-12 mx-auto">
                                    <button class="btn color_btn" type="button" disabled><b>Coming Soon</b> </button>
                                    <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" type="button"><b> Learn  More </b></a>
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
            <div class="col-lg-5">
                <img src="{{  asset('vue/images/mob.png')}}" class="img-fluid" alt="Hero Video">
            </div>
            <div class="col-lg-7 ps-lg-4">
                <h1 class="third">SIGN UP</h1>
                <h6 class="animate__animated animate__fadeInRight third">
                    New users will be prompted to create an
                    account and provide
                    initial information for a customized setup.</h6>
            </div>
        </div>
        <div class="row align-items-center p-lg-5">
            <div class="col-lg-7">
                <h1 class="third">EXPLORE</h1>
                <h6 class="animate__animated animate__fadeInLeft third">Explore our
                    marketplace for investment opportunities after
                    creating your account.</h6>
            </div>
            <div class="col-lg-5 text-end">
                <img src="{{  asset('vue/images/mob-2.png')}}" class="img-fluid" alt="Hero Video">
            </div>

        </div>
        <div class="row align-items-center p-lg-5">
            <div class="col-lg-5">
                <img src="{{  asset('vue/images/mob3.png')}}" class="img-fluid" alt="Hero Video">
            </div>
            <div class="col-lg-7">
                <h1 class="third">INVEST</h1>
                <h6 class="animate__animated animate__fadeInRight third">Once you've
                    identified the right opportunity, you'll
                    initiate the KCY (Know Your Customer) process to verify your identity and complete the required
                    investor documents.</h6>
            </div>
        </div>
    </div>
</section>
@endsection
