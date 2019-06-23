@extends('layouts/app')
@section('content')
	<h1>{{ $category->title }}</h1>
	@if ($category->subCategories->count())
	<ul style="list-style: none;">
		@foreach ($category->subCategories as $sub)
		<li>{{ $sub->title }}</li>
		@endforeach
	</ul>
	@endif
@endsection
