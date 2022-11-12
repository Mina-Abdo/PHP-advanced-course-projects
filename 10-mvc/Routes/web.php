<?php

use Src\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\LoginController;




Route::get('/profile',function(){
    echo "profile";
});

Route::get('home',[HomeController::class,'index']);

Route::post('login',[LoginController::class,'login']);

Route::get('register','App\Controllers\LoginController@register');


// x