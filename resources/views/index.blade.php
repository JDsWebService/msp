@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- Above The Fold Hero Section --}}
    @include('content.app.hero')

    {{-- About Us Section --}}
    @include('content.app.about')

    {{-- Feature Section --}}
    @include('content.app.feature')

    {{-- Service Section --}}
    @include('content.app.service')

    {{-- Call To Action Section --}}
    @include('content.app.calltoaction')
    
    {{-- Testimonial Section --}}
    @include('content.app.testimonial')

@endsection