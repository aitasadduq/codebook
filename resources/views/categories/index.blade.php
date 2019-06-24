@extends('layouts.app')
@section('content')
	<h1>View Categories</h1>
	<br>
	<ul class="list-group col-md-4">
		@foreach ($categories as $category)
			@if ($category->category_id == 0)
				<li class="list-group-item d-flex justify-content-between align-items-center"><a href="/categories/{{ $category->id }}">{{ $category->title }}</a></li>
			@endif
		@endforeach
	</ul>
	<br>
	<a href="/categories/create" class="btn btn-primary">Add New Category</a>
@endsection
