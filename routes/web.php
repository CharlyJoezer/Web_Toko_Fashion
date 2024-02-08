<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

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

Route::prefix('dashboard')->group(function(){
    Route::middleware('auth:administrator')->group(function(){
        Route::GET('/beranda', [DashboardController::class, 'viewBeranda']);
        
        Route::GET('/product/buat-produk', [\App\Http\Controllers\ProductController::class, 'viewCreateProduct']);
        Route::POST('/product/create', [ProductController::class, 'createDataProduct']);
        Route::POST('/product/edit', [ProductController::class, 'editDataProduct']);
        Route::DELETE('/product/delete', [ProductController::class, 'deleteDataProduct']);
    });
    Route::GET('/login', [DashboardController::class, 'viewLogin'])->name('login');
    Route::POST('/login', [DashboardController::class, 'actionLogin']);
    Route::GET('/logout', [DashboardController::class, 'actionLogout']);
});