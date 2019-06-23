@extends('layouts.app')
@section('content')
	<h1>View Categories</h1>
	<ul style="list-style: none;">
		@foreach ($categories as $category)
			@if ($category->parent_id == 0)
				<li><a href="/categories/{{ $category->id }}">{{ $category->title }}</a></li>
			@endif
		@endforeach
	</ul>
@endsection
