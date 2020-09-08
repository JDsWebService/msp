@extends('layouts.admin')

@section('title', 'Create New Category')

@section('content')

    <div class="row">

        <div class="col-sm-12">
            {{ Form::open(['route' => 'admin.category.store', 'method' => 'POST']) }}
                <label for="name">Category Name</label>
                {{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Category Name', 'required']) }}

                <button type="submit" class="btn btn-success mt-4 btn-block"><i class="far fa-plus-square"></i> Add Category</button>
            {{ Form::close() }}
        </div>

    </div>

@endsection
