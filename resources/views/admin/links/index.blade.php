@extends('layouts.admin')

@section('title', 'Private Client Links Index')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-borderless table-sm text-white">
                <thead>
                <tr>
                    <th scope="col">Client Name</th>
                    <th scope="col">Link</th>
                    <th scope="col">UUID</th>
                    <th scope="col">Link To Give To Client</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($links as $link)

                        <tr>
                            <td>{{ $link->client }}</td>
                            <td>
                                <a href="{{ $link->link }}">Dropbox Link</a>
                            </td>
                            <td>
                                {{ $link->uuid }}
                            </td>
                            <td>
                                <a href="{{ route('client.private.link', $link->uuid) }}">Right Click Me!</a>
                            </td>
                            <td>
                                {{ Form::open(['route' => ['admin.links.delete', $link->uuid], 'method' => 'DELETE']) }}
                                <a href="{{ route('admin.links.edit', $link->uuid) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
