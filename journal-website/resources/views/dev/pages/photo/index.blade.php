@extends('dev.layout.master')

@section('content')
    <!-- ======= Breadcrumb Section ======= -->
    <div style="margin-top: 115px !important;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $album->name ?? '' }}</li>
            </ol>
        </nav>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Album</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $album->name ?? '' }}</li>
            </ol>
        </nav>
    </div>

    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Photos</h2>
                <p>{{ $album->title ?? '' }}</p>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                @forelse ($photos as $item)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ $item->thumb ?? '' }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $item->title ?? '' }}</h4>
                        </div>
                    </div>
                @empty
                @endforelse
                {{ $photos->links() }}
            </div>
        </div>
    </section><!-- End Portfolio Section -->
@endsection
