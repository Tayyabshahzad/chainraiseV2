
@extends('layouts.master')
@section('page_title','Details')
@section('page_style')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vue/css/style-detail.css') }}">
    <style>
        .container-bg {
            background-image: url("{{ $offer->getFirstMediaUrl('cover_photo', 'thumb') }}") !important;
        }
        .play-btn {
            position: absolute!important;

            text-align: center!important;
        }
        .container-bg {
            background-blend-mode: multiply;
            background-color: #000000ab;
        }
        ::marker {
        color: white;
    }
    </style>
@endsection

@section('page_content')
<!-- Hero Section Start -->
<section class="p-lg-5 p-3 hero-bg">
    <div class="container container-bg rounded">
        <div class="row align-items-end position-relative " style="height: 600px;">
            <div class="col-lg-6 p-lg-5">
                <img src="{{ $offer->getFirstMediaUrl('offer_logo', 'thumb') }}" alt="Offer Logo" width="92" height="92">
                <h1 class="explore-detail">{{ $offer->name }}</h1>
                <div class="d-grid gap-2 d-md-block pt-lg-3">
                    {{-- <button class="btn text-white px-lg-5 fw-semibold" style="background-color: #FF7A00 !important;"
                        type="button"> 30 Days
                        Left <img src="{{ asset('vue/images/info.png') }}">
                    </button>
                    <button class="btn px-lg-5 fw-semibold"
                        style="background-color: #ffffff !important; color: #294FF6 !important;" type="button">
                        ${{ number_format($offer->total_valuation) }} <span class="text-dark">Raised</span>
                    </button> --}}
                </div>
            </div>

            <div class="col-lg-12 play-btn">
                <a type="button" data-bs-toggle="modal" data-src="{{ $offer->feature_video }}"
                    data-bs-target="#myModal">
                    <img src="{{ asset('vue/images/Group 12576.png') }}" alt="Video Paly Button">
                </a>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item" src="{{ $offer->feature_video }}"
                                        id="video" allowscriptaccess="always" allow="autoplay"></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>
<!-- Hero Section End -->
<section class="bg-dark-color p-lg-5 p-3 ">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 ps-lg-0">
                <ul class="nav nav-pills nav-fill" style="background-color: #333333;" id="pills-tab" role="tablist">
                    <li class="nav-item me-lg-3" role="presentation">
                        <button class="nav-link active text-white" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#overview" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Overview</button>
                    </li>
                    <li class="nav-item me-lg-3" role="presentation">
                        <button class="nav-link text-white" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#videos" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Videos</button>
                    </li>
                    <li class="nav-item me-lg-3" role="presentation">
                        <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#updates" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Updates</button>
                    </li>
                    <li class="nav-item me-lg-3" role="presentation">
                        <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#qa" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Q&A</button>
                    </li>
                </ul>
                <div class="tab-content py-lg-4 py-3" id="pills-tabContent">
                    <div class="tab-pane fade show active p-2" id="overview" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <h1 class="tab-text">Overview</h1>
                        <p class="tab-text text-white">
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
                        <hr>
                        @if ($slider_images->count() > 0)

                            <h1 class="tab-text py-lg-4 py-3">Pitch Deck</h1>

                            <div class="row g-3 gy-4">
                                @foreach ($slider_images as $slider_image)

                                    <div class="col-lg-4">
                                        <a href="{{ asset('storage/' . $slider_image->id . '/' . $slider_image->file_name) }}" class="popup-link" data-title="Image 1">
                                            <img src="{{ asset('storage/' . $slider_image->id . '/' . $slider_image->file_name) }}" class="img-fluid rounded" alt="Image 1">
                                        </a>

                                    </div>
                                @endforeach

                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade p-2" id="videos" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        <div class="row gy-3">
                            <h1 class="tab-text">Videos</h1>
                            @foreach ($offer->offerVideos as $video)
                                <div class="col-lg-4 m-3">
                                    <iframe src="{{ $video->url }}" frameborder="0"></iframe>
                                    <br>
                                    <p class="text-center text-white"> {{ $video->description }} </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade p-2" id="updates" role="tabpanel"
                        aria-labelledby="pills-contact-tab">
                        <h1 class="tab-text">Recent Updates</h1>

                        @foreach ($offer->updates as $update)
                            <div class="row mt-3">
                                <div class="col-6">
                                    <p class="fw-bolder text-white mb-0">New Issuer Account Setup </p>
                                </div>
                                <div class="col-6 text-lg-end">
                                    <p class="text-white mb-0"> Last Update {{ $update->updated_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class=" my-3 ps-4 py-4 pe-3 bg-image-modal rounded">
                                <div>
                                    <p class=" fw-semibold tab-text  mb-0">
                                        {!! $update->update !!}

                                    </p>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="tab-pane fade p-2" id="qa" role="tabpanel"
                        aria-labelledby="pills-contact-tab">
                        <h1 class="tab-text">Q & A</h1>
                        <p class="text-white"> <strong>Can’t find an answer to your question?</strong> Use the form
                            at the bottom
                            of
                            this page to submit your questions.
                        </p>


                        @foreach ($offer->activeQuestions as $question)
                            <div>
                                <h5 class="fw-bolder fs-4 mb-0 text-white">
                                    {{ Str::ucfirst($question->investor->name) }}
                                </h5>
                            </div>
                            <div class="my-3 ps-4 py-4 pe-3 rounded bg-image-modal">
                                <p class=" fw-semibold tab-text mb-0">
                                    {{ $question->question }}
                                </p>
                                <div>
                                </div>
                            </div>
                            <div class="ms-5">
                                <h5 class="fw-bolder fs-4 mb-0 text-white">
                                    @if ($question->issuer)
                                        {{ Str::ucfirst($question->issuer->name) }}
                                    @endif
                                </h5>
                            </div>
                            <div class="my-3 ps-4 py-4 pe-3 ms-5 rounded bg-image-modal ">
                                <p class=" fw-semibold tab-text mb-0">
                                    {{ $question->answer }}
                                </p>
                                <div>
                                </div>
                            </div>
                        @endforeach
                        <h1 class="fw-bolder tab-text mt-5">Submit Question
                        </h1>
                        <form action="{{ route('post.offer.question') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                            <div class="mb-3 text-end">
                                <label for="exampleFormControlTextarea1" class="form-label">Maximum 500 Characters
                                </label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="question" required rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"
                                @if (!Auth::user()) disabled @endif>Submit</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 ">
                <div class="side-col-bg p-lg-4" style="position:sticky;top:0;">
                    <div class="p-lg-4 bg-image-modal">
                        <p class="text-white"><b>INVEST IN OUR OFFERING</b></p>
                        <div class="text-white border-style-div text-center p-3">
                            <p class="mb-0"><b>Closing on  {{ $remainingTimeArray['remainingMonths']  }} </b></p>
                            <p> {{ $remainingTimeArray['formated']  }} New York time</p>
                            <hr>

                            <div class="row pt-3">
                                <div class="col border-end"> {{ $remainingTimeArray['remainingDays'] }}<br>Days</div>
                                <div class="col border-end"> {{ $remainingTimeArray['hours'] }}<br>Hour</div>
                                <div class="col border-end"> {{ $remainingTimeArray['minutes'] }}<br>Min</div>
                                <div class="col"> {{ $remainingTimeArray['seconds'] }}<br>Sec</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  pt-3 text-white">
                        <div class="col-4 border-end"><span class="blue">Offer   Type</span><br>{{ ucfirst($offer->offer_type) }}</div>
                        <div class="col-4 border-end"><span class="blue">Offer    Amount</span><br>${{ number_format($offer->size) }}</div>
                        <div class="col-4 border-end"><span  class="blue">Valuation</span><br>${{ number_format($offer->total_valuation) }}  </div>
                        <div class="py-2">
                            <hr>
                        </div>
                        <div class="col-4 "><span class="blue">Securitiy Type</span><br>    {{ ucfirst($offer->security_type) }}</div>
                        @if($offer->security_type == 'SAFE')
                            <div class="col-4 "><span class="blue">SAFE</span><br>    {{ ucfirst($offer->safe) }}</div>
                        @elseif($offer->security_type == 'Structure-SAFE')
                            <div class="col-4 "><span class="blue">Structure-SAFE</span><br>    {{ ucfirst($offer->structure_safe) }}</div>
                        @endif

                        <div class="col-4"><span class="blue">Min.    Investment</span><br>${{ number_format($offer->investmentRestrictions->min_invesment) }}  </div>
                        <div class="py-2"> <hr> </div>
                        <div>
                            {{-- <p><b>Almost Sold out</b></p> --}}
                            {{-- <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 25%"></div>
                            </div> --}}
                        </div>
                        <div class="row pt-2 mx-0 px-0">
                            {{-- <div class="col-6">
                                <p>Total Investment Raised</p>
                            </div>
                            <div class="col-6 text-lg-end">
                                <p>${{ number_format($offer->total_valuation) }}</p>
                            </div> --}}
                        </div>
                        <form action="{{ route('invest.submit') }}" method="get" id="investForm">
                            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                        <div class="row pt-2 mx-0 px-0">
                                <div class="col-4">
                                    <span class="blue">Invest</span><br>min
                                    ${{ number_format($offer->investmentRestrictions->min_invesment) }}
                                    <br><br>
                                </div>
                                <div class="col-8 text-lg-end">
                                    <div class="input-group mb-3">
                                        {{-- <span class="input-group-text">$</span>
                                        <div class="form-floating">
                                            <input type="text" required name="investment_amount" class="form-control" id="floatingInputGroup1"
                                                placeholder="Username" min="{{  $offer->investmentRestrictions->min_invesment }}">
                                            <label for="floatingInputGroup1">Invest</label>
                                        </div> --}}
                                    </div>

                                </div>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                                {{-- <a href="{{ route('offer.details',$offer->id)  }}" class="btn color_btn" target="_blank">Invest Now</a> --}}
                                @if($offer->ext_url != null)
                                <a href="{{  $offer->ext_url  }}" class="btn transparent_btn "  ><b> Invest Now </b></a>
                                @else
                                <button class="btn transparent_btn" type="button" disabled><b>Coming Soon</b> </button>
                                @endif

                            </div>
                        </form>

                        <div class="py-3">
                            <hr>
                        </div>

                        <div class="pb-5">
                            <p class="mb-0 pb-0"><b>Document(s)</b></p>
                            <div class="py-3">
                                <hr>
                            </div>
                            <div class="row">
                                @foreach ($manual_offer_documents as $manual_offer_document)
                                    @if ($manual_offer_document->type == 'pdf')
                                        <div class="col-10 pe-0 pb-3">
                                            <img src="{{ asset('vue/images/pdf (1).png') }}" alt="">
                                            <span class="ps-3"> {{ Str::ucfirst($manual_offer_document->name) }} </span>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ $manual_offer_document->getUrl() }}"
                                                download="{{ Str::ucfirst($manual_offer_document->name) }}">
                                                <img src="{{ asset('vue/images/Group 12584.png') }}" alt="">
                                            </a>
                                        </div>
                                    @endif
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

@section('page_js')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
  $(document).ready(function () {
    $('.popup-link').magnificPopup({type:'image'});
  });
</script>

@endsection
