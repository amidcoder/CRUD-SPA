<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Src\Interfaces\Http\Controllers\AuthController;
use Src\Interfaces\Http\Controllers\PostController;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
  Route::get('user',[AuthController::class,'user']);
  Route::post('logout',[AuthController::class,'logout']);
  Route::apiResource('posts',PostController::class);
});