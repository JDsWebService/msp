@extends('layouts.admin')

@section('title', 'Edit Category Category')

@section('content')

    <div class="row">

        <div class="col-sm-12">
            {{ Form::model($category, ['route' => 'admin.category.store', 'method' => 'PUT']) }}
            <label for="name">Category Name</label>
            {{ Form::text('name', null, ['class' => 'form-control form-control-lg', 'placeholder' => 'Category Name', 'required']) }}

            <button type="submit" class="btn btn-success mt-4 btn-block"><i class="far fa-save"></i> Save Category</button>
            {{ Form::close() }}
        </div>

    </div>

@endsection
