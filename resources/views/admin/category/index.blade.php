@extends('layouts.admin')

@section('title', 'Categories Index')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-success btn-block">
                <i class="far fa-plus-square"></i> Create New Category
            </a>
        </div>
    </div>
    @if($categories->count() == 0)
        <div class="row justify-content-center mt-4">
            <div class="col-sm-6 text-center">
                <h1>Uh-Oh! No Categories To Show Here Yet!</h1>
                <p class="lead">Click on the add new category button above to get started!</p>
            </div>
        </div>
    @else
        <table class="table table-dark table-hover table-sm table-borderless mt-3 text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{!! $category->name !!}</td>
                    <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($category->created_at))->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-secondary btn-sm">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" form="deleteCategoryForm{{ $category->id }}">
                            <i class="far fa-trash-alt"></i> Delete
                        </button>
                        {{ Form::open(['route' => ['admin.category.destroy', $category->id], 'id' => 'deleteCategoryForm' . $category->id, 'method' => 'DELETE'])}}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="pagination">
            {{ $categories->links() }}
        </div>
    @endif

@endsection
