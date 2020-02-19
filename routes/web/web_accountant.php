<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 25.11.2019
 * Time: 12:33
 */


Route::group([ 'prefix' => 'accountant'], function () {

    Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/users', ['uses' => 'UserController@index', 'as' => 'users.index']);

    Route::get('/subscriptions', ['uses' => 'SubscriptionController@index', 'as' => 'subscription.index']);
    Route::get('/followers', ['uses' => 'FollowerController@index', 'as' => 'follower.index']);
    Route::get('/withdrawals', ['uses' => 'WithdrawalController@index', 'as' => 'withdrawal.index']);
    Route::post('/withdrawals/approve/{id}', ['uses' => 'WithdrawalController@approve', 'as' => 'withdrawal.approve']);
    Route::post('/withdrawals/cancel/{id}', ['uses' => 'WithdrawalController@cancel', 'as' => 'withdrawal.cancel']);
    Route::get('/histories', ['uses' => 'HistoryController@index', 'as' => 'history.index']);



});
