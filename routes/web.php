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
Route::get('/login', 'SessionController@create')->name('login');
Route::post('/login', 'SessionController@store');
Route::post('/logout', 'SessionController@destroy');
//Register routes
Route::get('/register', 'RegisterController@create')->name('register');
Route::post('/register', 'RegisterController@store');
//Post routes
Route::get('/post/create', 'PostController@create')->name('add');
Route::post('/post', 'PostController@store');
Route::patch('/post/{post}', 'PostController@edit');
Route::get('/post/{post}/edit', 'PostController@update');
Route::delete('/post/{post}', 'PostController@destroy');
Route::get('/post/{post}', 'PostController@show');
//Routes for autocomplete field
Route::get('/get/categories', 'AutoInputController@category');
Route::get('/get/cities', 'AutoInputController@city');
//Routes for search
Route::get('/search', 'SearchController@index')->name('search');
Route::get('/result', 'SearchController@show');
//Routes for dashboard
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/home/favourites/{post}', 'HomeController@store');
Route::delete('/user/{user}/delete', 'HomeController@delete');
//Routes for AJAX requests
Route::post('/ajax/phone/{post}', 'AjaxController@phone');
Route::post('/ajax/uploadPhoto', 'AjaxController@uploadPhoto');
Route::post('/ajax/thumbPhoto', 'AjaxController@thumbnailPhoto');
Route::post('/ajax/deletePhoto', 'AjaxController@deletePhoto');