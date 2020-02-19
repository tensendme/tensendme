<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:33
 */


Route::group([ 'prefix' => 'contentManager'], function () {

    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/users', ['uses' => 'UserController@index', 'as' => 'users.index']);

    Route::get('/categories', ['uses' => 'CategoryController@index', 'as' => 'category.index']);
    Route::get('/category/create', ['uses' => 'CategoryController@create', 'as' => 'category.create']);
    Route::post('/category/store', ['uses' => 'CategoryController@store', 'as' => 'category.store']);
    Route::get('/category/edit/{id}', ['uses' => 'CategoryController@edit', 'as' => 'category.edit']);
    Route::post('/category/update/{id}', ['uses' => 'CategoryController@update', 'as' => 'category.update']);
    Route::delete('/category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.delete']);




    Route::get('/levels', ['uses' => 'LevelController@index', 'as' => 'level.index']);



    Route::get('/countries', ['uses' => 'CountryController@index', 'as' => 'country.index']);



    Route::get('/cities', ['uses' => 'CityController@index', 'as' => 'city.index']);



    Route::get('/subscription/types', ['uses' => 'SubscriptionTypeController@index', 'as' => 'subscription.type.index']);
    Route::get('/subscription/type/create', ['uses' => 'SubscriptionTypeController@create', 'as' => 'subscription.type.create']);
    Route::post('/subscription/type/store', ['uses' => 'SubscriptionTypeController@store', 'as' => 'subscription.type.store']);
    Route::get('/subscription/type/edit/{id}', ['uses' => 'SubscriptionTypeController@edit', 'as' => 'subscription.type.edit']);
    Route::post('/subscription/type/update/{id}', ['uses' => 'SubscriptionTypeController@update', 'as' => 'subscription.type.update']);
    Route::delete('/subscription/type/delete/{id}', ['uses' => 'SubscriptionTypeController@destroy', 'as' => 'subscription.type.delete']);


    Route::get('/subscriptions', ['uses' => 'SubscriptionController@index', 'as' => 'subscription.index']);
    Route::get('/followers', ['uses' => 'FollowerController@index', 'as' => 'follower.index']);



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

    Route::get('/meditations', ['uses' => 'MeditationController@index', 'as' => 'meditation.index']);
    Route::get('/meditation/create', ['uses' => 'MeditationController@create', 'as' => 'meditation.create']);
    Route::post('/meditation/create', ['uses' => 'MeditationController@store', 'as' => 'meditation.store']);
    Route::get('/meditation/edit/{id}', ['uses' => 'MeditationController@edit', 'as' => 'meditation.edit']);
    Route::post('/meditation/edit/{id}', ['uses' => 'MeditationController@update', 'as' => 'meditation.update']);

    Route::get('/meditations/themes/{meditationId}', ['uses' => 'MeditationThemeController@index', 'as' => 'meditation.theme.index']);
    Route::get('/meditations/theme/create/{meditationId}', ['uses' => 'MeditationThemeController@create', 'as' => 'meditation.theme.create']);
    Route::post('/meditations/theme/create/{meditationId}', ['uses' => 'MeditationThemeController@store', 'as' => 'meditation.theme.store']);
    Route::get('/meditations/theme/edit/{id}', ['uses' => 'MeditationThemeController@edit', 'as' => 'meditation.theme.edit']);
    Route::post('/meditations/theme/update/{id}', ['uses' => 'MeditationThemeController@update', 'as' => 'meditation.theme.update']);

    Route::get('/locations', ['uses' => 'LocationController@index', 'as' => 'location.index']);
    Route::get('/location/create', ['uses' => 'LocationController@create', 'as' => 'location.create']);
    Route::post('/location/store', ['uses' => 'LocationController@store', 'as' => 'location.store']);
    Route::get('/location/edit/{id}', ['uses' => 'LocationController@edit', 'as' => 'location.edit']);
    Route::post('/location/update/{id}', ['uses' => 'LocationController@update', 'as' => 'location.update']);
    Route::delete('/location/delete/{id}', ['uses' => 'LocationController@destroy', 'as' => 'location.delete']);

    Route::get('/news', ['uses' => 'NewsController@index', 'as' => 'news.index']);
    Route::get('/news/create', ['uses' => 'NewsController@create', 'as' => 'news.create']);
    Route::post('/news/store', ['uses' => 'NewsController@store', 'as' => 'news.store']);
    Route::get('/news/edit/{id}', ['uses' => 'NewsController@edit', 'as' => 'news.edit']);
    Route::post('/news/update/{id}', ['uses' => 'NewsController@update', 'as' => 'news.update']);
    Route::delete('/news/delete/{id}', ['uses' => 'NewsController@destroy', 'as' => 'news.delete']);

    Route::get('/banners', ['uses' => 'BannerController@index', 'as' => 'banner.index']);
    Route::get('/banner/create', ['uses' => 'BannerController@create', 'as' => 'banner.create']);
    Route::post('/banner/store', ['uses' => 'BannerController@store', 'as' => 'banner.store']);
    Route::get('/banner/edit/{id}', ['uses' => 'BannerController@edit', 'as' => 'banner.edit']);
    Route::post('/banner/update/{id}', ['uses' => 'BannerController@update', 'as' => 'banner.update']);
    Route::delete('/banner/delete/{id}', ['uses' => 'BannerController@destroy', 'as' => 'banner.delete']);

    Route::get('/faqs', ['uses' => 'FAQController@index', 'as' => 'faq.index']);
    Route::get('/faq/create', ['uses' => 'FAQController@create', 'as' => 'faq.create']);
    Route::post('/faq/store', ['uses' => 'FAQController@store', 'as' => 'faq.store']);
    Route::get('/faq/edit/{id}', ['uses' => 'FAQController@edit', 'as' => 'faq.edit']);
    Route::post('/faq/update/{id}', ['uses' => 'FAQController@update', 'as' => 'faq.update']);
    Route::delete('/faq/delete/{id}', ['uses' => 'FAQController@destroy', 'as' => 'faq.delete']);

});
