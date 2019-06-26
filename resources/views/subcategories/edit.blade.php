@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-body">
		<h1 class="card-title">Edit Subcategory</h1>
		<form method="POST" action="/categories/{{ $category->id }}/subcategories/{{ $subcategory->id }}">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label for="title" >Title</label>
				<input class="form-control" type="text" name="title" id="title">
			</div>
			<input class="btn btn-primary" type="submit" name="submit" value="Edit Subcategory">
		</form>
	</div>
</div>
@endsection
