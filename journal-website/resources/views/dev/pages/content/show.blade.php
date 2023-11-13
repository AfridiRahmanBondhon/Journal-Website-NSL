@extends('dev.layout.master')

@section('content')
    <!-- ======= Breadcrumb Section ======= -->
    <div style="margin-top: 115px !important;">
        <center>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ $content->title ?? '' }}</li>
                </ol>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Content</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $content->title ?? '' }}</li>
                </ol>
            </nav>
        </center>
    </div>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Content</h2>
                <p>{{ $content->title ?? '' }}</p>
            </div>

            <div class="row content">

                <div class="col-lg-6">
                    {!! $content->description ?? '' !!}
                </div>

                @if (!empty($content->original_image))
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <img class="" alt="{{ $content->title ?? '' }}" src="{{ $content->original_image ?? '' }}">
                    </div>
                @endif
            </div>
        </div>
    </section><!-- End About Section -->
@endsection
