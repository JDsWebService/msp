@extends('layouts.admin')

@section('title', 'Edit Link For ' . $link->client)

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-8">

            {{ Form::model($link, ['route' => ['admin.links.update', $link->uuid], 'method' => 'PUT']) }}
                <label for="client">Client Name</label>
                {{ Form::text('client', null, ['class' => 'form-control', 'placeholder' => 'Client Name']) }}

                <label for="link" class="mt-3">Dropbox Link</label>
                {{ Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'http://dropbox.com/link']) }}

                <button class="btn btn-block btn-success mt-3" type="submit">
                    Save Link
                </button>
            {{ Form::close() }}

        </div>
    </div>

@endsection
