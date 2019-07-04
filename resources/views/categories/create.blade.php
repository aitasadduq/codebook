@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		@include('partials.errors')
		<div class="card">
			<div class="card-body text-center">
				<h1 class="card-title">Add New Category</h1>
				<form method="POST" action="/categories">
					@csrf
					<div class="form-group text-left">
						<label for="title">Title</label>
						<input type="text" id="title" name="title" class="form-control">
					</div>
					<div class="form-group text-left">
						<label for="description">Description</label>
						<textarea id="description" name="description" class="form-control"></textarea>
					</div>
					<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<br>
<div class="text-center">
	<a class="btn btn-primary" href="/categories">View All Categories</a>
</div>
@endsection
