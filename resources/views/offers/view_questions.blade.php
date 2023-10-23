@extends('layouts.app')
@section('title', 'Q&A Session')
@section('page_name','Q&A Session')
@section('page_head')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('page_content')

<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Listing</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('offers.qa.session') }}"> Q&A Listing </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Questions</li>



                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Questions</span>
                    </h3>


                    <div class="card-toolbar ">


                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="flex-lg-row-fluid">
                        <div class="card">
                            <div class="card-body p-0">
                                <!--begin::Table-->
                                <div id="kt_inbox_listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                     <form action="{{ route('offers.update.question') }}" method="post" enctype="multipart/form-data">
                                        <button type="submit"  class="btn btn-sm btn-info mb-10"> Update </button>
                                        @csrf
                                        @foreach ($questions as $question )
                                            <input type="hidden" class="form-control" name="question_id[]" id="" value="{{$question->id }}" >
                                            <div class="mb-10">
                                                <div class="col-lg-12 form-group mb-5">
                                                    <strong>Question</strong>
                                                    <input type="text" class="form-control" name="question[]" id="" value="{{$question->question }}" >
                                                </div>
                                                <div class="col-lg-12 form-group mb-5">
                                                    <strong>Answer</strong>
                                                    <input type="text" class="form-control" name="answer[]" value="{{$question->answer }}" id="">
                                                </div>
                                                <div class="col-lg-12 form-group mb-5">
                                                    <strong>Status</strong>
                                                    <select name="status[]" class="form-control" id="">
                                                        <option value="active" @if($question->status =='active') selected @endif> Active </option>
                                                        <option value="inactive" @if($question->status =='inactive') selected @endif> Inactive </option>
                                                    </select>


                                                </div>
                                            </div>
                                        @endforeach
                                     </form>
                                </div>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--begin::Table container-->

                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
        <!--end::Content container-->
    </div>
</div>

<div class="modal fade" id="modal-policy-create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <form action="{{ route('offers.policy.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y px-10 px-lg-15 pt-10 pb-15">
                        <h3>
                            Policy
                        </h3>
                        <div class="row mt-3">
                            <div class="col-lg-12 form-group">
                                <textarea type="text"  class="form-control" name="content" placeholder="Policy Content" required></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 form-group">
                                <button class="btn btn-sm btn-dark no-radius" type="submit"  > Add Policy </button>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="policy_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">   </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div class="row mt-3">
                        <div class="col-lg-12 form-group">
                            <input type="text"  class="form-control video_url" placeholder="Enter Feature Video URL">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-sm btn-dark add_feature_video_btn" type="button" data-bs-dismiss="modal" > Add Feature Video </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('page_js')

    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>

        $('#action-send-email').click(function(){
            var form = $('#send_email_form')[0].reset();
            $('.summernote').summernote('reset');
            $('#sendEmailBtn').prop('disabled',false);
            $('#sendEmailBtn').html('Send Email');

        });
        $('.deleteUser').click(function() {
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: "Are you sure to delete this policy?",
                text: "This action can't undo are you sure to delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes Delete"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('offers.policy.delete')}}",
                        method: "POST",
                        data: {
                            id: id,
                        },
                        success: function(result) {
                            if(result.status == true){
                                toastr.success(result.message, "Success");
                                location.reload();
                            }else{
                                toastr.error(result.message, "Error");
                            }
                        }
                    });

                }
            });

        });
    </script>

@endsection
