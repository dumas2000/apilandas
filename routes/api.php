<?php

use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('login', [UserController::class,'login']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::apiResource('rol',RolController::class);
    Route::post('persona/crear',[PersonaController::class, 'store']);
    Route::apiResource('trabajador',TrabajadorController::class);
    Route::post('registro', [UserController::class,'registro']);
});
