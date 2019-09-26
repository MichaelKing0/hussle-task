@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-warning">
            {{ implode('', $errors->all(':message')) }}
        </div>
    @endif

    {{ Form::open(['route' => 'urls.store', 'method' => 'POST']) }}
        {{ Form::token() }}

        <div class="form-group">
            {{ Form::label('url', 'URL to Shorten') }}
            {{ Form::text('url', '', ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Shorten!', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
