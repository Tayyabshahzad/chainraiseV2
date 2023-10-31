@extends('layouts.app')
@section('title', 'Transactions')
@section('page_name', 'Transactions')
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
                            <a href="" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Transactions</li>
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
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="col-xxl-12">
                    <!--begin::Security summary-->
                    <div class="card card-xxl-stretch mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header card-header-stretch">
                            <!--begin::Title-->
                            <div class="card-title">
                                <h3 class="m-0 text-gray-900"> Transactions</h3>
                            </div>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold" id="kt_security_summary_tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link text-active-primary active" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_security_summary_tab_pane_hours" data-kt-initialized="1" aria-selected="false" role="tab" tabindex="-1">Your Transactions</a>
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
                                    
                                    <div class="row p-0 mb-5 px-9">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <div class="border border-dashed border-gray-300 text-center min-w-125px rounded ">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr> 
                                                            <th  scope="col" style="min-width: 120px;" >S#</th>
                                                            <th  scope="col" style="min-width: 120px;">From</th>
                                                            <th  scope="col" style="min-width: 120px;">To</th>
                                                            <th  scope="col" style="min-width: 120px;">Amount</th>
                                                            <th  scope="col" style="min-width: 120px;">Date</th>
                                                            <th  scope="col" style="min-width: 120px;">KYC</th>
                                                            <th  scope="col" style="min-width: 120px;">Status</th>
                                                            <th  scope="col" style="min-width: 120px;">Type</th>
                                                            <th  scope="col" style="min-width: 120px;">Payment Method</th>
                                                            <th  scope="col" style="min-width: 120px;">E-Sign</th>
                                                            <th  scope="col" style="min-width: 120px;"> Action </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($transactions as $transaction)
                                                        <tr>
                                                             <td> {{ $loop->iteration }} </td>
                                                             <td> {{ $transaction->user->name }} {{ $transaction->user->userDetail->last_name }} </td>
                                                             <td> {{ $transaction->offer->name }} </td>
                                                             <td> {{ $transaction->funds }} </td>
                                                             <td> {{ $transaction->created_at }} </td>
                                                             <td> {{ $transaction->kyc_status }} </td>
                                                             <td> {{ $transaction->status }} </td>
                                                             <td> {{ $transaction->type }} </td>
                                                             <td> {{ $transaction->payment_method }} </td>
                                                             <td> {{ $transaction->e_sign }} </td>
                                                             <td>
                                                                <i class="fa fa-edit"></i>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr >
                                                            <td class="text-right" colspan="11">
                                                                <nav aria-label="Page navigation example">
                                                                    <ul class="pagination">
                                                                        @if ($transactions->currentPage() > 1)
                                                                            <li class="page-item"><a class="page-link" href="{{ $transactions->previousPageUrl() }}">Previous</a></li>
                                                                        @endif
                            
                                                                        @for ($i = 1; $i <= $transactions->lastPage(); $i++)
                                                                            <li class="page-item {{ ($i == $transactions->currentPage()) ? 'active' : '' }}">
                                                                                <a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a>
                                                                            </li>
                                                                        @endfor
                            
                                                                        @if ($transactions->hasMorePages())
                                                                            <li class="page-item"><a class="page-link" href="{{ $transactions->nextPageUrl() }}">Next</a></li>
                                                                        @endif
                                                                    </ul>
                                                                </nav>
                            
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Security summary-->
                </div>
            </div> 

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


