@extends('layouts.master')
@section('page_title','Market Place')
@section('page_style')
<link rel="stylesheet" href="{{ asset('vue/css/market-page.css') }}">
@endsection
@section('page_content')



<section class="p-lg-5 p-3 bg-dark-color">
    <div class="container">
        <div class="row text-center">
            <h5 class="market-title text-lg-center text-start aa">Invest in the Equity of Web 3.0</h5>
            <h1 class="second text-lg-center text-start">Build an Ambitious Portfolio.</h1>
        </div>
        <div class="row text-white text-end">
            <p>Sort by</p>
        </div>
        <div class="row g-3">
            @foreach ($offers as $offer)
            <div class="col-lg-4">
                <div class="card card-bg">
                    <img src="{{ $offer->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="rounded p-2" alt="...">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-white"> {{ $offer->name }} </h5>
                            <p class="badge-class"> {{  $offer->offer_type  }} </p>
                        </div>
                        <p class="card-text mt-2" style="height: 50px; color: white !important;">
                            {{  substr($offer->short_description, 0, 80); }}
                        </p>
                    </div>
                    @if($offer->ext_url != null)
                        <a href="{{ route('offer.details', $offer->slug) }}" class="btn "  style="border-radius:0;color:#fff;border:1px solid #fff"><b> Learn  More </b></a>
                    @else
                        <button class="btn "  style="border-radius:0;color:#fff;"  type="button" disabled><b>Coming Soon</b> </button>
                    @endif
                    {{-- <button class="btn transparent_btn"   type="button" disabled><b> Learn  More </b></button> --}}
                </div>

            </div>

            @endforeach
        </div>
    </div>
</section>



@endsection
