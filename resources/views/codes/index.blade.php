@extends('layouts.app')
@section('content')
<div class="text-center"><h1>View {{ $category->title }} Codes</h1></div>
<br>
<div class="row">
	<div class="col-md-3">
		<form method="POST" action="/categories/{{ $category->id }}/codes">
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
		<ul class="list-group">
			@foreach($category->codes as $code)
				@if($code->code_id == 0)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<a href="/codes/{{ $code->id }}">{{ $code->title }}</a>
						<div>
							@foreach($code->subcategories as $sub)
							<span class="badge badge-primary badge-pill">
								{{ $sub->title }}
							</span>
							@endforeach
						</div>
					</li>
				@endif
			@endforeach
		</ul>
	</div>
</div>
<br>
<div class="text-center"><a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/create">Add New Code</a></div>
@endsection
