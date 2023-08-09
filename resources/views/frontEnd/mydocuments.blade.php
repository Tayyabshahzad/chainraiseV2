@extends('layouts.master')
@section('page_head')
@endsection
@section('title', 'Home')
@section('content')

    <div class="container">
        <div class="row my-5">
            <div class="col-lg-4">
                <h4>Documents</h4>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-3">
                        <input class="form-control" type="text" placeholder="Search">
                    </div>
                    <div class="col-lg-3">
                        <input class="form-control" type="date" id="floatingInput" placeholder="Search">
                    </div>
                    <div class="col-lg-3">
                        <div class="d-grid gap-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class=" bi bi-folder-plus"></i> Add Folders
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Folder</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form" method="post" action="{{ route('folder.create') }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col d-flex justify-content-end">
                                                        <div class="form-check form-switch mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="flexSwitchCheckDefault">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                                Upload a Folder </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="Folder Name"
                                                            name="name" required>
                                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"
                                                            required>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select form-select-solid" data-control="select2"
                                                            data-hide-search="true" data-placeholder="Related Offer"
                                                            name="offer">
                                                            <option value="" disabled selected>Related Offer</option>
                                                            @foreach ($offers as $offer)
                                                                <option value="{{ $offer->id }}"> {{ $offer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="sort"
                                                            placeholder="Sort Order" aria-label="Sort Order">
                                                    </div>

                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col d-flex justify-content-end">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox1" value="option1">
                                                            <label class="form-check-label" for="inlineCheckbox1">Allow
                                                                Download
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox2" value="option2">
                                                            <label class="form-check-label" for="inlineCheckbox2">Show
                                                                All Pages</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col d-flex justify-content-end">
                                                        <button type="button" class="btn btn-secondary me-3"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-secondary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-light"> <i class="bi bi-folder-plus"></i> Sort
                                Folders</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">


            @foreach ($folders as $folder)
                <div class="col-lg-3 mb-5">
                    <button type="button" class="btn btn-secondary viewDocuments" data-bs-toggle="modal"
                        data-id="{{ $folder->id }}" data-bs-target="#modal-viewDocument">
                        <i class="bi bi-folder "></i>
                        {{ $folder->name }} <span class="badge text-bg-success"> {{ $folder->documents_count }} </span>
                    </button>
                </div>
            @endforeach





            <div class="col-12">
                <p>
                    Issuers pay ChainRaise a fee to use the ChainRaise communication Portal for Reg CF offerings. This
                    fee may be paid as a flat fee, commission based on the amount of money issuers raise, or in other
                    ways. Issuers may pay additional fees for specified services ChainRaise provides, including
                    reimbursement of any expenses ChainRaise incurs on their behalf. ChainRaise discloses its
                    compensation for each offering in which an issuer invests. If an issuer pays ChainRaise in whole or
                    in part with its own issuing securities, these securities will always be the same class offered to
                    investors on the ChainRaise Portal.

                    ChainRaise does not charge a fee to investors for offerings via Reg CF or Reg A.
                    For secondary transactions, ChainRaise may receive a fee for the purchase and/or sale of privately
                    held securities. Every secondary transaction is unique, and fees will differ per transaction.
                </p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-viewDocument" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> View Document </h5>
                    <button class="modal-title btn btn-default uploadFIle" id="exampleModalLabel" data-bs-toggle="modal"
                        data-id="1" data-bs-target="#modal-addFile  "> <i class="fa fa-plus"></i> Add Content
                    </button>
                </div>
                <div class="modal-body">
                    <span id="folder_id_content"></span>
                    <div class="row" id="all_documents">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-addFile" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Add Document </h5>
                    {{--                
        <label class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input" type="checkbox" value="1">
            <span class="form-check-label fw-semibold text-muted">Upload a Folder</span>
        </label> --}}
                </div>
                <form class="form" method="post" action="{{ route('folder.upload.file') }}"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card card-custom">
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-lg-4">
                                    <label for="" class="required"> Document Name </label>
                                    <input type="text" class="form-control" placeholder="Document Name"
                                        id="file_name" name="name" required>
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" required>
                                    <input type="hidden" id="folder_id" name="folder_id" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="" class=" "> Document Description </label>
                                    <input type="text" class="form-control" placeholder="Document description"
                                        name="description">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group ">
                                        <label for=""> Related Offer </label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-hide-search="true" data-placeholder="Related Offer" name="offer">
                                            <option value="" disabled selected>None</option>
                                            @foreach ($offers as $offer)
                                                <option value="{{ $offer->id }}"> {{ $offer->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <br>
                                        <input type="file" name="file" id="upload_file">
                                    </div>

                                </div>

                            </div>
                            <!--end::Form-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-sm btn btn-light-primary font-weight-bold btn-square"
                            data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn-sm btn btn-primary font-weight-bold btn-square">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('page_js')
    <script>
        $('.uploadFIle').click(function() {
            var id = $('.selected_folder_id').val();
            $('#folder_id').val(id);

        });


        $('.viewDocuments').click(function() {
            $('#folder_id_content').html('');
            var folder_id = $(this).data('id');
            $.ajax({
                url: "{{ route('folder.get.files') }}",
                method: 'GET',
                data: {
                    folder_id: folder_id
                },
                success: function(response) {
                    var listItem = '';
                    $('#folder_id_content').append(
                        `<input type="hidden" class="selected_folder_id"  value="` + folder_id +
                        `"/>`);
                    if (response.status == true) {
                        $(response.data).each(function(index, value) {
                            console.log(value)
                            listItem +=

                                `  <div class="col-lg-3 mb-10"> 
                                        <div class="d-flex flex-center flex-column py-5" style="border:1px solid #000" >
                                            <!--begin::Avatar-->
                                            <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3 text-center"> ` +
                                            value.name + ` </a>
                                            <!--end::Name-->
                                            <!--begin::Position-->
                                            <div class="mb-9">
                                                <!--begin::Badge-->
                                                <div class="badge badge-lg badge-light-danger d-inline">REQUIRES SIGNATURE</div>
                                                <!--begin::Badge-->
                                            </div>
                                            <div class="d-flex flex-wrap flex-center justify-content-center" >
                                                <!--begin::Stats-->
                                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 m-2">
                                                    <div class="fs-4 fw-bold text-gray-700">
                                                        <i class="text-danger la la-trash"></i>
                                                    </div>
                                                </div>

                                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 m-2">
                                                    <div class="fs-4 fw-bold text-gray-700">
                                                        <i class="text-warning la la-history"></i>
                                                    </div>
                                                </div>

                                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 m-2">
                                                    <div class="fs-4 fw-bold text-gray-700">
                                                        <i class="text-info la la-download"></i>
                                                    </div>
                                                </div>

                                            </div>
                                            <p class='text-center'>
                                                 ---
                                            </p>
                                            <!--end::Info-->
                                        </div>
                                    </div>  `;
                        });
                    }

                    $('#all_documents').html(listItem);

                },
            });
        });
    </script>

@endsection