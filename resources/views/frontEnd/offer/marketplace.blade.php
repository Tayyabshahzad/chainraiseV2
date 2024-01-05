@extends('layouts.master')
@section('page_title','Market Place')
@section('page_style')
<link rel="stylesheet" href="{{ asset('vue/css/style-listing.css') }}">
@endsection
@section('page_content')




<section class="p-lg-5 p-3 bg-dark-color">
    <div class="container">
        <div class="row text-center">
            <h5 class="market-title text-lg-center text-start aa">Invest in the Equity of Web 3.0</h5>
            <h1 class="second text-lg-center text-start">Build an Ambitious Portfolio.</h1>
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
                                @foreach ($offers as $offer)
                                <div class="col-lg-4" style="margin-bottom: 10px">
                                    <div class="card bg-dark">

                                        <img src="{{ $offer->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                                        <div class="card-body ">
                                            <div class="d-flex justify-content-end">
                                                <img src="{{ $offer->getFirstMediaUrl('offer_logo', 'thumb') }}"  style="width: 100px;height:100px" class="img-fluid shield">
                                            </div>

                                            <h5 class="card-title text-white">{{ $offer->name }}</h5>
                                            <div style="height: 70px">
                                                <p class="card-text text-white h-50">{{  substr($offer->short_description, 0, 80); }}</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="text-white mb-0 pb-0">Min Investment</p>
                                                    <b class="text-white">${{  number_format(  $offer->investmentRestrictions->min_invesment)  }}</b>
                                                </div>
                                                <div class="col-lg-4 border-end"
                                                    style="border-color: #959595 !important;">
                                                    <p class="text-white mb-0 pb-0">Total Valuation</p>
                                                    <b class="text-white">${{  number_format($offer->total_valuation)  }}</b>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="text-white mb-0 pb-0">Offer Type</p>
                                                    <b class="text-white">{{  $offer->offer_type  }}</b>
                                                </div>
                                            </div>
                                            <span class="  text-wrap col-12 my-3 mx-auto py-2 px-3"   style="text-align: left !important;"> </span>
                                            <div class="d-grid gap-2 col-12 mx-auto">

                                                @if($offer->ext_url != null)
                                                    <a href="{{ route('offer.details', $offer->slug) }}" class="btn transparent_btn" ><b> Learn  More </b></a>
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
            </div>

        </div>
    </div>
</section>



@endsection
