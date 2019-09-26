@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        Success!
    </div>

    <p>Your URL has been shortened, your new URL is: <a href="{{ route('urls.redirectShortUrl', ['path' => $url->short_path]) }}">{{ route('urls.redirectShortUrl', ['path' => $url->short_path]) }}</a></p>
@endsection
