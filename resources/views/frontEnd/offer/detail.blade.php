<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chainrasie</title>
    <link rel="stylesheet" href="{{  asset('vue/css/detail-2-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <style>
            .container-bg{
                background-image: url("{{ $offer->getFirstMediaUrl('cover_photo', 'thumb') }}")!important;
            }
        </style>
</head>

<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg bg-dark-color" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item px-lg-3">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Investors</a>
                    </li>
                    <li class="nav-item dropdown px-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Learn
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">FAQ</a></li>
                            <li><a class="dropdown-item" href="#">Business</a></li>
                            <li><a class="dropdown-item" href="#">Blockchain</a></li>
                        </ul>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Real Estate</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Tech</a>
                    </li>
                </ul>
                <button type="button" class="btn transparent_btn mx-3 px-4" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Login</button>
                <button type="button" class="btn color_btn px-4">Signup</button>
            </div>
        </div>
    </nav>
    <!-- Header End -->

    <!-- Hero Section Start -->
    <section class="p-lg-5 p-3 hero-bg">
        <div class="container container-bg rounded">
            <div class="row align-items-end position-relative " style="height: 600px;">
                <div class="col-lg-6 p-lg-5">
                    <img src="{{ $offer->getFirstMediaUrl('offer_logo', 'thumb') }}" alt="Logo" srcset="">

                    <h1 class="explore-detail">{{ $offer->name }}</h1>
                    <div class="d-grid gap-2 d-md-block pt-lg-3">
                        <button class="btn text-white px-lg-5 fw-semibold" style="background-color: #FF7A00 !important;"
                            type="button"> 30 Days
                            Left <img src="{{ asset('vue/images/info.png')}}">
                        </button>
                        <button class="btn px-lg-5 fw-semibold"
                            style="background-color: #ffffff !important; color: #294FF6 !important;" type="button">
                            US${{ number_format($offer->total_valuation) }} <span class="text-dark">Raised</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 p-lg-5 text-white text-end">
                    <p class="tab-text text-lg-start">{{ $offer->short_description }}.</p>
                    <img src="{{ asset('vue/images/Group 12578.png')}}" alt="" srcset="" class="img-fluid">
                </div>
                <div class="col-lg-12 play-btn">

                    <a type="button" data-bs-toggle="modal" data-src="{{ $offer->feature_video }}"
                        data-bs-target="#myModal">
                        <img src="{{ asset('vue/images/Group 12576.png')}}" alt="Video Paly Button">
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
                                        <iframe class="embed-responsive-item"
                                            src="{{ $offer->feature_video }}"
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
                <div class="col-lg-8 ps-lg-0">
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
                                                            class="img img-thumbnail figure-img img-fluid rounded" alt="..."
                                                            style="width:200px">
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

                            <div class="row gx-0 gy-4">
                                @foreach ($slider_images as $slider_image)
                                <div class="col-lg-4">
                                    <img src="{{ asset('storage/' . $slider_image->id . '/' . $slider_image->file_name) }}" alt="" srcset="" class="img-fluid">
                                </div>
                                @endforeach

                            </div>
                            @endif
                        </div>
                        <div class="tab-pane fade p-2" id="videos" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                        <div class="tab-pane fade p-2" id="updates" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <h1 class="tab-text">Recent Updates</h1>

                            @foreach ($offer->updates as $update)
                            <div class="row mt-3">
                                <div class="col-6">
                                    <p class="fw-bolder text-white mb-0">New Issuer Account Setup </p>
                                </div>
                                <div class="col-6 text-lg-end">
                                    <p class="text-white mb-0"> Last Update {{  $update->updated_at->diffForHumans() }} </p>
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
                        <div class="tab-pane fade p-2" id="qa" role="tabpanel" aria-labelledby="pills-contact-tab">
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
                                    {{  $question->question }}
                                </p>
                                <div>
                                </div>
                            </div>
                            <div class="ms-5">
                                <h5 class="fw-bolder fs-4 mb-0 text-white">
                                    @if($question->issuer){{ Str::ucfirst($question->issuer->name) }}@endif
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
                            <form action="{{  route('post.offer.question') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                                <div class="mb-3 text-end">
                                    <label for="exampleFormControlTextarea1" class="form-label">Maximum 500 Characters
                                    </label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="question" required rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"  @if(!Auth::user())  disabled @endif  >Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 side-col-bg px-lg-4">
                    <div class="my-lg-4 p-lg-4 bg-image-modal">
                        <p class="text-white"><b>LAST CHANCE</b></p>
                        <div class="text-white border-style-div text-center p-3">
                            <p class="mb-0"><b>Closing on 3 nov</b></p>
                            <p>@11.59 pm new York time</p>
                            <hr>
                            <div class="row pt-3">
                                <div class="col border-end">07<br>Day</div>
                                <div class="col border-end">16<br>Hour</div>
                                <div class="col border-end">09<br>Min</div>
                                <div class="col">33<br>Sec</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  text-white">
                        <div class="col-4 border-end"><span class="blue">Offer Type</span><br>{{ ucfirst($offer->offer_type) }}</div>
                        <div class="col-4 border-end"><span class="blue">Offer Amount</span><br>${{ number_format($offer->size) }}</div>
                        <div class="col-4 "><span class="blue">Securities Type</span><br>{{ ucfirst($offer->security_type)}}</div>
                        <div class="py-2">
                            <hr>
                        </div>
                        <div class="col-4 border-end"><span class="blue">Valuation</span><br>${{ number_format($offer->total_valuation) }}</div>
                        <div class="col-4"><span class="blue">Min. Investment</span><br>${{ number_format($offer->investmentRestrictions->min_invesment) }}</div>
                        <div class="py-2">
                            <hr>
                        </div>
                        <div>
                            <p><b>Almost Sold out</b></p>
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: 25%"></div>
                            </div>
                        </div>
                        <div class="row pt-2 mx-0 px-0">
                            <div class="col-6">
                                <p>Total Investment Raised</p>
                            </div>
                            <div class="col-6 text-lg-end">
                                <p>${{ number_format($offer->total_valuation) }}</p>
                            </div>
                        </div>
                        <div class="row pt-2 mx-0 px-0">
                            <div class="col-4">
                                <span class="blue">Invest</span><br>min ${{ number_format($offer->investmentRestrictions->min_invesment) }}
                            </div>
                            <div class="col-8 text-lg-end">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingInputGroup1"
                                            placeholder="Username">
                                        <label for="floatingInputGroup1">Invest</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto">
                            <button class="btn color_btn" type="button">Invest Now</button>
                            <button class="btn transparent_btn" type="button">Add to Watchlist</button>
                        </div>
                        <div class="py-3">
                            <hr>
                        </div>
                        <div>
                            <p class="mb-0 pb-0"><b>Document(s)</b></p>
                            <div class="py-3">
                                <hr>
                            </div>
                            <div class="row">
                                @foreach ($manual_offer_documents as $manual_offer_document)
                                    @if($manual_offer_document->type == 'pdf')
                                        <div class="col-10">
                                            <img src="{{ asset('vue/images/pdf (1).png')}}" alt="">
                                            <span class="ps-3"> {{ Str::ucfirst($manual_offer_document->name) }} </span>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ $manual_offer_document->getUrl() }}" download="{{ Str::ucfirst($manual_offer_document->name) }}">
                                                <img src="{{ asset('vue/images/Group 12584.png')}}" alt="">
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
    </section>



    <footer class="bg-dark-color">
        <div class="container">
            <div class="row pt-lg-4 pb-lg-2">
                <div class="col-lg-3">
                    <a href="#">
                        <img src="{{ asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
                    </a>
                </div>
                <div class="col-lg-9 text-white">
                    <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 text-lg-start ms-lg-0 ps-lg-0">
                    <ul class="d-flex m-lg-0 py-lg-3 px-lg-0">
                        <li class="nav-item px-lg-3">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link" href="#">Educational Materials</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link" href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 my-lg-auto text-lg-end">
                    <img src="{{ asset('vue/images/social.png')}}" alt="Logo">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr>
            <p class="text-white py-lg-4 text-lg-center my-0">© Copyright 2023 - investchainraise</p>
        </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-image-modal">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a class="py-lg-4" href="#">
                        <img src="{{ asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
                    </a>
                    <div class="d-grid gap-2">
                        <button class="btn transparent_btn" type="button">Button</button>
                        <button class="btn transparent_btn" type="button">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
