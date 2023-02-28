<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('login', [UserController::class,'login']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::post('registro', [UserController::class,'registro']);
});