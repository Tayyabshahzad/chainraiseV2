@extends('layouts.master')
@section('page_title','consultation')
@section('page_style')

    <link rel="stylesheet" href="{{  asset('vue/css/style-business.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .bg-image-tree{
            background-image: url("{{ asset('vue/images/hero-bg.png') }}");
        }
    </style>
@endsection
@section('page_content')

<div class="container-fluid section-bg py-5">
    <div class="row ">
        <div class="col-lg-12 text-center py-4">
            <h1 class="second">Book Your Consultation</h1>
        </div>
    </div>
    <!-- Faq for investor -->
    <div class="container-fluid">
        <div class="container py-4 ">
            <div class="row">
                <div class="col-12" style="margin-bottom:2%;height:500%">

                    <iframe src="https://calendly.com/chainraise/30min?month=2024-01" style="width: 100%;height:42em" frameborder="0"></iframe>


                </div>
            </div>
        </div>
    </div>
    <!-- Faq for investor End -->
</div>
@endsection
