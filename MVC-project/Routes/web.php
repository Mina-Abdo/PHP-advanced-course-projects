<?php

use Src\Http\Route;
use App\Controllers\LoginController;
use App\Controllers\ProfileController;

Route::get("home" ,function(){
    echo 'home';

} );
Route::get("/" ,function(){
    echo 'index';
} );
Route::get('profile' , [ProfileController::class , 'index']);

Route::post('login' , [LoginController::class , 'login']);

Route::get('register' , 'App\Controllers\LoginController@register');