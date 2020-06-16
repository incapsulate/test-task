<?php

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('{user}', 'API\UserController@get');
            Route::post('logout', 'API\AuthController@logout');
        });

        Route::post('registration', 'API\AuthController@register');
        Route::post('login', 'API\AuthController@login');
    });
});
