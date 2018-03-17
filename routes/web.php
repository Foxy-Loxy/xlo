<?php

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
    return view('welcome');
});

Auth::routes();
//Main page Routes
Route::get('/', 'PostController@index')->name('home');
//Login routes
Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::post('/logout', 'SessionController@destroy');
//Register routes
Route::get('/register', 'RegisterController@create');
Route::post('/register', 'RegisterController@store');
//Post routes
Route::get('/post/create', 'PostController@create');
Route::post('/post', 'PostController@store');
Route::patch('/post/{id}', 'PostController@update');
Route::get('/post/{id}/edit', 'PostController@edit');
Route::delete('/post/{id}', 'PostController@destroy');
Route::get('/post/id', 'PostController@show');
//Routes for autocomplete field
Route::get('/get/categories', 'AutoInputController@category');
Route::get('/get/cities', 'AutoInputController@city');