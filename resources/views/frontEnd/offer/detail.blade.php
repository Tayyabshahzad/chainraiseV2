@extends('layouts.master')
@section('page_head')
    <style>
        .hero-section-offer-2 {
            height: 100vh !important;
            background: linear-gradient(rgb(137 126 126 / 50%), rgb(0 0 0)), url("{{ $offer->getFirstMediaUrl('banner_image', 'thumb') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: end;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section Start -->
    <section class="container-fluid hero-section-offer-2">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <button type="button" data-bs-toggle="modal" data-src="{{ $offer->feature_video }}" data-bs-target="#myModal"
                    class="btn btn-outline-light rounded-circle"
                    style=" border: 2px solid RGBA(67, 195, 254, 1); padding: 16px 25px;"><span
                        class="bi bi-play-fill fs-2"></span>
                </button>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item" src="{{ $offer->feature_video }}" id="video"
                                        allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center ">
                <img src="{{ $offer->getFirstMediaUrl('offer_image', 'thumb') }}" class="p-3 img-fluid" alt="...">
                <p class="text-white fs-5 fw-semibold mb-4"> {{ $offer->name }}</p>
            </div>
            <div class="col-lg-6">
                <div class="row mb-4">
                    <div class="col-4 text-center">
                        <h6 class="text-white fw-normal">Securities Type</h6>
                        <h6 class="sky-blue fw-normal">Crowdfund Safe</h6>
                    </div>
                    <div class="col-4 text-center">
                        <h6 class="text-white fw-normal">Min. Investment</h6>
                        <h6 class="sky-blue fw-normal"> ${{ number_format($offer->investmentRestrictions->min_invesment) }}
                        </h6>
                    </div>
                    <div class="col-4 text-center fw-normal">
                        <h6 class="text-white fw-normal">Valuation</h6>
                        <h6 class="sky-blue fw-normal">${{ number_format($offer->size) }}</h6>
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
                                <input type="text" class="form-control text-left" name="investment_amount" required
                                    placeholder="@if ($offer->investmentRestrictions) {{ number_format($offer->investmentRestrictions->min_invesment) }}" @endif
                        id="autoSizingInputGroup"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-outline-info text-white"
                                @if (Auth::user()) type="submit"  @else  disabled type="button" title="Login To Invest" @endif>INVEST</button>
                        </div>
                    </div>
                </form>
                <div class="row px-5">
                    <div class="col-12 text-center mt-5">
                        <a href="#detail"><i class="bi bi-arrow-down-circle fs-3 sky-blue"></i></a>
                        <p class="text-white fs-5 fw-semibold">Scroll Down for Details</p>
                    </div>
                </div>



            </div>
    </section>
    <!-- Hero Section End -->
    <!-- Faq Section Start -->
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center px-lg-5 p-4">
            <div class="col-6">
                <img src="{{ $offer->getFirstMediaUrl('offer_image', 'thumb') }}" class="img-fluid " alt="...">
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
                    data-bs-target="#document" type="button" role="tab" aria-controls="pills-document"
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
            <div class="tab-pane fade p-2" id="deal-video" role="tabpanel" aria-labelledby="pills-deal-video">
                <h3 class="fw-bolder" style="margin-top:20px"> Offer Videos </h3>
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
            <div class="tab-pane fade p-2" id="document" role="tabpanel" aria-labelledby="pills-document">
                <h3 class="fw-bolder" style="margin-top:20px"> Offer Documents </h3>
                <br />
                <div class="row ">

                    <div class="row gx-5">
                        <div class="col-lg-4 mb-3  text-center">
                            <a href="offering3.html" target="_blank">

                                <img src="{{ asset('media/PDF_file_icon.png') }}" alt="" style="width: 10%" class="img-fluid" srcset="">
                            </a>
                            <div class="row text-white p-3">
                                <div class="col-12 text-start text-info text-center">
                                    <h6>  {{ $temp_name }} </h6>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    </div>

@endsection
