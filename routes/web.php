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



Route::get('/', 'HomeController@index');
Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');



Route::group(['middleware' => 'auth'], function (){
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::get('/logout', 'AuthContoller@logout');
});

Route::group(['middleware' => 'guest'], function (){
    Route::get('/register', 'AuthContoller@registerForm');
    Route::post('/register', 'AuthContoller@register');
    Route::get('/login', 'AuthContoller@loginForm')->name('login');
    Route::post('/login', 'AuthContoller@login');
});

Route::group([
    'middleware' => 'admin'
], function (){

});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'admin' ], function (){
    Route::get('/', 'DashboardController@index');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
});


