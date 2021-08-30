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

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });
Route::get('/home', function () { return view('layouts.master'); });

// blog
Route::resource('/category', 'CategoryController');
Route::resource('/tag', 'TagController');
Route::get('/post/show_delete', 'PostController@show_delete')->name('post.show_delete');
Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
Route::delete('/post/kill/{id}', 'PostController@kill')->name('post.kill');
Route::resource('/post', 'PostController');


