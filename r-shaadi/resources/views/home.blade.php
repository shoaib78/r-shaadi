@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <!-- banner -->
    <section class="banner">
        @include('frontend.includes.banner')
    </section>
    <!-- /banner -->

    <!-- vendor-service -->
    <section class="vendor-service secpad slideanim">
        @include('frontend.includes.vendor_service')
    </section>
    <!-- /vendor-service -->

    <!-- gallery -->
    <section class="gallery secpad slideanim">
        @include('frontend.includes.home_gallery')
    </section>
    <!-- gallery -->

    <!-- testimonials -->
    <section class="testimonials secpad slideanim">
        @include('frontend.includes.testimonials')
    </section>
    <!-- testimonials -->

    <!-- slideanim -->
    <section class="why-us secpad slideanim">
        @include('frontend.includes.slideanim')
    </section>
    <!-- slideanim -->

@endsection
