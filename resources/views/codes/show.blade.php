@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="card">
			<h4 class="card-header">Categories</h4>
			<div class="card-body">
				<ul class="list-group">
					@foreach ($code->subcategories as $cat)
						<li class="list-group-item d-flex justify-content-between align-items-center">
							{{ $cat->title }}
							<span class="badge badge-primary badge-pill">
								{{ app('App\Category')::find($cat->category_id)->title }}
							</span>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<h1>Code</h1>
		<div class="card">
			<h2 class="card-header">{{ $code->title }}</h2>
			<div class="card-body">
				<p>{{ $code->details }}</p>
				<div class="card">
					<div class="card-body"><p>{{ $code->code }}</p></div>
				</div>
			</div>
		</div>
		<br>
		<div class="float-right">
			<a class="btn btn-primary" href="/codes">Edit Code</a>
			<a class="btn btn-primary" href="/codes">View All Codes</a>
		</div>
	</div>
</div>
@endsection
