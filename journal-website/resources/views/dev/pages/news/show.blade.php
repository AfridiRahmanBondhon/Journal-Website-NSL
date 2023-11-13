@extends('dev.layout.master')

@section('content')
    <!-- ======= Breadcrumb Section ======= -->
    <div style="margin-top: 115px !important;">
        <center>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ $news->title ?? '' }}</li>
                </ol>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $news->title ?? '' }}</li>
                </ol>
            </nav>
        </center>
    </div>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>News</h2>
                <p>{{ $news->title ?? '' }}</p>
            </div>

            <div class="row content">

                <div class="col-lg-6">
                    {!! $news->description ?? '' !!}
                </div>

                @if (!empty($news->original_image))
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <img class="" alt="{{ $news->title ?? '' }}" src="{{ $news->original_image ?? '' }}">
                    </div>
                @endif
            </div>
        </div>
    </section><!-- End About Section -->
@endsection
