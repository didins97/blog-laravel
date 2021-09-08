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



Auth::routes(); 
Route::get('/','BlogController@index')->name('blog.index');
Route::get('/isi-post/{slug}','BlogController@isi_post')->name('blog.isi_post');
Route::get('/list-post','BlogController@list_post')->name('blog.list_post');
Route::get('/list-category/{category}','BlogController@list_category')->name('blog.category');
Route::get('/search', 'BlogController@search')->name('blog.search');

// blog
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/category', 'CategoryController');
    Route::resource('/tag', 'TagController');
    Route::get('/post/show_delete', 'PostController@show_delete')->name('post.show_delete');
    Route::get('/post/restore/{id}', 'PostController@restore')->name('post.restore');
    Route::get('/post/detail/{id}', 'PostController@detail')->name('post.detail');
    Route::delete('/post/kill/{id}', 'PostController@kill')->name('post.kill');
    Route::resource('/post', 'PostController');
    Route::resource('/user', 'UserController');
});


