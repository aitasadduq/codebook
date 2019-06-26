<?php

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
    // return redirect('categories');
});
Route::resource('categories', 'CategoryController');
Route::get('categories/{category}/codes', 'CodeController@index');
Route::get('categories/{category}/codes/create', 'CodeController@create');
Route::post('categories/{category}/codes', 'CodeController@store');
Route::get('categories/{category}/codes/{code}', 'CodeController@show');
Route::get('categories/{category}/codes/{code}/edit', 'CodeController@edit');
Route::patch('categories/{category}/codes/{code}', 'CodeController@update');
Route::delete('categories/{category}/codes/{code}', 'CodeController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
