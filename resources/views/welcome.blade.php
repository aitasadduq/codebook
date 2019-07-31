@extends('layouts.app')
@section('content')
<div id="one">
    <category-codes :categories="{{ $categories->toJson() }}"></category-codes>
</div>
@endsection
