@extends('dev.layout.master')

@section('content')
    <main id="main">
        @include('dev.components.slider')
        @include('dev.components.about')
        @include('dev.components.event')
        @include('dev.components.news')
        @include('dev.components.notice')
        @include('dev.components.gallery')
        @include('dev.components.faq')
        @include('dev.components.contact')
    </main>
@endsection
