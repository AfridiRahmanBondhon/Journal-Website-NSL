@extends('dev.layout.master')

@section('content')
    <!-- ======= Breadcrumb Section ======= -->
    <div style="margin-top: 115px !important;">
        <center>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Notice</li>
                </ol>
            </nav>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Notice</a></li>
                </ol>
            </nav>
        </center>
    </div>

    <!-- ======= Event Section ======= -->
    <section id="services" class="services">
        <div class="container" data-aos="fade-up">
            <div class="row">
                @forelse ($notices as $item)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <img src="{{ $item->thumb_one ?? '' }}" width="150px">
                            <h4><a href="{{ route('dev.notice.show', $item->slug) }}">{{ $item->title ?? '' }}</a></h4>
                        </div>
                    </div>
                @empty
                    <x-empty-component></x-empty-component>
                @endforelse
            </div>
        </div>
    </section><!-- End Services Section -->

    {{ $notices->links() }}
@endsection
