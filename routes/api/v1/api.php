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

        Route::get('/faqs', ['uses' => 'StaticController@getAllFaqs']);
        Route::get('/about/tensend', ['uses' => 'StaticController@getAboutTensend']);
        Route::get('/about/app', ['uses' => 'StaticController@aboutTensend']);


        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/levels', ['uses' => 'StaticController@getAllLevels']);
        });
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

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('meditation/{id}', ['uses' => 'MeditationController@getMeditation'])->where('id', '[0-9]+');
        });
    });

    Route::group(['namespace' => 'Course'], function () {
//        Route::post('courses/material/{id}', ['uses' => 'MaterialController@videoCompress'])->where('id', '[0-9]+');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/courses', ['uses' => 'CourseController@getAllCourses']);
            Route::get('/courses/category/{categoryId}', ['uses' => 'CourseController@getCoursesByCategory'])
                ->where('categoryId', '[0-9]+');
            Route::get('courses/for/me', ['uses' => 'CourseController@coursesForMe']);
            Route::get('/users/courses', ['uses' => 'CourseController@getUserCourses']);
            Route::get('courses/{id}', ['uses' => 'CourseController@getById'])->where('id', '[0-9]+');
            Route::get('courses/certificate/{id}', ['uses' => 'CourseController@certificate'])->where('id', '[0-9]+');
            Route::get('courses/certificate/url/{id}', ['uses' => 'CourseController@certificateUrl'])->where('id', '[0-9]+');
            Route::post('courses/material/pass', ['uses' => 'PassingController@passCourseLesson']);
            Route::post('courses/start/{id}', ['uses' => 'PassingController@startCourse'])->where('id', '[0-9]+');
            //Material
            Route::get('courses/material/{id}', ['uses' => 'MaterialController@getMaterialById'])->where('id', '[0-9]+');
        });
    });

    Route::group(['namespace' => 'Subscription'], function () {

        Route::get('/subscription/types', ['uses' => 'SubscriptionController@getSubscriptionTypes']);
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/subscribe/{subscribeTypeId}', ['uses' => 'SubscriptionController@subscribe'])
                ->where('subscribeTypeId', '[0-9]+');;
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

    Route::group(['namespace' => 'CloudPayments'], function () {

//        Route::group(['middleware' => 'auth:api'], function () {


        Route::post('/3d/secure', ['uses' => 'PaymentController@send3dSecure']);
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/pay', ['uses' => 'PaymentController@subscribe']);

//            Route::get('/pay', ['uses' => 'PaymentController@subscribe']);
            Route::get('/saveCard', ['uses' => 'PaymentController@saveCard']);
            Route::get('/user/cards', ['uses' => 'PaymentController@getCardsByUserId']);
            Route::post('/save/transaction', ['uses' => 'PaymentController@saveTransaction']);
            Route::post('/send/crypto', ['uses' => 'PaymentController@sendCrypto']);
            Route::post('/card/pay', ['uses' => 'PaymentController@cardPay']);
            Route::post('/delete/card/{id}', ['uses' => 'PaymentController@deleteCard']);
            Route::get('/makeWithdraw', ['uses' => 'PaymentController@makeWithdraw']);

        });
    });

    Route::group(['namespace' => 'Advertisement'], function () {


        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/news', ['uses' => 'NewsController@getAllNews']);
            Route::get('/newsPaginated', ['uses' => 'NewsController@getAllNewsPaginated']);
            Route::get('/news/{id}', ['uses' => 'NewsController@getNewsById'])->where('id', '[0-9]+');
            Route::get('/locations', ['uses' => 'BannerController@getAllLocations']);

            Route::get('/banners', ['uses' => 'BannerController@getAllBanners']);
            Route::get('/bannersPaginated', ['uses' => 'BannerController@getAllBannersPaginated']);
            Route::get('/banner/{id}', ['uses' => 'BannerController@getBannerById'])->where('id', '[0-9]+');
            Route::get('/banner/location/{location}', ['uses' => 'BannerController@getBannerByLocation']);
        });
    });

//    Route::group(['namespace' => 'Cabinet'], function (){
//        Route::get('cabinet', ['uses'=>'CabinetController']);
//    });
//
    Route::group(['namespace' => 'Rating'], function () {
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/evaluate/course', ['uses' => 'RatingController@evaluate']);
            Route::post('/evaluate/meditation', ['uses' => 'RatingController@evaluateMeditation']);
            Route::get('/evaluate/rating', ['uses' => 'RatingController@userRating']);
        });
    });

    //AUTHENTICATED
    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['namespace' => 'Auth'], function () {

            Route::post('/logout', ['uses' => 'AuthController@logout']);
            Route::post('/refresh', ['uses' => 'AuthController@refresh']);
            Route::post('/me', ['uses' => 'AuthController@me']);
            Route::post('/set-device-token', ['uses' => 'AuthController@setDeviceToken']);
            Route::post('/reset/password', ['uses' => 'AuthController@resetPassword']);

        });

        Route::group(['namespace' => 'Profile'], function () {

            Route::post('/profile/update', ['uses' => 'ProfileController@updateProfile']);
            Route::post('/profile/avatar', ['uses' => 'ProfileController@changeAvatar']);
            Route::get('/profile', ['uses' => 'ProfileController@myProfile']);
            Route::get('/profile/certificates', ['uses' => 'ProfileController@myCertificates']);
            Route::get('/profile/promo-code', ['uses' => 'ProfileController@getMyReferralLink']);
            Route::get('/profile/marketing-materials', ['uses' => 'ProfileController@myMarketingMaterials']);
        });
    });

});
