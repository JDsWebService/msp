@extends('layouts.admin')

@section('title', 'Portfolio Images Index')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <a href="{{ route('admin.portfolio.create') }}" class="btn btn-sm btn-success btn-block">
                <i class="far fa-plus-square"></i> Create New Image
            </a>
        </div>
    </div>
    @if($images->count() == 0)
        <div class="row justify-content-center mt-4">
            <div class="col-sm-6 text-center">
                <h1>Uh-Oh! No Images To Show Here Yet!</h1>
                <p class="lead">Click on the add new image button above to get started!</p>
            </div>
        </div>
    @else
        <table class="table table-dark table-hover table-sm table-borderless mt-3 text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Width</th>
                <th scope="col">Height</th>
                <th scope="col">Created At</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
                    <th scope="row">{{ $image->id }}</th>
                    <td>{!! $image->title !!}</td>
                    <td>{{ $image->width }}</td>
                    <td>{{ $image->height }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($image->created_at))->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.portfolio.edit', $image->id) }}" class="btn btn-secondary btn-sm">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-danger btn-sm" form="deleteImageForm{{ $image->id }}">
                            <i class="far fa-trash-alt"></i> Delete
                        </button>
                        {{ Form::open(['route' => ['admin.portfolio.destroy', $image->id], 'id' => 'deleteImageForm' . $image->id, 'method' => 'DELETE'])}}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="pagination">
            {{ $images->links() }}
        </div>
    @endif

@endsection
