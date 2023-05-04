@extends('layouts.master')
@section('page_head')
    <style>
        .lernbtn:hover {
            background: #fff !important;
            color: #4b1dff !important;
        }
        ul{
            list-style-type: square;
            margin-left: 3rem;
        }
        ul li{
            color:#fff;
        }
        p{
            color:#fff
        }
        
        .account_type_wrapper{
            min-height: 15em;
            line-height: 1.5em;
        }
    </style>
@endsection
@section('title', 'Home')
@section('content')
    <div class="container-fluid header-sec py-3">
        <div class="row ">nano in
            <div class="col-lg-12 d-flex justify-content-center align-items-center py-4">
                <img src="{{ asset('media/logo/logo-h.jpg') }}" alt="logo" width="80" height="60">
                <h2>Build an <span style="color:#4b1dff">Ambitious</span> Portfolio.</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-image ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container" style="padding:10px 50px">
                        <form action="" id="update_profile" enctype="multipart/form-data">
                            <div class="row message">
                                <div class="col-lg-12">
                                    <p class="text-center">
                                        Before we get started, we need a little bit more information about you.
                                            <br/>
                                        Please select one of the account types listed below. 
                                    </p>
                                </div>
                            </div>
                            <div class="row account_type_wrapper_row" style="padding:50px;border-radius:3px">
                                <div class="col-lg-6 ">
                                    <div class="account_type_wrapper">
                                        <h6>
                                            Individual
                                        </h6>
                                        <p>
                                            Individual or Joint investor managing a single account
                                        </p>
                                        <p>
                                            <input type="radio" name="account_type" class="account_type" value="individual">
                                        </p>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="account_type_wrapper">
                                        <h6>
                                            Entity
                                        </h6>

                                        <p>
                                            Registered Investment Advisors, Financial Advisors, Family Offices, Trusts,
                                            IRAs or those investing on behalf of an entity
                                        </p>
                                        <p>
                                            <input type="radio" name="account_type" class="account_type"
                                                value="entity">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row row_individual d-none" style="padding:50px">
                                <div class="col-lg-12">
                                    <h3 class="type-label">
                                        -
                                    </h3>
                                    <p class="f goback goto-account_type" style="cursor: pointer;">
                                        Not the right account type? Click here to go back. 
                                    </p>
                                </div>
                                <div class="col-lg-12 text-white">
                                    <label for=""> Personal Information</label>
                                    <div class="form-group row">
                                        <div class="  col-lg-6">
                                            <input type="text" class="form-control" name="first_name"
                                                id="" placeholder="First Name">
                                        </div>
                                        <div class="  col-lg-6">
                                            <input type="text" class="form-control" name="last_name"
                                                id="" placeholder="Last Name">
                                        </div>
                                        <div class="col-lg-12 mt-6 text-center"
                                            style="margin-top:30px;margin-bottom:10px">
                                            <div class="wrapper">
                                                <p> Consent to Electronic Delivery </p>
                                                <p>
                                                    I consent to the electronic delivery of all communications and
                                                    materials.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="  col-lg-12 text-center">
                                            <input type="checkbox" class="" name="electronic_delivery"
                                                id="">
                                            I agree to the Consent to Electronic Delivery
                                        </div>
                                    </div>
                                    <div class="form-group row   show_when_type_entity">
                                        <div class="col-lg-12">
                                            <label for=""> ENTITY INFORMATION </label>
                                        </div>
                                        <div class="  col-lg-12">
                                            <input type="text" class="form-control" name="entity_name"
                                                id="" placeholder="Entity Name">
                                        </div>
                                    </div>

                                    <div class="form-group row text-center buttons">
                                        <div class="col-lg-12">
                                            <button type="button"
                                                class="btn btn-sm no-radius btn-info goto-account_type"> Back </button>
                                            <button type="button"
                                                class="btn btn-sm no-radius btn-info goto-accreditation"> Next
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row row_accreditation text-center text-white d-none" style="padding:50px">
                                <div class="col-lg-12">
                                    <strong>
                                        ACCREDITATION STATUS
                                    </strong>
                                    <br><br>
                                </div>
                                @foreach ($accreditations as $accreditation)
                                    <div class="col-lg-4 mb-10">
                                        <!--begin::Card-->
                                        <div class="py-4 h-250px"
                                            style="margin-bottom:10px;color:#ffffff;background:#000;border:1px solid #fff;border-radius:3px;font-size:13px!important;min-height:250px">
                                            <div class="card-header justify-content-center">
                                                <div class="card-title">
                                                    <div>
                                                        <span class="">
                                                            <i class="{{ $accreditation->icon }} fs-3x"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2 text-center">
                                                <span class="fs-6"> {{ $accreditation->title }} </span><br>
                                                <span class="fs-6 text-success">
                                                    @if ($accreditation->amount != null)
                                                        Above ${{ number_format($accreditation->amount) }}
                                                    @endif
                                                </span><br>
                                                <span> {{ $accreditation->years }} </span>
                                            </div>
                                            <div class=" ">
                                                <input class="form-check-input" type="radio"
                                                    value="{{ $accreditation->id }}" name="accreditation" required />
                                                <label class="form-check-label"></label>
                                            </div>
                                        </div>

                                        <!--end::Card-->
                                    </div>
                                @endforeach
                                <div class="form-group row text-center buttons">
                                    <div class="col-lg-12">
                                        <button type="button"
                                            class="btn btn-sm no-radius btn-info backto_account_type"> Back </button>
                                        <button type="submit" class="btn btn-sm no-radius btn-info goto-final"> Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row row_final text-center d-none" style="padding:50px">
                                <div class="col-lg-12">
                                    <strong>
                                        Great! You're all set.
                                    </strong>
                                    <br><br>
                                    <a href="/" class="btn btn-sm btn-primary no-radius">
                                        ACCESS PORTAL
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
