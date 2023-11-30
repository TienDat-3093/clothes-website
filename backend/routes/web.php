<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminsController;
use App\Http\Controllers\Web\ProductTypesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('dashboard');
}); */

Route::middleware('guest')->group(function () {

    Route::get('/login', [AdminsController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminsController::class, 'loginHandle'])->name('loginHandle');
    
});


Route::middleware('auth')->group(function () {

    Route::get('/', [AdminsController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminsController::class, 'logout'])->name('admin.logout');
    
    Route::get('/admin', [AdminsController::class, 'Index'])->name('adminIndex');

    
    //ProductTypes

    Route::prefix('/product-types')->group(function(){

        Route::name('product-types.')->group(function(){

            Route::get('index',[ProductTypesController::class,'List'])->name('index');
            
            Route::get('create',[ProductTypesController::class,'Create'])->name('create');
            Route::post('create',[ProductTypesController::class,'createHandler'])->name('create-handler');
            
            Route::get('update/{id}',[ProductTypesController::class,'Update'])->name('update');
            Route::post('update/{id}',[ProductTypesController::class,'updateHandler'])->name('update-handler');
            
            Route::get('delete/{id}',[ProductTypesController::class,'Delete'])->name('delete');

        });

    });

    //Product

});
