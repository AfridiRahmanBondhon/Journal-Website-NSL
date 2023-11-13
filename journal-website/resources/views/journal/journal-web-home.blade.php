@extends('journal.layouts.journal-master')

@section('content')
    <!-- main part start -->
  <main>
    @include('journal.layouts.banner.banner')

    @include('journal.layouts.feature.feature')

    @include('journal.layouts.callToAction.call-to-action')

    @include('journal.layouts.videoSection.video-section')

    @include('journal.layouts.testimonialAreaOne.testimonial-area-one')
    
    @include('sweetalert::alert')
  </main>
  <!-- main part end -->
@endsection