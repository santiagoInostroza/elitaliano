<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.index');
// })->name('admin');


Route::get('/',  [HomeController::class,'index'])->name('home');
Route::get('admin',  [AdminController::class,'index'])->middleware(['can:admin','auth:sanctum', 'verified'])->name('admin');
Route::get('dashboard',  [AdminController::class,'dashboard'])->middleware(['can:admin.dashboard','auth:sanctum', 'verified'])->name('admin.dashboard')->missing(function (Request $request) { return Redirect::route('admin');});
Route::get('admin/users',  [UserController::class,'index'])->middleware(['can:admin.users','auth:sanctum', 'verified'])->name('admin.users');


Route::controller(PurchaseController::class)->group(function () {  
    Route::get('admin/purchases', 'index')->middleware(['can:admin.purchases.index','auth:sanctum', 'verified'])->name('admin.purchases.index');
    Route::get('admin/purchases/create', 'create')->middleware(['can:admin.purchases.create','auth:sanctum', 'verified'])->name('admin.purchases.create');
    Route::get('admin/purchases/{purchase}/edit', 'edit')->middleware(['can:admin.purchases.edit','auth:sanctum', 'verified'])->name('admin.purchases.edit');
    Route::get('admin/purchases/{purchase}', 'show')->middleware(['can:admin.purchases.show','auth:sanctum', 'verified'])->name('admin.purchases.show');
});  
Route::controller(SaleController::class)->group(function () {    
    Route::get('admin/sales','index')->middleware(['can:admin.sales.index','auth:sanctum', 'verified'])->name('admin.sales.index');
    Route::get('admin/sales/create', 'create')->middleware(['can:admin.sales.create','auth:sanctum', 'verified'])->name('admin.sales.create')->missing(function (Request $request) { return Redirect::route('admin.sales.index');});
    Route::get('admin/sales/{sale}/edit', 'edit')->middleware(['can:admin.sales.edit','auth:sanctum', 'verified'])->name('admin.sales.edit')->missing(function (Request $request) { return Redirect::route('admin.sales.index');});
    Route::get('admin/sales/{sale}', 'show')->middleware(['can:admin.sales.show','auth:sanctum', 'verified'])->name('admin.sales.show')->missing(function (Request $request) { return Redirect::route('admin.sales.index');});
});

Route::controller(CategoryController::class)->group(function () {    
    Route::get('admin/categories','index')->middleware(['can:admin.categories.index','auth:sanctum', 'verified'])->name('admin.categories.index');
    Route::get('admin/categories/create', 'create')->middleware(['can:admin.categories.create','auth:sanctum', 'verified'])->name('admin.categories.create')->missing(function (Request $request) { return Redirect::route('admin.categories.index');});
    Route::get('admin/categories/{category}/edit', 'edit')->middleware(['can:admin.categories.edit','auth:sanctum', 'verified'])->name('admin.categories.edit')->missing(function (Request $request) { return Redirect::route('admin.categories.index');});
    Route::get('admin/categories/{category}', 'show')->middleware(['can:admin.categories.show','auth:sanctum', 'verified'])->name('admin.categories.show')->missing(function (Request $request) { return Redirect::route('admin.categories.index');});
});


Route::get('admin/roles',  [RoleController::class,'index'])->middleware(['can:admin.roles','auth:sanctum', 'verified'])->name('admin.roles');
Route::get('admin/products',  [ProductController::class,'index'])->middleware(['can:admin.products','auth:sanctum', 'verified'])->name('admin.products');
Route::get('admin/supplier',  [SupplierController::class,'index'])->middleware(['can:admin.suppliers','auth:sanctum', 'verified'])->name('admin.suppliers');
Route::get('admin/customer',  [CustomerController::class,'index'])->middleware(['can:admin.customers','auth:sanctum', 'verified'])->name('admin.customers');

