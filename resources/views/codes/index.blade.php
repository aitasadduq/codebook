@extends('layouts.app')
@section('content')
	<h1>View Codes</h1>
	<br>
	<ul class="list-group col-md-6">
		@foreach($codes as $code)
			@if($code->code_id == 0)
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<a href="/codes/{{ $code->id }}">{{ $code->title }}</a>
				</li>
			@endif
		@endforeach
	</ul>
	<br>
	<a class="btn btn-primary" href="/codes/create">Add New Code</a>
@endsection
