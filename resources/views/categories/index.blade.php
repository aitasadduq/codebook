@extends('layouts.app')
@section('content')
@include('partials.success')
	<div class="container text-center col-md-4">
		<h1>View Sections</h1>
		<br>
		<ul class="list-group">
			@foreach ($categories as $category)
				<li class="list-group-item d-flex justify-content-between align-items-center"><a href="/categories/{{ $category->id }}">{{ $category->title }}</a> <span class="badge badge-primary badge-pill"><a style="color: white;" href="/categories/{{ $category->id }}/edit">Edit</a></span></li>
			@endforeach
		</ul>
		<br>
		<a href="/categories/create" class="btn btn-primary">Add New Section</a>
	</div>
@endsection
