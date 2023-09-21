@extends('layouts.master')
@section('page_head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
<!-- Add SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

@endsection
@section('title', 'My Account')
@section('content')

    <div class="container p-lg-5 mt-lg-3">
        <div id="detail">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item px-lg-5 border-bottom" role="presentation">
                    <button class="nav-link active bg-transparent text-muted fs-5" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#info" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Info</button>
                </li>

            </ul>
            <div class="tab-content py-3" id="pills-tabContent">
                <div class="tab-pane fade show active p-2" id="info" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="kyc_level_area">
                        @if($user->fortress_id == null)
                            <h4 class="text-center text-danger">Dear {{ Auth::user()->name }}, YOUR KYC  PROCESS NOT YET COMPLETED</h4>
                        @else
                            <h4 class="text-center text-success">Dear {{ Auth::user()->name }}, YOUR KYC  LEVEL IS {{ strtoupper ($user->kyc->kyc_level) }} </h4>
                        @endif
                    </div>
                    <h4>Investor Information</h4>
                    <h5 class="text-muted fw-normal">To invest online, the law requires that we collect some info</h5>
                    <form class="row g-3 needs-validation" id="profile_update_form" enctype="multipart/form-data"  method="post"
                    action="{{ route('my.account.update') }}">
                        @csrf

                        <div class="col-md-12 ">
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <label for="validationCustom01" class="form-label">  Email Address</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" disabled class="form-control  "
                                        value="{{ $user->email }}" >

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 ">
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <label for="validationCustom01" class="form-label"><span
                                            class="text-danger fs-4">*</span> Legal Name:</label>
                                </div>
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="validationCustom03"
                                        value="@if($user->userDetail){{ $user->userDetail->address }}"@endif required name="address">
                                    <div class="invalid-feedback">
                                        Please Enter Address
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-lg-3 gy-2 mb-3">
                            <div class="col-3 d-lg-block d-none">
                            </div>
                            <div class="col-lg-2">
                                <label for="">City</label>
                                <input type="text" class="form-control" name="city" required
                                    value="@if($user->userDetail) {{ $user->userDetail->city }}" @endif>
                            </div>
                            <div class="col-lg-2">
                                <label for="">State</label>
                                <input type="text" class="form-control state" name="state" required
                                    value="@if($user->userDetail) {{ $user->userDetail->state }}" @endif>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Zip Code</label>
                                <input type="text" class="form-control zipCode" name="zip" required
                                    value="@if($user->userDetail) {{ $user->userDetail->zip }}" @endif min="5" max="5">
                            </div>
                        </div>
                        <div class="row g-lg-3 mb-3 mt-lg-4">
                            <div class="col-lg-4">
                                <label for="inputPassword6" class="col-form-label fs-5 fw-normal">What is your net
                                    worth?</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text"  class="border-0 border-bottom lh-lg myNumberField" name="net_worth"   placeholder="Enter manually" required data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'rightAlign': false" value="{{ $user->net_worth }}">
                            </div>
                        </div>
                        <div class="row g-lg-3 mb-3">
                            <div class="col-lg-4">
                                <label for="inputPassword6" class="col-form-label fs-5 fw-normal">What is your annual
                                    income?</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="text"  class="border-0 border-bottom lh-lg myNumberField" name="annual_income"   placeholder="Enter manually" required data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'rightAlign': false" value="{{ $user->annual_income }}">
                            </div>
                        </div>
                        <div class="row g-lg-3 align-items-center mb-3 mt-lg-4 mx-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label fs-5" for="flexSwitchCheckDefault">
                                    Are you an accredited investor? <span class="text-danger fs-4">*</span>
                                </label>
                                <input class="form-check-input fs-5" type="checkbox" id="flexSwitchCheckDefault" name="are_you_accredited"
                                    @if ($user->are_you_accredited) checked @endif  >
                                <div class="invalid-feedback">Check Toogle Button</div>
                            </div>
                            <p>An accredited investor is defined by U.S. federal law:</p>
                            <ul class="p-lg-0 my-0 ps-lg-5 p-3">
                                <li>$200,000+ income for two or more years and reasonably expect the same this year</li>
                                <li>$1M+ net worth (your assets minus liabilities, excluding home)</li>
                                <li>Hold a Series 7, 65, or 82</li>
                                <li>Certain banks, trusts, brokers, and funds</li>
                            </ul>
                        </div>
                        <div class="row g-lg-3 align-items-center mb-3 mt-lg-4">
                            <div class="col-lg-2">
                                <label for="inputPassword6" class="col-form-label"><span
                                        class="text-danger fs-4">*</span> Birth Date:</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" name="dob" placeholder="MM/DD/YYYY"
                                    value="@if($user->userDetail){{ $user->userDetail->dob }}@endif" required>
                                <div class="invalid-feedback">Please Select Birthday </div>
                            </div>
                        </div>

                        <div class="row g-lg-3 align-items-center mb-3 mt-lg-4">
                            <div class="col-lg-2">
                                <label for="inputPassword6" class="col-form-label"><span
                                        class="text-danger fs-4">*</span> Phone Number:</label>
                            </div>
                            <div class="col-lg-6">
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
                        <div class="row g-lg-3 align-items-center mb-3 ssn_number_container
                            @if(isset(Auth::user()->identityVerification) && Auth::user()->identityVerification->nationality != 'US') d-none @endif">
                            <div class="col-lg-2">
                                <label for="ssn-number"  class=" col-form-label"><span class="text-danger fs-4">*</span>
                                    SSN:</label>
                            </div>
                            <div class="col-lg-6">
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
                        <div class="row g-lg-3 align-items-center mb-3 d-none">
                            <div class="col-lg-2">
                                <label for="ssn-number" class="col-form-label"><span class="text-danger fs-4">*</span>
                                    Document Type:</label>
                            </div>
                            <div class="col-lg-6">
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

                        <div class="col-lg-12 document_upload_container  @if(isset(Auth::user()->identityVerification) && Auth::user()->identityVerification->nationality == 'US')  d-none @endif">
                            <div class="notice bg-light-dark rounded border-dark border border-dashed p-6 text-center mb-12 change_photo_wrapper">
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
                        <div class="row g-lg-3 align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="ssn-number" class="col-form-label">
                                    Profile Photo:</label>
                            </div>
                            <div class="col-lg-6">
                                    <input type="file" name="user_profile_photo"  class="form-control">
                            </div>
                        </div>

                        <div class="row g-lg-3 align-items-center mb-3">
                            <div class="col-lg-2">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Run KYC</label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="kyc_run">
                                  </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <button class="btn btn-outline-dark mt-3 px-4  mt-lg-4 rounded-pill fw-semibold"   type="submit">Save & Continue</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
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
                // Get the form data
                var formData = $(this).serialize();
                // Send an AJAX POST request to the server

                $(this).unbind('submit').submit();

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
        $('.nationality').on('change', function() {
                $val = $(this).val();
                if($val == 'US'){
                        $('.ssn_number_container').removeClass('d-none')
                        $('.document_upload_container').addClass('d-none')

                }else{
                        $('.ssn_number_container').addClass('d-none')
                        $('.document_upload_container').removeClass('d-none')
                        $('#primary_contact_social_security').attr('required',false)

                }
                $('.run_process_button').removeClass('d-none')
        });

    </script>


@endsection
