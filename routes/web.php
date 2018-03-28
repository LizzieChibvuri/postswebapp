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

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get ("/",function(){
	return view('pages.home');
});
*/

Route::get ("/","PostsController@index")->name('pages.index');

Route::get ("/about",function(){
	return view('pages.about');
})->name('pages.about');

Route::get ("/services","PagesController@services")->name('pages.services');

Route::resource('posts','PostsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
