<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chainrasie | @yield('page_title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('vue/css/style-business.css') }}">
    <style>
        .footer_social {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer_social li {
            display: inline-block;
            margin-right: 10px;
            color: white !important;
        }

        .footer_social a {
            text-decoration: none;
        }

        .footer_social i {
            font-size: 24px;
            color: #ffffff;
        }

        .bg-image-tree {
            background-image: url("{{ asset('vue/images/hero-bg.png') }}");
        }

        .section-bg {
            background-image: url("{{ asset('vue/images/section-bg.png') }}");
        }
        </style>

    @vite('resources/js/app.js')
    @inertiaHead
    @routes
</head>

<body>
    <!-- Header Start -->

    <nav class="navbar navbar-expand-lg bg-dark-color" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('vue/images/logo.png') }}" alt="Logo" width="250px" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item px-lg-3">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="{{  route('investors') }}">Investors</a>
                    </li>
                    <li class="nav-item dropdown px-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Learn
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-white" href="{{  route('faq')  }}">FAQ</a></li>
                            <li><a class="dropdown-item text-white" href="{{  route('businesses') }}">Business</a></li>
                            {{-- <li><a class="dropdown-item" href="{{  route('blockchain') }}">Block Chain</a></li> --}}

                        </ul>
                    </li>
                    {{-- <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Real Estate</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Tech</a>
                    </li> --}}
                </ul>
                <a href="https://chainraise.sppx.io/sso?destination=/" target="_blank" class="btn transparent_btn mx-3 px-4">Login</a>

                {{-- <button type="button" class="btn color_btn px-4">Signup</button> --}}
            </div>
        </div>
    </nav>
    <!-- Header End -->
    <!-- Hero Section Start -->
    @section('page_content')
        @inertia
    @show
    <!-- 2nd Section Start -->
    <footer class="bg-dark-color">
        <div class="container">
            <div class="row pt-lg-4 pb-lg-2">
                <div class="col-lg-12 text-lg-start text-center">
                    <a href="{{  route('index') }}">
                        <img src="{{  asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 text-lg-start ms-lg-0 ps-lg-0">
                    <ul class="d-flex m-lg-0 py-3 px-lg-0 m-0 p-0">
                        <li class="nav-item px-lg-3">
                            <a class="nav-link  xyz" href="#">Educational Materials</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link  xyz" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link  xyz" href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 my-auto">
                    <ul
                        class="d-flex justify-content-lg-end justify-content-center text-white align-items-center mb-0 pb-0">
                        <li class="pe-3">
                            <a href="https://www.facebook.com/chainraise.io">
                                <i class="bi bi-facebook text-white"></i>
                            </a>
                        </li>

                        <li class="pe-3">
                            <a href="https://www.instagram.com/chainraise.io/">
                                <i class="bi bi-instagram text-white"></i>
                            </a>
                        </li>


                        <li class="pe-3">
                            <a href="https://www.linkedin.com/company/chainraise-io/">
                                <i class="bi bi-linkedin text-white"></i>
                            </a>
                        </li>


                        <li class="pe-3">
                            <a href="https://twitter.com/chainraise_io">
                                <i class="bi bi-twitter text-white"></i>
                            </a>
                        </li>

                        <li class="pe-3">
                            <a href="https://www.youtube.com/@chainraise3485">
                                <i class="bi bi-youtube text-white"></i>
                            </a>
                        </li>

                        <li>
                            <a href="https://discord.com/invite/Xau7zzmQk5">
                                <i class="bi bi-discord text-white"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 text-white py-3">


                    <p>
                        <strong>
                            Important Message
                        </strong>
                        <br/>
                        In Making An Investment Decision, Investors Must Rely On Their Own Examination Of The Issuer And The Terms Of The Offering, Including The Merits And Risks Involved. Investments On Startengine Are Speculative, Illiquid, And Involve A High Degree Of Risk, Including The Possible Loss Of Your Entire Investment.
                    </p>

                    <p>
                        <strong>
                            <a href="https://chainraise.io"> www.ChainRaise.io </a>
                        </strong>
                        is a website owned and operated by ChainRaise, LLC. (“ChainRaise”), which is neither a registered broker-dealer, investment advisor nor funding portal.
                    </p>
                    <p>
                        Unless indicated otherwise with respect to a particular issuer, all securities-related activity is conducted by the regulated affiliate of ChainRaise: ChainRaise Portal, LLC, a funding portal registered with the US Securities and Exchange Commission (SEC) and as a member of the Financial Industry Regulatory Authority (FINRA).
                    </p>
                    <p>
                        ChainRaise Portal, LLC is a “funding portal” as defined in section 3(a)(80) of the Securities Exchange Act of 1934. Here, you can review investment opportunities of companies offering securities under section 4(a)(6) of the Securities Act of 1933, also known as Regulation Crowdfunding or Reg CF. These investments are offered to everyone, not just to accredited investors.
                    </p>
                    <p>
                        Issuers pay ChainRaise a fee to use the ChainRaise communication Portal for Reg CF offerings. This fee may be paid as a flat fee, commission based on the amount of money issuers raise, or in other ways.
                    </p>
                    <p>
                        We provide financial projections for some of the investment opportunities listed on the Site. All such financial projections are only estimates based on current conditions and current assumptions. The actual result of any investment is likely to be different than the original projection, often by a large amount.
                    </p>
                    <p>
                        Any securities offered on this website have not been recommended or approved by any federal or state securities commission or regulatory authority. ChainRaise and its affiliates do not provide any investment advice or recommendation and do not provide any legal or tax advice with respect to any securities. All securities listed on this site are being offered by, and all information included on this site is the responsibility of, the applicable issuer of such securities. ChainRaise does not verify the adequacy, accuracy or completeness of any information. Neither ChainRaise nor any of its officers, directors, agents and employees makes any warranty, express or implied, of any kind whatsoever related to the adequacy, accuracy, or completeness of any information on this site or the use of information on this site.
                    </p>
                    <p>
                        By accessing this site and any pages on this site, you agree to be bound by our Terms of use and Privacy Policy, as may be amended from time to time without notice or liability.


                    </p>


                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr>
            <p class="text-white py-lg-4 text-center my-0">© Copyright {{ \Carbon\Carbon::now()->format('Y') }} - <a href="https://chainraise.io/">Chainraise</a> </p>
        </div>
    </footer>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="border-radius: 10px;">
            <div class="modal-content bg-image-modal p-3">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <a href="#" class="text-center">
                        <img src="{{  asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
                    </a>
                    <div class="d-grid gap-2 mt-4">
                        <a class="btn transparent_btn" href="{{ route('login.google') }}">
                            <img src="{{ asset('vue/images/google.png') }}" alt="" srcset="">
                            Login with Google
                        </a>
                        <a class="btn transparent_btn" href="#">
                            <img src="{{  asset('vue/images/image 42.png') }}" alt=""
                                srcset=""> Login
                            with Facebook
                        </a>

                        <button class="btn transparent_btn" type="button">
                           <i class="fa fa-envelope"></i> Login with Email
                        </button>
                    </div>
                    <div class="my-3">
                        <p class="text-center text-white">By signing up I agree to ChainRaise's
                            <a href="#" style="color: #42e8e031">Terms of Service</a>
                            and <a href="#" style="color: #42E8E0">Privacy Policy .</a>
                        </p>
                    </div>
                    <hr class="my-4">
                    <div class="my-3">
                        <p class="text-center text-white">Don't have account?
                            <a href="#" style="color: #42E8E0">Sign in.</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    @section('page_js')
    @show
</body>

</html>

