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
    @section('page_style')
    @show
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
                    <p> This website, which we refer to as the “Site,” is used by two different companies: </p>
                    <p> ChainRaise Portal LLC and ChainRaise Fund LLC. </p>
                    <p> ChainRaise Fund LLC offers investments under Rule 506(c) issued by the
                        Securities and Exchange Commission (SEC). These investments are offered to accredited
                        investors
                        only.</p>
                    <p>ChainRaise Portal LLC is a “funding portal” as defined in section 3(a)(80) of the Securities
                        Exchange Act of 1934. Here, you can review investment opportunities of companies offering
                        securities
                        under section 4(a)(6) of the Securities Act of 1933, also known as Regulation Crowdfunding
                        or
                        Reg
                        CF. These investments are offered to everyone, not just to accredited investors.</p>

                    <p>By using this Site,
                        you are subject to our Terms of Use and our Privacy Policy. Please read these carefully
                        before
                        using
                        the Site.</p>
                    <p>Although our website offers investors the opportunity to invest in a variety of companies,
                        we do not make recommendations regarding the appropriateness of a particular investment
                        opportunity
                        for any particular investor. We are not investment advisers. Investors must make their own
                        investment decisions, either alone or with their personal advisors. </p>
                    <p>You should view all of the
                        investment opportunities on our website as risky. You should consider investing only if you
                        can
                        afford to lose your entire investment. </p>
                    <p> We provide financial projections for some of the investment
                        opportunities listed on the Site. All such financial projections are only estimates based on
                        current
                        conditions and current assumptions. The actual result of any investment is likely to be
                        different
                        than the original projection, often by a large amount. </p>
                    <p>Neither the Securities and Exchange
                        Commission nor any state agency has reviewed the investment opportunities listed on the
                        Site.
                    </p>
                    <p>Thank you for using the Site. If you have questions, please contact us at info@chainraise.io
                    </p>


                    <p>
                        Issuers pay ChainRaise a fee to use the ChainRaise communication Portal for Reg CF offerings.
                        This fee may be paid as a flat fee, commission based on the amount of money issuers raise, or in
                        other ways.
                    </p>

                    <p>
                        Issuers may pay additional fees for specified services ChainRaise provides, including
                        reimbursement of any expenses ChainRaise incurs on their behalf. ChainRaise discloses its
                        compensation for each offering in which an issuer invests.

                    </p>
                    <p>
                        If an issuer pays ChainRaise in whole
                        or
                        in part with its own issuing securities, these securities will always be the same class offered
                        to
                        investors on the ChainRaise Portal.
                    </p>

                    ChainRaise does not charge a fee to investors for offerings via Reg CF or Reg A.
                    For secondary transactions, ChainRaise may receive a fee for the purchase and/or sale of
                    privately
                    held securities. Every secondary transaction is unique, and fees will differ per transaction.
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
