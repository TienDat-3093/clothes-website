<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\APIProductsController;
use App\Http\Controllers\API\APIUsersController;
use App\Http\Controllers\API\APICommentsController;
use App\Http\Controllers\API\APISlideShowController;
use App\Http\Controllers\API\APIProductTypesController;
use App\Http\Controllers\API\APICategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function(){
    Route::get('me', [APIUsersController::class,"getUser"]);
    Route::post('edit',[APIUsersController::class,"Edit"]);
    
    Route::prefix('/comment')->group(function(){
        Route::post('',[APICommentsController::class,"Comment"]);
        Route::get('user/{id}',[APICommentsController::class,'getUserComment']);
        Route::delete('/{id}',[APICommentsController::class,'deleteUserComment']);
    });
});
Route::group([

    'middleware' => 'api',
], function ($router) {

    Route::post('register',[APIUsersController::class,"Register"]);
    Route::post('login', [APIUsersController::class,"login"]);
    Route::post('logout', [APIUsersController::class,"logout"]);

});

Route::prefix('/product')->group(function(){
    Route::get('/index',[APIProductsController::class,'index']);
    Route::get('/show/{id}',[APIProductsController::class,'show']);
    Route::post('/search/{keyword}',[APIProductsController::class,'search']);
    Route::post('filter/{sort}/{price}',[APIProductsController::class,'filter']);
});
Route::prefix('/producttype')->group(function(){
    Route::get('/index',[APIProductTypesController::class,'index']);
    Route::get('/show/{id}',[APIProductTypesController::class,'show']);
});

Route::prefix('/category')->group(function(){
    Route::get('/index',[APICategoriesController::class,'index']);
    Route::get('/show/{id}',[APICategoriesController::class,'show']);
});

Route::prefix('/slideshow')->group(function(){
    Route::get('/index',[APISlideShowController::class,'index']);
});


Route::prefix('/comment')->group(function(){
    Route::get('/{id}',[APICommentsController::class,'getComment']);
});