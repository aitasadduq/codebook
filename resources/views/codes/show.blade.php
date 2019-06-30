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
			<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $child->id }}/edit">Edit Child Code</a>
		</div>
		@endforeach
		<div class="row">
			<div class="col-md-2"></div>
			<div class="card col-md-10">
				<div class="card-body">
					<h3 class="card-title">Add Child Code</h3>
					<form method="POST" action="/categories/{{ $category->id }}/codes">
						@csrf
						<input class="form-control" type="text" name="title" placeholder="Title">
						<br>
						<textarea class="form-control" name="details" placeholder="Details"></textarea>
						<br>
						<textarea class="form-control" name="code" placeholder="Code"></textarea>
						<br>
						<div class="text-right">
							<input class="btn btn-primary" type="submit" name="submit" value="Add Child Code">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="text-center">
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $code->id }}/edit">Edit Code</a>
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes">View All Codes</a>
</div>
@endsection
