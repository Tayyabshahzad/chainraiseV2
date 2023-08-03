@extends('layouts.master')

 
@section('page_head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<!-- Add SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
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
                <form action="{{ route('invest.save') }}" method="post" enctype="multipart/form-data" id="make_investment_form">
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

                        <button type="button"    data-bs-toggle="modal"   data-bs-target="#kyc_data_modal" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill show_user_detail_form">
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
                    <div class="my-5  bank_wrapper d-none">
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
                                <button type="button"
                                data-bs-toggle="modal"data-bs-target="#payment_widget" class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill payment_widget_button">
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
                        <input type="hidden" class="user_guid" name="user_guid">
                        <input type="hidden" class="payment_type" name="payment_type" required>
                        <div class="d-grid gap-2">
                            <button type="submit" disabled class="confirm_investment_button btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill">
                                Confirm Investment
                            </button>
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

 
   
  

         
        <div class="modal fade" id="kyc_data_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
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
                        <form class="row g-3 needs-validation" id="profile_update_form"   method="post" 
                        action="{{ route('investment.verify_identity') }}">
                            @csrf
                            <div class="col-md-12 ">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label for="validationCustom01" class="form-label"><span
                                                class="text-danger fs-4">*</span> Legal Name:</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control legal_name" id="validationCustom01"
                                            value="{{ $user->name }}" name="legal_name"  required>
                                        <div class="invalid-feedback">
                                            Please Enter Legal Name
                                        </div>
                                    </div> 
                                </div> 
                            </div>
                            <div class="col-md-12 ">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label for="validationCustom01" class="form-label"><span
                                                class="text-danger fs-4">*</span> Last Name:</label>
                                    </div>
                                    <div class="col-lg-9">  
                                        <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Last Name" name="last_name" 
                                        @if ($user->userDetail) value="{{ $user->userDetail->last_name }}" @endif required />    
                                         
                                    </div>
                                </div> 
                            </div> 
                            <div class="col-md-12 ">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label for="validationCustom02" class="form-label"><span
                                                class="text-danger fs-4">*</span> Nationality:</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-select nationality" required data-control="select2"
                                        name="nationality" data-placeholder="Select an option"
                                        data-live-search="true">
                                            @include('user.country')
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 ">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label for="validationCustom02" class="form-label"><span   class="text-danger fs-4">*</span> Country of Residence:</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-select country_residence" required data-control="select2"
                                            name="country_residence" data-placeholder="Select an option"
                                            data-live-search="true">
                                            @include('user.country')
                                    </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 ">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label for="validationCustom03" class="form-label"><span
                                                class="text-danger fs-4">*</span> Address:</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="validationCustom03"
                                            value="{{ $user->userDetail->address }}" required name="address">
                                        <div class="invalid-feedback">
                                            Please Enter Address
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-lg-3 gy-2 mb-3 mt-3">
                                <div class="col-3 d-lg-block d-none">
                                </div>
                                <div class="col-lg-2">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" name="city" required
                                        value="{{ $user->userDetail->city }}">
                                </div>
                                <div class="col-lg-2">
                                    <label for="">State</label>
                                    <input type="text" class="form-control state" name="state" required
                                        value="{{ $user->userDetail->state }}">
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Zip Code</label>
                                    <input type="text" class="form-control zipCode" name="zip" required
                                        value="{{ $user->userDetail->zip }}" min="5" max="5">
                                </div>
                            </div>
                              
                            <div class="col-md-12 ">
                                <div class="row mt-3">    
                                    <div class="col-lg-3">
                                        <label for="inputPassword6" class="col-form-label"><span
                                                class="text-danger fs-4">*</span> Birth Date:</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="date" class="form-control" name="dob" placeholder="MM/DD/YYYY"
                                            value="{{ $user->userDetail->dob }}" required>
                                        <div class="invalid-feedback">Please Select Birthday </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 ">
                                <div class="row mt-3">  
                                    <div class="col-lg-3">
                                        <label for="inputPassword6" class="col-form-label"><span
                                                class="text-danger fs-4">*</span> Phone Number:</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                        <div class="col-lg-4"> 
                                            <select class="form-control cc" name="cc" required
                                            data-control="select2">
                                            @include('user.partials.cc')
                                            </select>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="phone" required
                                            id="phone_number" value="{{ $user->phone }}" />
                                            <code>-999-999-9999</code>  
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="row mt-3">  
                                    <div class="col-lg-3"> 
                                        <label for="ssn-number"  class=" col-form-label"><span class="text-danger fs-4">*</span>
                                            SSN:</label>
                                    </div>
                                    <div class="col-lg-9">   
                                        <div class="input-group">
                                            <input   class="form-control" name="primary_contact_social_security" style=" border-top-right-radius: 0;  border-bottom-right-radius: 0;"
                                                @if ($user->identityVerification && $user->identityVerification->primary_contact_social_security != null)
                                                    type="password"
                                                    value="999-99-9999" readonly
                                                @else
                                                    required 
                                                    type="text"
                                                @endif
                                                id="primary_contact_social_security">
                                            
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary no-radius" id="show_ssn_field"
                                                style="
                                                background: #e9ecef;
                                                color: #000;
                                                border-left: 0;
                                                border-color: #e9ecef;
                                                border-top-left-radius: 0;
                                                border-bottom-left-radius: 0;"
                                                type="button">x</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-12 ">
                                <div class="row mt-3">  
                                    <div class="col-lg-3">
                                        <label for="ssn-number" class="col-form-label"><span class="text-danger fs-4">*</span>
                                            Document Type:</label> 
                                    </div> 
                                    <div class="col-lg-9">    
                                            <select class="form-select doc_type" data-control="select2"
                                                data-placeholder="Select Document Type" required name="doc_type">
                                                @if ($user->hasRole('issuer'))
                                                    <option value="other">Other</option>
                                                    <option value="proofOfAddress">Proof Of Address</option>
                                                    <option value="proofOfCompanyFormation"> Proof Of Company Formation
                                                    </option>
                                                @else
                                                    <option value="license">License</option>
                                                    <option value="identificationCard"> Identification Card </option>
                                                    <option value="passport"> Passport </option>
                                                @endif
                                            </select>
                                        
                                    </div>
                                </div>
                            </div> 
    
                            <div class="col-lg-12">
                                <div class="notice   bg-light-dark rounded border-dark border border-dashed p-6 text-center mb-12 change_photo_wrapper">
                                    <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column change_photo_wrapper">
                                        <div class="col-lg-12 mb-5">
                                            <a href="{{ $user->getFirstMediaUrl('kyc_document_collection', 'thumb') }}"
                                                download title="Download Document File">
                                                <i class="la la-download"></i>
                                            </a>
                                        </div>
                                        <button type="button"  class="kyc_document_upload_btn btn btn-sm btn-dark-primary btn-square mb-1">
                                            <i class="fa fa-upload"></i>
                                            Upload Document
                                        </button>
                                        <input type="file" name="kyc_document"
                                        class="new_profile_photo  d-none change_photo"
                                        data-type="project_logo">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-12 text-center mb-3">
                                <button class="btn btn-outline-dark mt-3 px-4  mt-lg-4 rounded-pill fw-semibold submit_button"   type="submit"> Run KYC </button>  
                            </div>
                        </form>
                           
                           
                    </div> 
                </div> 
            </div>
        </div> 


    


        <div class="modal fade" id="payment_widget" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header--> 
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-5 pb-15">
                        <div class="text-center loader_image">
                            <img src="{{ asset('assets/media/spinner.svg') }}" alt="" >
                        </div> 
                        <div id="load_widget"></div>
                        <input type="hidden" name="user_guid" id="user_guid" required>
                        <script src="https://atrium.mx.com/connect.js"></script> 
                        <div class="tab-pane fade show active p-2 text-center"> 
                            <button type="button" data-bs-dismiss="modal" disabled   class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill continue_investment_button ">
                                Continue Investment
                            </button>  
                        </div>
                         
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
 
@endsection
@section('page_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" 
integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" 
crossorigin="anonymous"
></script>


<script>
    const passwordInput = document.getElementById("primary_contact_social_security");
    const toggleButton = document.getElementById("show_ssn_field"); 
    if (toggleButton ) {
        toggleButton.addEventListener("click", () => { 
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordInput.value = "";
                passwordInput.removeAttribute('readonly');
                $('#primary_contact_social_security').attr('required', true); 
                $('#primary_contact_social_security').mask('999-99-9999');
            }else{
                passwordInput.removeAttribute('readonly');
                passwordInput.type = "text";
                passwordInput.value = "";
                $('#primary_contact_social_security').mask('999-99-9999');
            } 
        });
    }  
    $('#phone_number').mask('-999-999-9999');
    $('#ein_number').mask('99-9999999');
    
    $('#primary_contact_social_security').on('focus', function() {
        const passwordInput = document.getElementById("primary_contact_social_security");
        const toggleButton = document.getElementById("show_ssn_field"); 
        if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordInput.value = "";
                    passwordInput.removeAttribute('readonly');
                    $('#primary_contact_social_security').attr('required', true); 
                    $('#primary_contact_social_security').mask('999-99-9999');
                }else{
                    passwordInput.removeAttribute('readonly');
                    passwordInput.type = "text";
                    passwordInput.value = "";
                    $('#primary_contact_social_security').mask('999-99-9999');
        } 
    });
   
</script> 
<script>
    $(document).ready(function() {
        $('.myNumberField').inputmask();
    });
</script> 

    <script>
        
          
        $(document).ready(function () {
            $('#profile_update_form').submit(function (event) {
                event.preventDefault(); // Prevent the default form submission 
                $('.submit_button').attr('disabled', true); 
                var formData = $(this).serialize(); 
                // Send an AJAX POST request to the server
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        console.log(response)  
                        $('.submit_button').attr('disabled', false); 
                        if (response.success == false) { 
                            if (response.status == 400) {
                                if (response.errors && response.errors.length > 0) {
                                    // Check for specific validation errors
                                    if (response.errors[1] && response.errors[1].Phone) {
                                        // Display validation error for Phone field
                                        console.log(response.errors[1].Phone[0]);
                                        toastr.error(response.errors[1].Phone[0],
                                            "Validation Error");
                                    } else {
                                        // Display other validation errors
                                        jQuery.each(response.errors, function(index, item) {
                                            if (typeof item === 'object') {
                                                jQuery.each(item, function(key,
                                                    value) {
                                                    console.log(key + ": " +
                                                        value);
                                                    toastr.error(value,
                                                        "Validation Error"
                                                        );
                                                });
                                            }
                                        });
                                    }
                                } else {
                                    // Display generic error message
                                    console.log(response.errors[0]);
                                    toastr.error(response.errors[0], "Error");
                                }
                            } 
                            if (typeof response.errors !== 'undefined' && response
                                .errors !== null) {
                                jQuery.each(response.errors, function(index, item) {
                                    toastr.error(item, "Error");
                                });
                            }
                            }
                            if (response.status == true) {
                                $('#kyc_data_modal').modal('hide');
                                $('.show_user_detail_form').attr('disabled', true); 
                                $('.bank_wrapper').removeClass('d-none');
                                toastr.success('Verification Has Been Completed', "Success"); 
                            }
                            if (response.status == 200) {
                                $('#kyc_data_modal').modal('hide');
                                $('.bank_wrapper').removeClass('d-none');
                                $('.show_user_detail_form').attr('disabled', true); 
                                toastr.success('Verification Has Been Completed', "Success"); 
                            }
                    },
                    error: function (xhr) {
                        console.log('erros')
                        // Handle validation errors from the server
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        $.each(errors, function (key, value) {
                            errorMessage += '<p class="text-danger">' + value[0] + '</p>';
                        });
                        $('#responseMessage').html(errorMessage);
                    },
                });
            }); 
            $('.payment_widget_button').click(function (event) {
                event.preventDefault(); // Prevent the default form submission 
                $('.payment_widget').attr('disabled', true); 
                $('#user_guid').val('');  
                $('#user_guid').attr('required', true); 
                
                $.ajax({
                    url: "{{ route('invest.get.widget.url') }}",
                    type: 'GET', 
                    dataType: 'json',
                    success: function (response) { 
                        if (response.success == true) { 
                            $('.payment_type').val('bank');
                            console.log(response)
                            var arr = [];
                            $('.loader_image').remove();
                            var mxConnect = new window.MXConnect({
                                id: "load_widget", //id of where the widget will load into
                                iframeTitle: "Connect", 
                                onEvent: function (type, payload) { 
                                    arr.push(payload.member_guid);
                                    $('#user_guid').val(arr);
                                    $('.user_guid').val(arr);
                                    $('.confirm_investment_button').attr('disabled', false); 
                                    console.log(arr);
                                },
                                config: {
                                    mode: "verification",
                                    color_scheme: "dark", //or "light"
                                    ui_message_version: 4
                                },
                                targetOrigin: "*"
                            })
                            mxConnect.load(response.url) 
                            $('.continue_investment_button').attr('disabled', false); 
                        }else{
                            toastr.error('There is some error while generation widget url', "Error"); 
                        }
                    },
                    error: function (xhr) {
                        console.log('erros') 
                    },
                });
            });  
        }); 

        $(document).ready(function() {
        // Apply the masking to the state field
            $('.zipCode').mask('00000');
            $('#primary_contact_social_security').mask('***-**-****');
             
            @if ($user->identityVerification)
                $('.country_residence').val('{{ $user->identityVerification->country_residence }}')
            @endif
            @if ($user->identityVerification)
                $('.nationality').val('{{ $user->identityVerification->nationality }}')
            @endif 
            
        });
        $('.kyc_document_upload_btn').click(function() {
            var imgBtnWrapper = $(this).closest('.change_photo_wrapper');
            imgBtnWrapper.find('.change_photo').click();
        });

      

 

    </script>
@endsection
