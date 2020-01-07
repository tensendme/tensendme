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

//Auth::routes();

//Route::get('register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
//Route::post('register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);


    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'ResetPasswordController@reset']);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Web\v1\Admin'], function () {
    Route::get('/categories', ['uses' => 'CategoryController@index', 'as' => 'category.index']);
    Route::get('/category/create', ['uses' => 'CategoryController@create', 'as' => 'category.create']);
    Route::post('/category/store', ['uses' => 'CategoryController@store', 'as' => 'category.store']);
    Route::get('/category/edit/{id}', ['uses' => 'CategoryController@edit', 'as' => 'category.edit']);
    Route::post('/category/update/{id}', ['uses' => 'CategoryController@update', 'as' => 'category.update']);
    Route::delete('/category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.delete']);

    Route::get('/levels', ['uses' => 'LevelController@index', 'as' => 'level.index']);
    Route::get('/level/create', ['uses' => 'LevelController@create', 'as' => 'level.create']);
    Route::post('/level/store', ['uses' => 'LevelController@store', 'as' => 'level.store']);
    Route::get('/level/edit/{id}', ['uses' => 'LevelController@edit', 'as' => 'level.edit']);
    Route::post('/level/update/{id}', ['uses' => 'LevelController@update', 'as' => 'level.update']);
    Route::delete('/level/delete/{id}', ['uses' => 'LevelController@destroy', 'as' => 'level.delete']);


    Route::get('/countries', ['uses' => 'CountryController@index', 'as' => 'country.index']);

    Route::get('/cities', ['uses' => 'CityController@index', 'as' => 'city.index']);
    Route::get('/city/create', ['uses' => 'CityController@create', 'as' => 'city.create']);
    Route::post('/city/store', ['uses' => 'CityController@store', 'as' => 'city.store']);
    Route::get('/city/edit/{id}', ['uses' => 'CityController@edit', 'as' => 'city.edit']);
    Route::post('/city/update/{id}', ['uses' => 'CityController@update', 'as' => 'city.update']);
    Route::delete('/city/delete/{id}', ['uses' => 'CityController@destroy', 'as' => 'city.delete']);


    Route::get('/subscription/types', ['uses' => 'SubscriptionTypeController@index', 'as' => 'subscription.type.index']);
    Route::get('/subscription/type/create', ['uses' => 'SubscriptionTypeController@create', 'as' => 'subscription.type.create']);
    Route::post('/subscription/type/store', ['uses' => 'SubscriptionTypeController@store', 'as' => 'subscription.type.store']);
    Route::get('/subscription/type/edit/{id}', ['uses' => 'SubscriptionTypeController@edit', 'as' => 'subscription.type.edit']);
    Route::post('/subscription/type/update/{id}', ['uses' => 'SubscriptionTypeController@update', 'as' => 'subscription.type.update']);
    Route::delete('/subscription/type/delete/{id}', ['uses' => 'SubscriptionTypeController@destroy', 'as' => 'subscription.type.delete']);


    Route::get('/subscriptions', ['uses' => 'SubscriptionController@index', 'as' => 'subscription.index']);

});
