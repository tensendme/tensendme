<?php


Route::group(['middleware' => 'api'], function () {

    //UNAUTHENTICATED
    Route::group(['namespace' => 'Auth'], function () {

        Route::post('/login', ['uses' => 'AuthController@login']);
        Route::post('/register', ['uses' => 'AuthController@register']);
        Route::post('/code/send', ['uses' => 'CodeController@sendCode']);
        Route::post('/code/check', ['uses' => 'CodeController@checkCode']);
        Route::post('/login/check', ['uses' => 'AuthController@checkLogin']);

    });

    Route::group(['namespace' => 'Category'], function () {

        Route::get('/categories', ['uses' => 'CategoryController@getAllCategories']);

    });

    Route::group(['namespace' => 'Meditation'], function () {

        Route::get('/meditations', ['uses' => 'MeditationController@getAllMeditations']);

    });

    Route::group(['namespace' => 'Course'], function () {

        Route::get('/courses', ['uses' => 'CourseController@getAllCourses']);


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

//    Route::group(['name space' => 'Cabinet'], function (){
//        Route::get('cabinet', ['uses'=>'CabinetController']);
//    });

    //AUTHENTICATED
    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['namespace' => 'Auth'], function () {

            Route::post('/logout', ['uses' => 'AuthController@logout']);
            Route::post('/refresh', ['uses' => 'AuthController@refresh']);
            Route::post('/me', ['uses' => 'AuthController@me']);

        });
        Route::group(['namespace' => 'Course'], function () {
            Route::get('/user/courses', ['uses' => 'CourseController@getUserCourses']);

        });

    });

});
