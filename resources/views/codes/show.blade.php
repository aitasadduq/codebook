@extends('layouts.app')
@section('content')
<div class="text-center">
	<h1>{{ $category->title }} Code</h1>
</div>
<br>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">
				<h2>{{ $code->title }}</h2>
			</div>
			<div class="col-md-6 text-right">
				@foreach($code->subcategories as $sub)
				<span class="badge badge-primary badge-pill">{{ $sub->title }}</span>
				@endforeach
			</div>
		</div>
	</div>
	{{-- <h2 class="card-header">{{ $code->title }}</h2> --}}
	<div class="card-body">
		<h5>{{ $code->details }}</h5>
		<hr>
		{{-- <div class="card"> --}}
			{{-- <div class="card-body"> --}}<p>{{ $code->code }}</p>{{-- </div> --}}
		{{-- </div> --}}
		@foreach($code->childCodes as $child)
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-6">
								<h2>{{ $child->title }}</h2>
							</div>
							<div class="col-md-6 text-right">
								@foreach($code->subcategories as $sub)
								<span class="badge badge-primary badge-pill">{{ $sub->title }}</span>
								@endforeach
							</div>
						</div>
					</div>
					{{-- <h2 class="card-header">{{ $child->title }}</h2> --}}
					<div class="card-body">
						<h5>{{ $child->details }}</h5>
						<hr>
						<p>{{ $child->code }}</p>
						<div class="text-center">
							<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $child->id }}/edit">Edit Child Code</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<br>
		@endforeach
		<hr>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Add Child Code</h3>
						<form method="POST" action="/categories/{{ $category->id }}/codes">
							@csrf
							<input type="hidden" name="code_id" value="{{ $code->id }}">
							<input class="form-control" type="text" name="title" placeholder="Title">
							<br>
							<textarea class="form-control" name="details" placeholder="Details"></textarea>
							<br>
							<textarea class="form-control" name="code" placeholder="Code"></textarea>
							<br>
							<div class="text-center">
								<input class="btn btn-primary" type="submit" name="submit" value="Add Child Code">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>
<br>
<div class="text-center">
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $code->id }}/edit">Edit Code</a>
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes">View All Codes</a>
</div>
@endsection
