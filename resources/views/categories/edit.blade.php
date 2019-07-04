@extends('layouts.app')
@section('content')
<div class=row>
	<div class="col-md-2"></div>
	<div class="col-md-8">
	@include('partials.errors')
		<div class="card text-center">
			<div class="card-body">
				<h1 class="card-title">Edit Category</h1>
				<form method="POST" action="/categories/{{ $category->id }}">
					@csrf
					@method('PATCH')
					<div class="form-group text-left">
						<label for="title">Title</label>
						<input type="text" id="title" name="title" class="form-control" value="{{ $category->title }}">
					</div>
					<div class="form-group text-left">
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
	</div>
	<div class="col-md-2"></div>
</div>
@endsection
