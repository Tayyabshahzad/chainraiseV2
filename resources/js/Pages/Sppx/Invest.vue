<template>
    <div
        class="container p-lg-5 mt-lg-3 p-3 text-black"
        style="background: #000; color: #fff !important"
    >
        <p class="fw-bolder mb-5">
            <a href="https://development.investchainraise.io">
                <i class="bi bi-skip-backward pe-3"></i> Back To Market Place
            </a>
        </p>

        <h1 class="fw-bolder mb-5">
            <i class="bi bi-circle-fill pe-3"></i>Invest in Victory Litigation
            Fund
        </h1>
        <div class="row">
            <div class="col-lg-8">
                <form
                    action="https://development.investchainraise.io/invest/save"
                    method="post"
                    enctype="multipart/form-data"
                    id="make_investment_form"
                >
                    <input
                        type="hidden"
                        name="_token"
                        value="27M45oHSCHjpLSXhZzTLFPgntVxo93NO6LcqkWAE"
                    />
                    <input type="hidden" name="offer_id" value="18" />
                    <h4 class="fw-bolder">1. Investment amount</h4>
                    <p class="text-muted">
                        Payments are processed immediately.
                    </p>
                    <input
                        type="text"
                        class="form-control rounded-pill py-2 px-4 mb-3"
                        value="123"
                        placeholder="$500 (Click to change amount)"
                        id="investmentAmountInput"
                        name="investment_amount"
                        required=""
                    />

                    <div class="invalid-feedback">
                        Please Enter Investment amount
                    </div>
                    <p>You are investing as Myself / individual change</p>
                    <div class="my-5">
                        <h4 class="fw-bolder">2. Investor Limits</h4>
                        <p>
                            Your Investment Limit Is
                            <span id="investment_limit_label"> $4,040 </span>
                        </p>
                        <input
                            type="hidden"
                            name="investment_limit"
                            class="current_investment_limit"
                            value="4040.45"
                            required=""
                        />
                        <input
                            type="hidden"
                            class="total_investment_limit"
                            value="4040.45"
                            required=""
                        />
                        <p class="text-muted">
                            Have you made an investments in equity crowdfunding
                            (REG CF) on any platform in the past 12 months
                            (including ChainRaise)?
                        </p>
                        <div class="form-check form-switch mb-3 ms-2 mt-0">
                            <input
                                class="form-check-input fs-5 past_12_months_investment_check_button"
                                type="checkbox"
                                id="flexSwitchCheckDefault"
                                name="past_12_months_investment"
                            />
                            <div class="invalid-feedback">
                                Please Check Toggle Button
                            </div>
                        </div>
                        <input
                            type="number"
                            class="update_investment_limits show_investment_limit d-none form-control rounded-pill py-2 px-4 mb-3"
                            id="validationCustom03"
                            placeholder="Total Amount Invested in Crowdfunding Offerings*"
                        />

                        <div class="invalid-feedback">
                            Please Enter Total Amount Invested in Crowdfunding
                            Offerings
                        </div>
                    </div>
                    <div class="my-5">
                        <h4 class="fw-bolder">3. Personal information</h4>
                        <p>
                            Required by United States banking laws. This
                            information is kept secure. It will never be used
                            for any purpose beyond executing your investment.
                        </p>

                        <button
                            type="button"
                            disabled=""
                            class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill show_user_detail_form"
                        >
                            Verify My Identity
                            <small> (Your KYC Is Completed) </small>
                        </button>

                        <svg
                            class="spinner d-none"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <circle
                                class="spinner_qM83"
                                cx="4"
                                cy="12"
                                r="3"
                            ></circle>
                            <circle
                                class="spinner_qM83 spinner_oXPr"
                                cx="12"
                                cy="12"
                                r="3"
                            ></circle>
                            <circle
                                class="spinner_qM83 spinner_ZTLf"
                                cx="20"
                                cy="12"
                                r="3"
                            ></circle>
                        </svg>
                    </div>

                    <div class="my-5 bank_wrapper">
                        <h4 class="fw-bolder">
                            4. Bank information <i class="bi bi-lock-fill"></i>
                        </h4>
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li
                                class="nav-item px-lg-5 border-bottom"
                                role="presentation"
                            >
                                <button
                                    class="nav-link active bg-transparent text-muted"
                                    id="pills-home-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#investment"
                                    type="button"
                                    role="tab"
                                    aria-controls="pills-home"
                                    aria-selected="true"
                                >
                                    ACH
                                </button>
                            </li>
                            <li
                                class="nav-item px-lg-5 border-bottom"
                                role="presentation"
                            >
                                <button
                                    class="nav-link bg-transparent text-muted"
                                    id="pills-profile-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#investment_wire"
                                    type="button"
                                    role="tab"
                                    aria-controls="pills-profile"
                                    aria-selected="false"
                                    tabindex="-1"
                                >
                                    Wire Transfer
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content py-3" id="pills-tabContent">
                            <div
                                class="tab-pane fade show active p-2"
                                id="investment"
                                role="tabpanel"
                                aria-labelledby="pills-home-tab"
                            >
                                <p>Pay using a ACH:</p>
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#payment_widget"
                                    class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill payment_widget_button"
                                    style="color: #fff"
                                >
                                    Select ACH Bank Account
                                </button>
                            </div>
                            <div
                                class="tab-pane fade p-2"
                                id="investment_wire"
                                role="tabpanel"
                                aria-labelledby="pills-profile-tab"
                            >
                                <p>Pay using a Wire Transfer:</p>
                                <button
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#payment_wire"
                                    class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill payment_wire_button"
                                >
                                    Select Wire Transfer
                                </button>
                            </div>
                        </div>
                        <div class="my-5">
                            <h4 class="fw-bolder">5. Terms</h4>
                        </div>
                        <div class="border px-5 py-3 mb-3">
                            <input
                                type="checkbox"
                                name=""
                                id="validationCustom04"
                                required=""
                            />
                            By checking this box, I, the investor, acknowledge
                            that I have reviewed the Issuer's
                            <a href="https://www.google.com" target="_blank"
                                >Form C and Disclosure Materials</a
                            >, as well as the
                            <a href="https://www.google.com" target="_blank">
                                educational materials</a
                            >
                            provided on the Portal, understood the risks that
                            come with investing in issuing companies on the
                            Portal, and acknowledge that my entire investment
                            may be lost and I will be financially and
                            psychologically fine if it is. I understand that the
                            decision whether to consult a professional advisor
                            regarding my investment is my decision and that the
                            Portal does not offer any investment advice or
                            suggestions.

                            <div class="invalid-feedback">Please Check</div>
                        </div>

                        <div class="border px-5 py-3 mb-3">
                            <input
                                type="checkbox"
                                name=""
                                id="validationCustom06"
                                required=""
                            />
                            By checking this box, I, the investor, acknowledge
                            that I understand I can cancel my investment
                            commitment up to 48 hours before the offer's closing
                            deadline. If I have made a commitment within this
                            48-hour window, I cannot cancel my investment.
                            <div class="invalid-feedback">Please Check</div>
                        </div>

                        <div class="border px-5 py-3 mb-3">
                            <input
                                type="checkbox"
                                name=""
                                id="validationCustom06"
                                required=""
                            />
                            By checking this box, I, the investor, acknowledge
                            that the securities are subject to transfer
                            restrictions and that I have reviewed and understood
                            these transfer restrictions as provided in the
                            Portal's
                            <a href="https://www.google.com" target="_blank">
                                educational materials </a
                            >.
                            <div class="invalid-feedback">Please Check</div>
                        </div>

                        <div class="border px-5 py-3 mb-3">
                            <input
                                type="checkbox"
                                name=""
                                id="validationCustom06"
                                required=""
                            />
                            By checking this box, I, the investor, acknowledge
                            that I have provided truthful and accurate
                            representations of the documents and information
                            requested by the Portal.
                            <div class="invalid-feedback">Please Check</div>
                        </div>

                        <div class="border px-5 py-3 mb-3">
                            <input
                                type="checkbox"
                                class="esing_check"
                                name="esing_check"
                                id="validationCustom05"
                                required=""
                            />
                            I have read and agree to the e-sign disclosure

                            <a
                                href="#"
                                class="text-gray-700 view_template"
                                data-user_id="1"
                                data-template_id=" eea3eaf6-55f0-45d7-9280-2a00af16b487"
                                data-bs-toggle="modal"
                                data-bs-target="#modal_view_e_sign"
                            >
                                (Review Document)
                            </a>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <a class="check_esing_status" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>

                            <div class="invalid-feedback">Please Check</div>
                        </div>

                        <input
                            type="hidden"
                            class="user_guid"
                            name="user_guid"
                        />
                        <input
                            type="hidden"
                            class="payment_type"
                            name="payment_type"
                            required=""
                        />
                        <div class="d-grid gap-2">
                            <button
                                type="submit"
                                disabled=""
                                class="confirm_investment_button btn btn-2 fw-semibold px-lg-5 px-3 me-2"
                            >
                                Confirm Investment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="border text-center p-5 mb-4">
                    <h6>Deal Terms</h6>
                    <h6>Future Equity</h6>
                    <a href="">$50,000,000 valuation cap</a>
                    <p class="mt-3">
                        Offer Type Reg CF | Offer Amount $5,000,000 | Securities
                        Type Revenue Share | Valuation $50,000,000 | Min.
                        Investment $100.
                    </p>
                </div>

                <div class="mb-3">
                    <h4 class="fw-bolder mb-3">FAQ &amp; Help</h4>
                    <ul>
                        <li>
                            <ul>
                                <li></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="mb-3">
                    <h4 class="fw-bolder mb-3">Need help?</h4>

                    <p>
                        Email:
                        <a href="mailt0:info@chainraise.io"
                            >info@chainraise.io</a
                        >
                    </p>
                </div>
                <div class="mb-3">
                    <h4 class="fw-bolder mb-3">Documents</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a
                                href="https://development.investchainraise.io/storage/303/Form-C---Victory-Litigation-Fund.pdf"
                                target="_blank"
                            >
                                <i class="bi bi-file-earmark-pdf"></i> Form C -
                                Victory Litigation Fund
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="modal_view_e_sign"
            data-backdrop="static"
            tabindex="-1"
            role="dialog"
            aria-labelledby="staticBackdrop"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-xl"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Document Preview
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="card card-custom">
                            <div class="card-body row">
                                <iframe src="" id="eSignaturesIOIframe">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="kyc_data_modal"
            tabindex="-1"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-xl">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <!--begin::Close-->
                        <div
                            class="btn btn-sm btn-icon btn-active-color-primary"
                            data-bs-dismiss="modal"
                        >
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <rect
                                        opacity="0.5"
                                        x="6"
                                        y="17.3137"
                                        width="16"
                                        height="2"
                                        rx="1"
                                        transform="rotate(-45 6 17.3137)"
                                        fill="currentColor"
                                    ></rect>
                                    <rect
                                        x="7.41422"
                                        y="6"
                                        width="16"
                                        height="2"
                                        rx="1"
                                        transform="rotate(45 7.41422 6)"
                                        fill="currentColor"
                                    ></rect>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <form
                            class="row g-3 needs-validation"
                            id="profile_update_form"
                            method="post"
                            action="https://development.investchainraise.io/verify_identity"
                        >
                            <input
                                type="hidden"
                                name="_token"
                                value="27M45oHSCHjpLSXhZzTLFPgntVxo93NO6LcqkWAE"
                            />
                            <div class="text-center d-none kyc_loader_image">
                                <img
                                    src="https://development.investchainraise.io/assets/media/spinner.svg"
                                    alt=""
                                />
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="validationCustom01"
                                            class="form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Legal Name:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <input
                                            type="text"
                                            class="form-control legal_name"
                                            id="validationCustom01"
                                            value="admin"
                                            name="legal_name"
                                            required=""
                                        />
                                        <div class="invalid-feedback">
                                            Please Enter Legal Name
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="validationCustom01"
                                            class="form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Last Name:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="validationCustom01"
                                            placeholder="Last Name"
                                            name="last_name"
                                            value="Shahzad"
                                            required=""
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="validationCustom02"
                                            class="form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Nationality:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <select
                                            class="form-select nationality"
                                            required=""
                                            data-control="select2"
                                            name="nationality"
                                            data-placeholder="Select an option"
                                            data-live-search="true"
                                        >
                                            <option value="">Select</option>
                                            <option value="AF">
                                                Afghanistan
                                            </option>
                                            <option value="AX">
                                                Åland Islands
                                            </option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">
                                                American Samoa
                                            </option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">
                                                Antarctica
                                            </option>
                                            <option value="AG">
                                                Antigua and Barbuda
                                            </option>
                                            <option value="AR">
                                                Argentina
                                            </option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">
                                                Australia
                                            </option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">
                                                Azerbaijan
                                            </option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">
                                                Bangladesh
                                            </option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">
                                                Bolivia, Plurinational State of
                                            </option>
                                            <option value="BQ">
                                                Bonaire, Sint Eustatius and Saba
                                            </option>
                                            <option value="BA">
                                                Bosnia and Herzegovina
                                            </option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">
                                                Bouvet Island
                                            </option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">
                                                British Indian Ocean Territory
                                            </option>
                                            <option value="BN">
                                                Brunei Darussalam
                                            </option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">
                                                Burkina Faso
                                            </option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">
                                                Cape Verde
                                            </option>
                                            <option value="KY">
                                                Cayman Islands
                                            </option>
                                            <option value="CF">
                                                Central African Republic
                                            </option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">
                                                Christmas Island
                                            </option>
                                            <option value="CC">
                                                Cocos (Keeling) Islands
                                            </option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">
                                                Congo, the Democratic Republic
                                                of the
                                            </option>
                                            <option value="CK">
                                                Cook Islands
                                            </option>
                                            <option value="CR">
                                                Costa Rica
                                            </option>
                                            <option value="CI">
                                                Côte d'Ivoire
                                            </option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curaçao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">
                                                Czech Republic
                                            </option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">
                                                Dominican Republic
                                            </option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">
                                                El Salvador
                                            </option>
                                            <option value="GQ">
                                                Equatorial Guinea
                                            </option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">
                                                Falkland Islands (Malvinas)
                                            </option>
                                            <option value="FO">
                                                Faroe Islands
                                            </option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">
                                                French Guiana
                                            </option>
                                            <option value="PF">
                                                French Polynesia
                                            </option>
                                            <option value="TF">
                                                French Southern Territories
                                            </option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">
                                                Gibraltar
                                            </option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">
                                                Greenland
                                            </option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">
                                                Guadeloupe
                                            </option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">
                                                Guatemala
                                            </option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">
                                                Guinea-Bissau
                                            </option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">
                                                Heard Island and McDonald
                                                Islands
                                            </option>
                                            <option value="VA">
                                                Holy See (Vatican City State)
                                            </option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">
                                                Hong Kong
                                            </option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">
                                                Indonesia
                                            </option>
                                            <option value="IR">
                                                Iran, Islamic Republic of
                                            </option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">
                                                Isle of Man
                                            </option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">
                                                Kazakhstan
                                            </option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">
                                                Korea, Democratic People's
                                                Republic of
                                            </option>
                                            <option value="KR">
                                                Korea, Republic of
                                            </option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">
                                                Kyrgyzstan
                                            </option>
                                            <option value="LA">
                                                Lao People's Democratic Republic
                                            </option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libya</option>
                                            <option value="LI">
                                                Liechtenstein
                                            </option>
                                            <option value="LT">
                                                Lithuania
                                            </option>
                                            <option value="LU">
                                                Luxembourg
                                            </option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">
                                                Macedonia, the former Yugoslav
                                                Republic of
                                            </option>
                                            <option value="MG">
                                                Madagascar
                                            </option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">
                                                Marshall Islands
                                            </option>
                                            <option value="MQ">
                                                Martinique
                                            </option>
                                            <option value="MR">
                                                Mauritania
                                            </option>
                                            <option value="MU">
                                                Mauritius
                                            </option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">
                                                Micronesia, Federated States of
                                            </option>
                                            <option value="MD">
                                                Moldova, Republic of
                                            </option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">
                                                Montenegro
                                            </option>
                                            <option value="MS">
                                                Montserrat
                                            </option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">
                                                Mozambique
                                            </option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">
                                                Netherlands
                                            </option>
                                            <option value="NC">
                                                New Caledonia
                                            </option>
                                            <option value="NZ">
                                                New Zealand
                                            </option>
                                            <option value="NI">
                                                Nicaragua
                                            </option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">
                                                Norfolk Island
                                            </option>
                                            <option value="MP">
                                                Northern Mariana Islands
                                            </option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">
                                                Palestinian Territory, Occupied
                                            </option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">
                                                Papua New Guinea
                                            </option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">
                                                Philippines
                                            </option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">
                                                Puerto Rico
                                            </option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Réunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">
                                                Russian Federation
                                            </option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">
                                                Saint Barthélemy
                                            </option>
                                            <option value="SH">
                                                Saint Helena, Ascension and
                                                Tristan da Cunha
                                            </option>
                                            <option value="KN">
                                                Saint Kitts and Nevis
                                            </option>
                                            <option value="LC">
                                                Saint Lucia
                                            </option>
                                            <option value="MF">
                                                Saint Martin (French part)
                                            </option>
                                            <option value="PM">
                                                Saint Pierre and Miquelon
                                            </option>
                                            <option value="VC">
                                                Saint Vincent and the Grenadines
                                            </option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">
                                                San Marino
                                            </option>
                                            <option value="ST">
                                                Sao Tome and Principe
                                            </option>
                                            <option value="SA">
                                                Saudi Arabia
                                            </option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SC">
                                                Seychelles
                                            </option>
                                            <option value="SL">
                                                Sierra Leone
                                            </option>
                                            <option value="SG">
                                                Singapore
                                            </option>
                                            <option value="SX">
                                                Sint Maarten (Dutch part)
                                            </option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">
                                                Solomon Islands
                                            </option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">
                                                South Africa
                                            </option>
                                            <option value="GS">
                                                South Georgia and the South
                                                Sandwich Islands
                                            </option>
                                            <option value="SS">
                                                South Sudan
                                            </option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">
                                                Sri Lanka
                                            </option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">
                                                Svalbard and Jan Mayen
                                            </option>
                                            <option value="SZ">
                                                Swaziland
                                            </option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">
                                                Switzerland
                                            </option>
                                            <option value="SY">
                                                Syrian Arab Republic
                                            </option>
                                            <option value="TW">
                                                Taiwan, Province of China
                                            </option>
                                            <option value="TJ">
                                                Tajikistan
                                            </option>
                                            <option value="TZ">
                                                Tanzania, United Republic of
                                            </option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">
                                                Timor-Leste
                                            </option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">
                                                Trinidad and Tobago
                                            </option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">
                                                Turkmenistan
                                            </option>
                                            <option value="TC">
                                                Turks and Caicos Islands
                                            </option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">
                                                United Arab Emirates
                                            </option>
                                            <option value="GB">
                                                United Kingdom
                                            </option>
                                            <option value="US">
                                                United States
                                            </option>
                                            <option value="UM">
                                                United States Minor Outlying
                                                Islands
                                            </option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">
                                                Uzbekistan
                                            </option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">
                                                Venezuela, Bolivarian Republic
                                                of
                                            </option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">
                                                Virgin Islands, British
                                            </option>
                                            <option value="VI">
                                                Virgin Islands, U.S.
                                            </option>
                                            <option value="WF">
                                                Wallis and Futuna
                                            </option>
                                            <option value="EH">
                                                Western Sahara
                                            </option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="validationCustom02"
                                            class="form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Country of Residence:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <select
                                            class="form-select country_residence"
                                            required=""
                                            data-control="select2"
                                            name="country_residence"
                                            data-placeholder="Select an option"
                                            data-live-search="true"
                                        >
                                            <option value="">Select</option>
                                            <option value="AF">
                                                Afghanistan
                                            </option>
                                            <option value="AX">
                                                Åland Islands
                                            </option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">
                                                American Samoa
                                            </option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">
                                                Antarctica
                                            </option>
                                            <option value="AG">
                                                Antigua and Barbuda
                                            </option>
                                            <option value="AR">
                                                Argentina
                                            </option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">
                                                Australia
                                            </option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">
                                                Azerbaijan
                                            </option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">
                                                Bangladesh
                                            </option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">
                                                Bolivia, Plurinational State of
                                            </option>
                                            <option value="BQ">
                                                Bonaire, Sint Eustatius and Saba
                                            </option>
                                            <option value="BA">
                                                Bosnia and Herzegovina
                                            </option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">
                                                Bouvet Island
                                            </option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">
                                                British Indian Ocean Territory
                                            </option>
                                            <option value="BN">
                                                Brunei Darussalam
                                            </option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">
                                                Burkina Faso
                                            </option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">
                                                Cape Verde
                                            </option>
                                            <option value="KY">
                                                Cayman Islands
                                            </option>
                                            <option value="CF">
                                                Central African Republic
                                            </option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">
                                                Christmas Island
                                            </option>
                                            <option value="CC">
                                                Cocos (Keeling) Islands
                                            </option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">
                                                Congo, the Democratic Republic
                                                of the
                                            </option>
                                            <option value="CK">
                                                Cook Islands
                                            </option>
                                            <option value="CR">
                                                Costa Rica
                                            </option>
                                            <option value="CI">
                                                Côte d'Ivoire
                                            </option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curaçao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">
                                                Czech Republic
                                            </option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">
                                                Dominican Republic
                                            </option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">
                                                El Salvador
                                            </option>
                                            <option value="GQ">
                                                Equatorial Guinea
                                            </option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">
                                                Falkland Islands (Malvinas)
                                            </option>
                                            <option value="FO">
                                                Faroe Islands
                                            </option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">
                                                French Guiana
                                            </option>
                                            <option value="PF">
                                                French Polynesia
                                            </option>
                                            <option value="TF">
                                                French Southern Territories
                                            </option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">
                                                Gibraltar
                                            </option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">
                                                Greenland
                                            </option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">
                                                Guadeloupe
                                            </option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">
                                                Guatemala
                                            </option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">
                                                Guinea-Bissau
                                            </option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">
                                                Heard Island and McDonald
                                                Islands
                                            </option>
                                            <option value="VA">
                                                Holy See (Vatican City State)
                                            </option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">
                                                Hong Kong
                                            </option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">
                                                Indonesia
                                            </option>
                                            <option value="IR">
                                                Iran, Islamic Republic of
                                            </option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">
                                                Isle of Man
                                            </option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">
                                                Kazakhstan
                                            </option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">
                                                Korea, Democratic People's
                                                Republic of
                                            </option>
                                            <option value="KR">
                                                Korea, Republic of
                                            </option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">
                                                Kyrgyzstan
                                            </option>
                                            <option value="LA">
                                                Lao People's Democratic Republic
                                            </option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libya</option>
                                            <option value="LI">
                                                Liechtenstein
                                            </option>
                                            <option value="LT">
                                                Lithuania
                                            </option>
                                            <option value="LU">
                                                Luxembourg
                                            </option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">
                                                Macedonia, the former Yugoslav
                                                Republic of
                                            </option>
                                            <option value="MG">
                                                Madagascar
                                            </option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">
                                                Marshall Islands
                                            </option>
                                            <option value="MQ">
                                                Martinique
                                            </option>
                                            <option value="MR">
                                                Mauritania
                                            </option>
                                            <option value="MU">
                                                Mauritius
                                            </option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">
                                                Micronesia, Federated States of
                                            </option>
                                            <option value="MD">
                                                Moldova, Republic of
                                            </option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">
                                                Montenegro
                                            </option>
                                            <option value="MS">
                                                Montserrat
                                            </option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">
                                                Mozambique
                                            </option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">
                                                Netherlands
                                            </option>
                                            <option value="NC">
                                                New Caledonia
                                            </option>
                                            <option value="NZ">
                                                New Zealand
                                            </option>
                                            <option value="NI">
                                                Nicaragua
                                            </option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">
                                                Norfolk Island
                                            </option>
                                            <option value="MP">
                                                Northern Mariana Islands
                                            </option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">
                                                Palestinian Territory, Occupied
                                            </option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">
                                                Papua New Guinea
                                            </option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">
                                                Philippines
                                            </option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">
                                                Puerto Rico
                                            </option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Réunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">
                                                Russian Federation
                                            </option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">
                                                Saint Barthélemy
                                            </option>
                                            <option value="SH">
                                                Saint Helena, Ascension and
                                                Tristan da Cunha
                                            </option>
                                            <option value="KN">
                                                Saint Kitts and Nevis
                                            </option>
                                            <option value="LC">
                                                Saint Lucia
                                            </option>
                                            <option value="MF">
                                                Saint Martin (French part)
                                            </option>
                                            <option value="PM">
                                                Saint Pierre and Miquelon
                                            </option>
                                            <option value="VC">
                                                Saint Vincent and the Grenadines
                                            </option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">
                                                San Marino
                                            </option>
                                            <option value="ST">
                                                Sao Tome and Principe
                                            </option>
                                            <option value="SA">
                                                Saudi Arabia
                                            </option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SC">
                                                Seychelles
                                            </option>
                                            <option value="SL">
                                                Sierra Leone
                                            </option>
                                            <option value="SG">
                                                Singapore
                                            </option>
                                            <option value="SX">
                                                Sint Maarten (Dutch part)
                                            </option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">
                                                Solomon Islands
                                            </option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">
                                                South Africa
                                            </option>
                                            <option value="GS">
                                                South Georgia and the South
                                                Sandwich Islands
                                            </option>
                                            <option value="SS">
                                                South Sudan
                                            </option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">
                                                Sri Lanka
                                            </option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">
                                                Svalbard and Jan Mayen
                                            </option>
                                            <option value="SZ">
                                                Swaziland
                                            </option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">
                                                Switzerland
                                            </option>
                                            <option value="SY">
                                                Syrian Arab Republic
                                            </option>
                                            <option value="TW">
                                                Taiwan, Province of China
                                            </option>
                                            <option value="TJ">
                                                Tajikistan
                                            </option>
                                            <option value="TZ">
                                                Tanzania, United Republic of
                                            </option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">
                                                Timor-Leste
                                            </option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">
                                                Trinidad and Tobago
                                            </option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">
                                                Turkmenistan
                                            </option>
                                            <option value="TC">
                                                Turks and Caicos Islands
                                            </option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">
                                                United Arab Emirates
                                            </option>
                                            <option value="GB">
                                                United Kingdom
                                            </option>
                                            <option value="US">
                                                United States
                                            </option>
                                            <option value="UM">
                                                United States Minor Outlying
                                                Islands
                                            </option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">
                                                Uzbekistan
                                            </option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">
                                                Venezuela, Bolivarian Republic
                                                of
                                            </option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">
                                                Virgin Islands, British
                                            </option>
                                            <option value="VI">
                                                Virgin Islands, U.S.
                                            </option>
                                            <option value="WF">
                                                Wallis and Futuna
                                            </option>
                                            <option value="EH">
                                                Western Sahara
                                            </option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="validationCustom03"
                                            class="form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Address:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="validationCustom03"
                                            value="Address"
                                            required=""
                                            name="address"
                                        />
                                        <div class="invalid-feedback">
                                            Please Enter Address
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-lg-3 gy-2 mb-3 mt-3">
                                <div class="col-3 d-lg-block d-none"></div>
                                <div class="col-lg-2">
                                    <label for="">City</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="city"
                                        required=""
                                        value="City"
                                    />
                                </div>
                                <div class="col-lg-2">
                                    <label for="">State</label>
                                    <input
                                        type="text"
                                        class="form-control state"
                                        name="state"
                                        required=""
                                        value="State"
                                    />
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Zip Code</label>
                                    <input
                                        type="text"
                                        class="form-control zipCode"
                                        name="zip"
                                        required=""
                                        value="44000"
                                        min="5"
                                        max="5"
                                        maxlength="5"
                                    />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="inputPassword6"
                                            class="col-form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Birth Date:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <input
                                            type="date"
                                            class="form-control"
                                            name="dob"
                                            placeholder="MM/DD/YYYY"
                                            value="1992-02-15"
                                            required=""
                                        />
                                        <div class="invalid-feedback">
                                            Please Select Birthday
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="inputPassword6"
                                            class="col-form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            Phone Number:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <select
                                                    class="form-control cc"
                                                    name="cc"
                                                    required=""
                                                    data-control="select2"
                                                >
                                                    <option
                                                        data-countrycode="GB"
                                                        value="+44"
                                                    >
                                                        UK (+44)
                                                    </option>
                                                    <option
                                                        data-countrycode="US"
                                                        value="+1"
                                                        selected=""
                                                    >
                                                        USA (+1)
                                                    </option>
                                                    <optgroup
                                                        label="Other countries"
                                                    >
                                                        <option
                                                            data-countrycode="DZ"
                                                            value="+213"
                                                        >
                                                            Algeria (+213)
                                                        </option>
                                                        <option
                                                            data-countrycode="AD"
                                                            value="+376"
                                                        >
                                                            Andorra (+376)
                                                        </option>
                                                        <option
                                                            data-countrycode="AO"
                                                            value="+244"
                                                        >
                                                            Angola (+244)
                                                        </option>
                                                        <option
                                                            data-countrycode="AI"
                                                            value="+1264"
                                                        >
                                                            Anguilla (+1264)
                                                        </option>
                                                        <option
                                                            data-countrycode="AG"
                                                            value="+1268"
                                                        >
                                                            Antigua &amp;
                                                            Barbuda (+1268)
                                                        </option>
                                                        <option
                                                            data-countrycode="AR"
                                                            value="+54"
                                                        >
                                                            Argentina (+54)
                                                        </option>
                                                        <option
                                                            data-countrycode="AM"
                                                            value="+374"
                                                        >
                                                            Armenia (+374)
                                                        </option>
                                                        <option
                                                            data-countrycode="AW"
                                                            value="+297"
                                                        >
                                                            Aruba (+297)
                                                        </option>
                                                        <option
                                                            data-countrycode="AU"
                                                            value="+61"
                                                        >
                                                            Australia (+61)
                                                        </option>
                                                        <option
                                                            data-countrycode="AT"
                                                            value="+43"
                                                        >
                                                            Austria (+43)
                                                        </option>
                                                        <option
                                                            data-countrycode="AZ"
                                                            value="+994"
                                                        >
                                                            Azerbaijan (+994)
                                                        </option>
                                                        <option
                                                            data-countrycode="BS"
                                                            value="+1242"
                                                        >
                                                            Bahamas (+1242)
                                                        </option>
                                                        <option
                                                            data-countrycode="BH"
                                                            value="+973"
                                                        >
                                                            Bahrain (+973)
                                                        </option>
                                                        <option
                                                            data-countrycode="BD"
                                                            value="+880"
                                                        >
                                                            Bangladesh (+880)
                                                        </option>
                                                        <option
                                                            data-countrycode="BB"
                                                            value="+1246"
                                                        >
                                                            Barbados (+1246)
                                                        </option>
                                                        <option
                                                            data-countrycode="BY"
                                                            value="+375"
                                                        >
                                                            Belarus (+375)
                                                        </option>
                                                        <option
                                                            data-countrycode="BE"
                                                            value="+32"
                                                        >
                                                            Belgium (+32)
                                                        </option>
                                                        <option
                                                            data-countrycode="BZ"
                                                            value="+501"
                                                        >
                                                            Belize (+501)
                                                        </option>
                                                        <option
                                                            data-countrycode="BJ"
                                                            value="+229"
                                                        >
                                                            Benin (+229)
                                                        </option>
                                                        <option
                                                            data-countrycode="BM"
                                                            value="+1441"
                                                        >
                                                            Bermuda (+1441)
                                                        </option>
                                                        <option
                                                            data-countrycode="BT"
                                                            value="+975"
                                                        >
                                                            Bhutan (+975)
                                                        </option>
                                                        <option
                                                            data-countrycode="BO"
                                                            value="+591"
                                                        >
                                                            Bolivia (+591)
                                                        </option>
                                                        <option
                                                            data-countrycode="BA"
                                                            value="+387"
                                                        >
                                                            Bosnia Herzegovina
                                                            (+387)
                                                        </option>
                                                        <option
                                                            data-countrycode="BW"
                                                            value="+267"
                                                        >
                                                            Botswana (+267)
                                                        </option>
                                                        <option
                                                            data-countrycode="BR"
                                                            value="+55"
                                                        >
                                                            Brazil (+55)
                                                        </option>
                                                        <option
                                                            data-countrycode="BN"
                                                            value="+673"
                                                        >
                                                            Brunei (+673)
                                                        </option>
                                                        <option
                                                            data-countrycode="BG"
                                                            value="+359"
                                                        >
                                                            Bulgaria (+359)
                                                        </option>
                                                        <option
                                                            data-countrycode="BF"
                                                            value="+226"
                                                        >
                                                            Burkina Faso (+226)
                                                        </option>
                                                        <option
                                                            data-countrycode="BI"
                                                            value="+257"
                                                        >
                                                            Burundi (+257)
                                                        </option>
                                                        <option
                                                            data-countrycode="KH"
                                                            value="+855"
                                                        >
                                                            Cambodia (+855)
                                                        </option>
                                                        <option
                                                            data-countrycode="CM"
                                                            value="+237"
                                                        >
                                                            Cameroon (+237)
                                                        </option>
                                                        <option
                                                            data-countrycode="CA"
                                                            value="+1"
                                                        >
                                                            Canada (+1)
                                                        </option>
                                                        <option
                                                            data-countrycode="CV"
                                                            value="+238"
                                                        >
                                                            Cape Verde Islands
                                                            (+238)
                                                        </option>
                                                        <option
                                                            data-countrycode="KY"
                                                            value="+1345"
                                                        >
                                                            Cayman Islands
                                                            (+1345)
                                                        </option>
                                                        <option
                                                            data-countrycode="CF"
                                                            value="+236"
                                                        >
                                                            Central African
                                                            Republic (+236)
                                                        </option>
                                                        <option
                                                            data-countrycode="CL"
                                                            value="+56"
                                                        >
                                                            Chile (+56)
                                                        </option>
                                                        <option
                                                            data-countrycode="CN"
                                                            value="+86"
                                                        >
                                                            China (+86)
                                                        </option>
                                                        <option
                                                            data-countrycode="CO"
                                                            value="+57"
                                                        >
                                                            Colombia (+57)
                                                        </option>
                                                        <option
                                                            data-countrycode="KM"
                                                            value="+269"
                                                        >
                                                            Comoros (+269)
                                                        </option>
                                                        <option
                                                            data-countrycode="CG"
                                                            value="+242"
                                                        >
                                                            Congo (+242)
                                                        </option>
                                                        <option
                                                            data-countrycode="CK"
                                                            value="+682"
                                                        >
                                                            Cook Islands (+682)
                                                        </option>
                                                        <option
                                                            data-countrycode="CR"
                                                            value="+506"
                                                        >
                                                            Costa Rica (+506)
                                                        </option>
                                                        <option
                                                            data-countrycode="HR"
                                                            value="+385"
                                                        >
                                                            Croatia (+385)
                                                        </option>
                                                        <option
                                                            data-countrycode="CU"
                                                            value="+53"
                                                        >
                                                            Cuba (+53)
                                                        </option>
                                                        <option
                                                            data-countrycode="CY"
                                                            value="+90392"
                                                        >
                                                            Cyprus North
                                                            (+90392)
                                                        </option>
                                                        <option
                                                            data-countrycode="CY"
                                                            value="+357"
                                                        >
                                                            Cyprus South (+357)
                                                        </option>
                                                        <option
                                                            data-countrycode="CZ"
                                                            value="+42"
                                                        >
                                                            Czech Republic (+42)
                                                        </option>
                                                        <option
                                                            data-countrycode="DK"
                                                            value="+45"
                                                        >
                                                            Denmark (+45)
                                                        </option>
                                                        <option
                                                            data-countrycode="DJ"
                                                            value="+253"
                                                        >
                                                            Djibouti (+253)
                                                        </option>
                                                        <option
                                                            data-countrycode="DM"
                                                            value="+1809"
                                                        >
                                                            Dominica (+1809)
                                                        </option>
                                                        <option
                                                            data-countrycode="DO"
                                                            value="+1809"
                                                        >
                                                            Dominican Republic
                                                            (+1809)
                                                        </option>
                                                        <option
                                                            data-countrycode="EC"
                                                            value="+593"
                                                        >
                                                            Ecuador (+593)
                                                        </option>
                                                        <option
                                                            data-countrycode="EG"
                                                            value="+20"
                                                        >
                                                            Egypt (+20)
                                                        </option>
                                                        <option
                                                            data-countrycode="SV"
                                                            value="+503"
                                                        >
                                                            El Salvador (+503)
                                                        </option>
                                                        <option
                                                            data-countrycode="GQ"
                                                            value="+240"
                                                        >
                                                            Equatorial Guinea
                                                            (+240)
                                                        </option>
                                                        <option
                                                            data-countrycode="ER"
                                                            value="+291"
                                                        >
                                                            Eritrea (+291)
                                                        </option>
                                                        <option
                                                            data-countrycode="EE"
                                                            value="+372"
                                                        >
                                                            Estonia (+372)
                                                        </option>
                                                        <option
                                                            data-countrycode="ET"
                                                            value="+251"
                                                        >
                                                            Ethiopia (+251)
                                                        </option>
                                                        <option
                                                            data-countrycode="FK"
                                                            value="+500"
                                                        >
                                                            Falkland Islands
                                                            (+500)
                                                        </option>
                                                        <option
                                                            data-countrycode="FO"
                                                            value="+298"
                                                        >
                                                            Faroe Islands (+298)
                                                        </option>
                                                        <option
                                                            data-countrycode="FJ"
                                                            value="+679"
                                                        >
                                                            Fiji (+679)
                                                        </option>
                                                        <option
                                                            data-countrycode="FI"
                                                            value="+358"
                                                        >
                                                            Finland (+358)
                                                        </option>
                                                        <option
                                                            data-countrycode="FR"
                                                            value="+33"
                                                        >
                                                            France (+33)
                                                        </option>
                                                        <option
                                                            data-countrycode="GF"
                                                            value="+594"
                                                        >
                                                            French Guiana (+594)
                                                        </option>
                                                        <option
                                                            data-countrycode="PF"
                                                            value="+689"
                                                        >
                                                            French Polynesia
                                                            (+689)
                                                        </option>
                                                        <option
                                                            data-countrycode="GA"
                                                            value="+241"
                                                        >
                                                            Gabon (+241)
                                                        </option>
                                                        <option
                                                            data-countrycode="GM"
                                                            value="+220"
                                                        >
                                                            Gambia (+220)
                                                        </option>
                                                        <option
                                                            data-countrycode="GE"
                                                            value="+7880"
                                                        >
                                                            Georgia (+7880)
                                                        </option>
                                                        <option
                                                            data-countrycode="DE"
                                                            value="+49"
                                                        >
                                                            Germany (+49)
                                                        </option>
                                                        <option
                                                            data-countrycode="GH"
                                                            value="+233"
                                                        >
                                                            Ghana (+233)
                                                        </option>
                                                        <option
                                                            data-countrycode="GI"
                                                            value="+350"
                                                        >
                                                            Gibraltar (+350)
                                                        </option>
                                                        <option
                                                            data-countrycode="GR"
                                                            value="+30"
                                                        >
                                                            Greece (+30)
                                                        </option>
                                                        <option
                                                            data-countrycode="GL"
                                                            value="+299"
                                                        >
                                                            Greenland (+299)
                                                        </option>
                                                        <option
                                                            data-countrycode="GD"
                                                            value="+1473"
                                                        >
                                                            Grenada (+1473)
                                                        </option>
                                                        <option
                                                            data-countrycode="GP"
                                                            value="+590"
                                                        >
                                                            Guadeloupe (+590)
                                                        </option>
                                                        <option
                                                            data-countrycode="GU"
                                                            value="+671"
                                                        >
                                                            Guam (+671)
                                                        </option>
                                                        <option
                                                            data-countrycode="GT"
                                                            value="+502"
                                                        >
                                                            Guatemala (+502)
                                                        </option>
                                                        <option
                                                            data-countrycode="GN"
                                                            value="+224"
                                                        >
                                                            Guinea (+224)
                                                        </option>
                                                        <option
                                                            data-countrycode="GW"
                                                            value="+245"
                                                        >
                                                            Guinea - Bissau
                                                            (+245)
                                                        </option>
                                                        <option
                                                            data-countrycode="GY"
                                                            value="+592"
                                                        >
                                                            Guyana (+592)
                                                        </option>
                                                        <option
                                                            data-countrycode="HT"
                                                            value="+509"
                                                        >
                                                            Haiti (+509)
                                                        </option>
                                                        <option
                                                            data-countrycode="HN"
                                                            value="+504"
                                                        >
                                                            Honduras (+504)
                                                        </option>
                                                        <option
                                                            data-countrycode="HK"
                                                            value="+852"
                                                        >
                                                            Hong Kong (+852)
                                                        </option>
                                                        <option
                                                            data-countrycode="HU"
                                                            value="+36"
                                                        >
                                                            Hungary (+36)
                                                        </option>
                                                        <option
                                                            data-countrycode="IS"
                                                            value="+354"
                                                        >
                                                            Iceland (+354)
                                                        </option>
                                                        <option
                                                            data-countrycode="IN"
                                                            value="+91"
                                                        >
                                                            India (+91)
                                                        </option>
                                                        <option
                                                            data-countrycode="PK"
                                                            value="+92"
                                                        >
                                                            Pakistan (+92)
                                                        </option>
                                                        <option
                                                            data-countrycode="ID"
                                                            value="+62"
                                                        >
                                                            Indonesia (+62)
                                                        </option>
                                                        <option
                                                            data-countrycode="IR"
                                                            value="+98"
                                                        >
                                                            Iran (+98)
                                                        </option>
                                                        <option
                                                            data-countrycode="IQ"
                                                            value="+964"
                                                        >
                                                            Iraq (+964)
                                                        </option>
                                                        <option
                                                            data-countrycode="IE"
                                                            value="+353"
                                                        >
                                                            Ireland (+353)
                                                        </option>
                                                        <option
                                                            data-countrycode="IL"
                                                            value="+972"
                                                        >
                                                            Israel (+972)
                                                        </option>
                                                        <option
                                                            data-countrycode="IT"
                                                            value="+39"
                                                        >
                                                            Italy (+39)
                                                        </option>
                                                        <option
                                                            data-countrycode="JM"
                                                            value="+1876"
                                                        >
                                                            Jamaica (+1876)
                                                        </option>
                                                        <option
                                                            data-countrycode="JP"
                                                            value="+81"
                                                        >
                                                            Japan (+81)
                                                        </option>
                                                        <option
                                                            data-countrycode="JO"
                                                            value="+962"
                                                        >
                                                            Jordan (+962)
                                                        </option>
                                                        <option
                                                            data-countrycode="KZ"
                                                            value="+7"
                                                        >
                                                            Kazakhstan (+7)
                                                        </option>
                                                        <option
                                                            data-countrycode="KE"
                                                            value="+254"
                                                        >
                                                            Kenya (+254)
                                                        </option>
                                                        <option
                                                            data-countrycode="KI"
                                                            value="+686"
                                                        >
                                                            Kiribati (+686)
                                                        </option>
                                                        <option
                                                            data-countrycode="KP"
                                                            value="+850"
                                                        >
                                                            Korea North (+850)
                                                        </option>
                                                        <option
                                                            data-countrycode="KR"
                                                            value="+82"
                                                        >
                                                            Korea South (+82)
                                                        </option>
                                                        <option
                                                            data-countrycode="KW"
                                                            value="+965"
                                                        >
                                                            Kuwait (+965)
                                                        </option>
                                                        <option
                                                            data-countrycode="KG"
                                                            value="+996"
                                                        >
                                                            Kyrgyzstan (+996)
                                                        </option>
                                                        <option
                                                            data-countrycode="LA"
                                                            value="+856"
                                                        >
                                                            Laos (+856)
                                                        </option>
                                                        <option
                                                            data-countrycode="LV"
                                                            value="+371"
                                                        >
                                                            Latvia (+371)
                                                        </option>
                                                        <option
                                                            data-countrycode="LB"
                                                            value="+961"
                                                        >
                                                            Lebanon (+961)
                                                        </option>
                                                        <option
                                                            data-countrycode="LS"
                                                            value="+266"
                                                        >
                                                            Lesotho (+266)
                                                        </option>
                                                        <option
                                                            data-countrycode="LR"
                                                            value="+231"
                                                        >
                                                            Liberia (+231)
                                                        </option>
                                                        <option
                                                            data-countrycode="LY"
                                                            value="+218"
                                                        >
                                                            Libya (+218)
                                                        </option>
                                                        <option
                                                            data-countrycode="LI"
                                                            value="+417"
                                                        >
                                                            Liechtenstein (+417)
                                                        </option>
                                                        <option
                                                            data-countrycode="LT"
                                                            value="+370"
                                                        >
                                                            Lithuania (+370)
                                                        </option>
                                                        <option
                                                            data-countrycode="LU"
                                                            value="+352"
                                                        >
                                                            Luxembourg (+352)
                                                        </option>
                                                        <option
                                                            data-countrycode="MO"
                                                            value="+853"
                                                        >
                                                            Macao (+853)
                                                        </option>
                                                        <option
                                                            data-countrycode="MK"
                                                            value="+389"
                                                        >
                                                            Macedonia (+389)
                                                        </option>
                                                        <option
                                                            data-countrycode="MG"
                                                            value="+261"
                                                        >
                                                            Madagascar (+261)
                                                        </option>
                                                        <option
                                                            data-countrycode="MW"
                                                            value="+265"
                                                        >
                                                            Malawi (+265)
                                                        </option>
                                                        <option
                                                            data-countrycode="MY"
                                                            value="+60"
                                                        >
                                                            Malaysia (+60)
                                                        </option>
                                                        <option
                                                            data-countrycode="MV"
                                                            value="+960"
                                                        >
                                                            Maldives (+960)
                                                        </option>
                                                        <option
                                                            data-countrycode="ML"
                                                            value="+223"
                                                        >
                                                            Mali (+223)
                                                        </option>
                                                        <option
                                                            data-countrycode="MT"
                                                            value="+356"
                                                        >
                                                            Malta (+356)
                                                        </option>
                                                        <option
                                                            data-countrycode="MH"
                                                            value="+692"
                                                        >
                                                            Marshall Islands
                                                            (+692)
                                                        </option>
                                                        <option
                                                            data-countrycode="MQ"
                                                            value="+596"
                                                        >
                                                            Martinique (+596)
                                                        </option>
                                                        <option
                                                            data-countrycode="MR"
                                                            value="+222"
                                                        >
                                                            Mauritania (+222)
                                                        </option>
                                                        <option
                                                            data-countrycode="YT"
                                                            value="+269"
                                                        >
                                                            Mayotte (+269)
                                                        </option>
                                                        <option
                                                            data-countrycode="MX"
                                                            value="+52"
                                                        >
                                                            Mexico (+52)
                                                        </option>
                                                        <option
                                                            data-countrycode="FM"
                                                            value="+691"
                                                        >
                                                            Micronesia (+691)
                                                        </option>
                                                        <option
                                                            data-countrycode="MD"
                                                            value="+373"
                                                        >
                                                            Moldova (+373)
                                                        </option>
                                                        <option
                                                            data-countrycode="MC"
                                                            value="+377"
                                                        >
                                                            Monaco (+377)
                                                        </option>
                                                        <option
                                                            data-countrycode="MN"
                                                            value="+976"
                                                        >
                                                            Mongolia (+976)
                                                        </option>
                                                        <option
                                                            data-countrycode="MS"
                                                            value="+1664"
                                                        >
                                                            Montserrat (+1664)
                                                        </option>
                                                        <option
                                                            data-countrycode="MA"
                                                            value="+212"
                                                        >
                                                            Morocco (+212)
                                                        </option>
                                                        <option
                                                            data-countrycode="MZ"
                                                            value="+258"
                                                        >
                                                            Mozambique (+258)
                                                        </option>
                                                        <option
                                                            data-countrycode="MN"
                                                            value="+95"
                                                        >
                                                            Myanmar (+95)
                                                        </option>
                                                        <option
                                                            data-countrycode="NA"
                                                            value="+264"
                                                        >
                                                            Namibia (+264)
                                                        </option>
                                                        <option
                                                            data-countrycode="NR"
                                                            value="+674"
                                                        >
                                                            Nauru (+674)
                                                        </option>
                                                        <option
                                                            data-countrycode="NP"
                                                            value="+977"
                                                        >
                                                            Nepal (+977)
                                                        </option>
                                                        <option
                                                            data-countrycode="NL"
                                                            value="+31"
                                                        >
                                                            Netherlands (+31)
                                                        </option>
                                                        <option
                                                            data-countrycode="NC"
                                                            value="+687"
                                                        >
                                                            New Caledonia (+687)
                                                        </option>
                                                        <option
                                                            data-countrycode="NZ"
                                                            value="+64"
                                                        >
                                                            New Zealand (+64)
                                                        </option>
                                                        <option
                                                            data-countrycode="NI"
                                                            value="+505"
                                                        >
                                                            Nicaragua (+505)
                                                        </option>
                                                        <option
                                                            data-countrycode="NE"
                                                            value="+227"
                                                        >
                                                            Niger (+227)
                                                        </option>
                                                        <option
                                                            data-countrycode="NG"
                                                            value="+234"
                                                        >
                                                            Nigeria (+234)
                                                        </option>
                                                        <option
                                                            data-countrycode="NU"
                                                            value="+683"
                                                        >
                                                            Niue (+683)
                                                        </option>
                                                        <option
                                                            data-countrycode="NF"
                                                            value="+672"
                                                        >
                                                            Norfolk Islands
                                                            (+672)
                                                        </option>
                                                        <option
                                                            data-countrycode="NP"
                                                            value="+670"
                                                        >
                                                            Northern Marianas
                                                            (+670)
                                                        </option>
                                                        <option
                                                            data-countrycode="NO"
                                                            value="+47"
                                                        >
                                                            Norway (+47)
                                                        </option>
                                                        <option
                                                            data-countrycode="OM"
                                                            value="+968"
                                                        >
                                                            Oman (+968)
                                                        </option>
                                                        <option
                                                            data-countrycode="PW"
                                                            value="+680"
                                                        >
                                                            Palau (+680)
                                                        </option>
                                                        <option
                                                            data-countrycode="PA"
                                                            value="+507"
                                                        >
                                                            Panama (+507)
                                                        </option>
                                                        <option
                                                            data-countrycode="PG"
                                                            value="+675"
                                                        >
                                                            Papua New Guinea
                                                            (+675)
                                                        </option>
                                                        <option
                                                            data-countrycode="PY"
                                                            value="+595"
                                                        >
                                                            Paraguay (+595)
                                                        </option>
                                                        <option
                                                            data-countrycode="PE"
                                                            value="+51"
                                                        >
                                                            Peru (+51)
                                                        </option>
                                                        <option
                                                            data-countrycode="PH"
                                                            value="+63"
                                                        >
                                                            Philippines (+63)
                                                        </option>
                                                        <option
                                                            data-countrycode="PL"
                                                            value="+48"
                                                        >
                                                            Poland (+48)
                                                        </option>
                                                        <option
                                                            data-countrycode="PT"
                                                            value="+351"
                                                        >
                                                            Portugal (+351)
                                                        </option>
                                                        <option
                                                            data-countrycode="PR"
                                                            value="+1787"
                                                        >
                                                            Puerto Rico (+1787)
                                                        </option>
                                                        <option
                                                            data-countrycode="QA"
                                                            value="+974"
                                                        >
                                                            Qatar (+974)
                                                        </option>
                                                        <option
                                                            data-countrycode="RE"
                                                            value="+262"
                                                        >
                                                            Reunion (+262)
                                                        </option>
                                                        <option
                                                            data-countrycode="RO"
                                                            value="+40"
                                                        >
                                                            Romania (+40)
                                                        </option>
                                                        <option
                                                            data-countrycode="RU"
                                                            value="+7"
                                                        >
                                                            Russia (+7)
                                                        </option>
                                                        <option
                                                            data-countrycode="RW"
                                                            value="+250"
                                                        >
                                                            Rwanda (+250)
                                                        </option>
                                                        <option
                                                            data-countrycode="SM"
                                                            value="+378"
                                                        >
                                                            San Marino (+378)
                                                        </option>
                                                        <option
                                                            data-countrycode="ST"
                                                            value="+239"
                                                        >
                                                            Sao Tome &amp;
                                                            Principe (+239)
                                                        </option>
                                                        <option
                                                            data-countrycode="SA"
                                                            value="+966"
                                                        >
                                                            Saudi Arabia (+966)
                                                        </option>
                                                        <option
                                                            data-countrycode="SN"
                                                            value="+221"
                                                        >
                                                            Senegal (+221)
                                                        </option>
                                                        <option
                                                            data-countrycode="CS"
                                                            value="+381"
                                                        >
                                                            Serbia (+381)
                                                        </option>
                                                        <option
                                                            data-countrycode="SC"
                                                            value="+248"
                                                        >
                                                            Seychelles (+248)
                                                        </option>
                                                        <option
                                                            data-countrycode="SL"
                                                            value="+232"
                                                        >
                                                            Sierra Leone (+232)
                                                        </option>
                                                        <option
                                                            data-countrycode="SG"
                                                            value="+65"
                                                        >
                                                            Singapore (+65)
                                                        </option>
                                                        <option
                                                            data-countrycode="SK"
                                                            value="+421"
                                                        >
                                                            Slovak Republic
                                                            (+421)
                                                        </option>
                                                        <option
                                                            data-countrycode="SI"
                                                            value="+386"
                                                        >
                                                            Slovenia (+386)
                                                        </option>
                                                        <option
                                                            data-countrycode="SB"
                                                            value="+677"
                                                        >
                                                            Solomon Islands
                                                            (+677)
                                                        </option>
                                                        <option
                                                            data-countrycode="SO"
                                                            value="+252"
                                                        >
                                                            Somalia (+252)
                                                        </option>
                                                        <option
                                                            data-countrycode="ZA"
                                                            value="+27"
                                                        >
                                                            South Africa (+27)
                                                        </option>
                                                        <option
                                                            data-countrycode="ES"
                                                            value="+34"
                                                        >
                                                            Spain (+34)
                                                        </option>
                                                        <option
                                                            data-countrycode="LK"
                                                            value="+94"
                                                        >
                                                            Sri Lanka (+94)
                                                        </option>
                                                        <option
                                                            data-countrycode="SH"
                                                            value="+290"
                                                        >
                                                            St. Helena (+290)
                                                        </option>
                                                        <option
                                                            data-countrycode="KN"
                                                            value="+1869"
                                                        >
                                                            St. Kitts (+1869)
                                                        </option>
                                                        <option
                                                            data-countrycode="SC"
                                                            value="+1758"
                                                        >
                                                            St. Lucia (+1758)
                                                        </option>
                                                        <option
                                                            data-countrycode="SD"
                                                            value="+249"
                                                        >
                                                            Sudan (+249)
                                                        </option>
                                                        <option
                                                            data-countrycode="SR"
                                                            value="+597"
                                                        >
                                                            Suriname (+597)
                                                        </option>
                                                        <option
                                                            data-countrycode="SZ"
                                                            value="+268"
                                                        >
                                                            Swaziland (+268)
                                                        </option>
                                                        <option
                                                            data-countrycode="SE"
                                                            value="+46"
                                                        >
                                                            Sweden (+46)
                                                        </option>
                                                        <option
                                                            data-countrycode="CH"
                                                            value="+41"
                                                        >
                                                            Switzerland (+41)
                                                        </option>
                                                        <option
                                                            data-countrycode="SI"
                                                            value="+963"
                                                        >
                                                            Syria (+963)
                                                        </option>
                                                        <option
                                                            data-countrycode="TW"
                                                            value="+886"
                                                        >
                                                            Taiwan (+886)
                                                        </option>
                                                        <option
                                                            data-countrycode="TJ"
                                                            value="+7"
                                                        >
                                                            Tajikstan (+7)
                                                        </option>
                                                        <option
                                                            data-countrycode="TH"
                                                            value="+66"
                                                        >
                                                            Thailand (+66)
                                                        </option>
                                                        <option
                                                            data-countrycode="TG"
                                                            value="+228"
                                                        >
                                                            Togo (+228)
                                                        </option>
                                                        <option
                                                            data-countrycode="TO"
                                                            value="+676"
                                                        >
                                                            Tonga (+676)
                                                        </option>
                                                        <option
                                                            data-countrycode="TT"
                                                            value="+1868"
                                                        >
                                                            Trinidad &amp;
                                                            Tobago (+1868)
                                                        </option>
                                                        <option
                                                            data-countrycode="TN"
                                                            value="+216"
                                                        >
                                                            Tunisia (+216)
                                                        </option>
                                                        <option
                                                            data-countrycode="TR"
                                                            value="+90"
                                                        >
                                                            Turkey (+90)
                                                        </option>
                                                        <option
                                                            data-countrycode="TM"
                                                            value="+7"
                                                        >
                                                            Turkmenistan (+7)
                                                        </option>
                                                        <option
                                                            data-countrycode="TM"
                                                            value="+993"
                                                        >
                                                            Turkmenistan (+993)
                                                        </option>
                                                        <option
                                                            data-countrycode="TC"
                                                            value="+1649"
                                                        >
                                                            Turks &amp; Caicos
                                                            Islands (+1649)
                                                        </option>
                                                        <option
                                                            data-countrycode="TV"
                                                            value="+688"
                                                        >
                                                            Tuvalu (+688)
                                                        </option>
                                                        <option
                                                            data-countrycode="UG"
                                                            value="+256"
                                                        >
                                                            Uganda (+256)
                                                        </option>
                                                        <!-- <option data-countryCode="GB" value="+44">UK (+44)</option> -->
                                                        <option
                                                            data-countrycode="UA"
                                                            value="+380"
                                                        >
                                                            Ukraine (+380)
                                                        </option>
                                                        <option
                                                            data-countrycode="AE"
                                                            value="+971"
                                                        >
                                                            United Arab Emirates
                                                            (+971)
                                                        </option>
                                                        <option
                                                            data-countrycode="UY"
                                                            value="+598"
                                                        >
                                                            Uruguay (+598)
                                                        </option>
                                                        <!-- <option data-countryCode="US" value="+1">USA (+1)</option> -->
                                                        <option
                                                            data-countrycode="UZ"
                                                            value="+7"
                                                        >
                                                            Uzbekistan (+7)
                                                        </option>
                                                        <option
                                                            data-countrycode="VU"
                                                            value="+678"
                                                        >
                                                            Vanuatu (+678)
                                                        </option>
                                                        <option
                                                            data-countrycode="VA"
                                                            value="+379"
                                                        >
                                                            Vatican City (+379)
                                                        </option>
                                                        <option
                                                            data-countrycode="VE"
                                                            value="+58"
                                                        >
                                                            Venezuela (+58)
                                                        </option>
                                                        <option
                                                            data-countrycode="VN"
                                                            value="+84"
                                                        >
                                                            Vietnam (+84)
                                                        </option>
                                                        <option
                                                            data-countrycode="VG"
                                                            value="+84"
                                                        >
                                                            Virgin Islands -
                                                            British (+1284)
                                                        </option>
                                                        <option
                                                            data-countrycode="VI"
                                                            value="+84"
                                                        >
                                                            Virgin Islands - US
                                                            (+1340)
                                                        </option>
                                                        <option
                                                            data-countrycode="WF"
                                                            value="+681"
                                                        >
                                                            Wallis &amp; Futuna
                                                            (+681)
                                                        </option>
                                                        <option
                                                            data-countrycode="YE"
                                                            value="+969"
                                                        >
                                                            Yemen (North)(+969)
                                                        </option>
                                                        <option
                                                            data-countrycode="YE"
                                                            value="+967"
                                                        >
                                                            Yemen (South)(+967)
                                                        </option>
                                                        <option
                                                            data-countrycode="ZM"
                                                            value="+260"
                                                        >
                                                            Zambia (+260)
                                                        </option>
                                                        <option
                                                            data-countrycode="ZW"
                                                            value="+263"
                                                        >
                                                            Zimbabwe (+263)
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-lg-8">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="phone"
                                                    required=""
                                                    id="phone_number"
                                                    value="-231-232-1111"
                                                    maxlength="13"
                                                />
                                                <code>-999-999-9999</code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ssn_number_container d-none">
                                <div class="row mt-3">
                                    <div class="col-lg-3">
                                        <label
                                            for="ssn-number"
                                            class="col-form-label"
                                            ><span class="text-danger fs-4"
                                                >*</span
                                            >
                                            SSN:</label
                                        >
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <input
                                                class="form-control"
                                                name="primary_contact_social_security"
                                                type="password"
                                                value="999-99-9999"
                                                readonly=""
                                                id="primary_contact_social_security"
                                                maxlength="11"
                                            />

                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-secondary no-radius"
                                                    id="show_ssn_field"
                                                    type="button"
                                                >
                                                    x
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="document_upload_container">
                                <div class="col-md-12">
                                    <div class="row mt-3">
                                        <div class="col-lg-3">
                                            <label
                                                for="ssn-number"
                                                class="col-form-label"
                                                ><span class="text-danger fs-4"
                                                    >*</span
                                                >
                                                Document Type:</label
                                            >
                                        </div>
                                        <div class="col-lg-9">
                                            <select
                                                class="form-select doc_type"
                                                data-control="select2"
                                                data-placeholder="Select Document Type"
                                                required=""
                                                name="doc_type"
                                            >
                                                <option value="license">
                                                    License
                                                </option>
                                                <option
                                                    value="identificationCard"
                                                >
                                                    Identification Card
                                                </option>
                                                <option value="passport">
                                                    Passport
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div
                                        class="notice -dark rounded border-dark border border-dashed p-6 text-center mb-12 change_photo_wrapper"
                                    >
                                        <div
                                            class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column change_photo_wrapper"
                                        >
                                            <div class="col-lg-12 mb-5">
                                                <a
                                                    href=""
                                                    download=""
                                                    title="Download Document File"
                                                >
                                                    <i
                                                        class="la la-download"
                                                    ></i>
                                                </a>
                                            </div>
                                            <button
                                                type="button"
                                                class="kyc_document_upload_btn btn btn-sm btn-dark-primary btn-square mb-1"
                                            >
                                                <i class="fa fa-upload"></i>
                                                Upload Document
                                            </button>
                                            <input
                                                type="file"
                                                name="kyc_document"
                                                class="new_profile_photo d-none change_photo"
                                                data-type="project_logo"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="col-12 text-center run_process_button mb-3"
                            >
                                <button
                                    class="btn btn-outline-dark mt-3 px-4 mt-lg-4 rounded-pill fw-semibold submit_button"
                                    type="submit"
                                >
                                    Run KYC
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="payment_widget"
            tabindex="-1"
            aria-hidden="true"
            data-bs-backdrop="static"
        >
            <div class="modal-dialog mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <h5 class="modal-title">ACH Payment</h5>
                        <button
                            type="button"
                            class="close btn-sm btn-info closeAchPopup"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-5 pb-15">
                        <div class="text-center loader_image">
                            <img
                                src="https://development.investchainraise.io/assets/media/spinner.svg"
                                alt=""
                            />
                        </div>
                        <div id="load_widget"></div>
                        <input
                            type="hidden"
                            name="user_guid"
                            id="user_guid"
                            required=""
                        />

                        <div class="tab-pane fade show active p-2 text-center">
                            <button
                                type="button"
                                data-bs-dismiss="modal"
                                disabled=""
                                class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill continue_investment_button"
                            >
                                Continue Investment
                            </button>
                        </div>
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
        </div>
        <div
            class="modal fade"
            id="payment_wire"
            tabindex="-1"
            aria-hidden="true"
            data-bs-backdrop="static"
        >
            <div class="modal-dialog mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-5 pb-15">
                        <div class="text-center loader_image">
                            <img
                                src="https://development.investchainraise.io/assets/media/spinner.svg"
                                alt=""
                            />
                        </div>
                        <div class="row" id="account_details"></div>
                        <div class="tab-pane fade show active p-2 text-center">
                            <button
                                type="button"
                                data-bs-dismiss="modal"
                                disabled=""
                                class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill continue_investment_button"
                            >
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
</template>
<script>
export default {
    data() {
        return {
            listing: "",
        };
    },
    props: {
        offer: Object,
    },
};
</script>
