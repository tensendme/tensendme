<?php


Route::group(['middleware' => 'api'], function () {

    //UNAUTHENTICATED
    Route::group(['namespace' => 'Auth'], function () {

        Route::post('/login', ['uses' => 'AuthController@login']);
        Route::post('/register', ['uses' => 'AuthController@register']);
        Route::post('/code/send', ['uses' => 'CodeController@sendCode']);
        Route::post('/code/check', ['uses' => 'CodeController@checkCode']);
        Route::post('/code/reset', ['uses' => 'CodeController@resetCode']);
        Route::post('/login/check', ['uses' => 'AuthController@checkLogin']);
    });

    Route::group(['namespace' => 'StaticFunc'], function () {
        Route::get('/countries', ['uses' => 'StaticController@getAllCountries']);
    });


    Route::group(['namespace' => 'Category'], function () {

        Route::get('/categories', ['uses' => 'CategoryController@getCategories']);
        Route::get('/courses/categories', ['uses' => 'CategoryController@getCoursesCategories']);
        Route::get('/meditations/categories', ['uses' => 'CategoryController@getMeditationsCategories']);
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/recommended/categories', ['uses' => 'CategoryController@recommendedCategories']);
        });

    });

    Route::group(['namespace' => 'Meditation'], function () {

        Route::get('/meditations', ['uses' => 'MeditationController@getAllMeditations']);

    });

    Route::group(['namespace' => 'Course'], function () {

        Route::get('/courses', ['uses' => 'CourseController@getAllCourses']);
        Route::get('/courses/category/{categoryId}', ['uses' => 'CourseController@getCoursesByCategory']);

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('courses/for/me', ['uses' => 'CourseController@coursesForMe']);
        });

        //Material
        Route::get('courses/material/{id}', ['uses' => 'MaterialController@getMaterialById']);

    });

    Route::group(['namespace' => 'Subscription'], function () {

        Route::get('/subscription/types', ['uses' => 'SubscriptionController@getSubscriptionTypes']);
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/subscribe/{subscribeTypeId}', ['uses' => 'SubscriptionController@subscribe']);
        });
    });

    Route::group(['namespace' => 'Withdrawal'], function () {

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/withdrawal/make', ['uses' => 'WithdrawalController@withdrawalRequest']);
        });
    });

    Route::group(['namespace' => 'Follower'], function () {

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/follow', ['uses' => 'FollowerController@follow']);
        });
    });

    Route::group(['namespace' => 'Advertisement'], function () {

        Route::get('/news', ['uses' => 'NewsController@getAllNews']);
        Route::get('/newsPaginated', ['uses' => 'NewsController@getAllNewsPaginated']);
        Route::get('/news/{id}', ['uses' => 'NewsController@getNewsById']);

        Route::get('/banners', ['uses' => 'BannerController@getAllBanners']);
        Route::get('/bannersPaginated', ['uses' => 'BannerController@getAllBannersPaginated']);
        Route::get('/banner/{id}', ['uses' => 'BannerController@getBannerById']);
        Route::get('/banner/by/location/{id}', ['uses' => 'BannerController@getBannerByLocation']);

    });

//    Route::group(['namespace' => 'Cabinet'], function (){
//        Route::get('cabinet', ['uses'=>'CabinetController']);
//    });
//
       Route::group(['namespace' => 'Rating'], function (){
           Route::group(['middleware' => 'auth:api'], function () {
               Route::post('/evaluate/course', ['uses' => 'RatingController@evaluate']);
           });
    });

    //AUTHENTICATED
    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['namespace' => 'Auth'], function () {

            Route::post('/logout', ['uses' => 'AuthController@logout']);
            Route::post('/refresh', ['uses' => 'AuthController@refresh']);
            Route::post('/me', ['uses' => 'AuthController@me']);
            Route::post('/set-device-token', ['uses' => 'AuthController@setDeviceToken']);

        });
        Route::group(['namespace' => 'Course'], function () {
            Route::get('/users/courses', ['uses' => 'CourseController@getUserCourses']);
            Route::get('courses/{id}', ['uses' => 'CourseController@getById']);
        });

    });

});
