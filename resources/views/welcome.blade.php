@extends('layouts.app')
@section('content')
<h1 class="text-center">Code Categories</h1>
<br>
<div class="row">
    @foreach ($categories as $cat)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">{{ $cat->title }}</h4>
                <p class="card-text">{{ $cat->description }}</p>
                <div class="text-center">
                    <form method="GET" action="/categories/{{ $cat->id }}/codes">
                        @csrf
                        <input type="hidden" name="is_filter" value="0">
                        <input class="btn btn-primary" type="submit" name="submit" value="View Codes">
                    </form>
                    {{-- <a class="btn btn-primary" href="/categories/{{ $cat->id }}/codes">View Codes</a> --}}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
