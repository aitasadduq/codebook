@extends('layouts.app')
@section('content')
<h1 class="text-center">Code Categories</h1>
<br>
<div id="one">
    <category-list
        :categories="{{ $categories->toJson() }}"
        :primary-button-text="`View All Codes`"
    ></category-list>
    <hr>
</div>
@endsection
