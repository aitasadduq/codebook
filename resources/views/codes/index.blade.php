@extends('layouts.app')
@section('content')
@include('partials.success')
<div class="row">
	<div class="col-md-2"><a class="btn btn-primary" href="/">< Code Categories</a></div>
	<div class="text-center col-md-8"><h1>{{ $category->title }} Codes</h1></div>
	<div class="col-md-2 text-right"><a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/create">Add New Code</a></div>
</div>
<br>
<div class="row">
	<div class="col-md-3">
		<form method="GET" action="/categories/{{ $category->id }}/codes">
			@csrf
			<input type="hidden" name="is_filter" value="1">
			<div class="card">
				<div class="card-body text-center">
					<h3 class="card-title">Subcategories</h3>
				</div>
				<ul class="list-group list-group-flush">
					@foreach($category->subCategories as $sub)
					<li class="list-group-item">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="{{ $sub->id }}" id="{{ $sub->id }}">
							<label class="form-check-label" for="{{ $sub->id }}">{{ $sub->title }}</label>
						</div>
					</li>
					@endforeach
				</ul>
				<div class="card-body text-center">
					<input class="btn btn-primary" type="submit" name="submit" value="Filter">
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-9">
		@foreach($codes as $code)
			@if($code->code_id == 0)
				<div class="card">
					<div class="card-body">
						<h3><a class="card-title" href="/codes/{{ $code->id }}">{{ $code->title }}</a></h3>
						<p class="card-text">{{ $code->details }}</p>
						<div class="text-right">
							@foreach($code->subcategories as $sub)
							<span class="badge badge-primary badge-pill">
								{{ $sub->title }}
							</span>
							@endforeach
						</div>
					</div>
				</div>
				<br>
			@endif
		@endforeach
	</div>
</div>
<br>
<div class="text-center"><a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/create">Add New Code</a> <a class="btn btn-primary" href="/">Code Categories</a></div>
@endsection
