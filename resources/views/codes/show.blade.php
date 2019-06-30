@extends('layouts.app')
@section('content')
<div class="text-center">
	<h1>{{ $category->title }} Code</h1>
	<h3>Subcategories: |
		@foreach($code->subcategories as $sub)
		{{ $sub->title }} |
		@endforeach
	</h3>
</div>
<br>
<div class="card">
	<h2 class="card-header">{{ $code->title }}</h2>
	<div class="card-body">
		<h5>{{ $code->details }}</h5>
		<hr>
		{{-- <div class="card"> --}}
			{{-- <div class="card-body"> --}}<p>{{ $code->code }}</p>{{-- </div> --}}
		{{-- </div> --}}
		@foreach($code->childCodes as $child)
		<div class="card">
			<h2 class="card-header">{{ $child->title }}</h2>
			<div class="card-body">
				<h5>{{ $child->details }}</h5>
				<hr>
				<p>{{ $child->code }}</p>
			</div>
		</div>
		@endforeach

	</div>
</div>
<br>
<div class="text-center">
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $code->id }}/edit">Edit Code</a>
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes">View All Codes</a>
</div>
@endsection
