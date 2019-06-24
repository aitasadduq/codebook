@extends('layouts/app')
@section('content')
	<h1>{{ $category->title }}</h1>
	@if ($category->subCategories->count())
	<ul style="list-style: none;">
		@foreach ($category->subCategories as $sub)
		<li>{{ $sub->title }} <a href="/categories/{{ $sub->id }}/edit">Edit</a></li>
		@endforeach
	</ul>
	@endif
	<div class="card">
		<div class="card-body">
			<form method="POST" action="/categories">
				@csrf
				<input type="hidden" name="category_id" value="{{ $category->id }}">
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
