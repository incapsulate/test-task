<?php

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('/', 'API\UserController@get');
            Route::post('logout', 'API\AuthController@logout');
        });

        Route::post('register', 'API\AuthController@register');
        Route::post('login', 'API\AuthController@login');
    });
});
