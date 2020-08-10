<?php

Route::namespace('User')->name('user')->group(function(){
    Route::get('login', 'AuthController@login')->name('.login');
    Route::post('login', 'AuthController@authLogin')->name('.login.auth');
    Route::get('register', 'AuthController@register')->name('.register');
    Route::post('register', 'AuthController@authRegister')->name('.register.auth');
    Route::get('verify/{id}', 'AuthController@verify')->name('.verify');
    Route::post('verify/{id}', 'AuthController@verifyResend')->name('.verify.resend');
    Route::get('verify/token/{token}', 'AuthController@verifyToken')->name('.verify.token');
    
    Route::get('forgot', 'AuthController@forgot')->name('.forgot');
    Route::post('forgot', 'AuthController@recover')->name('.recover');
    Route::get('forgot/{token}', 'AuthController@forgotToken')->name('.forgot.token');
    Route::post('forgot/{token}', 'AuthController@password')->name('.password');

    Route::get('subscription', 'SubscriptionController@payment')->name('.payment');
    Route::post('payment', 'SubscriptionController@paymentExe')->name('.payment.exe');
});