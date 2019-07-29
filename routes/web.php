<?php

use App\Code;
use App\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$categories = Category::all();
    return view('welcome', compact('categories'));
});
Route::get('/categories/{category}/codes', 'CodeController@index');
Route::get('/categories/{category}/codes/create', 'CodeController@create');
Route::post('/categories/{category}/codes', 'CodeController@store');
Route::post('/categories/{category}/subcategories', 'SubcategoryController@store');

Route::resource('categories', 'CategoryController');
Route::resource('codes', 'CodeController')->except(['index', 'create', 'store']);
Route::resource('subcategories', 'SubcategoryController')->except(['store']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categorycodes/{category}', function(Category $category) {
    return $category->codes()->where('code_id', 0)->get();
});
Route::get('/categorysubcategories/{category}', function(Category $category) {
    return $category->subcategories()->get();
});
Route::get('/categorytitle/{category}', function(Category $category) {
    return $category->title;
});
Route::get('/codesubcategories/{code}', function(Code $code) {
    return $code->subcategories()->get();
});
