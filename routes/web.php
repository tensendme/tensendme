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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Web\v1\Admin'], function () {

    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::get('/category/create','CategoryController@create')->name('category.create');
    Route::post('/category/store','CategoryController@store')->name('category.store');
    Route::get('/category/edit/{id}','CategoryController@edit')->name('category.edit');
    Route::post('/category/update/{id}','CategoryController@update')->name('category.update');
    Route::delete('/category/delete/{id}','CategoryController@destroy')->name('category.destroy');
});
