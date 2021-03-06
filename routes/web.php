<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('admin.home');



Route::group(['middleware' => 'auth'], function () {
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('tag', 'TagController');
    Route::resource('post', 'PostController');
});
