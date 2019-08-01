@extends('layouts.app')
@section('content')
@include('partials.errors')
@include('partials.success')
<div class="row">
	<div class="col-md-2">
		<a class="btn btn-primary" href="/">All Codes</a>
		<br>
	</div>
	<div class="text-center col-md-8">
		<h1>{{ $code->category->title }} Code</h1>
	</div>
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
	<div class="card-body">
		<h5>{{ $code->details }}</h5>
		<br>
		<textarea style="height: 200px" data-readonly="true" data-editor="php" class="form-control" name="code">{{ $code->code }}</textarea>
		<br>
		<div class="text-center">
			<a class="btn btn-primary" href="/codes/{{ $code->id }}/edit">Edit Code</a>
		</div>
		<br>
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
					<div class="card-body">
						<h5>{{ $child->details }}</h5>
						<br>
						<textarea style="height: 200px" data-readonly="true" data-editor="php" class="form-control" name="code">{{ $child->code }}</textarea>
						<br>
						<div class="text-center">
							<a class="btn btn-primary" href="/codes/{{ $child->id }}/edit">Edit Code</a>
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
				@include('partials.errors')
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Add Code</h3>
						<form method="POST" action="/categories/{{ $code->category->id }}/codes">
							@csrf
							<input type="hidden" name="code_id" value="{{ $code->id }}">
							<input class="form-control" type="text" name="title" placeholder="Title">
							<br>
							<textarea class="form-control" name="details" placeholder="Details"></textarea>
							<br>
							<textarea style="height: 200px" data-readonly="false" data-editor="php" class="form-control" name="code" placeholder="Code"></textarea>
							<br>
							<div class="text-center">
								<input class="btn btn-primary" type="submit" name="submit" value="Add Code">
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
	<form method="GET" action="/categories/{{ $code->category->id }}/codes">
		@csrf
		<input type="hidden" name="is_filter" value="0">
		<input class="btn btn-primary" type="submit" name="submit" value="All Codes">
	</form>
</div>
@include('partials.editor')
@endsection
