@extends('layouts.master')
@section('title',   $offer->name  )
@section('page_head')
    <style>
        .hero-section{
            height: 100% !important;
            background: linear-gradient(rgb(137 126 126 / 50%), rgb(0 0 0)), url("{{ $offer->getFirstMediaUrl('banner_image', 'thumb') }}");
            background-size: cover;
            background-repeat: no-repeat;

        }
        /* #myModal iframe {
            width: 100%;
            height: 80%;
        }
        .video_modal {
        max-width: 100%;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        }
        .video_modal_content {
        width: 80%;
        height: 80%;
        } */

    </style>
@endsection

@section('content')
    <!-- Hero Section Start -->

    <!-- Hero Section Start -->
    <section class="container-fluid hero-section">
        <div class="row justify-content-center">
            <div class="col-12 text-center" style="margin-top: 5%;">
                <button type="button" data-bs-toggle="modal" data-src="{{ $offer->feature_video }}"
                    data-bs-target="#myModal" class="btn btn-outline-light rounded-circle"
                    style=" border: 2px solid RGBA(67, 195, 254, 1); padding: 16px 25px;"><span
                        class="bi bi-play-fill fs-2"></span>
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered video_modal" role="document">
                        <div class="modal-content video_modal_content">
                            <div class="modal-body text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item"
                                        src="{{ $offer->feature_video }}"
                                        id="video" allowscriptaccess="always" ></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center ">
                <img src="{{ $offer->getFirstMediaUrl('offer_image', 'thumb') }}"   style="width: 25%!important" class="p-3 white-logo" alt="...">
                <p class="text-white fs-5 fw-semibold mb-4"> {{ $offer->name }} </p>
            </div>
            <div class="col-lg-12">
                <div class="row mb-4">
                    <div class="col-lg-2 col-6 text-center">
                        <h6 class="text-white fw-normal">Offer Type</h6>
                        <h6 class="sky-blue fw-normal">  {{ ucfirst($offer->offer_type) }} </h6>
                    </div>

                    <div class="col-lg-2 col-6 text-center">
                        <h6 class="text-white fw-normal">Offer Amount</h6>
                        <h6 class="sky-blue fw-normal">  ${{ number_format($offer->size) }} </h6>
                    </div>

                    <div class="col-lg-2  col-6 text-center">
                        <h6 class="text-white fw-normal">Securities Type </h6>
                        <h6 class="sky-blue fw-normal">  {{ ucfirst($offer->security_type) }} </h6>
                    </div>

                    <div class="col-lg-2  col-6 text-center fw-normal">
                        <h6 class="text-white fw-normal">Valuation</h6>
                        <h6 class="sky-blue fw-normal">${{ number_format( $offer->total_valuation) }}</h6>
                    </div>

                    <div class="col-lg-2  col-6 text-center">
                        <h6 class="text-white fw-normal">Min. Investment</h6>
                        <h6 class="sky-blue fw-normal">${{ number_format($offer->investmentRestrictions->min_invesment) }}</h6>
                    </div>

                </div>
                <form action="{{ route('invest.submit') }}" method="get" id="investForm">
                <div class="row px-5">
                         @csrf
                        <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <div class="col-9">
                        <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="text" class="form-control" id="autoSizingInputGroup" name="investment_amount"
                            placeholder="@if ($offer->investmentRestrictions) {{ number_format($offer->investmentRestrictions->min_invesment) }} @endif"
                            required >
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit"
                        @if (Auth::user()) type="submit"  @else  disabled type="button" title="Login To Invest" @endif
                        class="btn btn-outline-info text-white">INVEST</button>
                    </div>
                </div>
                </form>
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
                <img src="{{ $offer->getFirstMediaUrl('offer_image', 'thumb') }}" style="width: 15%!important" class="img-fluid b-logo" alt="...">
            </div>
            <div class="col-6 text-end">
                <!-- <img src="images/social icon.png" class="img-fluid" alt="..."> -->
                <!-- Linkedin -->
                <i class="bi bi-linkedin me-lg-4 me-2 icon"></i>
                <!-- Telegram-->
                <i class="bi bi-send me-lg-4 me-2 icon"></i>
                <!-- Twitter -->
                <i class="bi bi-instagram me-lg-4 me-2  icon"></i>
                <!-- Instagram -->
                <i class="bi bi-twitter me-lg-4 me-2 icon"></i>
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
            @if ($offer->offerVideos->count() > 0)
                <li class="nav-item me-lg-3" role="presentation">
                    <button class="nav-link text-white" id="pills-videos-tab" data-bs-toggle="pill"
                        data-bs-target="#deal-video" type="button" role="tab" aria-controls="pills-deal-videos"
                        aria-selected="false">Videos</button>
                </li>
            @endif
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#documents" type="button" role="tab" aria-controls="pills-document"
                    aria-selected="false">Documents</button>
            </li>
        </ul>
        <div class="tab-content px-lg-5 px-3 py-3" id="pills-tabContent">
            <div class="tab-pane fade show active p-2" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @foreach ($offer->offerDetail as $offerDetail)
                    @if ($offerDetail->input == 'summary')
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
                                                class="img img-thumbnail figure-img img-fluid rounded" alt="..."
                                                style="width:200px">
                                        </figure>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="col">
                        <h2 class="fs-2 fw-bolder my-5">Company Deck    </h2>
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="0" class="active" aria-current="true"
                                    aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="3" aria-label="Slide 4"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="4" aria-label="Slide 5"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="5" aria-label="Slide 6"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="6" aria-label="Slide 7"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="7" aria-label="Slide 8"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="8" aria-label="Slide 9"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="9" aria-label="Slide 10"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="10" aria-label="Slide 11"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="11" aria-label="Slide 12"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="12" aria-label="Slide 13"></button>
                            </div>
                            <div class="carousel-inner">
                                @foreach($slider_images as $slider_image)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img src="{{ asset('storage/'.$slider_image->id.'/'.$slider_image->file_name)}}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- <img src="images/desktop.png" class="img-fluid" alt="" srcset=""> -->
                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-2" id="deal-video" role="tabpanel" aria-labelledby="pills-profile-tab">
                <h3 class="fw-bolder">Videos</h3>
                <br />
                <div class="row">
                    @foreach ($offer->offerVideos as $video)
                        <div class="col-lg-4 mb-10">
                            <iframe src="{{ $video->url }}" frameborder="0" style="width: 100%"
                                height="350"></iframe>
                            <br />
                            <h3 class="text-center mt-3"> {{ $video->description }} </h3>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade p-2" id="documents" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="fw-bolder">Documents</h3>
                <br>
                <div class="row ">
                    <div class="row gx-5">
                            @foreach($manual_offer_documents as $manual_offer_document)
                                <div class="col-lg-4 mb-3  col-md-4 col-sm-6 col-xs-6 text-center" style="margin-bottom:6%!important">
                                    @if($manual_offer_document->type == "image")
                                        <a href="{{ $manual_offer_document->getUrl() }}" target="_blank">
                                            <img src="{{ $manual_offer_document->getUrl() }}" alt="" width="250">
                                        </a>
                                    @elseif($manual_offer_document->type == "pdf")
                                        <a href="{{ $manual_offer_document->getUrl() }}" target="_blank">
                                            <img src="{{ asset('media/PDF_file_icon.png') }}" alt="" width="90">
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>




@endsection
