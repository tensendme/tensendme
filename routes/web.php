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


Route::group(['namespace' => 'Web\v1'], function () {
    Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@welcome']);

    Route::get('/secure/config/migrate-refresh', ['uses' => 'ConfigController@migrateRefresh']);
    Route::get('/secure/config/migrate', ['uses' => 'ConfigController@migrate']);
    Route::get('/secure/config/db-seed', ['uses' => 'ConfigController@dbSeed']);
    Route::get('/secure/config/clear-autoload', ['uses' => 'ConfigController@clearAutoLoad']);
    Route::get('/secure/config/config-cache', ['uses' => 'ConfigController@configCache']);
    Route::get('/secure/config/key-generate', ['uses' => 'ConfigController@keyGenerate']);
    Route::get('/secure/config/optimize', ['uses' => 'ConfigController@optimize']);
    Route::get('/config/locale/{locale}', ['as' => 'locale', 'uses' => 'LocalizationController@index']);

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);


        Route::group(['namespace' => 'Admin'], function () {
            //users
            Route::get('/users', ['uses' => 'UserController@index', 'as' => 'users.index']);

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
            Route::get('/country/create', ['uses' => 'CountryController@create', 'as' => 'country.create']);
            Route::post('/country/store', ['uses' => 'CountryController@store', 'as' => 'country.store']);
            Route::get('/country/edit/{id}', ['uses' => 'CountryController@edit', 'as' => 'country.edit']);
            Route::post('/country/update/{id}', ['uses' => 'CountryController@update', 'as' => 'country.update']);


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
            Route::get('/followers', ['uses' => 'FollowerController@index', 'as' => 'follower.index']);
            Route::get('/withdrawals', ['uses' => 'WithdrawalController@index', 'as' => 'withdrawal.index']);
            Route::post('/withdrawals/approve/{id}', ['uses' => 'WithdrawalController@approve', 'as' => 'withdrawal.approve']);
            Route::post('/withdrawals/cancel/{id}', ['uses' => 'WithdrawalController@cancel', 'as' => 'withdrawal.cancel']);
            Route::get('/histories', ['uses' => 'HistoryController@index', 'as' => 'history.index']);

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

    });


});
