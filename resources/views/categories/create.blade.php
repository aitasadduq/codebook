@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-header">
		<h1>Add New Category</h1>
	</div>
	<div class="card-body">
		<form method="POST" action="categories/">
			@csrf
			<input type="text" name="title" class="form-control" placeholder="Title">
			<br>
			<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
		</form>
	</div>
</div>
<br>
<a class="btn btn-primary" href="/categories">View All Categories</a>
@endsection
