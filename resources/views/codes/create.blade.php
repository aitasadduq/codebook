@extends('layouts.app')
@section('content')
<div class="card">
	<h1 class="card-header">Add New Code</h1>
	<div class="card-body">
		<form method="POST" action="/codes">
			@csrf
			<input type="hidden" name="code_id" value="0">
			<div class="row">
				<div class="col-md-6 box">
					<div class="form-group">
						<label for="title">Title</label>
						<input class="form-control" type="text" name="title">
					</div>
					<div class="form-group">
						<label for="details">Details</label>
						<textarea class="form-control" name="details"></textarea>
					</div>
					<div class="form-group">
						<label for="code">Code</label>
						<textarea class="form-control" name="code"></textarea>
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" name="submit" value="Add Code">
					</div>
				</div>
				<div class="col-md-6">
					<h3>Select Categories:</h3>
					<ul class="list-group">
						@foreach ($categories as $category)
							@if ($category->category_id == 0)
								<li class="list-group-item">
									<h5 class="card-header">{{ $category->title }}</h5>
									<div class="card-body">
										@if ($category->subCategories->count() === 0)
											@php
												$category->addSubCategory(['title' => $category->title]);
											@endphp
										@endif
										<ul class="list-group">
											@foreach ($category->subCategories as $sub)
												<li class="list-group-item">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="{{ $sub->id }}" id="{{ $sub->id}}">
														<label class="form-check-label" for="{{ $sub->id }}">{{ $sub->title }}</label>
													</div>
												</li>
											@endforeach
										</ul>
									</div>
								</li>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
