<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('posts',[PostsController::class,'index']);
    Route::get('me',[AuthController::class,'me']);
    Route::post('createPost',[PostsController::class,'store']);
    Route::post('uploadProfilePic',[UserController::class,'store']);

    // Route::get('user/{id}',function(){return 'Hello';});
});

Route::get('user',[UserController::class,'index']);
Route::get('user/{id}',[UserController::class,'show']);
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);



// Route::apiResource('/users',UserController::class);

