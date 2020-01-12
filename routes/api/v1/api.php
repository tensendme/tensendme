<?php


Route::group(['middleware' => 'api'], function () {

    //UNAUTHENTICATED
    Route::group(['namespace' => 'Auth'], function () {

        Route::post('/login', ['uses' => 'AuthController@login']);
        Route::post('/code/send', ['uses' => 'CodeController@sendCode']);
        Route::post('/code/check', ['uses' => 'CodeController@checkCode']);

    });

    //AUTHENTICATED
    Route::group(['middleware' => 'auth:api'], function () {

        Route::group(['namespace' => 'Auth'], function () {

            Route::post('/logout', ['uses' => 'AuthController@logout']);
            Route::post('/refresh', ['uses' => 'AuthController@refresh']);
            Route::post('/me', ['uses' => 'AuthController@me']);

        });
    });

});
