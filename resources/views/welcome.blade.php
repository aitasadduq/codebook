@extends('layouts.app')
@section('content')
<h1 class="text-center">Code Categories</h1>
<br>
<div id="one">
    <category-list
        :categories="{{ $categories->toJson() }}"
        :primary-button-text="`View All Codes`"
        :secondary-button-text="`View Latest Codes`"
    ></category-list>
    <router-view></router-view>
</div>
@endsection
