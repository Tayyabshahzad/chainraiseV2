@extends('layouts.app')
@section('title', 'Dashboard')
@section('page_name', 'Dashboard')
@section('page_head')
    <style>
        .offering_row{
            background-color: #fff;
            padding:10px 20px;
            box-shadow: 20px 20px 50px grey;"
        }
        .offering_row:hover{
            box-shadow: 5px 5px 70px grey;"
        }
    </style>
@endsection
@section('page_content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Dashboard</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            @hasrole('admin')
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->
                    <div class="row ">
                        <!--begin::Col-->

                            <!--begin::Card widget 20-->
                            <div class="col-lg-4 card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"  >
                                <!--begin::Header-->
                                <div class="card-header pt-5 pb-5" style="border-radius:4px;background-color: #bd4d69;background-image:url('assets/media/patterns/vector-1.png')">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"> {{ $users }} </span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <hr>
                                        <span class="text-white opacity-75 pt-1 fw-bold fs-6 text-dark"> ACTIVE ACCOUNTS </span>
                                        <!--end::Subtitle-->
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"  >
                                <!--begin::Header-->
                                <div class="card-header pt-5 pb-5" style="border-radius:4px;background-color: #42413c;background-image:url('assets/media/patterns/vector-1.png')">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $investors }}</span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <hr>
                                        <span class="text-white opacity-75 pt-1 fw-bold fs-6 "> NUMBER OF INVESTOR </span>
                                        <!--end::Subtitle-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"  >
                                <!--begin::Header-->
                                <div class="card-header pt-5 pb-5" style="border-radius:4px;background-color: #15c2c2;background-image:url('assets/media/patterns/vector-1.png')">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"> {{ $raised_amount }} <small class="text-dark"> USD </small> </span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <hr>
                                        <span class="text-white opacity-75 pt-1 fw-bold fs-6 text-dark"> TOTAL AMOUNT RAISED  </span>
                                        <!--end::Subtitle-->
                                    </div>
                                </div>
                            </div>


                    </div>



                </div>
            @endhasrole
            @hasrole('issuer')
            <div id="kt_app_content_container" class="app-container container-fluid">


										<!--begin::Col-->
										<div class="col-xxl-12">
											<!--begin::Security summary-->
											<div class="card card-xxl-stretch mb-5 mb-xl-10">
												<!--begin::Header-->
												<div class="card-header card-header-stretch">
													<!--begin::Title-->
													<div class="card-title">
														<h3 class="m-0 text-gray-900"> Summary</h3>
													</div>
													<!--end::Title-->
													<!--begin::Toolbar-->
													<div class="card-toolbar">
														<ul class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold" id="kt_security_summary_tabs" role="tablist">
															<li class="nav-item" role="presentation">
																<a class="nav-link text-active-primary active" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_security_summary_tab_pane_hours" data-kt-initialized="1" aria-selected="false" role="tab" tabindex="-1">Investment</a>
															</li>
															<li class="nav-item" role="presentation">
																<a class="nav-link text-active-primary" data-kt-countup-tabs="true" data-bs-toggle="tab" id="kt_security_summary_tab_day" href="#kt_security_summary_tab_pane_day" data-kt-initialized="1" aria-selected="false" role="tab" tabindex="-1">Transaction  History</a>
															</li>
														</ul>
													</div>
													<!--end::Toolbar-->
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-7 pb-0 px-0">
													<!--begin::Tab content-->
													<div class="tab-content">
														<!--begin::Tab panel-->
														<div class="tab-pane fade active show" id="kt_security_summary_tab_pane_hours" role="tabpanel">
															<!--begin::Row-->
															<div class="row p-0 mb-5 px-9">
																<!--begin::Col-->
																<div class="col">
																	<div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
																		<span class="fs-4 fw-semibold text-success d-block">Total Invested</span>
																		<span class="fs-2hx fw-bold text-gray-900 counted" data-kt-countup="true" data-kt-countup-value="36899" data-kt-initialized="1">
																			{{ number_format($totalInvested, 2) }}
																		</span>
																	</div>
																</div>
																<!--end::Col-->
																<!--begin::Col-->
																<div class="col">
																	<div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
																		<span class="fs-4 fw-semibold text-primary d-block">Date of Last Activity</span>
																		<span class="fs-2hx fw-bold text-gray-900 counted" data-kt-countup="true" data-kt-countup-value="72" data-kt-initialized="1">
                                                                            {{ $lastInsertedDate }}
                                                                        </span>
																	</div>
																</div>
																<!--end::Col-->
																<!--begin::Col-->
																<div class="col">
																	<div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
																		<span class="fs-4 fw-semibold text-danger d-block">Deals Funded</span>
																		<span class="fs-2hx fw-bold text-gray-900 counted" data-kt-countup="true" data-kt-countup-value="291" data-kt-initialized="1">
                                                                            {{ $transactions->count() }}
                                                                        </span>
																	</div>
																</div>


                                                                <div class="col">
																	<div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
                                                                        <table class="table table-hover">
                                                                            <thead>
                                                                                <tr>

                                                                                    <th scope="col" style="min-width: 120px;"> From </th>
                                                                                    <th scope="col" style="min-width: 120px;"> To </th>
                                                                                    <th scope="col" style="min-width: 120px;"> Amount </th>
                                                                                    <th scope="col" style="min-width: 120px;"> Date </th>
                                                                                    <th scope="col" style="min-width: 120px;"> KYC </th>
                                                                                    <th scope="col" style="min-width: 120px;"> Status </th>
                                                                                    <th scope="col" style="min-width: 120px;"> Type </th>
                                                                                    <th scope="col" style="min-width: 120px;"> Payment Method</th>
                                                                                    <th scope="col" style="min-width: 120px;"> E-Sign </th>
                                                                                    <th scope="col" style="min-width: 120px;"> Action </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-group-divider">

                                                                                @foreach ($transactions as $transaction)
                                                                                    <tr>
                                                                                        <td> {{ $transaction->user->name }} </td>
                                                                                        <td> {{ $transaction->offer->name }} </td>
                                                                                        <td> {{ $transaction->funds }} </td>
                                                                                        <td> {{ $transaction->created_at }} </td>
                                                                                        <td> {{ $transaction->kyc_status }} </td>
                                                                                        <td> {{ $transaction->status }} </td>
                                                                                        <td> {{ $transaction->type }} </td>
                                                                                        <td> {{ $transaction->payment_method }} </td>
                                                                                        <td> {{ $transaction->e_sign }} </td>
                                                                                        <td> <button data-bs-toggle="modal" data-bs-target="#delete_transaction"
                                                                                                class="btn btn-danger delete_payment" data-id="{{ $transaction->id }}"> <i class="fa fa-trash"></i> </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
																	</div>
																</div>


																<!--end::Col-->
															</div>



														</div>
														<!--end::Tab panel-->
														<!--begin::Tab panel-->
														<div class="tab-pane fade" id="kt_security_summary_tab_pane_day" role="tabpanel" aria-labelledby="#kt_security_summary_tab_day">
															<!--begin::Row-->
															<div class="row p-0 mb-5 px-9">
																<!--begin::Col-->
																<div class="col">
																	<div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
                                                                        <table class="table table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col" style="min-width: 120px;">Investment</th>
                                                                                    <th scope="col" style="min-width: 120px;">Transaction Amount</th>
                                                                                    <th scope="col" style="min-width: 120px;">Status</th>
                                                                                    <th scope="col" style="min-width: 170px;">Transaction Date</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-group-divider">
                                                                                @foreach ($transactions as $transaction)
                                                                                    <tr>
                                                                                        <th scope=" row"><span class="px-2 me-2"   style="background-color: #43C3FE;"></span> {{ $transaction->offer->name }} </th>
                                                                                        <td>${{ number_format($transaction->funds)  }}</td>
                                                                                        <td> {{ $transaction->status }}</td>
                                                                                        <td> {{ $transaction->created_at }} </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
																	</div>
																</div>
															</div>

														</div>

														<!--end::Tab panel-->
													</div>
													<!--end::Tab content-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Security summary-->
										</div>




            </div>
            @endhasrole
            <!--end::Content container-->

        </div>
        <!--end::Content-->
    </div>




@endsection
@section('page_js')


    @if(Session::has('success'))
        @php
            $message = (session::get('success'));
        @endphp
        <script>
            toastr.success('{{$message}}', "Success");
        </script>

    @endif


    @if(Session::has('error'))
        @php
            $message = (session::get('error'));
        @endphp
        <script>
            toastr.error('{{$message}}', "Error");
        </script>

    @endif


@endsection
