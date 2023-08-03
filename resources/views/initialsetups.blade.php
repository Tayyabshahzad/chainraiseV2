@extends('layouts.master')
@section('page_head')
    <link rel="stylesheet" href="{{ asset('assets/css/style-setup.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <style>
        .error {
            padding-top: 0.3em !important;
            color: rgb(236 83 83);
        }
    </style>
@endsection
@section('title', 'Home')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h4 class="mb-lg-4 border-bottom">Investor Information</h4>
                <h5 class="text-muted fw-normal">To invest online, the law requires that we collect some info</h5>
                <form class="row g-3 needs-validation" novalidate enctype="multipart/form-data" id="update_profile" method="post"
                    action="{{ route('user.basic.details.update') }}">
                    @csrf
                    <div class="col-md-12 ">
                        <label class="fs-5 pe-3 mb-lg-3">
                            I am investing as an:
                        </label>
                        <div class="form-check form-check-inline mb-lg-3">
                            <input class="form-check-input" type="radio" name="account_type" id="Individual"   value="individual" checked> 
                            <label class="form-check-label" for="Individual">
                                Individual
                            </label>
                        </div>
                        <div class="form-check form-check-inline mb-lg-3">
                            <input class="form-check-input" type="radio" name="account_type" id="Entity" value="entity" >
                            <label class="form-check-label" for="Entity">
                                Entity
                            </label>
                        </div>
                        <div class="row mt-3 d-none entity_name_container">
                            <div class="col-lg-3">
                                <label for="entity_name" class="form-label">
                                    Entity Name:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="entity_name" name="entity_name"  >
                                <div class="invalid-feedback">
                                    Please Enter Entity Name
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label for="legal_name" class="form-label">
                                    Legal Name:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="legal_name" name="legal_name" required>
                                <div class="invalid-feedback">
                                    Please Enter Legal Name
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-none ">
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <label for="validationCustom02" class="form-label"><span
                                            class="text-danger fs-4">*</span> Country:</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="validationCustom02" name="country"
                                        required>
                                    <div class="invalid-feedback">
                                        Please Enter Country Name
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-none ">
                            <div class="row mt-3">
                                <div class="col-lg-3">
                                    <label for="validationCustom03" class="form-label"><span
                                            class="text-danger fs-4">*</span> Address:</label>
                                </div>
                                <div class="col-lg-9 mb-3">
                                    <input type="text" class="form-control" id="validationCustom03" name="address"
                                        required>
                                    <div class="invalid-feedback">
                                        Please Enter Address
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-lg-3 gy-2 mb-3 d-none">
                            <div class="col-2 d-lg-block d-none">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="text" class="form-control" name="" value="MIAMI">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="text" class="form-control" name="" value="">
                            </div>
                            <div class="col-lg-2 mb-2">
                                <input type="text" class="form-control" name="" value="33130">
                            </div>
                        </div>
                        <div class="row g-lg-3 mb-3 mt-lg-4">
                            <div class="col-lg-6">
                                <label for="inputPassword6" class="col-form-label fs-5 fw-normal "> What is your net
                                    worth?</label>
                            </div>
                            <div class="col-lg-6"> 
                                <input type="text"  class="border-0 border-bottom lh-lg myNumberField" name="net_worth"   placeholder="Enter manually" required data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'rightAlign': false">

                                <div class="invalid-feedback">
                                    Please Add Your Net Worth
                                </div>
                            </div>
                        </div>
                        <div class="row g-lg-3 mb-3">
                            <div class="col-lg-6">
                                <label for="inputPassword6" class="col-form-label fs-5 fw-normal"> What is your annual
                                    income?</label>
                            </div>
                            <div class="col-lg-6">
                                
                                <input type="text"  class="border-0 border-bottom lh-lg myNumberField" name="annual_income"   placeholder="Enter manually" required data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'rightAlign': false"> 
                                <div class="invalid-feedback">
                                    Please Add Annual Income
                                </div>
                            </div>
                        </div>
                        <div class="row g-lg-3 align-items-center mb-lg-5 mt-lg-4 mx-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label fs-5" for="flexSwitchCheckDefault">
                                    Are you an accredited investor?
                                </label>
                                <input class="form-check-input fs-5" type="checkbox" id="flexSwitchCheckDefault" name="are_you_accredited"    >
                                <div class="invalid-feedback">Check Toogle Button</div>
                            </div>

                            <p>An accredited investor is defined by U.S. federal law as one of the following:</p>
                            <ul class="p-lg-0 my-0 ps-lg-5 p-3">
                                <li>I represent a company that (i) is owned by two or more natural
                                    persons who are related as spouses, siblings, or direct lineal
                                    descendants and (ii) owns Above $5M of Investments</li>
                                <li>$200,000+ income for two or more years and reasonably expect the same this year
                                </li>
                                <li>$1M+ net worth (your assets minus liabilities, excluding home)</li>
                                <li>Hold a Series 7, 65, or 82</li>
                                <li>Certain banks, trusts, brokers, and funds</li>
                                <li>I am an investment manager who, for my account or the account
                                    of other Qualified Purchasers, owns and invests, on a discretionary
                                    basis above $25M of Investments
                                </li>
                                <li>I invest on behalf of a business entity, with total assets above $5M I invest on
                                    behalf
                                    of a business entity or trust, each of whose equity
                                    owners or members are
                                </li>
                            </ul>
                            <div class="form-check form-switch my-3">
                                <label class="form-check-label fs-5" for="flexSwitchCheckDefault"> Consent to electronic
                                    delivery </label>
                                <input class="form-check-input fs-5" type="checkbox" id="flexSwitchCheckDefault"
                                    name="electronic_delivery" required>
                                <div class="invalid-feedback">Check Toogle Button</div>
                            </div>
                        </div>
                        <div class="p-lg-0 p-3">
                            <h4 class="mb-lg-4">ChainRaise is different than the stock market...</h4>
                            <div class="col-md-12">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        I understand startups and small businesses are very risky. I
                                        can afford a 100% loss of all investments I make on ChainRaise.</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="afford_loss" required>
                                    <div class="invalid-feedback">
                                        Please Select Toggle
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        I understand securities on ChainRaise are not easily re-sold.
                                        There is no secondary market. I can wait years for a return.</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="understand_securities" required>
                                    <div class="invalid-feedback">
                                        Please Select Toggle
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        I understand ChainRaise does not offer investment advice. I
                                        have the sophistication to evaluate investments on my own.</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="investment_advice" required>
                                    <div class="invalid-feedback">
                                        Please Select Toggle
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        I agree to the Terms Privacy Policy
                                        Investor Agreement and Electronic Consent &
                                        Delivery
                                        Agreement.</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                        name="agree_policy" required>
                                    <div class="invalid-feedback">
                                        Please Select Toggle
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-outline-dark mt-3 px-4  mt-lg-4 ms-lg-5 rounded-pill fw-semibold"
                                    type="submit">Create Account</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('page_js')

    <script>
         $(document).ready(function() {
            $('#Entity').click(function(){
                 $('.entity_name_container').removeClass('d-none');
                 $('#entity_name').attr('required', 'required');
            });

            $('#Individual').click(function(){
                $('.entity_name_container').addClass('d-none');
                $('#entity_name').removeAttr('required',)
            });

            
         });

        $(document).ready(function() {
            $('#update_profile').validate({
                rules: {
                    account_type: 'required',
                    entity_name: 'required',
                    legal_name: 'required',
                    net_worth: 'required',
                    annual_income: 'required',
                },
                messages: {
                    account_type: 'Please Select Account Type ',
                    entity_name: 'Please Enter Entity Name ',
                    legal_name: 'Please Enter Legal  Name ',
                },
                highlight: function(element) {
                    $(element).addClass('error');
                },
                unhighlight: function(element) {
                    $(element).removeClass('error');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });



        $('#update_profile1').submit(function(e) {

            e.preventDefault();
            var formData = new FormData(this);
            alert();
            var value = formData.get('account_type');
            console.log(value)
            $.ajax({
                url: "{{ route('user.basic.details.update') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == true) {
                        $('.row_accreditation').addClass('d-none')
                        $('.row_final').removeClass('d-none');
                        //toastr.success(response.message, "Success");
                    } else {
                        //toastr.error(response.message, "Error");
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
          $('.myNumberField').inputmask();
        });
    </script>
        
        
        
        
@endsection
