@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1 class="h2">Welcome to my URL Shortener</h1>
        <a class="btn btn-primary btn-lg" href="{{ route('urls.create') }}" role="button">Get started &raquo;</a>
    </div>
    <h2 class="h3">Most visited links</h2>
    <table class="table table-striped">
        <tr>
            <th>Short link</th>
            <th>Visits</th>
        </tr>
        @forelse($mostVisited as $visited)
            <tr>
                <td><a href="{{ route('urls.redirectShortUrl', ['path' => $visited->short_path]) }}">{{ route('urls.redirectShortUrl', ['path' => $visited->short_path]) }}</a></td>
                <td>{{ $visited->visits }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2"><p>There are no URLs to display</p></td>
            </tr>
        @endforelse
    </table>
@endsection
