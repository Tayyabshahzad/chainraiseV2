@extends('layouts.master')
@section('page_head')
 <link rel="stylesheet" href="{{ asset('assets/css/listing_page_style.css') }}">
    <style>
        .lernbtn:hover {
            background: #fff !important;
            color: #4b1dff !important;
        }
    </style>
@endsection
@section('title', 'Manage Offers')
@section('content')
<div style="background: url({{ asset('assets/v3-images/bg-img.png') }}); background-position: top; background-size: cover;">
    <div class="text-white text-center pt-5">
        <h1 class="mb-lg-4 mt-lg-5 my-3">Build an <span style="color: #43C3FE;">Ambitious</span> Portfolio.</h1>
        <h5>Invest in the Equity of Web 3.0</h5>
    </div>
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col text-white text-end">
                <button class="btn btn-transparent text-white dropdown-toggle fs-5" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Sort by
                </button>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" id="sortAscending" href="#">A to Z</a> </li>
                    <li> <a class="dropdown-item" id="sortDescending" href="#">Z to A</a> </li>
                    <li> <a class="dropdown-item" id="default" href="#"> Default </a> </li>
                </ul>
            </div>
        </div>
        <div class="row gx-5" id="offerContainer">
            @foreach ($offers as $offer)
                <div class="col-lg-4 mb-3  text-center offerItem">
                    <a href="{{ route('offer.details', $offer->slug) }}" >
                        <img src="{{ $offer->getFirstMediaUrl('banner_image', 'thumb') }}" class=" img-fluid rounded"  srcset="">
                    <div class="row text-white p-3">
                        <div class="col-8 text-start">
                            <h6>  {{ $offer->name }} </h6>
                        </div>
                        <div class="col-4 text-end">
                            <h6>  {{ $offer->offer_type }} </h6>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 text-center mt-2">
                            <p class="m-0">
                                {{ $offer->short_description }}
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach


        </div>
        <div class=" row gx-5 pb-5">
            <h1 class="my-5 text-white">Coming Soon</h1>
            @foreach ($offer_coming_soon as $coming_soon)
                <div class="col-lg-4 mb-5  text-center">
                    <a href="{{ route('offer.details', $offer->slug) }}" target="_blank">
                        <img src="{{ $coming_soon->getFirstMediaUrl('banner_image', 'thumb') }}" alt="" class="img-fluid" srcset="" style="width:390;height:190">
                    </a>
                </div>
            @endforeach


        </div>

    </div>
</div>
@endsection
@section('page_js')
    <script>
        $('#sortAscending').click(function() {

            sortOffers('asc');
        });

        $('#sortDescending').click(function() {
            sortOffers('desc');
        });
        $('#default').click(function() {
            sortOffers('default');
        });

        function sortOffers(order) {

            $.ajax({
                url: "{{ route('offers.sort', ['order' => '']) }}" + '/' + order,
                type: 'GET',
                success: function(data) {
                    var sortedOffers = $(data).find('.offerItem'); // Extract only the sorted offer items
                    $('#offerContainer').html(sortedOffers); // Replace the existing offer items with the sorted ones
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Handle any errors if necessary
                }
            });
        }
    </script>
@endsection
