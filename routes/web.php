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

    Route::delete('/category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.destroy']);

    Route::get('/courses', ['uses' => 'CourseController@index', 'as' => 'course.index']);
    Route::get('/courses/create', ['uses' => 'CourseController@create', 'as' => 'course.create']);
    Route::get('/courses/edit/{id}', ['uses' => 'CourseController@edit', 'as' => 'course.edit']);
    Route::post('/courses/edit/{id}', ['uses' => 'CourseController@update', 'as' => 'course.update']);
    Route::post('/courses/create', ['uses' => 'CourseController@store', 'as' => 'course.store']);
    Route::post('/courses/visible/{id}', ['uses' => 'CourseController@visibleChange', 'as' => 'course.visible']);

    Route::get('/course/materials/{course_id}', ['uses' => 'CourseMaterialController@index', 'as' => 'course.material.index']);
    Route::get('/course/materials/create/{course_id}', ['uses' => 'CourseMaterialController@create', 'as' => 'course.material.create']);
    Route::post('/course/materials/create/{course_id}', ['uses' => 'CourseMaterialController@store', 'as' => 'course.material.store']);
    Route::get('/course/materials/edit/{id}', ['uses' => 'CourseMaterialController@edit', 'as' => 'course.material.edit']);
    Route::post('/course/materials/edit/{id}', ['uses' => 'CourseMaterialController@update', 'as' => 'course.material.update']);
    Route::delete('/course/materials/delete/{id}', ['uses' => 'CourseMaterialController@delete', 'as' => 'course.material.delete']);

});
