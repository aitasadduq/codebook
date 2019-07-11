@extends('layouts.app')
@section('content')
<h1 class="text-center">Code Categories</h1>
<br>
<div class="row">
    @forelse ($categories as $cat)
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
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center col-md-12">
            <h4>No categories found.</h4>
            <br>
            <a href="/categories/create" class="btn btn-primary">Add New Category</a>
        </div>
    @endforelse
</div>
@endsection
