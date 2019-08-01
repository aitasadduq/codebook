@extends('layouts.app')
@section('content')
@include('partials.errors')
<div class="card text-center">
	<div id="two" class="card-body">
		<h1 class="card-title">Add New Code</h1>
		<create-code
			:categories="{{ $categories->toJson() }}"
			:default-category="{{ $categories->first()->id }}"
		></create-code>
	</div>
</div>
@include('partials.editor')
@endsection
