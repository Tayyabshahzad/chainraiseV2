@extends('layouts.master')
@section('page_title', 'API')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('vue/css/style-business.css') }}">

    <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>


@endsection
@section('page_content')



<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div class="row py-10"> </div>
        <div class="row justify-content-between py-10 pb-20" >
            <div class="col-lg-12 py-5 text-right ">
                <a href="{{route('api.profile')}}" class="text-white">My Profile</a>
            </div>
                @if (isset($jsonResponse['status']['code']) && $jsonResponse['status']['code'] == '200')
                    @if (isset($jsonResponse['issues']) && is_array($jsonResponse['issues']))
                        @foreach ($jsonResponse['issues'] as $issue)
                        <div class="col-lg-4" style="margin-bottom: 10px">
                            <div class="card bg-dark">

                                <img src="{{ $issue['media']['thumb']['url'] }}" class="card-img-top" alt="Image 1" style="height: 17em;">
                                <div class="card-body ">


                                    <h5 class="card-title text-white"> {{ $issue['name'] ?? 'No Name' }} </h5>
                                    <div style="height: 70px">
                                        <p class="card-text text-white h-50"> {{ $issue['raise']['terms'] ?? 'No Name' }} </p>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 border-end"
                                            style="border-color: #959595 !important;">
                                            <p class="text-white mb-0 pb-0">Type </p>
                                            <b class="text-white"> {{ $issue['raise']['type'] ?? 'No Name' }} </b>
                                        </div>
                                        <div class="col-lg-4 border-end"
                                            style="border-color: #959595 !important;">
                                            <p class="text-white mb-0 pb-0">Target Raised</p>
                                            <b class="text-white">  {{ $issue['raise']['raised'] ?? 'No Name' }} </b>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="text-white mb-0 pb-0">Min Investment</p>
                                            <b class="text-white"> {{ $issue['raise']['minimum'] ?? 'No Name' }}  </b>
                                        </div>
                                    </div>
                                    <span class="  text-wrap col-12 my-3 mx-auto py-2 px-3"   style="text-align: left !important;"> </span>
                                    <div class="d-grid gap-2 col-12 mx-auto">

                                        <a href="" class="btn transparent_btn" ><b> Learn  More </b></a>
                                        {{-- <button class="btn transparent_btn"   type="button" disabled><b> Learn  More </b></button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                @endif


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



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



    <div class="container-fluid section-bg py-5">
        <div class="row ">
            <div class="col-lg-12 text-center py-4">
                @if (isset($jsonResponse['status']['code']) && $jsonResponse['status']['code'] == '200')
                @if (isset($jsonResponse['issues']) && is_array($jsonResponse['issues']))

                @else
                    <p>No offers found.</p>
                @endif
            @else
                <p>Error fetching data.</p>
            @endif
            </div>
        </div>
    </div>

@endsection
