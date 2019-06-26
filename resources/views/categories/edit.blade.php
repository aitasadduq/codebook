@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-header">
		<h1>Edit Category</h1>
	</div>
	<div class="card-body">
		<form method="POST" action="/categories/{{ $category->id }}">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" id="title" name="title" class="form-control" value="{{ $category->title }}">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea id="description" name="description" class="form-control">{{ $category->description }}</textarea>
			</div>
			<input class="btn btn-primary" type="submit" name="submit" value="Edit Category">
		</form>
		<br>
		<form method="POST" action="/categories/{{ $category->id }}">
			@csrf
			@method('DELETE')
			<input class="btn btn-danger" type="submit" name="submit" value="Delete Category">
		</form>
	</div>
</div>
@endsection
