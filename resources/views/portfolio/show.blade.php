@extends('layouts.app')

@section('title', $image->title)

@section('content')

    <section class="portfolio-single-page section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-center">
                    <a href="{{ $image->publicPath }}" target="_blank">
                        <img src="{{ $image->publicPath }}" class="portfolio-single-image" alt="{!! $image->title !!}">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="project-details mt-50">
                        <h4>Image Meta-Data</h4>
                        <ul>
                            @if($image->taken_on)
                                <li><span><i class="far fa-calendar-alt"></i> Taken On</span><strong> {{ $image->taken_on }}</strong></li>
                            @endif
                            @if($image->width)
                                <li><span><i class="fas fa-arrows-alt-h"></i> Resolution Width</span><strong> {{ $image->width }}px</strong></li>
                            @endif
                            @if($image->height)
                                <li><span><i class="fas fa-arrows-alt-v"></i> Resolution Height</span><strong> {{ $image->height }}px</strong></li>
                            @endif
                            <li><span><i class="fas fa-upload"></i> Uploaded on</span> {{ $image->created_at }}</li>
                            <li>
                                <span><i class="fas fa-link"></i> Permalink </span>
                                <a href="{{ route('portfolio.show', $image->slug) }}">Link <i class="fas fa-external-link-alt"></i></a>
                            </li>
                            <li><span><i class="fas fa-th-list"></i> Category </span> {{ $image->category->name }}</li>
                            <li>
                                <a href="{{ $image->publicPath }}" target="_blank"><i class="far fa-eye"></i> View Full Image</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="project-content mt-50">
                        <h2>{!! $image->title !!}</h2>
                        @if($image->description)
                            <p>{!! $image->description !!}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">

                </div>
            </div>

        </div>
    </section>

@endsection
