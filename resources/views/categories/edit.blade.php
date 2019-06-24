@extends('layouts.app')
@section('content')
<div class="card">
	<div class="card-header">
		<?php $text = ($category->category_id == 0) ? "Category" : "Sub-category" ?>
		<h1>Edit {{ $text }}</h1>
	</div>
	<div class="card-body">
		<form method="POST" action="/categories/{{ $category->id }}">
			@csrf
			@method('PATCH')
			<input type="hidden" name="category_id" value="{{ $category->category_id }}">
			<input type="text" name="title" class="form-control" placeholder="Title" value="{{ $category->title }}">
			<br>
			<input class="btn btn-primary" type="submit" name="submit" value="Edit {{ $text }}">
		</form>
		<br>
		<form method="POST" action="/categories/{{ $category->id }}">
			@csrf
			@method('DELETE')
			<input class="btn btn-danger" type="submit" name="submit" value="Delete {{ $text }}">
		</form>
	</div>
</div>
@endsection
