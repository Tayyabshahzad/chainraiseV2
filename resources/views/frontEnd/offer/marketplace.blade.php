@extends('layouts.master')
@section('page_title','Market Place')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('vue/css/market-page.css') }}">
    <style>
        .hero-play{
            background-image: url("{{ asset('vue/images/image-3.png') }}");
        }

    </style>
@endsection
@section('page_content')

<section class="p-lg-5 p-3 bg-dark-color">
    <div class="container">
        <div class="row text-center">
            <h5 class="card-title text-white">Invest in the Equity of Web 3.0</h5>
            <h1 class="second">Build an Ambitious Portfolio.</h1>
        </div>
        <div class="row text-white text-end">
            <p></p>
        </div>
        <div class="row g-3">
            @foreach ($offers as $offer)
            <div class="col-lg-4 ">
                <div class="card card-bg">
                    <img src="{{ $offer->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top p-2" alt="...">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-white"> {{ $offer->name }} </h5>
                            <p class="badge-class">{{  $offer->offer_type  }}</p>
                        </div>
                        <p class="card-text text-white mt-2" style="height: 50px;">
                            {{  substr($offer->short_description, 0, 80); }}

                        </p>

                    </div>

                </div>
                <div class="d-grid gap-2 col-12 mx-auto mt-10">

                    <a href="{{ route('offer.details', $offer->slug) }}" style="margin-top:5px" class="btn transparent_btn" type="button"><b> Learn  More </b></a>
                    {{-- <button class="btn transparent_btn"   type="button" disabled><b> Learn  More </b></button> --}}
                </div>

            </div>
            @endforeach


        </div>


    </div>
</section>


@endsection
