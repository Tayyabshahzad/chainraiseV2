@extends('layouts.master')
@section('title', $offer->name)
@section('page_head')
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <style>
        .hero-section {
            height: 100% !important;
            background: linear-gradient(rgb(137 126 126 / 50%), rgb(0 0 0)), url("{{ $offer->getFirstMediaUrl('cover_photo', 'thumb') }}");
            background-size: cover;
            background-repeat: no-repeat;

        }
        .image-with-initial {
  position: relative;
  display: inline-block;
}

.image-with-initial::before {
  content: "T"; /* Set the content to the desired initial letter */
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #007bff;
  color: #fff;
  font-weight: bold;
  font-size: 18px;
  text-align: center;
  line-height: 32px;
  border-radius: 50%;
  z-index: 1;
  opacity: 0.8;
  pointer-events: none;
}

/* Optional: Add some padding to the image to prevent overlap with the initial */
.image-with-initial img {
  padding: 8px;
}



    </style>
@endsection

@section('content')
    <!-- Hero Section Start -->

    <!-- Hero Section Start -->
    <section class="container-fluid hero-section">
        <div class="row justify-content-center">

            <div class="col-12 text-center ">
                <img src="{{ $offer->getFirstMediaUrl('offer_logo', 'thumb') }}" style="width: 25%!important"
                    class="p-3 white-logo" alt="...">
                <p class="text-white fs-5 fw-semibold mb-4"> {{ $offer->name }} </p>
            </div>
            <div class="col-12 text-center" style="margin-bottom:1%;">
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
                                <button type="button" class="btn-close" id="video_close_button" data-bs-dismiss="modal"
                                    aria-label="Close"> </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item" src="{{ $offer->feature_video }}" id="video"
                                        allowscriptaccess="always"></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <form action="{{ route('invest.submit') }}" method="get" id="investForm">
                    <div class="row mb-4">
                        <div class="col-lg-2 col-6 text-center">
                            <h6 class="text-white fw-normal">Offer Type</h6>
                            <h6 class="sky-blue fw-normal"> {{ ucfirst($offer->offer_type) }} </h6>
                        </div>

                        <div class="col-lg-2 col-6 text-center">
                            <h6 class="text-white fw-normal">Offer Amount</h6>
                            <h6 class="sky-blue fw-normal"> ${{ number_format($offer->size) }} </h6>
                        </div>

                        <div class="col-lg-2  col-6 text-center">
                            <h6 class="text-white fw-normal">Securities Type </h6>
                            <h6 class="sky-blue fw-normal"> {{ ucfirst($offer->security_type) }} </h6>
                        </div>

                        <div class="col-lg-2  col-6 text-center fw-normal">
                            <h6 class="text-white fw-normal">Valuation</h6>
                            <h6 class="sky-blue fw-normal">${{ number_format($offer->total_valuation) }}</h6>
                        </div>

                        <div class="col-lg-2  col-12 text-center">
                            <h6 class="text-white fw-normal">Min. Investment</h6>
                            <h6 class="sky-blue fw-normal">
                                ${{ number_format($offer->investmentRestrictions->min_invesment) }}</h6>
                        </div>

                    </div>
                    <div class="row px-5">
                        @csrf
                        <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                        <div class="col-9 px-0">
                            <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                            <div class="input-group">
                                <div class="input-group-text">$</div>
                                <input type="text" class="form-control" id="autoSizingInputGroup"
                                    name="investment_amount"
                                    placeholder="@if ($offer->investmentRestrictions) {{ number_format($offer->investmentRestrictions->min_invesment) }} @endif"
                                    required>
                            </div>
                        </div>
                        <div class="col-3">
                            <button
                                @if (Auth::user()) type="submit"  @else id="show-login-message"  type="button" @endif
                                class="btn btn-outline-info text-white">
                                INVEST
                            </button>
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
            <div class="col-lg-6 col-12 text-center ">
                <img src="{{ $offer->getFirstMediaUrl('offer_logo', 'thumb') }}"
                    class="img-responsive offer_logo_image img-fluid b-logo" alt="...">
                <br>
                <strong> {{ $offer->name }} </strong>
            </div>


            <div class="col-lg-6 col-12 text-center">

                @if ($offer->socialMedia)
                    <a target="_blank" href="https://www.linkedin.com/{{ $offer->socialMedia->linkedIn }}">
                        <i class="bi bi-linkedin me-lg-4 me-2 icon"></i>
                    </a>

                    <a target="_blank" href="https://www.telegram.com/{{ $offer->socialMedia->telegram }}">
                        <i class="bi bi-send me-lg-4 me-2 icon"></i>
                    </a>

                    <a target="_blank" href="https://www.instagram.com/{{ $offer->socialMedia->instagram }}">
                        <i class="bi bi-instagram me-lg-4 me-2  icon"></i>
                    </a>

                    <a target="_blank" href="https://www.twitter.com/{{ $offer->socialMedia->twitter }}">
                        <i class="bi bi-twitter me-lg-4 me-2 icon"></i>
                    </a>

                    <a target="_blank" href="https://www.youtube.com/{{ $offer->socialMedia->youtube }}">
                        <i class="bi bi-youtube me-lg-4 me-2 icon"></i>
                    </a>

                    <a target="_blank" href="https://www.facebook.com/{{ $offer->socialMedia->facebook }}">
                        <i class="bi bi-facebook me-lg-4 me-2 icon"></i>
                    </a>
                @endif
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
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#updates" type="button" role="tab" aria-controls="pills-document"
                    aria-selected="false">Updates</button>
            </li>
            <li class="nav-item me-lg-3" role="presentation">
                <button class="nav-link text-white" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#questions_answers" type="button" role="tab" aria-controls="pills-document"
                    aria-selected="false">Q&A</button>
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
                @if ($slider_images->count() > 0)
                    <div class="row">
                        <div class="col">
                            <h2 class="fs-2 fw-bolder my-5">Company Deck </h2>
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    @for ($i = 0; $i <= $slider_images->count(); $i++)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $i }}" class="active" aria-current="true"
                                            aria-label="Slide {{ $i }}"></button>
                                    @endfor

                                </div>
                                <div class="carousel-inner">
                                    @foreach ($slider_images as $slider_image)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img src="{{ asset('storage/' . $slider_image->id . '/' . $slider_image->file_name) }}"
                                                class="d-block w-100" alt="...">
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
                @endif
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
                        @foreach ($manual_offer_documents as $manual_offer_document)
                            <div class="col-lg-4 mb-3  col-md-4 col-sm-6 col-xs-6 text-left"
                                style="margin-bottom:6%!important">
                                <div class="row">
                                    <div class="col-lg-2">
                                        @if ($manual_offer_document->type == 'image')
                                            <a href="{{ $manual_offer_document->getUrl() }}" target="_blank">
                                                <img src="{{ $manual_offer_document->getUrl() }}" alt=""
                                                    height="250" width="250">
                                            </a>
                                        @elseif($manual_offer_document->type == 'pdf')
                                            <a href="{{ $manual_offer_document->getUrl() }}" target="_blank">
                                                <img src="{{ asset('media/PDF_file_icon.png') }}" alt=""
                                                    width="40">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-lg-10 text-left " style="padding-top:10px;">
                                        <p style="font-size:20px;font-weight:600">
                                            {{ Str::ucfirst($manual_offer_document->name) }} </p>
                                    </div>
                                </div>



                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-2" id="updates" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="fw-bolder">Updates</h3>
                <br>
                <div class="row ">
                        @foreach ($offer->updates as $update)
                            <div class="col-lg-12 "  style="margin-bottom:1%!important">
                                 <p>
                                    {!! $update->update !!}
                                 </p>
                                 <br>
                                 <small>
                                    Last Updated {{  $update->updated_at->diffForHumans() }}
                                 </small>
                            </div>
                        @endforeach
                </div>
            </div>
            <div class="tab-pane fade p-2" id="questions_answers" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h3 class="fw-bolder col-lg-12 col-md-6">Q&A</h3>

                @if(Auth::user())
                    <button class="btn btn-sm btn-info" type="button" data-bs-toggle="modal"
                        data-bs-target="#PostQuestion" class="btn btn-outline-light rounded-circle"
                        style=" border-radius:no-radius;"> Post A Question</button>
                @endif
                <hr>

                @foreach ($offer->activeQuestions as $question)
                    <div class="row">
                        <div class="">
                            <div class="media text-muted pt-3">
                                <div class="col-lg-12">
                                    <strong class="text-gray-dark">{{ $question->question }}</strong>
                                </div>
                                <p class="media-body pb-3 mt-2 mb-0 small lh-125 border-bottom border-gray">
                                    @php
                                        $answer = $question->answer;
                                        $limit = 300;
                                    @endphp
                                    <span class="question-text">
                                        {{ strlen($answer) > $limit ? substr($answer, 0, $limit) : $answer }}
                                    </span>
                                    @if (strlen($answer) > $limit)
                                        <span class="read-more-content" style="display: none;">
                                            {{ substr($answer, $limit) }}
                                        </span>
                                        <a href="#" class="read-more-link">Read More</a>
                                    @endif
                                </p>
                                <h6 class="" style="font-size: 10px; padding-top: 10px;">
                                    {{ $question->created_at->diffForHumans() }} Posted By {{ $question->investor->name }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

    </div>

    @if(Auth::user())
        <div class="modal fade" id="PostQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="{{  route('post.offer.question') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <input type="hidden" name="investor_id" value="{{ Auth::user()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title">Post Your Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="question" id="" class="form-control" cols="20" rows="5" required placeholder="Please Enter Your Question"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    @endif



@endsection

@section('page_js')
    <script>
        // Function to stop the Vimeo video when the modal is closed
        function stopVimeoVideo() {
            var iframe = document.getElementById('video');
            var player = new Vimeo.Player(iframe);
            player.pause(); // Pause the video
        }

        function stopYouTubeVideo() {
            var youtubeIframe = document.getElementById('video');
            var youtubePlayer;

            // Check if the YouTube iframe API is ready
            if (typeof YT !== 'undefined' && YT.Player) {
                youtubePlayer = new YT.Player(youtubeIframe);

                // Pause the YouTube video
                youtubePlayer.pauseVideo();
            }
        }
        // Attach the stopVimeoVideo function to the modal close event
        // document.getElementById('video_close_button').addEventListener('click', stopVimeoVideo);

        document.getElementById('video_close_button').addEventListener('click', function() {
            stopVimeoVideo();
            stopYouTubeVideo();
        });

        $(document).ready(function() {

            $('#show-login-message').click(function() {
                toastr["error"]('Need to be signed in to invest')
            });

        });
    </script>

    <script>
        // Function to format a number as a currency value without any currency symbol
        function formatCurrencyWithoutSymbol(number) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                currencyDisplay: 'narrowSymbol',
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            }).format(number);
        }

        // Get the input field
        var inputField = document.getElementById('autoSizingInputGroup');

        // Listen for input events on the input field
        inputField.addEventListener('input', function() {
            // Get the user's input
            var inputValue = inputField.value;

            // Remove non-numeric characters and any currency symbols
            var numericValue = parseFloat(inputValue.replace(/[^0-9.]/g, ''));

            // Check if the numericValue is a valid number
            if (!isNaN(numericValue)) {
                // Format the numeric value as a currency without any symbol and set it back in the input field
                inputField.value = formatCurrencyWithoutSymbol(numericValue);
            } else {
                // If the input is not a valid number, keep the original input
                inputField.value = inputValue;
            }
        });
    </script>
<script>
    $(document).ready(function () {
    $('.read-more-link').on('click', function (e) {
        e.preventDefault();
        var $readMoreLink = $(this);
        var $readMoreContent = $readMoreLink.siblings('.read-more-content');

        $readMoreContent.slideToggle();
        $readMoreLink.hide(); // Hide the "Read More" link
    });
});
    </script>

@endsection
