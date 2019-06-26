@extends('layouts/app')
@section('content')
	<h1>{{ $category->title }}</h1>
	<br>
	@if ($category->subCategories->count())
	<ul class="list-group col-md-4">
		@foreach ($category->subCategories as $sub)
		<li class="list-group-item d-flex justify-content-between align-items-center">{{ $sub->title }} <span  class="badge badge-primary badge-pill"><a style="color: white;" href="/categories/{{ $category->id }}/subcategories/{{ $sub->id }}/edit">Edit</a></span></li>
		@endforeach
	</ul>
	@endif
	<br>
	<div class="card">
		<div class="card-body">
			<form method="POST" action="/categories/{{ $category->id }}/subcategories">
				@csrf
				<input class="form-control" type="text" name="title" placeholder="Title">
				<br>
				<input class="btn btn-primary" type="submit" name="submit" value="Add Sub-category">
			</form>
		</div>
	</div>
	<br>
	<a class="btn btn-primary" href="/categories">View All Categories</a>
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/edit">Edit Category</a>
@endsection
