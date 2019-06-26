@extends('layouts.app')
@section('content')
<h1 class="text-center">Code Categories</h1>
<br>
<div class="row">
    @foreach ($categories as $cat)
    <div class="card col-md-4">
        <div class="card-body">
            <h4 class="card-title text-center">{{ $cat->title }}</h4>
            <p class="card-text">{{ $cat->description }}</p>
            <div class="text-center">
                <a class="btn btn-primary" href="/codes">View Codes</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
