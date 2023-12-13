@extends('layouts.master')
@section('page_style')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <!-- Add SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('vue/css/style-investor-flow.css') }}">

    <style>
        .accordion {
            --bs-accordion-bg: #fff0 !important;
        }

        .accordion-button:focus {
            z-index: 3;
            border-color: none !important;
            outline: 0;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: transparent !important;
        }
    </style>

@endsection
@section('page_title', 'Investor Flow')

@section('page_content')
         <!-- Hero Section Start -->

         <section class="bg-dark-color p-lg-5 p-3 ">
            <div class="container">
                <div class="row justify-content-around">

                    <div class="col-lg-7 ps-lg-0 bg-invest right-section">
                        <div class="bubble-container justify-content-center">
                            <div class="bubble" id="bubble1">
                                <span class=" bubble-number">1</span>
                                <i class="fas fa-check check-icon"></i>
                            </div>
                            <div class="line" id="line1"></div>
                            <div class="bubble" id="bubble2">
                                <span class=" bubble-number">2</span>
                                <i class="fas fa-check check-icon"></i>
                            </div>
                            <div class="line" id="line2"></div>
                            <div class="bubble" id="bubble3">
                                <span class=" bubble-number">3</span>
                                <i class="fas fa-check check-icon"></i>
                            </div>
                            <div class="line" id="line3"></div>
                            <div class="bubble" id="bubble4">
                                <span class=" bubble-number">4</span>
                                <i class="fas fa-check check-icon"></i>
                            </div>
                            <div class="line" id="line4"></div>
                            <div class="bubble" id="bubble5">
                                <span class="bubble-number">5</span>
                                <i class="fas fa-check check-icon"></i>
                            </div>
                        </div>
                        <div class="forms">
                            <div id="form1" class="form">
                                <div class="container px-5">
                                    <p class="form_heading">Investment Amount</p>
                                    <label class="form-label text-white">Amount</label>
                                    <input type="text "value="{{  $investment_amount }}" placeholder=" Enter Amount" id="investmentAmount" class="form-control" />
                                    <div class="container my-3">
                                        <div class="row justify-content-center inner-part p-3">
                                            <div class="col-5 d-flex align-items-center ">
                                                <p class="text-white mb-0">Invest US$10K for a perk!</p>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div>
                                                    <img src="{{ asset('vue/images/gift.png')}}" />
                                                    <p class="text-white mt-2 mb-0">US$10K</p>
                                                </div>
                                                <div class="line mx-2" id="line1"></div>
                                                <div>
                                                    <img src="{{ asset('vue/images/gift.png')}}" />
                                                    <p class="text-white mt-2 mb-0">US$10K</p>
                                                </div>
                                                <div class="line mx-2" id="line1"></div>
                                                <div>
                                                    <img src="{{ asset('vue/images/gift.png')}}" />
                                                    <p class="text-white mt-2 mb-0">US$10K</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form2" class="form" style="display: none">
                                <div class="container">
                                    <div class="container mt-4">
                                        <p class="form_heading">Investor Info</p>
                                    </div>
                                    <div class="container mt-4">
                                        <label class="form-label text-white">Investing As</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>My Self</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="container mt-4">
                                        <label class="form-label text-white">Full Name</label>
                                        <input type="text" placeholder="Enter Full Name" class="form-control" value="{{ Auth::user()->name }}" />
                                    </div>
                                    <div class="container mt-4">
                                        <label class="form-label text-white">Address</label>
                                        <input type="text" placeholder="Enter Address" class="form-control" value="{{ $user->userDetail->address }}"/>
                                    </div>
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label text-white">City</label>
                                                <input type="text" placeholder="Enter Address" class="form-control" value="{{ $user->userDetail->city }}"/>
                                            </div>
                                            <div class="col">
                                                <label class="form-label text-white">Region</label>
                                                <input type="text" placeholder="Region" class="form-control" value="{{ $user->userDetail->state }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label text-white">Postal Code</label>
                                                <input type="text" placeholder="Enter Postal Code" class="form-control" value="{{ $user->userDetail->zip }}"/>
                                            </div>
                                            <div class="col">
                                                <label class="form-label text-white">Country</label>
                                                <input type="text" placeholder="Your Country" class="form-control" value="{{ $user->userDetail->country }}"/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="newEntityForm" class="form" style="display: none">
                                <div class="container">
                                    <div class="container mt-4">
                                        <p class="form_heading">Add New Entity</p>
                                    </div>
                                    <div class="container mt-4">
                                        <p class="Invest-amount">Entity Type</p>
                                        <input type="text" placeholder="Select Entity Type" class="text-area" />
                                    </div>

                                    <div class="container mt-4">
                                        <p class="Invest-amount">Legal Name</p>
                                        <input type="text" placeholder="Legal Name" class="text-area" />
                                    </div>

                                    <div class="container mt-4">
                                        <p class="Invest-amount">Address</p>
                                        <input type="text" placeholder="Enter Address" class="text-area" />
                                    </div>

                                    <div class="container mt-4">
                                        <p class="Invest-amount">Employee Identification Number</p>
                                        <input type="text" placeholder="Enter Employee Identification Number"
                                            class="text-area" />
                                    </div>
                                </div>
                            </div>

                            <div id="form3" class="form" style="display: none">


                                <div class="container text-white px-5">
                                    <p class="form_heading mb-3">Payment Method</p>
                                    <div class="my-3">
                                        <label><input type="radio" class="form-switch" name="colorCheckbox"
                                                value="Credit / Debit" data-id="a" checked> Credit / Debit</label>
                                        <label><input type="radio" class="form-switch  ms-3" name="colorCheckbox"
                                                value="PayPal" data-id="b"> PayPal</label>
                                        <label><input type="radio" class="form-switch  ms-3" name="colorCheckbox"
                                                value="American Express" data-id="c"> American Express</label>
                                    </div>


                                    <div class="form form-a active">
                                        <label class="form-label text-white">Credit Card Number</label>
                                        <input type="text " placeholder="Card Number" class="form-control" />
                                        <div class="row">
                                            <div>
                                                <label class="form-label text-white">CVV</label>
                                                <input type="text " placeholder="CVV" class="form-control" />
                                            </div>
                                            <div>
                                                <label class="form-label text-white">Expires On</label>
                                                <input type="text " placeholder="Expires On" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form form-b">
                                        <label class="form-label text-white">PayPal</label>
                                        <input type="text " placeholder="Card Number" class="form-control" />
                                        <div class="row">
                                            <div>
                                                <label class="form-label text-white">CVV</label>
                                                <input type="text " placeholder="CVV" class="form-control" />
                                            </div>
                                            <div>
                                                <label class="form-label text-white">Expires On</label>
                                                <input type="text " placeholder="Expires On" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form form-c">
                                        <label class="form-label text-white">American Express</label>
                                        <input type="text " placeholder="Card Number" class="form-control" />
                                        <div class="row">
                                            <div>
                                                <label class="form-label text-white">CVV</label>
                                                <input type="text " placeholder="CVV" class="form-control" />
                                            </div>
                                            <div>
                                                <label class="form-label text-white">Expires On</label>
                                                <input type="text " placeholder="Expires On" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <p class="form_heading">Payment Method</p>
                                    <div class="container mt-4">
                                        <div class="row">
                                            <div class="col-md-4 custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                                        id="radio1" value="option1" />
                                                    <label class="form-check-label" for="radio1"> Credit / Debit
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                                        id="radio2" value="option2" />
                                                    <label class="form-check-label" for="radio2"> PayPal </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios"
                                                        id="radio3" value="option3" />
                                                    <label class="form-check-label" for="radio3"> American Express
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="Invest-amount">Credit Card Number</p>
                                    <input type="text " value="Card Number" class="text-area" />
                                    <div class="row">
                                        <div>
                                            <p class="Invest-amount">CVV</p>
                                            <input type="text " value="CVV" class="text-areaCVV" />
                                        </div>
                                        <div>
                                            <p class="Invest-amount">Expires On</p>
                                            <input type="text " value="Expires On" class="text-areaExpires" />
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div id="form4" class="form" style="display: none">
                                <div class="container px-5">
                                    <div class="container mt-4">
                                        <p class="form_heading">Legal Stuff</p>
                                    </div>
                                    <div class="container mt-4">
                                        <p class="form4-text">
                                            By checking this box, I, the investor, acknowledge that I have reviewed the Issuer's Form C and Disclosure Materials, as well as the educational materials provided on the Portal, understood the risks that come with investing in issuing companies on the Portal, and acknowledge that my entire investment may be lost and I will be financially and psychologically fine if it is. I understand that the decision whether to consult a professional advisor regarding my investment is my decision and that the Portal does not offer any investment advice or suggestions.
                                        </p>
                                    </div>
                                    <div class="container mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agreeCheckbox" />
                                            <label class="form-check-label" for="agreeCheckbox"> I agree to this and the
                                                Terms & Conditions </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form5" class="form" style="display: none">
                                <div class="container px-5">
                                    <p class="form_heading">Complete Investment</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-white mb-0">
                                                Investment Amount</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-white text-end mb-0">
                                                $<span class="investmentFinalAmount"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-white mb-0">
                                                Platform Fees</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-white text-end mb-0">
                                                US$8</p>
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-white mb-0">
                                                Total</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-white text-end mb-0">
                                                US$250</p>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="container investment_buttons" style="margin-top: 200px;">
                            <button class="button_cancel me-3" onclick="goToPreviousStep()">Cancel</button>
                            <button class="button_complete_investment" onclick="nextForm()">Complete Investment</button>
                        </div>
                    </div>
                    <div class="col-lg-4 side-col-bg px-0 bg-image-modal rounded">
                        <div class="p-lg-4">
                            <p class="text-white mb-0"><b>Deal Terms</b></p>
                            <p class="text-white mb-0">  {{ $offer->terms }}. </p>

                            <p class="text-white "><span> US ${{ number_format($offer->total_valuation) }} | US ${{ number_format($offer->price_per_unit) }}/share </span>
                            </p>
                            <p class="text-white">Enter an amount to view deal info</p>
                            <hr>
                            <p class="text-white mt-3"><b>Contracts</b></p>
                            <div class="col-10 mb-3">
                                <img src="images/pdf (1).png" alt=""> <span class="ps-3 text-white">From C</span>
                            </div>
                            <hr>
                            <p class="text-white mt-3"><b>FAQ & Help</b></p>

                            @if ($offer->faqs)
                                @foreach ($offer->faqs as $faq)
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed text-white" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                                aria-controls="collapseOne">
                                                {{ $faq->question }} </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body text-white">
                                                <p class="border-start ps-3">
                                                    {{ $faq->answer }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                @endforeach
                            @endif



                        </div>
                    </div>
                </div>
        </section>




        <!-- 2nd Section Start -->

@endsection
@section('page_js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
    ></script>

    <script>
        let previousBubble = null;
        let previousLine = null;
        let nextStep = 1;

        // Function to highlight a specific bubble
        function highlightBubble(number) {
            const currentBubble = document.getElementById(`bubble${number}`);
            const currentLine = document.getElementById(`line${number}`);

            if (previousBubble) {
                previousBubble.classList.add('completed');
                if (previousLine) {
                    previousLine.classList.add('completed-line');
                }
                const previousBubbleNumber = previousBubble.querySelector('.bubble-number');
                previousBubbleNumber.textContent = '';
                const previousCheckIcon = previousBubble.querySelector('.check-icon');
                previousCheckIcon.style.display = 'block';

                // Hide the form for the previous step
                document.getElementById(`form${previousBubble.dataset.step}`).style.display = 'none';
            }

            currentBubble.classList.add('selected');
            const lineBeforeCurrent = currentBubble.previousElementSibling;
            if (lineBeforeCurrent && lineBeforeCurrent.classList.contains('line')) {
                lineBeforeCurrent.classList.add('completed-line');
            }

            // Show the form for the current step
            document.getElementById(`form${number}`).style.display = 'block';

            previousBubble = currentBubble;
            previousLine = lineBeforeCurrent;

            // Update the dataset with the step number
            currentBubble.dataset.step = number;
        }

        // Highlight the first bubble by default when the page loads
        document.addEventListener('DOMContentLoaded', function () {
            highlightBubble(1);
        });

        function nextForm() {
            if (nextStep <= 6) {
                // Hide the form for the current step
                document.getElementById(`form${nextStep}`).style.display = 'none';
                document.getElementById('form2').style.display = 'none';
                document.getElementById('newEntityForm').style.display = 'none';
                nextStep = nextStep + 1;
                highlightBubble(nextStep);
            }
        }
    </script>

    <script>
        function showNewEntityForm() {
            document.getElementById('form2').style.display = 'none';
            document.getElementById('newEntityForm').style.display = 'block';
        }
    </script>

    <script>
            $('#investmentAmount').keyup(function(){
                var investmentAmount = $('#investmentAmount').val();

                $('.investmentFinalAmount').html(investmentAmount)
            });

    </script>
@endsection
