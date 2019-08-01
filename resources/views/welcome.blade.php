@extends('layouts.app')
@include('partials.success')
@section('content')
<div id="one">
    <category-codes :categories="{{ $categories->toJson() }}"></category-codes>
</div>
@endsection
