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
    <div class="container text-center"  style="margin-top:2em;margin-bottom: 10em">
        <div class="row">
            <h3 class="px-lg-0">Invest in the Equity of Web 3.0</h3>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-12 px-lg-0 text-center">
                <h1 class="display-3">Build an Ambitious Portfolio.</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 d-lg-block d-none">
                <div id="carouselExample" class="" data-bs-ride="carousel">
                    <div class="">
                        <div class=" ">
                            <div class="row">
                                @foreach ($activeOffers as $active)
                                <div class="col-lg-4" style="margin-bottom:2em">
                                    <div class="card bg-dark">

                                        <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1" style="height:200px">
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
                                                    <p class="text-white mb-0 pb-0">Min Investment</p>
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
                    <div class="col-lg-4 py-2" style="margin-bottom:2em">
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
                                        <p class="text-white mb-0 pb-0 abc">Min Investment</p>
                                        <b class="text-white abc">${{  number_format(  $active->investmentRestrictions->min_invesment)  }}</b>
                                    </div>
                                    <div class="col-4 border-end"
                                        style="border-color: #959595 !important;">
                                        <p class="text-white mb-0 pb-0 abc">Total Valuation</p>
                                        <b class="text-white abc">${{  number_format($active->total_valuation)  }}</b>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-white mb-0 pb-0 abc">Offer Type</p>
                                        <b class="text-white abc">{{  $active->offer_type  }}</b>
                                    </div>
                                </div>
                                <span class="badge text-wrap col-12 my-3 mx-auto py-2 px-3"
                                    style="text-align: left !important;">
                                    Due to our escrow partner switch, this offering will be be back online
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



@endsection
