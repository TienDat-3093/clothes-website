<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminsController;
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
    return view('admin/dashboard');
}); */

Route::middleware('guest')->group(function () {
    Route::name('admin.')->group(function () {
        Route::get('/login', [AdminsController::class, 'login'])->name('login');
        Route::post('/login', [AdminsController::class, 'loginHandle'])->name('loginHandle');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/', [AdminsController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminsController::class, 'logout'])->name('admin.logout');
    
    Route::get('/admin', [AdminsController::class, 'Index'])->name('adminIndex');
});
