@extends('layouts.master')
@section('custom_css')
    <style>
        .hero-section {
            background: linear-gradient(rgb(137 126 126 / 50%), rgb(0 0 0)), url({{ $offer->getFirstMediaUrl('banner_image', 'thumb') }});
        }
    </style>
    <link rel="stylesheet" href="https://rabhinav77.github.io/js-toastr/toast.min.css">
    <link rel="stylesheet" href="https://rabhinav77.github.io/js-toastr/toast.min.js">
@endsection

@section('content')
    <!-- Hero Section Start -->
    <section class="container-fluid hero-section">
        <div class="row justify-content-center">

            <div class="col-12 text-center">
                <button type="button" data-bs-toggle="modal" data-src="https://player.vimeo.com/video/235215203"
                    data-bs-target="#myModal" class="btn btn-outline-light rounded-circle"
                    style=" border: 2px solid RGBA(67, 195, 254, 1); padding: 16px 25px;"><span
                        class="bi bi-play-fill fs-2"></span>
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item" src="{{ $offer->feature_video }}"  id="video" allowscriptaccess="always" allow="autoplay"></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center ">
                <img src="{{ $offer->getFirstMediaUrl('offer_image', 'thumb') }}" class="p-3 white-logo" alt="...">
                <p class="text-white fs-5 fw-semibold mb-4"> {{  $offer->name }} </p>
            </div>
            <div class="col-lg-6">
                <div class="row mb-4">
                    <div class="col-4 text-center">
                        <h6 class="text-white fw-normal">Securities Type</h6>
                        <h6 class="sky-blue fw-normal">Preferred Stock</h6>
                    </div>
                    <div class="col-4 text-center">
                        <h6 class="text-white fw-normal">Price Per Unit</h6>
                        <h6 class="sky-blue fw-normal">$2.00</h6>
                    </div>
                    <div class="col-4 text-center fw-normal">
                        <h6 class="text-white fw-normal">Valuation</h6>
                        <h6 class="sky-blue fw-normal">$20,000,000</h6>
                    </div>
                </div>
                <div class="row px-5">
                    <div class="col-9">
                        <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="">
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-outline-info text-white">INVEST</button>
                    </div>
                </div>
                <div class="row px-5">
                    <div class="col-12 text-center pt-5">
                        <a href="#detail"><i class="bi bi-arrow-down-circle fs-3 sky-blue"></i></a>
                        <p class="text-white fs-5 fw-semibold">Scroll Down for Details</p>
                    </div>
                </div>



            </div>
    </section>
    <!-- Hero Section End -->
    <!-- Faq Section Start -->
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center p-lg-5 p-4">
            <div class="col-6">
                <img src="{{ $offer->getFirstMediaUrl('offer_image', 'thumb') }}" class="img-fluid b-logo" alt="..." style="width:10%">
            </div>
            <div class="col-6 text-end">
                <img src="{{ asset('assets/v2_images/social icon.png') }}" class="img-fluid" alt="...">
            </div>
        </div>
    </div>
    <!-- Faq Section End -->
    <div id="detail" class="container-fluid p-0 m-0">
        <ul class="nav nav-pills mb-3 mt-3 px-lg-5 py-3 bg-dark" id="pills-tab" role="tablist">
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link active text-white" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">Overview</button>
            </li>
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#deal-terms" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">Deal Terms</button>
            </li>
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#rewards" type="button" role="tab" aria-controls="pills-contact"
                    aria-selected="false">Rewards</button>
            </li>
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#updates" type="button" role="tab" aria-controls="pills-contact"
                    aria-selected="false">Updates</button>
            </li>
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#q&a"
                    type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Q & A</button>
            </li>
        </ul>
        <div class="tab-content px-lg-5 px-3 py-3" id="pills-tabContent">
            <div class="tab-pane fade show active p-2" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <p class="fs-5 fw-semibold">
                    @foreach ($offer->offerDetail as $offerDetail)
                        @if ($offerDetail->input == 'summary')
                            <div class="col-lg-6 mt-4">
                                <h5>{{ $offerDetail->heading }}</h5>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <h5>{{ $offerDetail->sub_heading }}</h6>
                            </div>
                            <div class="col-lg-11 mt-4">
                                {!! $offerDetail->description !!}
                            </div>
                        @elseif($offerDetail->input == 'text')
                            <div class="col-lg-6 mt-4">
                                <h6>{{ $offerDetail->heading }}</h6>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <h5>{{ $offerDetail->sub_heading }}</h6>
                            </div>
                            <div class="col-lg-12 mt-4">
                                {!! $offerDetail->description !!}
                            </div>
                        @elseif($offerDetail->input == 'tiles')
                            <div class="row">
                                @if ($offerDetail->offerTiles)
                                    @foreach ($offerDetail->offerTiles as $tiles)
                                        <div class="col-lg-6 col-md-6  p-3">
                                            <figure class="figure">
                                                <img src="{{ asset('files/' . $tiles->path) }}"
                                                    class="img img-thumbnail figure-img img-fluid rounded"
                                                    alt="..." style="width:200px">
                                            </figure>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                    @endforeach
                </p>
                 
                
            </div>
            <div class="tab-pane fade p-2" id="deal-terms" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="fw-bolder">Deal Terms</h3>
                <h6 class="fw-bolder">DelNorte</h6>
                <div class="border-start  border-5  border-info my-5 ps-4">
                    <span class="fw-bolder fs-5 mb-5">Overview </span>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Price Per Share</p>
                        <p class="fw-bolder fs-6 mb-0">$18.50</p>
                    </div>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Deadline</p>
                        <p class="fw-bolder fs-6 mb-0">May 19, 2023</p>
                    </div>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Valuation </p>
                        <p class="fw-bolder fs-6 mb-0">$125.06M</p>
                    </div>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Funding Goal </p>
                        <p class="fw-bolder fs-6 mb-0">$15k - $5M </p>
                    </div>
                </div>
                <div class="border-start border-info  border-5 my-5 ps-4">
                    <span class="fw-bolder fs-5 mb-5">Breakdown </span>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Minimum Investment </p>
                        <p class="fw-bolder fs-6 mb-0">$499.50</p>
                    </div>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Maximum Investment </p>
                        <p class="fw-bolder fs-6 mb-0">$4,999,976.50</p>
                    </div>
                    <div>
                        <p class="fw-normal fs-6 mb-0">Minimum Number of Shares Offered</p>
                        <p class="fw-bolder fs-6 mb-0"> 810 </p>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade p-2" id="rewards" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="fw-bolder">Rewards</h3>
                <p>Multiple investments in an offering cannot be combined to qualify for a larger campaign perk. Get
                    rewarded for investing more.
                </p>
                <div class="border-start border-info  my-5 ps-4 py-3 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <span class="fw-bolder fs-1 mb-5">$499</span>
                        <button type="button"
                            class="btn btn-outline-secondary rounded mt-4 px-4 fs-5 fw-semibold border-2"
                            style="float: right;">
                            Select </button>
                    </div>
                    <div>
                        <p class="fw-semibold fs-4 mb-0">EARN 10% BONUS SHARES</p>
                        <p class="fw-semibold fs-5 mb-0">Multiple investments in an offering cannot be combined to
                            qualify
                            for a larger campaign perk. Get rewarded for investing more.
                        </p>
                    </div>
                </div>
                <div class="border-start border-info  my-5 ps-4 py-3 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <span class="fw-bolder fs-1 mb-5">$5,000</span>
                        <button type="button"
                            class="btn btn-outline-secondary rounded mt-4 px-4 fs-5 fw-semibold border-2"
                            style="float: right;">
                            Select </button>
                    </div>
                    <div>
                        <p class="fw-semibold fs-4 mb-0">EARN 10% BONUS SHARES</p>
                        <p class="fw-semibold fs-5 mb-0">Multiple investments in an offering cannot be combined to
                            qualify
                            for a larger campaign perk. Get rewarded for investing more.
                        </p>
                    </div>
                </div>
                <div class="border-start border-info  my-5 ps-4 py-3 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <span class="fw-bolder fs-1 mb-5">$10,000</span>
                        <button type="button"
                            class="btn btn-outline-secondary rounded mt-4 px-4 fs-5 fw-semibold border-2"
                            style="float: right;">
                            Select </button>
                    </div>
                    <div>
                        <p class="fw-semibold fs-4 mb-0">EARN 10% BONUS SHARES</p>
                        <p class="fw-semibold fs-5 mb-0">Multiple investments in an offering cannot be combined to
                            qualify
                            for a larger campaign perk. Get rewarded for investing more.
                        </p>
                    </div>
                </div>
                <div class="border-start border-info  my-5 ps-4 py-3 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <span class="fw-bolder fs-1 mb-5">$46,795,898</span>
                        <button type="button"
                            class="btn btn-outline-secondary rounded mt-4 px-4 fs-5 fw-semibold border-2"
                            style="float: right;">
                            Select </button>
                    </div>
                    <div>
                        <p class="fw-semibold fs-4 mb-0">EARN 10% BONUS SHARES</p>
                        <p class="fw-semibold fs-5 mb-0">Multiple investments in an offering cannot be combined to
                            qualify
                            for a larger campaign perk. Get rewarded for investing more.
                        </p>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade p-2" id="updates" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="fw-bolder">Recent Updates</h3>
                <div>
                    <p class="fw-bolder fs-5 mb-0">07-23-23</p>
                    <p class="fw-bolder fs-4 mb-0">NEW RECORD OF UNITS SOLD + MAJOR PUBLICATION
                    </p>
                </div>
                <div class="border-start border-info my-3 ps-4 py-4 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <p class="fw-semibold fs-5 mb-0">
                            Over 1,000,000 units sold! We made it on FOX NEWS! This is GROUND BREAKING! NOW YOU NEED TO
                            INVEST OR YOU WILL REGRET! Joe DeMagio just recently aquired TD Ameritrade in a combat deal
                            against the Armed Forces Of Hawaii (AFH). Check Mate.

                        </p>
                    </div>
                </div>
                <div>
                    <p class="fw-bolder fs-5 mb-0">07-23-23</p>
                    <p class="fw-bolder fs-4 mb-0">NEW RECORD OF UNITS SOLD + MAJOR PUBLICATION
                    </p>
                </div>
                <div class="border-start border-info my-3 ps-4 py-4 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <p class="fw-semibold fs-5 mb-0">
                            Over 1,000,000 units sold! We made it on FOX NEWS! This is GROUND BREAKING! NOW YOU NEED TO
                            INVEST OR YOU WILL REGRET! Joe DeMagio just recently aquired TD Ameritrade in a combat deal
                            against the Armed Forces Of Hawaii (AFH). Check Mate.

                        </p>
                    </div>
                </div>
                <div>
                    <p class="fw-bolder fs-5 mb-0">07-23-23</p>
                    <p class="fw-bolder fs-4 mb-0">NEW RECORD OF UNITS SOLD + MAJOR PUBLICATION
                    </p>
                </div>
                <div class="border-start border-info my-3 ps-4 py-4 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <p class="fw-semibold fs-5 mb-0">
                            Over 1,000,000 units sold! We made it on FOX NEWS! This is GROUND BREAKING! NOW YOU NEED TO
                            INVEST OR YOU WILL REGRET! Joe DeMagio just recently aquired TD Ameritrade in a combat deal
                            against the Armed Forces Of Hawaii (AFH). Check Mate.

                        </p>
                    </div>
                </div>
                <div>
                    <p class="fw-bolder fs-5 mb-0">07-23-23</p>
                    <p class="fw-bolder fs-4 mb-0">NEW RECORD OF UNITS SOLD + MAJOR PUBLICATION
                    </p>
                </div>
                <div class="border-start border-info my-3 ps-4 py-4 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <div>
                        <p class="fw-semibold fs-5 mb-0">
                            Over 1,000,000 units sold! We made it on FOX NEWS! This is GROUND BREAKING! NOW YOU NEED TO
                            INVEST OR YOU WILL REGRET! Joe DeMagio just recently aquired TD Ameritrade in a combat deal
                            against the Armed Forces Of Hawaii (AFH). Check Mate.

                        </p>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade p-2" id="q&a" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="fw-bolder">Q & A</h3>
                <p class="fs-4 mb-5"> <strong>Can’t find an answer to your question?</strong> Use the form at the bottom
                    of
                    this page to submit your questions.
                </p>
                <div>
                    <h5 class="fw-bolder fs-4 mb-0">
                        JOHN ADAMS
                    </h5>
                </div>
                <div class="border-start border-info my-3 ps-4 py-4 pe-3 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <p class="fw-semibold fs-5 mb-0">
                        What time does Mcdonalds close? I could really use some hashbrowns and an iced coffee? Is your
                        location still serving all day breakfast? Thank you!
                    </p>
                    <div>
                    </div>
                </div>
                <div class="ms-5">
                    <h5 class="fw-bolder fs-4 mb-0">
                        McDonalds (Broadway)
                    </h5>
                </div>
                <div class="border-start border-info my-3 ps-4 py-4 pe-3 ms-5 rounded"
                    style="background-color: #DBDBDB;  border-width: 15px !important;">
                    <p class="fw-semibold fs-5 mb-0">
                        What time does Mcdonalds close? I could really use some hashbrowns and an iced coffee? Is your
                        location still serving all day breakfast? Thank you!
                    </p>
                    <div>
                    </div>
                </div>
                <h3 class="fw-bolder mt-5">Submit Question
                </h3>
                <form>
                    <div class="mb-3 text-end">
                        <label for="exampleFormControlTextarea1" class="form-label">Maximum 500 Characters
                        </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
