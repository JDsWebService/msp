@extends('layouts.app')

@section('title', 'Portfolio')

@section('content')

    <section class="page-title bg-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h1 class="portfolio-title">Some of our latest projects</h1>
                        <p class="portfolio-subtitle">Don’t just take our word for it. Check out some of our latest work.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Portfolio Start -->
    <section class="portfolio-work">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="portfolio-menu">
                            <div class="btn-group btn-group-toggle justify-content-center" data-toggle="buttons">
                                <label class="btn btn-sm btn-primary active">
                                    <input type="radio" name="shuffle-filter" value="all" checked="checked" />All
                                </label>
                                @foreach($categories as $category)
                                    <label class="btn btn-sm btn-primary">
                                        <input type="radio" name="shuffle-filter" value="{{ $category->name }}" />
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="row shuffle-wrapper">
                            @foreach($images as $image)
                                <div class="col-md-4 portfolio-item shuffle-item" data-groups="[&quot;{{ $image->category->name }}&quot;]">
                                    <img src="{{ $image->fullPath }}" class="img-fluid" alt="">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-content">
                                            <a href="#" class="portfolio-popup"><i class="icon ion-search"></i></a>
                                            <a class="h3" href="portfolio-single.html">{{ $image->title }}</a>
                                            <p>{{ \Illuminate\Support\Str::words($image->description, 5, '...') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
