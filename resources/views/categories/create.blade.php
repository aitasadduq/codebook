@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-header">
		<h1>Add New Category</h1>
	</div>
	<div class="card-body">
		<form method="POST" action="/categories">
			@csrf
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" id="title" name="title" class="form-control">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea id="description" name="description" class="form-control"></textarea>
			</div>
			<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
		</form>
	</div>
</div>
<br>
<a class="btn btn-primary" href="/categories">View All Categories</a>
@endsection
