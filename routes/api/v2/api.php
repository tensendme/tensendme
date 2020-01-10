<?php


Route::group(['middleware' => 'api'], function () {

    //UNAUTHENTICATED


    //AUTHENTICATED
    Route::group(['middleware' => 'auth:api'], function () {


    });

});