@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		@include('partials.errors')
		<div class="card text-center">
			<div class="card-body">
				<h1 class="card-title">Edit Category</h1>
				<form method="POST" action="/subcategories/{{ $subcategory->id }}">
					@csrf
					@method('PATCH')
					<div class="form-group text-left">
						<label for="title" >Title</label>
						<input class="form-control" type="text" name="title" id="title" value="{{ $subcategory->title }}">
					</div>
					<input class="btn btn-primary" type="submit" name="submit" value="Edit Category">
				</form>
				<br>
				<form method="POST" action="/subcategories/{{ $subcategory->id }}">
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
