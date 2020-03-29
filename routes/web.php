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
use App\Models\Profiles\Role;

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

    Route::get('/certificate', ['as' => 'certificates', 'uses' => 'CertificateController@getCertificate']);

    Route::get('lang/{locale}', ['as' => 'locale.change', 'uses' => 'HomeController@lang']);

    Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@welcome']);

    Route::get('/share/{promoCode}', ['as' => 'promo-code.index', 'uses' => 'HomeController@promoCode']);
    Route::post('/share/{promoCode}', ['as' => 'promo-code.post', 'uses' => 'HomeController@registerPromo']);

    Route::get('/secure/config/send-push', ['uses' => 'ConfigController@sendPush']);
    Route::get('/secure/config/migrate-refresh', ['uses' => 'ConfigController@migrateRefresh']);
    Route::get('/secure/config/migrate', ['uses' => 'ConfigController@migrate']);
    Route::get('/secure/config/db-seed', ['uses' => 'ConfigController@dbSeed']);
    Route::get('/secure/config/clear-autoload', ['uses' => 'ConfigController@clearAutoLoad']);
    Route::get('/secure/config/config-cache', ['uses' => 'ConfigController@configCache']);
    Route::get('/secure/config/key-generate', ['uses' => 'ConfigController@keyGenerate']);
    Route::get('/secure/config/optimize', ['uses' => 'ConfigController@optimize']);
    Route::get('/config/locale/{locale}', ['as' => 'locale', 'uses' => 'LocalizationController@index']);

    Route::get('/pay', ['uses' => 'PaymentController@pay', 'as' => 'cryptogram']);
    Route::get('/saveCard', ['uses' => 'PaymentController@saveCard', 'as' => 'saveCard']);
    Route::get('/status/success', ['uses' => 'PaymentController@status', 'as' => 'transactionStatusSuccess']);
    Route::get('/cardStatus/success', ['uses' => 'PaymentController@cardStatus', 'as' => 'cardStatusSuccess']);
    Route::get('/status/failure', ['uses' => 'PaymentController@status', 'as' => 'transactionStatusFailure']);
    Route::get('/cardStatus/failure', ['uses' => 'PaymentController@cardStatus', 'as' => 'cardStatusFailure']);
    Route::get('/testMobilka', ['uses' => 'PaymentController@test', 'as' => 'testMobilka']);

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);


        Route::group(['namespace' => 'Admin'], function () {
            //users

            Route::get('/profile', ['uses' => 'UserController@profile', 'as' => 'users.profile']);
            Route::post('/profile', ['uses' => 'UserController@updateProfile', 'as' => 'users.profile.update']);
            Route::post('/profile/change/password', ['uses' => 'UserController@updateProfilePassword', 'as' => 'users.profile.updatePassword']);

            Route::group(['middleware' => ['ROLE_OR:' . Role::ACCOUNTANT_ID . ',' . Role::SUPER_ADMIN_ID . ',' . Role::CONTENT_MANAGER_ID]], function () {
                Route::get('/users', ['uses' => 'UserController@index', 'as' => 'users.index']);
                Route::get('/levels', ['uses' => 'LevelController@index', 'as' => 'level.index']);
                Route::get('/countries', ['uses' => 'CountryController@index', 'as' => 'country.index']);
                Route::get('/cities', ['uses' => 'CityController@index', 'as' => 'city.index']);
                Route::get('/subscription/types', ['uses' => 'SubscriptionTypeController@index', 'as' => 'subscription.type.index']);
                Route::get('/subscriptions', ['uses' => 'SubscriptionController@index', 'as' => 'subscription.index']);
                Route::get('/followers', ['uses' => 'FollowerController@index', 'as' => 'follower.index']);


            });

            Route::group(['middleware' => ['ROLE_OR:' . Role::ACCOUNTANT_ID . ',' . Role::SUPER_ADMIN_ID]], function () {
                Route::get('/withdrawals', ['uses' => 'WithdrawalController@index', 'as' => 'withdrawal.index']);
                Route::post('/withdrawals/approve/{id}', ['uses' => 'WithdrawalController@approve', 'as' => 'withdrawal.approve'])->where('id', '[0-9]+');
                Route::post('/withdrawals/cancel/{id}', ['uses' => 'WithdrawalController@cancel', 'as' => 'withdrawal.cancel'])->where('id', '[0-9]+');
                Route::get('/histories', ['uses' => 'HistoryController@index', 'as' => 'history.index']);

                //AJAX REQUEST
                Route::post('/send/push/{id}' ,['uses' => 'UserController@sendPush']);
            });

            Route::group(['middleware' => ['ROLE_OR:' . Role::CONTENT_MANAGER_ID . ',' . Role::SUPER_ADMIN_ID . ',' . Role::AUTHOR_ID]], function () {

                Route::get('/courses', ['uses' => 'CourseController@index', 'as' => 'course.index']);
                Route::get('/courses/create', ['uses' => 'CourseController@create', 'as' => 'course.create']);
                Route::get('/courses/edit/{id}', ['uses' => 'CourseController@edit', 'as' => 'course.edit'])->where('id', '[0-9]+');
                Route::post('/courses/edit/{id}', ['uses' => 'CourseController@update', 'as' => 'course.update'])->where('id', '[0-9]+');
                Route::post('/courses/create', ['uses' => 'CourseController@store', 'as' => 'course.store'])->where('id', '[0-9]+');
                Route::post('/courses/visible/{id}', ['uses' => 'CourseController@visibleChange', 'as' => 'course.visible'])->where('id', '[0-9]+');

                Route::get('/course/materials/{course_id}', ['uses' => 'CourseMaterialController@index', 'as' => 'course.material.index'])->where('course_id', '[0-9]+');
                Route::get('/course/materials/create/{course_id}', ['uses' => 'CourseMaterialController@create', 'as' => 'course.material.create'])->where('course_id', '[0-9]+');
                Route::post('/course/materials/create/{course_id}', ['uses' => 'CourseMaterialController@store', 'as' => 'course.material.store'])->where('course_id', '[0-9]+');
                Route::get('/course/materials/edit/{id}', ['uses' => 'CourseMaterialController@edit', 'as' => 'course.material.edit'])->where('id', '[0-9]+');
                Route::post('/course/materials/edit/{id}', ['uses' => 'CourseMaterialController@update', 'as' => 'course.material.update'])->where('id', '[0-9]+');
                Route::delete('/course/materials/delete/{id}', ['uses' => 'CourseMaterialController@delete', 'as' => 'course.material.delete'])->where('id', '[0-9]+');

            });

            Route::group(['middleware' => ['ROLE_OR:' . Role::CONTENT_MANAGER_ID . ',' . Role::SUPER_ADMIN_ID]], function () {

                Route::get('/meditations', ['uses' => 'MeditationController@index', 'as' => 'meditation.index']);
                Route::get('/meditation/create', ['uses' => 'MeditationController@create', 'as' => 'meditation.create']);
                Route::post('/meditation/create', ['uses' => 'MeditationController@store', 'as' => 'meditation.store']);
                Route::get('/meditation/edit/{id}', ['uses' => 'MeditationController@edit', 'as' => 'meditation.edit'])->where('id', '[0-9]+');
                Route::post('/meditation/edit/{id}', ['uses' => 'MeditationController@update', 'as' => 'meditation.update'])->where('id', '[0-9]+');
                Route::post('/meditation/visible/{id}', ['uses' => 'MeditationController@visibleChange', 'as' => 'meditation.visible'])->where('id', '[0-9]+');


                Route::get('/meditations/themes/{meditationId}', ['uses' => 'MeditationThemeController@index', 'as' => 'meditation.theme.index'])->where('meditationId', '[0-9]+');
                Route::get('/meditations/theme/create/{meditationId}', ['uses' => 'MeditationThemeController@create', 'as' => 'meditation.theme.create'])->where('meditationId', '[0-9]+');
                Route::post('/meditations/theme/create/{meditationId}', ['uses' => 'MeditationThemeController@store', 'as' => 'meditation.theme.store'])->where('meditationId', '[0-9]+');
                Route::get('/meditations/theme/edit/{id}', ['uses' => 'MeditationThemeController@edit', 'as' => 'meditation.theme.edit'])->where('id', '[0-9]+');
                Route::post('/meditations/theme/update/{id}', ['uses' => 'MeditationThemeController@update', 'as' => 'meditation.theme.update'])->where('id', '[0-9]+');

                Route::get('/meditations/audios/{meditationId}', ['uses' => 'MeditationAudioController@index', 'as' => 'meditation.audio.index'])->where('meditationId', '[0-9]+');
                Route::get('/meditations/audios/create/{meditationId}', ['uses' => 'MeditationAudioController@create', 'as' => 'meditation.audio.create'])->where('meditationId', '[0-9]+');
                Route::post('/meditations/audios/store/{meditationId}', ['uses' => 'MeditationAudioController@store', 'as' => 'meditation.audio.store'])->where('meditationId', '[0-9]+');
                Route::get('/meditations/audios/edit/{id}', ['uses' => 'MeditationAudioController@edit', 'as' => 'meditation.audio.edit'])->where('id', '[0-9]+');
                Route::post('/meditations/audios/update/{id}', ['uses' => 'MeditationAudioController@update', 'as' => 'meditation.audio.update'])->where('id', '[0-9]+');

                Route::get('/categories', ['uses' => 'CategoryController@index', 'as' => 'category.index']);
                Route::get('/category/create', ['uses' => 'CategoryController@create', 'as' => 'category.create']);
                Route::post('/category/store', ['uses' => 'CategoryController@store', 'as' => 'category.store']);
                Route::get('/category/edit/{id}', ['uses' => 'CategoryController@edit', 'as' => 'category.edit'])->where('id', '[0-9]+');
                Route::post('/category/update/{id}', ['uses' => 'CategoryController@update', 'as' => 'category.update'])->where('id', '[0-9]+');
                Route::post('/category/visible/{id}', ['uses' => 'CategoryController@visibleChange', 'as' => 'category.visible'])->where('id', '[0-9]+');
                Route::delete('/category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.delete'])->where('id', '[0-9]+');
                Route::delete('/category/delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'category.destroy'])->where('id', '[0-9]+');
                Route::get('/users', ['uses' => 'UserController@index', 'as' => 'users.index']);
                Route::get('/users/filter', ['uses' => 'UserController@filter', 'as' => 'users.filter']);
                Route::get('/authors', ['uses' => 'UserController@authors', 'as' => 'authors']);

                Route::get('/levels', ['uses' => 'LevelController@index', 'as' => 'level.index']);
                Route::get('/level/create', ['uses' => 'LevelController@create', 'as' => 'level.create']);
                Route::post('/level/store', ['uses' => 'LevelController@store', 'as' => 'level.store']);
                Route::get('/level/edit/{id}', ['uses' => 'LevelController@edit', 'as' => 'level.edit'])->where('id', '[0-9]+');
                Route::post('/level/update/{id}', ['uses' => 'LevelController@update', 'as' => 'level.update'])->where('id', '[0-9]+');
                Route::delete('/level/delete/{id}', ['uses' => 'LevelController@destroy', 'as' => 'level.delete'])->where('id', '[0-9]+');


                Route::get('/city/create', ['uses' => 'CityController@create', 'as' => 'city.create']);
                Route::post('/city/store', ['uses' => 'CityController@store', 'as' => 'city.store']);
                Route::get('/city/edit/{id}', ['uses' => 'CityController@edit', 'as' => 'city.edit'])->where('id', '[0-9]+');
                Route::post('/city/update/{id}', ['uses' => 'CityController@update', 'as' => 'city.update'])->where('id', '[0-9]+');
                Route::delete('/city/delete/{id}', ['uses' => 'CityController@destroy', 'as' => 'city.delete'])->where('id', '[0-9]+');

                Route::get('/subscription/type/create', ['uses' => 'SubscriptionTypeController@create', 'as' => 'subscription.type.create']);
                Route::post('/subscription/type/store', ['uses' => 'SubscriptionTypeController@store', 'as' => 'subscription.type.store']);
                Route::post('/subscription/type/change-visibility/{id}', ['uses' => 'SubscriptionTypeController@visibleChange', 'as' => 'subscription.type.visibility']);
                Route::get('/subscription/type/edit/{id}', ['uses' => 'SubscriptionTypeController@edit', 'as' => 'subscription.type.edit'])->where('id', '[0-9]+');
                Route::post('/subscription/type/update/{id}', ['uses' => 'SubscriptionTypeController@update', 'as' => 'subscription.type.update'])->where('id', '[0-9]+');
                Route::delete('/subscription/type/delete/{id}', ['uses' => 'SubscriptionTypeController@destroy', 'as' => 'subscription.type.delete'])->where('id', '[0-9]+');

                Route::get('/locations', ['uses' => 'LocationController@index', 'as' => 'location.index']);
                Route::get('/location/create', ['uses' => 'LocationController@create', 'as' => 'location.create']);
                Route::post('/location/store', ['uses' => 'LocationController@store', 'as' => 'location.store']);
                Route::get('/location/edit/{id}', ['uses' => 'LocationController@edit', 'as' => 'location.edit'])->where('id', '[0-9]+');
                Route::post('/location/update/{id}', ['uses' => 'LocationController@update', 'as' => 'location.update'])->where('id', '[0-9]+');
                Route::delete('/location/delete/{id}', ['uses' => 'LocationController@destroy', 'as' => 'location.delete'])->where('id', '[0-9]+');

                Route::get('/news', ['uses' => 'NewsController@index', 'as' => 'news.index']);
                Route::get('/news/create', ['uses' => 'NewsController@create', 'as' => 'news.create']);
                Route::post('/news/store', ['uses' => 'NewsController@store', 'as' => 'news.store']);
                Route::get('/news/edit/{id}', ['uses' => 'NewsController@edit', 'as' => 'news.edit'])->where('id', '[0-9]+');
                Route::post('/news/update/{id}', ['uses' => 'NewsController@update', 'as' => 'news.update'])->where('id', '[0-9]+');
                Route::delete('/news/delete/{id}', ['uses' => 'NewsController@destroy', 'as' => 'news.delete'])->where('id', '[0-9]+');

                Route::get('/banners', ['uses' => 'BannerController@index', 'as' => 'banner.index']);
                Route::get('/banner/create', ['uses' => 'BannerController@create', 'as' => 'banner.create']);
                Route::post('/banner/store', ['uses' => 'BannerController@store', 'as' => 'banner.store']);
                Route::get('/banner/edit/{id}', ['uses' => 'BannerController@edit', 'as' => 'banner.edit'])->where('id', '[0-9]+');
                Route::post('/banner/update/{id}', ['uses' => 'BannerController@update', 'as' => 'banner.update'])->where('id', '[0-9]+');
                Route::delete('/banner/delete/{id}', ['uses' => 'BannerController@destroy', 'as' => 'banner.delete'])->where('id', '[0-9]+');

                Route::get('/faqs', ['uses' => 'FAQController@index', 'as' => 'faq.index']);
                Route::get('/faq/create', ['uses' => 'FAQController@create', 'as' => 'faq.create']);
                Route::post('/faq/store', ['uses' => 'FAQController@store', 'as' => 'faq.store']);
                Route::get('/faq/edit/{id}', ['uses' => 'FAQController@edit', 'as' => 'faq.edit'])->where('id', '[0-9]+');
                Route::post('/faq/update/{id}', ['uses' => 'FAQController@update', 'as' => 'faq.update'])->where('id', '[0-9]+');
                Route::delete('/faq/delete/{id}', ['uses' => 'FAQController@destroy', 'as' => 'faq.delete'])->where('id', '[0-9]+');

                Route::get('/marketing-materials', ['uses' => 'MarketingMaterialController@index', 'as' => 'marketingMaterial.index']);
                Route::get('/marketing-materials/create', ['uses' => 'MarketingMaterialController@create', 'as' => 'marketingMaterial.create']);
                Route::post('/marketing-materials/store', ['uses' => 'MarketingMaterialController@store', 'as' => 'marketingMaterial.store']);
                Route::get('/marketing-materials/edit/{id}', ['uses' => 'MarketingMaterialController@edit', 'as' => 'marketingMaterial.edit'])->where('id', '[0-9]+');
                Route::post('/marketing-materials/update/{id}', ['uses' => 'MarketingMaterialController@update', 'as' => 'marketingMaterial.update'])->where('id', '[0-9]+');
                Route::delete('/marketing-materials/delete/{id}', ['uses' => 'MarketingMaterialController@destroy', 'as' => 'marketingMaterial.delete'])->where('id', '[0-9]+');

                Route::post('/courses/advertise/{id}', ['uses' => 'CourseController@advertiseChange', 'as' => 'course.advertise'])->where('id', '[0-9]+');

            });

            Route::group(['middleware' => ['ROLE_OR:' . Role::SUPER_ADMIN_ID]], function () {
                Route::get('/level/create', ['uses' => 'LevelController@create', 'as' => 'level.create']);
                Route::post('/level/store', ['uses' => 'LevelController@store', 'as' => 'level.store']);
                Route::get('/level/edit/{id}', ['uses' => 'LevelController@edit', 'as' => 'level.edit'])->where('id', '[0-9]+');
                Route::post('/level/update/{id}', ['uses' => 'LevelController@update', 'as' => 'level.update'])->where('id', '[0-9]+');
                Route::delete('/level/delete/{id}', ['uses' => 'LevelController@destroy', 'as' => 'level.delete'])->where('id', '[0-9]+');

                Route::get('/country/create', ['uses' => 'CountryController@create', 'as' => 'country.create']);
                Route::post('/country/store', ['uses' => 'CountryController@store', 'as' => 'country.store']);
                Route::get('/country/edit/{id}', ['uses' => 'CountryController@edit', 'as' => 'country.edit']);
                Route::post('/country/update/{id}', ['uses' => 'CountryController@update', 'as' => 'country.update']);

                Route::get('/users/{id}', ['uses' => 'UserController@change', 'as' => 'users.edit'])->where('id', '[0-9]+');
                Route::post('/users/{id}', ['uses' => 'UserController@update', 'as' => 'users.update'])->where('id', '[0-9]+');
                Route::get('/users/subscribe/{id}', ['uses' => 'UserController@subscribe', 'as' => 'users.subscribe'])->where('id', '[0-9]+');
                Route::post('/users/subscribe/{id}', ['uses' => 'SubscriptionController@freeSubscribe', 'as' => 'users.subscribe.post'])->where('id', '[0-9]+');
                Route::get('/users/create', ['uses' => 'UserController@create', 'as' => 'users.create']);
                Route::post('/users/store', ['uses' => 'UserController@store', 'as' => 'users.store']);
            });

        });

    });


});
