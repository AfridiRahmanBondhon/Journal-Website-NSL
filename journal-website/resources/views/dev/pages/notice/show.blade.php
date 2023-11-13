@extends('dev.layout.master')

@section('content')
    <!-- ======= Breadcrumb Section ======= -->
    <div style="margin-top: 115px !important;">
        <center>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ $notice->title ?? '' }}</li>
                </ol>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Notice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $notice->title ?? '' }}</li>
                </ol>
            </nav>
        </center>
    </div>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Notice</h2>
                <p>{{ $notice->title ?? '' }}</p>
            </div>

            <div class="row content">

                @if (!empty($notice->file))
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <a href="{{ $notice->file }}">Download</a>

                    </div>
                @else
                    <div class="col-lg-6">
                        {!! $notice->description ?? '' !!}
                    </div>
                @endif
            </div>
        </div>
    </section><!-- End About Section -->
@endsection
