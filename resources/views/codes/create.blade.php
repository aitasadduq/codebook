@extends('layouts.app')
@section('content')
<div class="card text-center">
	<div class="card-body">
		<h1 class="card-title">Add New Code</h1>
		<form method="POST" action="/categories/{{ $category->id }}/codes">
			@csrf
			<input type="hidden" name="code_id" value="0">
			<div class="row">
				<div class="col-md-4">
					<h3>Select Subcategories</h3>
					@if ($category->subCategories->count() === 0)
						@php
							$category->addSubCategory(['title' => $category->title]);
						@endphp
					@endif
					<ul class="list-group text-left">
						@foreach ($category->subCategories as $sub)
							<li class="list-group-item">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="{{ $sub->id }}" id="{{ $sub->id}}">
									<label class="form-check-label" for="{{ $sub->id }}">{{ $sub->title }}</label>
								</div>
							</li>
						@endforeach
						{{-- @foreach ($categories as $category)
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
						@endforeach --}}
					</ul>
				</div>
				<div class="col-md-8 box">
					<div class="form-group text-left">
						<label for="title">Title</label>
						<input class="form-control" type="text" name="title">
					</div>
					<div class="form-group text-left">
						<label for="details">Details</label>
						<textarea class="form-control" name="details"></textarea>
					</div>
					<div class="form-group text-left">
						<label for="code">Code</label>
						<textarea class="form-control" name="code"></textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" name="submit" value="Add Code">
			</div>
		</form>
	</div>
</div>
@endsection
