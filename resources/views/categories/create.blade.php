@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-header">
		<h1>Add New Category</h1>
	</div>
	<div class="card-body">
		<form>
			<input type="text" name="title" class="form-control" placeholder="Title">
			<br>
			<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
		</form>
	</div>
</div>
@endsection
