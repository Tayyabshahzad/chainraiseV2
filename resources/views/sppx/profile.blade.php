@extends('layouts.master-new')
@section('page_title', 'API-Profile')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('vue/css/style-listing.css') }}">

    <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>


@endsection
@section('page_content')

<section class="p-lg-5 p-3 hero-bg">
    <div class="container">

        <div class="row justify-content-between">
            <div class="col-lg-12 px-lg-0">
                <div id="carouselExample" class="" data-bs-ride="carousel">
                    <div class="">
                        <div class=" ">
                            <div class="row">
                                <div class="col-lg-12 py-5 text-right">
                                    <a href="">My Profile</a>
                                </div>
                            </div>

                            <div class="row text-white">
                                <div class="col-lg-6">
                                    <div class="form-group py-2">
                                            <label>User Name</label>
                                            <input type="text" name="username" class="form-control"/>
                                    </div>
                                    <div class="form-group py-2">
                                        <label>Email</label>
                                        <input type="text" name="username" class="form-control"/>
                                    </div>
                                    <div class="form-group py-2">
                                        <label>Password</label>
                                        <input type="text" name="username" class="form-control"/>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group py-2">
                                            <label>First Name</label>
                                            <input type="text" name="username" class="form-control"/>
                                    </div>
                                    <div class="form-group py-2">
                                        <label>Middle Name</label>
                                        <input type="text" name="username" class="form-control"/>
                                    </div>
                                    <div class="form-group py-2">
                                        <label>Last Name</label>
                                        <input type="text" name="username" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-sm btn-info" style="padding:8px 60px"> Update </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>






@endsection
