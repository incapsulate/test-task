<?php

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('{user}', 'API\UserController@get');
        });

        Route::post('registration', 'API\AuthController@registration');
        Route::post('login', 'API\AuthController@login');
    });
});
