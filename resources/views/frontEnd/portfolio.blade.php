@extends('layouts.master')
@section('page_head')
@endsection
@section('title', 'Home')
@section('content')
    <div class="container p-lg-5 mt-lg-3 p-3">
        <div id="detail">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item px-lg-5 border-bottom" role="presentation">
                    <button class="nav-link active bg-transparent text-muted fs-5" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#investment" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Investment</button>
                </li>

                <li class="nav-item px-lg-5 border-bottom" role="presentation">
                    <button class="nav-link bg-transparent text-muted fs-5" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#date" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Transaction History</button>
                </li>
            </ul>
            <div class="tab-content py-3" id="pills-tabContent">
                <div class="tab-pane fade show active p-2" id="investment" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-left p-3">
                                <h6>Total Invested</h6>
                                <h4 class="fw-bolder">$ {{ number_format($totalInvested, 2) }}</h4>
                            </div>

                            <div class="text-left p-3">
                                <h6>Date of Last Activity</h6>
                                <h4 class="fw-bolder"> {{ $lastInsertedDate }} </h4>
                            </div>
                            <div class="text-left p-3">
                                <h6>Deals Funded</h6>
                                <h4 class="fw-bolder"> {{ $transactions->count() }} </h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
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

                <div class="tab-pane fade p-2" id="date" role="tabpanel" aria-labelledby="pills-profile-tab">
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
    <div class="modal fade" id="delete_transaction" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Transaction</h5>
                </div>
                <form class="form" method="get" action="{{ route('transaction.delete') }}" id="delete_transaction_form">
                    <div class="modal-body">
                        <div class="">
                            @csrf
                            <input type="hidden" name="transaction_id" id="transaction_id">
                            <div class="row text-center p-3">
                                <p class="text-danger"> Are you sure to delete this transaction? It will also delete your
                                    order</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-sm btn btn-light-primary font-weight-bold btn-square"
                            data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn-sm btn btn-danger font-weight-bold btn-square delete_button">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_js')

    <script>
        $(document).ready(function() {
            $('#delete_transaction_form').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally
                // Get form data

                var formData = $(this).serialize();
                $('.delete_button').prop('required', true);
                $('#delete_transaction').modal('hide');
                // Send the data using AJAX
                $.ajax({
                    url: "{{ route('transaction.delete') }}", // Replace with your backend endpoint
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        // Handle the successful response
                        console.log(response);
                        if(response.status == false){
                            $('.delete_button').prop('required', false);
                            toastr["error"](response.message)
                        }
                        if(response.status == true){
                            $('.delete_button').prop('required', false);
                            toastr["success"](response.message)
                        }
                        // Optionally, perform any additional actions here
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.log(xhr.responseText);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.delete_payment').click(function(){
                var tran_id = $(this).data('id');
                $('#transaction_id').val(tran_id)
            });
        });
    </script>
@endsection
