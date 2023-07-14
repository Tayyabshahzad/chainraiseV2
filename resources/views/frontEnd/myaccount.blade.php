@extends('layouts.master')
@section('page_head')
@endsection
@section('title', 'Home')
@section('content')

    <div class="container p-lg-5 mt-lg-3">
        <div id="detail">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item px-lg-5 border-bottom" role="presentation">
                    <button class="nav-link active bg-transparent text-muted fs-5" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#info" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Info</button>
                </li>
                {{-- <li class="nav-item px-lg-5 border-bottom" role="presentation">
                    <button class="nav-link bg-transparent text-muted fs-5" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#bank" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Bank</button>
                </li> --}}
            </ul>
            <div class="tab-content py-3" id="pills-tabContent">
                <div class="tab-pane fade show active p-2" id="info" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h4>Investor Information</h4>
                    <h5 class="text-muted fw-normal">To invest online, the law requires that we collect some info</h5>
                    <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('my.account.update') }}">
                        @csrf
                        <div class="col-md-12 ">
                            <div class="row mt-3">
                                <div class="col-lg-2">
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
                                <div class="col-lg-2">
                                    <label for="validationCustom02" class="form-label"><span
                                            class="text-danger fs-4">*</span> Country:</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="validationCustom02"  name="country" value="@if($user->identityVerification) {{  $user->identityVerification->nationality  }} @endif" required>
                                    <div class="invalid-feedback">
                                        Please Enter Country Name
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="row mt-3">
                                <div class="col-lg-2">
                                    <label for="validationCustom03" class="form-label"><span
                                            class="text-danger fs-4">*</span> Address:</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="validationCustom03"
                                        value="{{ $user->userDetail->address }}" required name="address">
                                    <div class="invalid-feedback">
                                        Please Enter Address
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-lg-3 gy-2 mb-3">
                            <div class="col-2 d-lg-block d-none">
                            </div>
                            <div class="col-lg-2">
                                <label for="">City</label>
                                <input type="text" class="form-control" name="city" required
                                    value="{{ $user->userDetail->city }}">
                            </div>
                            <div class="col-lg-2">
                                <label for="">State</label>
                                <input type="text" class="form-control" name="state" required
                                    value="{{ $user->userDetail->state }}">
                            </div>
                            <div class="col-lg-2">
                                <label for="">Zip Code</label>
                                <input type="text" class="form-control" name="zip" required
                                    value="{{ $user->userDetail->zip }}">
                            </div>
                        </div>
                        <div class="row g-lg-3 mb-3 mt-lg-4">
                            <div class="col-lg-4">
                                <label for="inputPassword6" class="col-form-label fs-5 fw-normal">What is your net
                                    worth?</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="number" class="border-0 border-bottom" name="net_worth" required
                                    placeholder="Enter manually" value="{{ $user->net_worth }}">
                            </div>
                        </div>
                        <div class="row g-lg-3 mb-3">
                            <div class="col-lg-4">
                                <label for="inputPassword6" class="col-form-label fs-5 fw-normal">What is your annual
                                    income?</label>
                            </div>
                            <div class="col-lg-8">
                                <input type="number" class="border-0 border-bottom" name="annual_income" required
                                    placeholder="Enter manually" value="{{ $user->annual_income }}">
                            </div>
                        </div>
                        <div class="row g-lg-3 align-items-center mb-3 mt-lg-4 mx-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label fs-5" for="flexSwitchCheckDefault">
                                    Are you an accredited investor? <span class="text-danger fs-4">*</span>
                                </label>
                                <input class="form-check-input fs-5" type="checkbox" id="flexSwitchCheckDefault" name="are_you_accredited"
                                    @if ($user->are_you_accredited) checked @endif required>
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
                                    value="{{ $user->userDetail->dob }}" required>
                                <div class="invalid-feedback">Please Select Birthday </div>
                            </div>
                        </div>
                        <div class="row g-lg-3 align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="ssn-number" class="col-form-label"><span class="text-danger fs-4">*</span>
                                    SSN:</label>
                            </div>
                            <div class="col-lg-6">   
                                <div class="input-group">
                                    <input type="text" class="form-control" name="primary_contact_social_security" style=" border-top-right-radius: 0;  border-bottom-right-radius: 0;"
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

                        <div class="col-12">
                            <button class="btn btn-outline-dark mt-3 px-4  mt-lg-4 rounded-pill fw-semibold"
                                type="submit">Save & Continue</button>
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
       
    </script>
@endsection
