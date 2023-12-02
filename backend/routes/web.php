<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminsController;
use App\Http\Controllers\Web\ProductTypesController;
use App\Http\Controllers\Web\SuppliersController;
use App\Models\Suppliers;

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
    //Admins
    Route::prefix('/admin')->name('admin.')->group(function(){
        Route::get('/',[AdminsController::class,'index'])->name('index');
        Route::post('/search',[AdminsController::class,'search'])->name('search');
        Route::get('/create',[AdminsController::class,'create'])->name('create');
        Route::post('/create',[AdminsController::class,'createHandle'])->name('createHandle');
        Route::get('/update/{id}',[AdminsController::class,'update'])->name('update');
        Route::post('/update/{id}',[AdminsController::class,'updateHandle'])->name('updateHandle');
        Route::get('/delete/{id}',[AdminsController::class,'delete'])->name('delete');
    });
    //endAdmins
    //Suppliers
    Route::prefix('/supplier')->name('supplier.')->group(function(){
        Route::get('/',[SuppliersController::class,'index'])->name('index');
        Route::post('/search',[SuppliersController::class,'search'])->name('search');
        Route::get('/create',[SuppliersController::class,'create'])->name('create');
        Route::post('/create',[SuppliersController::class,'createHandle'])->name('createHandle');
        Route::get('/update/{id}',[SuppliersController::class,'update'])->name('update');
        Route::post('/update/{id}',[SuppliersController::class,'updateHandle'])->name('updateHandle');
        Route::get('/delete/{id}',[SuppliersController::class,'delete'])->name('delete');
    });
    //endSuppliers
    
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
