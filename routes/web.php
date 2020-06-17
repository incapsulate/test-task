<?php

Route::get('/', function () {
    return view('index');
});

// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('index');
})->where('any', '^(?!api\/)[\/\w\.-]*');
