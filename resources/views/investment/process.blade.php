@extends('layouts.master')
@section('page_head')

    <link rel="stylesheet" href="{{ asset('assets/css/style1-v3.css') }}">
    <style>
        ::placeholder {
            color: #70FF00 !important;
            opacity: 1;
            /* Firefox */
        }

        :-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            color: #70FF00 !important;
        }

        ::-ms-input-placeholder {
            /* Microsoft Edge */
            color: #70FF00 !important;
        }
    </style>
@endsection
@section('title', 'Home')
@section('content')
    <div class="container  p-lg-5 mt-lg-3 p-3">
        <h1 class="fw-bolder mb-5"><i class="bi bi-circle-fill pe-3" style="color:#43C3FE;"></i>Invest in YOGURT LCC
        </h1>
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('invest.save') }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <h4 class="fw-bolder">1. Investment amount</h4>
                    <p class="text-muted">Payments are processed immediately.</p>
                    <input type="number" class="form-control rounded-pill py-2 px-4 mb-3" value="{{ $investment_amount }}"
                    placeholder="$500 (Click to change amount)" id="validationCustom02" name="investment_amount"
                    required>
                    <div class="invalid-feedback">
                        Please Enter Investment amount
                    </div>
                    <p>You are investing as Myself / individual change</p>
                    <div class="my-5">
                        <h4 class="fw-bolder">2. Investor Limits</h4>
                        <p class="text-muted">Have you made an investments in equity crowdfunding (REG CF) on any
                            platform
                            in the past 12 months (including ChainRaise)?</p>
                        <div class="form-check form-switch mb-3 ms-2 mt-0">
                            <input class="form-check-input fs-5" type="checkbox" id="flexSwitchCheckDefault"
                                value="{{ $offer->investmentRestrictions->max_invesment }}" required>
                            <div class="invalid-feedback">
                                Please Check Toggle Button
                            </div>
                        </div>
                        <input type="number" class="form-control rounded-pill py-2 px-4 mb-3" id="validationCustom03"
                            placeholder="Total Amount Invested in Crowdfunding Offerings*" required>
                        <div class="invalid-feedback">
                            Please Enter Total Amount Invested in Crowdfunding Offerings
                        </div>
                    </div>
                    <div class="my-5">
                        <h4 class="fw-bolder">Personal information</h4>
                        <p>Required by United States banking laws. This information is kept secure. It will never be
                            used
                            for any purpose beyond executing your investment.</p>
                        <button type="button" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill check_kyc">
                            Verify My Identity
                        </button>
                        <svg class="spinner d-none" width="24" height="24"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <style>
                            .spinner_qM83 {
                                animation: spinner_8HQG 1.05s infinite
                            }

                            .spinner_oXPr {
                                animation-delay: .1s
                            }

                            .spinner_ZTLf {
                                animation-delay: .2s
                            }

                            @keyframes spinner_8HQG {

                                0%,
                                57.14% {
                                    animation-timing-function: cubic-bezier(0.33, .66, .66, 1);
                                    transform: translate(0)
                                }

                                28.57% {
                                    animation-timing-function: cubic-bezier(0.33, 0, .66, .33);
                                    transform: translateY(-6px)
                                }

                                100% {
                                    transform: translate(0)
                                }
                            }
                        </style>
                        <circle class="spinner_qM83" cx="4"
                            cy="12" r="3" />
                        <circle class="spinner_qM83 spinner_oXPr"
                            cx="12" cy="12" r="3" />
                        <circle class="spinner_qM83 spinner_ZTLf"
                            cx="20" cy="12" r="3" />
                        </svg>
                    </div>
                    <div class="my-5">
                        <h4 class="fw-bolder">Bank information <i class="bi bi-lock-fill"></i> </h4>
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item px-lg-5 border-bottom" role="presentation">
                                <button class="nav-link active bg-transparent text-muted " id="pills-home-tab"
                                    data-bs-toggle="pill" data-bs-target="#investment" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true">U.S. Bank</button>
                            </li>
                            <li class="nav-item px-lg-5 border-bottom" role="presentation">
                                <button class="nav-link bg-transparent text-muted " id="pills-profile-tab"
                                    data-bs-toggle="pill" data-bs-target="#pending" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Card</button>
                            </li>
                            <li class="nav-item px-lg-5 border-bottom" role="presentation">
                                <button class="nav-link bg-transparent text-muted " id="pills-profile-tab"
                                    data-bs-toggle="pill" data-bs-target="#date" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Wire</button>
                            </li>
                        </ul>
                        <div class="tab-content py-3" id="pills-tabContent">
                            <div class="tab-pane fade show active p-2" id="investment" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <p>Pay using a United States bank account:</p> 
                                
                                <button type="button"    data-bs-toggle="modal"   data-bs-target="#payment_widget" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill">
                                    Select Bank Account
                                </button> 
                                 
                            </div>

                            <div class="tab-pane fade p-2" id="pending" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <p>Pay using a United States bank account:</p>
                                <button type="button" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill">
                                    Select United States bank
                                </button>

                            </div>
                            <div class="tab-pane fade p-2" id="date" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <p>Pay using a United States bank account:</p>
                                <button type="button" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill">
                                    Select Bank Account
                                </button>
                            </div> 
                        </div>
                        <div class="my-5">
                            <h4 class="fw-bolder">Terms
                            </h4>
                            <p>By signing this subscription agreement electronically, you are explicitly agreeing to
                                receive
                                documents electronically including your copy of this signed subscription agreement as
                                well as
                                ongoing disclosures, communications and notices.</p>
                            <p>I confirm that my answers to the suitability questionnaire have not changed since my last
                                investment</p>
                            <p>I understand that Republic will receive cash and security commission based on these rates
                            </p>
                            <p>I, (the “Subscriber”) hereby represent and warrant as of the date of this subscription
                                that:</p>
                            <p>1. The Subscriber hereby authorizes the Company to debit the funds necessary to purchase
                                the
                                securities from the payment source provided by the Subscriber.</p>
                            <p>2. The Subscriber meets one of the following qualifications to purchase the securities:
                                (A) The
                                aggregate purchase price for the securities being purchased does not exceed 10% of the
                                Subscriber’s net worth or annual income, whichever is greater; or (B) The Subscriber is
                                an “Accredited
                                Investor” within the meaning of Rule 501 under the Securities Act of 1933.</p>
                            <p>3. The Subscriber will truthfully complete all documentation requests regarding
                                Subscriber’s identity
                                and qualifications with respect to the investment, if requested by the Company, in
                                fifteen (15) days or
                                less.</p>
                            <p>4. Neither the Subscriber, nor any of its shareholders, members, managers, general or
                                limited
                                partners, directors, affiliates or executive officers, is subject to any of the “Bad
                                Actor”
                                disqualifications described in Rule 262 of the Securities Act (a “Disqualification
                                Event”).</p>
                            <p>5. The Subscriber is purchasing the securities solely for the Subscriber’s own account
                                for investment
                                purposes only and not with a view to the sale or distribution of any part or all of the
                                securities by
                                public or private sale or other disposition. The Subscriber understands that no public
                                market exists
                                for the securities and that the securities may have to be held for an indefinite period
                                of time.</p>
                            <p>6. The Subscriber's consideration for the securities will not be derived from money
                                laundering or
                                similar activities deemed illegal under federal laws and regulations.</p>
                            <p>
                                7. The Subscriber understands that the Company reserves the right to, in its sole
                                discretion, accept
                                or reject this subscription, in whole or in part, for any reason whatsoever, and to the
                                extent not
                                accepted, unused funds will remain in the Subscriber’s account.
                            </p>
                            <p>
                                8. The Subscriber has received and reviewed a copy of the offering circular.
                            </p>
                            <p>9. The Subscriber understands that by agreeing to these terms they are authorizing their
                                signature to
                                the subscription agreement.</p>

                        </div>
                        <div class="border px-5 py-3 rounded-pill bg-light mb-3">
                            <input type="checkbox" name="" id="validationCustom04" required>
                            By confirming my investment, I acknowledge that my contact
                            information (such as full name and email address) and
                            investment amount details will be shared with Skybound Holdings
                            LLC, who may send communication via email, social media,
                            and/or other channels.
                            <div class="invalid-feedback">
                                Please Check
                            </div>
                        </div>
                        <div class="border px-5 py-3 rounded-pill bg-light mb-3">
                            <input type="checkbox" name="" id="validationCustom05" required>
                            I have read and agree to the e-sign disclosure
                            <div class="invalid-feedback">
                                Please Check
                            </div>
                        </div>
                        <div class="border px-5 py-3 rounded-pill bg-light mb-3">
                            <input type="checkbox" name="" id="validationCustom06" required>
                            I have read and accept the terms of investment
                            <div class="invalid-feedback">
                                Please Check
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill">
                                Confirm Investment
                            </button>
                        </div>
                        <p class="my-3 text-center">The investment is final.</p> 
                        <div class="modal fade" id="payment_widget" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                        <!--begin::Close-->
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                                        <div id="load_widget"></div>
                                            <input type="" name="user_guid" id="user_guid" required>
                                            <script src="https://atrium.mx.com/connect.js"></script>
                                            <script>
                                                var arr = [];
                                                var mxConnect = new window.MXConnect({
                                                    id: "load_widget", //id of where the widget will load into
                                                    iframeTitle: "Connect",
                                                    
                                                    onEvent: function(type, payload) {
                                                      
                                                       arr.push(payload.member_guid); 
                                                       $('#user_guid').val(arr);
                                                       console.log(arr);
                                                    },
                                                    config: {
                                                        mode: "verification",
                                                        color_scheme: "dark", //or "light"
                                                        ui_message_version: 4
                                                    },
                                                    targetOrigin: "*"
                                                })
                                                mxConnect.load('{{ $json_widget["widgetUrl"] }}')
                                            </script>
                                            <button type="submit" class="btn btn-sm btn-dark no-radius">  Invest </button>
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="border text-center p-5 mb-4" style="border-radius: 40px;">
                    <h6>Deal Terms</h6>
                    <h6>Future Equity</h6>
                    <a href="">$30M valuation cap</a>
                    <p class="mt-3">A Future Equity Agreement (SAFE) gives you
                        the right to future shares in the company. If
                        you invest, you're betting the company will be
                        worth more than $30M eventually.</p>
                </div>
                <div class="border text-center p-5 mb-4" style=" border-radius: 40px;">
                    <h6>Contracts</h6>
                    <p>Contracts will be available when your
                        reservation is ready to convert into an
                        investment</p>
                </div>
                <div class="mb-3">
                    <h4 class="fw-bolder  mb-3">FAQ & Help
                    </h4>
                    <p>When will my reservation convert to an
                        investment?</p>
                    <p>Can I cancel my reservation?</p>
                    <p>When will I be charged?</p>
                    <p>What if I want to edit my reservation
                        amount?</p>
                    <p>Do I have to fund my reservation now?</p>
                </div>
                <div class="mb-3">
                    <h4 class="fw-bolder mb-3">Need help?
                    </h4>
                    <p class="mb-0 pb-0">Call us: <a href="tel:(347)-934-6876">(347)-934-6876</a></p>
                    <p>Email: <a href="mailt0:investors@thecapitalr.co">investors@thecapitalr.co</a> </p>
                </div>
                <div class="mb-3">
                    <h4 class="fw-bolder  mb-3">Documents
                    </h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-file-earmark-pdf"></i> Form CRS.pdf</li>
                        <li class="list-group-item"><i class="bi bi-file-earmark-pdf"></i> Skybound Form 253g2.pdf</li>
                        <li class="list-group-item"><i class="bi bi-file-earmark-pdf"></i> Disclosures & Disclaimers.pdf
                        </li>
                        <li class="list-group-item"><i class="bi bi-file-earmark-pdf"></i> Additional Risk
                            Disclosures.pdf</li>
                        <li class="list-group-item"><i class="bi bi-file-earmark-pdf"></i> Subscription Agreement</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        $('body').on('click', '.check_kyc', function(event) {

            event.preventDefault();
            $('.spinner').removeClass('d-none');
            $('.check_kyc').addClass('d-none');
            $.ajax({
                url: "{{ route('invest.check.kyc') }}",
                method: 'GET',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.status == false) {
                        $('.spinner').addClass('d-none');
                        $('.check_kyc').removeClass('d-none');
                        toastr.error(response.message, "Error");
                    }
                    if (response.status) {
                        $('.spinner').addClass('d-none');
                        if (response.status == 400) {
                            jQuery.each(response.data.errors, function(index, item) {
                                console.log(item);
                                toastr.error(item, "Error");
                            });
                            $('.check_kyc').removeClass('d-none');
                            // toastr.error(response.data.title, "Error");
                        }
                        if (response.status == 409) {
                            toastr.error(response.data.title, "Error");
                            $('.kyc_submit_button').removeClass('d-none');
                            $('.check_kyc').removeClass('d-none');


                        }
                        if (response.status == 200) {
                            $('.check_kyc').html('  KYC has been successfully checked');
                            //$('.submit_for_step_3').removeClass('d-none'); 
                            $('.check_kyc').removeClass('d-none'); 
                            $(".check_kyc").css("color", "green");
                            toastr.success('Verification Completed', "Success");
                            // setTimeout(function() {
                            //     $('.kyc_move').click()
                            // }, 1500);

                        }
                        if (response.status == false) {
                            toastr.error(response.message, "Error");
                            $('.check_kyc').removeClass('d-none');
                            $('.submit_for_step_3').addClass('d-none');
                        }
                    }


                },
                error: function(error) {
                    console.log(error);
                    toastr.error('Internal Server Error While Checking KYC', "Error");
                    $('.spinner').addClass('d-none');
                        $('.check_kyc').removeClass('d-none');
                }

            });
        });
    </script>
@endsection
