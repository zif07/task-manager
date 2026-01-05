@extends('layouts.app')

@section('content')
<div class="container text-center" style="padding: 100px 0;">
    <h1 class="display-1 fw-bold text-warning">500</h1>
    <h2 class="mb-4">System Error</h2>
    <p class="lead mb-5">
        Oops! Something went wrong on our end. Our administrators have been notified. 
        Please try again later.
    </p>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Back to Safety</a>
</div>
@endsection