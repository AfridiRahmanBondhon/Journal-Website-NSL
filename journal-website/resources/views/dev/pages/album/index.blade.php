@extends('dev.layout.master')

@section('content')
    <!-- ======= Breadcrumb Section ======= -->
    <div style="margin-top: 115px !important;">
        <center>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Album</li>
                </ol>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Album</a></li>
                </ol>
            </nav>
        </center>
    </div>

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Albums</h2>
                <p>Albums</p>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                @forelse ($albums as $item)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ $item->original_image ?? '' }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $item->name ?? '' }}</h4>
                        </div>
                    </div>
                @empty
                @endforelse
                {{ $albums->links() }}
            </div>
        </div>
    </section><!-- End Portfolio Section -->
@endsection
