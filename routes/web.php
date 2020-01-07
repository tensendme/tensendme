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
    Route::delete('/category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.destroy']);

    Route::get('/courses', ['uses' => 'CourseController@index', 'as' => 'course.index']);
    Route::get('/courses/create', ['uses' => 'CourseController@create', 'as' => 'course.create']);
    Route::get('/courses/edit/{id}', ['uses' => 'CourseController@edit', 'as' => 'course.edit']);
    Route::post('/courses/edit/{id}', ['uses' => 'CourseController@update', 'as' => 'course.update']);
    Route::post('/courses/create', ['uses' => 'CourseController@store', 'as' => 'course.store']);
    Route::post('/courses/visible/{id}', ['uses' => 'CourseController@visibleChange', 'as' => 'course.visible']);

    Route::get('/course/materials', ['uses' => 'CourseMaterialController@index', 'as' => 'course.material.index']);
    Route::get('/course/materials/create', ['uses' => 'CourseMaterialController@create', 'as' => 'course.material.create']);
    Route::post('/course/materials/create', ['uses' => 'CourseMaterialController@store', 'as' => 'course.material.store']);
    Route::get('/course/materials/edit/{id}', ['uses' => 'CourseMaterialController@edit', 'as' => 'course.material.edit']);
    Route::post('/course/materials/edit/{id}', ['uses' => 'CourseMaterialController@update', 'as' => 'course.material.update']);
    Route::delete('/course/materials/delete/{id}', ['uses' => 'CourseMaterialController@delete', 'as' => 'course.material.delete']);

});
