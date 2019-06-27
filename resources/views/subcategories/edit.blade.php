@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-2"></div>
	<div class="card text-center col-md-8">
		<div class="card-body">
			<h1 class="card-title">Edit Subcategory</h1>
			<form method="POST" action="/categories/{{ $category->id }}/subcategories/{{ $subcategory->id }}">
				@csrf
				@method('PATCH')
				<div class="form-group text-left">
					<label for="title" >Title</label>
					<input class="form-control" type="text" name="title" id="title" value="{{ $subcategory->title }}">
				</div>
				<input class="btn btn-primary" type="submit" name="submit" value="Edit Subcategory">
			</form>
			<br>
			<form method="POST" action="/categories/{{ $category->id }}/subcategories/{{ $subcategory->id }}">
				@csrf
				@method('DELETE')
				<input class="btn btn-danger" type="submit" name="submit" value="Delete Subcategory">
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
@endsection
