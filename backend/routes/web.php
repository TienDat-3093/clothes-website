<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminsController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\ProductTypesController;
use App\Http\Controllers\Web\SuppliersController;
use App\Http\Controllers\Web\CategoriesController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\ImportsController;
use App\Http\Controllers\Web\CommentsController;
use App\Http\Controllers\Web\CartsController;
use App\Http\Controllers\Web\DiscountsController;
use App\Http\Controllers\Web\SlideShowController;
use App\Http\Controllers\Web\DashBoardController;
use App\Http\Controllers\Web\ColorsController;
use App\Http\Controllers\Web\SizesController;
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


Route::middleware('guest')->group(function () {

    Route::get('/login', [AdminsController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminsController::class, 'loginHandle'])->name('loginHandle');
});

Route::middleware('auth')->group(function () {

    Route::get('/', [DashBoardController::class, 'index'])->name('dashboard.index');
    Route::get('/logout', [AdminsController::class, 'logout'])->name('admin.logout');

    //Admins
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/', [AdminsController::class, 'index'])->name('index');
        Route::post('/search', [AdminsController::class, 'search'])->name('search');
        Route::get('/create', [AdminsController::class, 'create'])->name('create');
        Route::post('/create', [AdminsController::class, 'createHandle'])->name('createHandle');
        Route::get('/update/{id}', [AdminsController::class, 'update'])->name('update');
        Route::post('/update/{id}', [AdminsController::class, 'updateHandle'])->name('updateHandle');
        Route::get('/delete/{id}', [AdminsController::class, 'delete'])->name('delete');

        Route::get('/view-pdf', [AdminsController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [AdminsController::class, 'index'])->name('import-excel');
        Route::post('/import-excel', [AdminsController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [AdminsController::class, 'ExportExcel'])->name('export-excel');
    });
    //endAdmins

    //Suppliers

    Route::prefix('/supplier')->name('supplier.')->group(function () {
        Route::get('/', [SuppliersController::class, 'index'])->name('index');
        Route::post('/search', [SuppliersController::class, 'search'])->name('search');
        Route::get('/create', [SuppliersController::class, 'create'])->name('create');
        Route::post('/create', [SuppliersController::class, 'createHandle'])->name('createHandle');
        Route::get('/update/{id}', [SuppliersController::class, 'update'])->name('update');
        Route::post('/update/{id}', [SuppliersController::class, 'updateHandle'])->name('updateHandle');
        Route::get('/delete/{id}', [SuppliersController::class, 'delete'])->name('delete');

        Route::get('/view-pdf', [SuppliersController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [SuppliersController::class, 'index'])->name('import-excel');
        Route::post('/import-excel', [SuppliersController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [SuppliersController::class, 'ExportExcel'])->name('export-excel');
    });

    //endSuppliers
    //Slideshow
    Route::prefix('/slideshow')->name('slideshow.')->group(function () {
        Route::get('/', [SlideShowController::class, 'index'])->name('index');
        Route::post('/create', [SlideShowController::class, 'create'])->name('create');
        Route::get('/delete/{id}', [SlideShowController::class, 'delete'])->name('delete');
        
    });
    //endSlideshow
    //Products
    Route::prefix('/product')->name('product.')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [ProductsController::class, 'detail'])->name('detail');
        Route::post('/quantity/{id}', [ProductsController::class, 'quantity'])->name('quantity');
        Route::post('/search', [ProductsController::class, 'search'])->name('search');
        Route::post('/create', [ProductsController::class, 'create'])->name('create');
        Route::get('/update/{id}', [ProductsController::class, 'update'])->name('update');
        Route::post('/delete-image', [ProductsController::class, 'deleteImage'])->name('deleteImage');
        Route::post('/update/{id}', [ProductsController::class, 'updateHandle'])->name('updateHandle');
        Route::get('/delete/{id}', [ProductsController::class, 'delete'])->name('delete');

        Route::get('/view-pdf', [ProductsController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [ProductsController::class, 'index'])->name('import-excel');
        Route::post('/import-excel', [ProductsController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [ProductsController::class, 'ExportExcel'])->name('export-excel');
    });
    //endProducts

    //ProductTypes

    Route::prefix('/product-types')->name('product-types.')->group(function () {
        Route::get('/', [ProductTypesController::class, 'List'])->name('index');
        Route::post('/search', [ProductTypesController::class, 'Search'])->name('search');

        Route::get('/create', [ProductTypesController::class, 'Create'])->name('create');
        Route::post('/create', [ProductTypesController::class, 'createHandler'])->name('create-handler');

        Route::get('/update/{id}', [ProductTypesController::class, 'Update'])->name('update');
        Route::post('/update/{id}', [ProductTypesController::class, 'updateHandler'])->name('update-handler');

        Route::get('/delete/{id}', [ProductTypesController::class, 'Delete'])->name('delete');

        Route::get('/view-pdf', [ProductTypesController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [ProductTypesController::class, 'List'])->name('import-excel');
        Route::post('/import-excel', [ProductTypesController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [ProductTypesController::class, 'ExportExcel'])->name('export-excel');
    });

    //endProductTypes

    //Categories

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', [CategoriesController::class, 'List'])->name('index');
        Route::post('/search', [CategoriesController::class, 'Search'])->name('search');

        Route::get('/create', [CategoriesController::class, 'Create'])->name('create');
        Route::post('/create', [CategoriesController::class, 'createHandler'])->name('create-handler');

        Route::get('/update/{id}', [CategoriesController::class, 'Update'])->name('update');
        Route::post('/update/{id}', [CategoriesController::class, 'updateHandler'])->name('update-handler');

        Route::get('/delete/{id}', [CategoriesController::class, 'Delete'])->name('delete');

        Route::get('/view-pdf', [CategoriesController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [CategoriesController::class, 'List'])->name('import-excel');
        Route::post('/import-excel', [CategoriesController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [CategoriesController::class, 'ExportExcel'])->name('export-excel');
    });

    //endCategories

    //Discounts

    Route::prefix('/discounts')->name('discounts.')->group(function () {
        Route::get('/', [DiscountsController::class, 'List'])->name('index');
        Route::post('/search', [DiscountsController::class, 'Search'])->name('search');

        Route::get('/create', [DiscountsController::class, 'Create'])->name('create');
        Route::post('/create', [DiscountsController::class, 'createHandler'])->name('create-handler');

        Route::get('/update/{id}', [DiscountsController::class, 'Update'])->name('update');
        Route::post('/update/{id}', [DiscountsController::class, 'updateHandler'])->name('update-handler');

        Route::get('/delete/{id}', [DiscountsController::class, 'Delete'])->name('delete');

        Route::get('/view-pdf', [DiscountsController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [DiscountsController::class, 'List'])->name('import-excel');
        Route::post('/import-excel', [DiscountsController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [DiscountsController::class, 'ExportExcel'])->name('export-excel');
    });

    //endDiscounts

    //Users

    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/', [UsersController::class, 'List'])->name('index');
        Route::post('/search', [UsersController::class, 'Search'])->name('search');

        Route::get('/delete/{id}', [UsersController::class, 'Delete'])->name('delete');

        Route::get('/view-pdf', [UsersController::class, 'ViewPDF'])->name('pdf');

        Route::get('/import-excel', [UsersController::class, 'List'])->name('import-excel');
        Route::post('/import-excel', [UsersController::class, 'ImportExcel'])->name('import-excel');

        Route::get('/export-excel', [UsersController::class, 'ExportExcel'])->name('export-excel');
    });

    //endUsers

    //Imports

    Route::prefix('/import')->name('import.')->group(function () {
        Route::get('/', [ImportsController::class, 'List'])->name('index');
        Route::post('/search', [ImportsController::class, 'Search'])->name('search');

        Route::get('/detail/{id}', [ImportsController::class, 'Detail'])->name('details');

        Route::get('/create', [ImportsController::class, 'Create'])->name('create');
        Route::post('/create', [ImportsController::class, 'createHandle'])->name('create-handle');

        Route::get('/delete/{id}', [ImportsController::class, 'Delete'])->name('delete');

        Route::get('/verify/{id}', [ImportsController::class, 'Verify'])->name('verify');

        Route::get('/view-pdf', [ImportsController::class, 'ViewPDF'])->name('pdf');

        Route::get('/export-excel', [ImportsController::class, 'ExportExcel'])->name('export-excel');
    });

    //endImports

    //Comments

    Route::prefix('/comment')->name('comment.')->group(function () {
        Route::get('/', [CommentsController::class, 'List'])->name('index');
        Route::post('/search', [CommentsController::class, 'Search'])->name('search');

        Route::get('/delete/{id}', [CommentsController::class, 'Delete'])->name('delete');

        Route::get('/view-pdf', [CommentsController::class, 'ViewPDF'])->name('pdf');

        Route::get('/export-excel', [CommentsController::class, 'ExportExcel'])->name('export-excel');
    });

    //endComments

    //Exports

    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/', [CartsController::class, 'List'])->name('index');
        Route::post('/search', [CartsController::class, 'Search'])->name('search');

        Route::get('/detail/{id}', [CartsController::class, 'Detail'])->name('details');

        Route::get('/delete/{id}', [CartsController::class, 'Delete'])->name('delete');

        Route::get('/status/{id}/{status}', [CartsController::class, 'ChangeStatus'])->name('status');

        Route::get('/view-pdf', [CartsController::class, 'ViewPDF'])->name('pdf');

        Route::get('/export-excel', [CartsController::class, 'ExportExcel'])->name('export-excel');
    });

    //endImports
    //Color
    Route::prefix('/color')->name('color.')->group(function () {
        Route::get('/',[ColorsController::class,'index'])->name('index');
        Route::post('/create',[ColorsController::class,'create'])->name('create');
        Route::get('/update/{id}', [ColorsController::class, 'update'])->name('update');
        Route::post('/update/{id}', [ColorsController::class, 'updateHandle'])->name('update');
    });
    //endColor
    Route::prefix('/size')->name('size.')->group(function () {
        Route::get('/',[SizesController::class,'index'])->name('index');
        Route::post('/create',[SizesController::class,'create'])->name('create');
        Route::get('/update/{id}', [SizesController::class, 'update'])->name('update');
        Route::post('/update/{id}', [SizesController::class, 'updateHandle'])->name('update');
        
    });
    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/chart', [DashBoardController::class, 'chart'])->name('dashboard.chart');
    });
});
