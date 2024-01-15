<div class="col-lg-3 pt-4">
    <div class="row">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-sm btn-dark no-radius" id="submit_offer"> SAVE CHANGES</button>
        </div>
    </div>
    <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
        <div class="w-100 mb-3">
            <div class="d-flex align-items-center mb-5" data-toggle="collapse" data-target="#basic_info">
                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3 fw-bold fs-6 text-gray-800"> Basic Info
                </span>
                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                <span class="svg-icon svg-icon-1 svg-icon-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                            fill="currentColor"></rect>
                        <path
                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <div id="basic_info" class="collapse mb-3">
                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12 ">
                        <select name="issuer" id="issuer_account" class="form-select form-select-lg" required>
                            <option value="" selected disabled> Select Issuer Account </option>
                            @if(Auth::user()->hasRole('issuer'))
                                <option value="{{ Auth::user()->id }}"> {{ Auth::user()->name }} </option>
                            @else
                                @foreach ($issuers as $issuer)
                                    <option value="{{ $issuer->id }}"> {{ $issuer->name }}  | {{ $issuer->email }} </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="offer_name" placeholder="Offer Name *"
                            id="offer_name" required>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="slug" placeholder="Slug" id="offer_slug"
                            readonly required>
                    </div>
                </div>

                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="short_description" id="short_description"
                            placeholder="Short Description (Optional)">
                    </div>

                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="terms"  id="terms" placeholder="Offer Terms">
                    </div>

                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <select name="offer_type" aria-label="Offer Tags (filters assets in marketplace)"
                                data-control="select2" data-placeholder="Offer Tags (filters assets in marketplace)"
                                class="form-select form-select-lg offer_type" id="offer_tags">
                                <option value="Reg CF"> Reg CF </option>
                                <option value="Reg A"> Reg A </option>
                                <option value="Reg D (506a)"> Reg D (506a) </option>
                                <option value=" Reg D (506b)"> Reg D (506b) </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <select name="status" aria-label="Offer Status" data-control="select2"
                                data-placeholder="Offer Status" class="form-select form-select-lg" id="status">
                                <option value="active"> Active </option>
                                <option value="coming-soon"> Coming Soon </option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12">
                        <select name="security_type" aria-label="Security Type (Optional)" data-control="select2"
                            data-placeholder="Security Type (Optional)" class="form-select form-select-lg"
                            id="security_type">
                            <option value="" selected disabled> Security Type (Optional) </option>
                            <option value="Equity"> Equity </option>
                            <option value="SAFE"> SAFE </option>
                            <option value="Structure-SAFE"> Structure -SAFE </option>
                            <option value="revenue share"> Revenue Share </option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <input type="number" class="form-control d-none" name="safe"  placeholder="SAFE">
                    </div>
                    <div class="col-lg-12">
                        <input type="number" class="form-control d-none" name="structure_safe"  placeholder="Structure-SAFE">
                    </div>
                    <div class="col-lg-12 d-none">
                        <input type="text" class="form-control" name="symbol" id="symbol" placeholder="Offer Symbol *" value="o">
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12">
                        <select name="offer_tags " aria-label="Offer Tags (filters assets in marketplace)"
                            data-control="select2" multiple
                            data-placeholder="Offer Tags (filters assets in marketplace)"
                            class="form-select  form-select-lg" id="offer_tags">
                            <option value="Blockchain"> Blockchain </option>
                            <option value="360 Sportsx"> 360 Sportsx </option>
                            <option value="CR"> CR </option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <input type="number" class="form-control" name="size" id="offer_size"
                            placeholder="Enter Amount" required>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">

                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="size_label" id="size_label"
                            placeholder="Offer Size Label (default: offering size)">
                    </div>

                    <div class="col-lg-12">
                        <select name="base_currency" id="base_currency" class="form-select  form-select-md" required>
                            <option value="USD">USD</option>
                            <option value="GBP">GBP</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <input type="number" class="form-control" name="price_per_unit"
                            placeholder="Price per share/unit (if applicable)?">
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" name="share_unit_label"
                            placeholder="Share/Unit Label (default: shares)">
                    </div>


                </div>
                <div class="row row-cols-2 row-cols-md-4 g-5 mb-8">
                    <div class="col-lg-12">
                        <label for=""> Commencement Date </label>
                        <div class="position-relative d-flex">
                            <input type="datetime-local" class="form-control " placeholder="Commencement Date?" required
                                name="commencement_date" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label for=""> Funding end date</label>
                        <div class="position-relative d-flex">
                            <input type="datetime-local" class="form-control " placeholder="Funding end date?" required
                                name="funding_end_date" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 mb-3">
            <div class="d-flex align-items-center mb-5" data-toggle="collapse" data-target="#investor_flow ">
                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3"> Investor Flow </span>
                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                <span class="svg-icon svg-icon-1 svg-icon-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20"
                            rx="10" fill="currentColor"></rect>
                        <path
                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
            </div>
            <div id="investor_flow" class="collapse mb-3">
                <div class="row">
                    <div class="col-lg-12  text-center mb-3">
                        <div class="overflow-auto" data-toggle="collapse" data-target="#investment_steps">
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded p-3 bg-white">
                                Investment Steps
                            </div>
                        </div>
                        <div class="row collapse p-5" id="investment_steps">
                            <div class="col-lg-12 pt-3 mb-3 text-center">
                                {{-- <button type="button" class="btn-sm btn btn-lg btn-dark me-3"
                                    id="add_new_investment_step" style="width: 100%;border-radius:0"
                                    data-bs-toggle="modal" data-bs-target="#modal_investment_setup">
                                    Add An Investment Setup
                                </button> --}}

                                <button type="button" class="btn-sm btn btn-lg btn-dark me-3"
                                    id="" style="width: 100%;border-radius:0" >
                                    Add An Investment Setup
                                </button>
                            </div>
                            <div class="col-lg-12">
                                <div class="row investment_step_button_row">
                                    {{-- <div class="col-lg-12  text-center button_row_wrapper">
                                        <div class="overflow-auto pb-1">
                                            <div class="row d-flex align-items-center border border-dashed border-gray-300 rounded p-3 bg-white">
                                               <span class="col-lg-10 text-left"> Select Account Type  </span>
                                                <span class="col-lg-2"> <i class="la la-times"></i>  </span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="investment_setups[]" value="Select Account Type">
                                    </div>
                                    <div class="col-lg-12  text-center button_row_wrapper">
                                        <div class="overflow-auto pb-1">
                                            <div  class="row d-flex align-items-center border border-dashed border-gray-300 rounded p-3 bg-white">
                                               <span class="col-lg-10 text-left"> Complete Account Form   </span>
                                                <span class="col-lg-2"> <i class="la la-times"></i>  </span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="investment_setups[]" value="Complete Account Form">
                                    </div>  --}}

                                    <div class="col-lg-12   button_row_wrapper">
                                        <table class="table">
                                            <tr>
                                                <th style="text-align: left">
                                                    Income Verification (Reg CF)
                                                </th>
                                            </tr>
                                            <tr>

                                                <th  style="text-align: left">
                                                    Educational Materials
                                                </th>
                                            </tr>

                                            <tr>
                                                <th  style="text-align: left">
                                                    <input type="" name="url_educational_materials[]" value="https://www.google.com" class="mt-3 form-control no-radius"
                                                    style="height:33px;font-size:13px" required>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th  style="text-align: left">
                                                    Issuer Form C
                                                </th>
                                            </tr>
                                            <tr>
                                                <th  style="text-align: left">
                                                    <input type="" name="url_issuer_form_c[]"
                                                value="https://www.google.com" class="mt-3 form-control no-radius"
                                                style="height:33px;font-size:13px" required>
                                                </th>
                                            </tr>
                                            <input type="hidden" name="investment_setups[]" value="Educational Materials">
                                        </table>


                                        <table class="table">
                                            <tr>
                                                <th style="text-align: left">
                                                    E-Sign Document
                                                </th>
                                            </tr>
                                            <tr>
                                                <th  style="text-align: left">
                                                    Select Template
                                                </th>
                                            </tr>
                                            <tr>
                                                <th  style="text-align: left">
                                                    <select class="form-control" name="e_sign_template"
                                                style="height:42px;font-size:13px">
                                                @foreach ($templates as $template)
                                                    <option value="{{ $template['template_id'] }}">
                                                        {{ $template['template_name'] }} </option>
                                                @endforeach
                                            </select>
                                                </th>
                                            </tr>

                                            <input type="hidden" name="investment_setups[]" value="E-Sign Document">
                                        </table>


                                        <table class="table">
                                            <tr>
                                                <th style="text-align: left">
                                                    Payment Method
                                                </th>
                                            </tr>
                                            <tr>
                                                <th  style="text-align: left">
                                                    <input type="checkbox" name="investment_setups_payment_method[]" value="ach" checked />    ACH
                                                </th>
                                            </tr>
                                            <tr>
                                                <th  style="text-align: left">
                                                    <input type="checkbox" name="investment_setups_payment_method[]" value="wired"   /> Wired
                                                </th>
                                            </tr>

                                            <tr>
                                                <th  style="text-align: left">
                                                    <input type="checkbox" name="investment_setups_payment_method[]" value="credit-debit-card"   /> Credit/Debit Card
                                                </th>
                                            </tr>

                                            <input type="hidden" name="investment_setups[]" value="Payment Method">
                                        </table>



                                    </div>



                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12  text-center mb-3">
                        <div class="overflow-auto" data-toggle="collapse" data-target="#investment_restrictions">
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded p-3 bg-white">
                                Investment Restrictions
                            </div>
                        </div>
                        <div class="row collapse" id="investment_restrictions">
                            <div class="col-lg-12 mt-3 text-center">
                                <input type="number" class="form-control" id="min_invesment" name="min_invesment"
                                    style="font-size:12px!important" placeholder="Minimum investment (USD) *">
                            </div>
                            <div class="col-lg-12 mt-3 mb-3 text-center">
                                <input type="number" class="form-control" id="max_invesment" name="max_invesment"
                                    style="font-size:12px!important" placeholder="Maximum investment (USD) *">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="d-flex flex-stack">
                                    <div class="me-5">
                                        <label class="required ">Allow fractional shares</label>
                                    </div>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom ">
                                            <input class="form-check-input h-11px w-11px" type="checkbox"
                                                name="allow_fractional_shares">
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="d-flex flex-stack">
                                    <div class="me-5">
                                        <label class="required "> Require investing by units </label>
                                    </div>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom ">
                                            <input class="form-check-input h-13px w-13px" type="checkbox"
                                                name="require_investing_units">
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12  text-center mb-3">
                        <div class="overflow-auto" data-toggle="collapse" data-target="#call_to_action_button">
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded p-3 bg-white">
                                Call To Action Buttons
                            </div>
                        </div>
                        <div class="row collapse" id="call_to_action_button">
                            <div class="col-lg-12 mt-3 text-center">
                                <input type="text" class="form-control" name="review_documents"
                                    style="font-size:12px!important" placeholder="Review Documents Button Text">
                            </div>
                            <div class="col-lg-12 mt-3 text-center">
                                <input type="text" class="form-control" name="invest_button_text"
                                    style="font-size:12px!important" placeholder="Invest Button Text">
                            </div>
                            <div class="col-lg-12 mt-3 text-center">
                                <input type="text" class="form-control" name="contact_us_button_text"
                                    style="font-size:12px!important" placeholder="Contact Us Button Text">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex flex-stack p-2">
                                    <div class="me-5">
                                        <label class="required "> Send me a notification when clicked </label>
                                    </div>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom ">
                                            <input class="form-check-input h-11px w-11px" type="checkbox"
                                                name="send_notification_when_clicked">
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex flex-stack p-2">
                                    <div class="me-5">
                                        <label class="required "> Hide Contact Us Button </label>
                                    </div>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom ">
                                            <input class="form-check-input h-13px w-13px" type="checkbox"
                                                name="hide_contact_button">
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex flex-stack p-2">
                                    <div class="me-5">
                                        <label class="required "> Use Calendly meeting scheduling </label>
                                    </div>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom ">
                                            <input class="form-check-input h-13px w-13px" type="checkbox"
                                                name="calendly_meeting_link">
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mt-3 text-center">
                                <input type="text" class="form-control custom_input"
                                    name="contact_us_external_url" placeholder="Contact Us External URL">
                            </div>
                            <div class="col-lg-12 mt-3  text-center">
                                <input type="text" class="form-control custom_input"
                                    name="alternate_notification_button" placeholder="Alternate Notification Button">
                            </div>

                            <div class="col-lg-12  mt-3">
                                <div class="d-flex flex-stack  p-2">
                                    <div class="me-5">
                                        <label class="required "> Allow User to Send Custom Message </label>
                                    </div>
                                    <div class="d-flex">
                                        <label class="form-check form-check-custom ">
                                            <input class="form-check-input h-11px w-11px" type="checkbox"
                                                name="allow_user_to_send_message">
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12  mt-3">
                                <div class="d-flex flex-stack  p-1">
                                    <small> <b>Complete Transaction Buttons / Messages</b></small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="text" class="form-control custom_input"
                                    name="confirm_invesment_button_text"
                                    placeholder=" Confirm Investment Button Text">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="text" class="form-control custom_input"
                                    name="transaction_confirmation_message"
                                    placeholder=" Transaction Confirmation Message">
                            </div>

                            <div class="col-lg-12  mt-3">
                                <div class="d-flex flex-stack  p-1">
                                    <small> <b> Transaction Created Messages </b></small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="text" class="form-control custom_input" name="addtl_created_emails"
                                    placeholder="Addtl. Created Emails (comma delimited list)">
                            </div>


                            <div class="col-lg-12  mt-3">
                                <div class="d-flex flex-stack  p-1">
                                    <small> <b> Marketplace Call To Action Buttons </b></small>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="text" class="form-control custom_input" name="learn_more_button"
                                    placeholder="Learn More Button">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="text" class="form-control custom_input" name="sign_in_button"
                                    placeholder="Sign In Button">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <input type="text" class="form-control custom_input" name="external_url"
                                    placeholder="External URL">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 mb-3">
            <div class="d-flex align-items-center mb-5" data-toggle="collapse" data-target="#access">
                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3"> Access </span>
                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                <span class="svg-icon svg-icon-1 svg-icon-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20"
                            rx="10" fill="currentColor"></rect>
                        <path
                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <div id="access" class="collapse mb-3">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <select name="visiblity" class="form-control custom_input" style="border-radius: 0">
                            <option value="" disabled selected>Offer Visibility</option>
                            <option value="active">Active</option>
                            <option value="public"> Public (Allow Anonymous Access) </option>
                            <option value="preview">Preview</option>
                            <option value="invite">Invite Only (Hidden)</option>
                            <option value="coming_soon">Coming Soon</option>
                            <option value="no-active">Not Active</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <select name="offer_status" class="form-control custom_input" style="border-radius: 0">
                            <option value="closed"> Closed </option>
                            <option value="open"> open </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <small class=" p-1"> <b>Allow Lists: Only allow these investors</b> </small>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <select name="allow_list" class="form-control custom_input" style="border-radius: 0">
                            <option value="" disabled selected>Select a list</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <small class=" p-1"> <b> Deny Lists: Disallow these investors </b> </small>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <select name="deny_list" class="form-control custom_input" style="border-radius: 0">
                            <option value="" disabled selected>Select a list</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <small class=" p-1"> <b>Invites </b> </small>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="d-flex flex-stack p-2">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-13px w-13px" type="checkbox"
                                        name="allow_referrals">
                                </label>
                            </div>
                            <div class="">
                                <label class=" "> Allow referrals of users who have access </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <small class=" p-1"> <b>Accreditation </b> </small>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="d-flex flex-stack p-2">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-13px w-13px" type="checkbox"
                                        name="allow_non_accredited_investors">
                                </label>
                            </div>
                            <div class="">
                                <label class=" "> Allow non-accredited investors </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <small class=" p-1"> <b>Editing </b> </small>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="d-flex flex-stack p-2">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-13px w-13px" type="checkbox"
                                        name="allow_editing">
                                </label>
                            </div>
                            <div class="">
                                <label class=" "> Allow issuer to edit this offer </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 mb-3">
            <div class="d-flex align-items-center mb-5" data-toggle="collapse" data-target="#display">
                <span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3"> Display </span>
                <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                <span class="svg-icon svg-icon-1 svg-icon-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20"
                            rx="10" fill="currentColor"></rect>
                        <path
                            d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <div id="display" class="collapse mb-3">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <small> <b> Display Settings </b></small>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox"
                                        name="enable_questions">
                                    <span class="form-check-label fw-semibold"> Enable Question & Answer Forum </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox"
                                        name="funding_process">
                                    <span class="form-check-label fw-semibold"> Show Funding Progress </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="show_funding_end_countdown">
                                    <span class="form-check-label fw-semibold"> Show Funding End Date Countdown</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="show_blockchain_info">
                                    <span class="form-check-label fw-semibold"> Show Blockchain Info </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="swap_issuer">
                                    <span class="form-check-label fw-semibold"> Swap Issuer and Offer Name </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="hide_logo_container">
                                    <span class="form-check-label fw-semibold"> Hide Logo Container </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="hide_logo_details">
                                    <span class="form-check-label fw-semibold"> Hide Logo in Details </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="hide_logo_marketplace">
                                    <span class="form-check-label fw-semibold"> Hide Logo in Marketplace </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-20px w-20px" type="checkbox" value="phone"
                                        name="remove_hero_image_mask">
                                    <span class="form-check-label fw-semibold"> Remove Hero Image Mask </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <small> <b>Page Tabs</b></small>
                        <hr>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input type="text" class="form-control" placeholder="Offer Details Tab Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <small> <b>Page Tabs</b></small>
                        <hr>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <input type="text" class="form-control custom_input" name="offer_tab_name"
                            placeholder="Offer Details Tab Name">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <input type="text" class="form-control custom_input" name="video_tab_name"
                            placeholder="Videos Tab Name">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <input type="text" class="form-control custom_input" name="document_tab_name"
                            placeholder="Document Tab Name">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <input type="text" class="form-control custom_input" name="update_tab_name"
                            placeholder="Updates Tab Name">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <input type="text" class="form-control custom_input" name="qa_tab_name"
                            placeholder="Q & A Tab Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <div class="d-flex flex-stack p-2">
                            <div class="d-flex">
                                <label class="form-check form-check-custom ">
                                    <input class="form-check-input h-13px w-13px" type="checkbox" value="phone"
                                        name="hide_contact_us_from">
                                </label>
                            </div>
                            <div class="">
                                <label class=" "> Hide Contact Us Tab </label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
