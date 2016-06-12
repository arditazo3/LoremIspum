@extends('layouts.admin-simple')

@section('content')

<h1>404</h1>
<h3 class="font-bold">Page Not Found</h3>

<div class="error-desc">
    Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
    <form class="form-inline m-t" role="form">
        <a href="{{ url('/') }}" class="btn btn-primary">Return to home</a>
    </form>
</div>

@endsection


