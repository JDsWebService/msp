@extends('layouts.admin')

@section('title', 'Create Portfolio Entry')

@section('content')

    <div class="row">

        <div class="col-sm-12">
            {{ Form::model($image, ['route' => ['admin.portfolio.update', $image->id], 'files' => true, 'method' => 'PUT']) }}
            <label for="title">Image Title</label>
            {{ Form::text('title', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Image Title', 'required']) }}

            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="width">Width</label>
                    {{ Form::number('width', null, ['class' => 'form-control', 'placeholder' => 1024]) }}
                </div>
                <div class="col-sm-3">
                    <label for="height">Height</label>
                    {{ Form::number('height', null, ['class' => 'form-control', 'placeholder' => 768]) }}
                </div>
                <div class="col-sm-3">
                    <label for="taken_on">Taken On</label>
                    {{ Form::date('taken_on', null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-3">
                    <label for="category">Category</label>
                    {{ Form::select('category_id', $categories, null, ['placeholder' => 'Select Category...', 'class' => 'form-control']) }}
                </div>
                <div class="col-sm-12 mt-3">
                    <label for="description">Image Description</label>
                    <x-tiny-m-c-e name="description"/>
                </div>
            </div>
            @include('components.fileupload')

            <button type="submit" class="btn btn-success mt-4 btn-block"><i class="far fa-save"></i> Save Changes</button>
            {{ Form::close() }}
        </div>

    </div>

@endsection
