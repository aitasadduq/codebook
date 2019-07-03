@extends('layouts/app')
@section('content')
@include('partials.errors')
	<div class="container text-center">
		<h1>{{ $category->title }}</h1>
		<br>
		<h4>{{ $category->description }}</h4>
		<br>
		<h2>Subcategories</h2>
		@if ($category->subCategories->count())
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<ul class="list-group">
					@foreach ($category->subCategories as $sub)
					<li class="list-group-item d-flex justify-content-between align-items-center">{{ $sub->title }} <span class="badge badge-primary badge-pill"><a style="color: white;" href="/categories/{{ $category->id }}/subcategories/{{ $sub->id }}/edit">Edit</a></span></li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-4"></div>
		</div>
		@endif
		<br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="card col-md-4">
				<div class="card-body">
					<form method="POST" action="/categories/{{ $category->id }}/subcategories">
						@csrf
						<input class="form-control" type="text" name="title" placeholder="Title">
						<br>
						<input class="btn btn-primary" type="submit" name="submit" value="Add Subcategory">
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
		<br>
		<a class="btn btn-primary" href="/categories">View All Categories</a>
		<a class="btn btn-primary" href="/categories/{{ $category->id }}/edit">Edit Category</a>
	</div>
@endsection
