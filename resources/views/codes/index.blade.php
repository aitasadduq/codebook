@extends('layouts.app')
@section('content')
<div class="text-center"><h1>View Codes</h1></div>
<br>
<div class="row">
	<div class="col-md-3">
		<ul class="list-group">
			@foreach($category->subCategories as $sub)
			<li class="list-group-item d-flex justify-content-between align-items-center">
				{{ $sub->title }}
			</li>
			@endforeach
		</ul>
	</div>
	<div class="col-md-9">
		<ul class="list-group">
			@foreach($codes as $code)
				@if($code->code_id == 0)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<a href="/codes/{{ $code->id }}">{{ $code->title }}</a>
					</li>
				@endif
			@endforeach
		</ul>
	</div>
</div>
<br>
<div class="text-center"><a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/create">Add New Code</a></div>
@endsection
