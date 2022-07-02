<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\SetupController;

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

Route::post('/save-setup', [ SetupController::class, 'saveSetup' ])->name('save_setup');

Route::middleware([ 'app' ])->group(function() {
    Route::middleware([ 'guest' ])->group(function() {
        Route::get('/login', [ AuthController::class, 'viewLogin' ])->name('auth.login');
        Route::post('/login', [ AuthController::class, 'doLogin' ])->name('auth.doLogin');
    });

    Route::middleware([ 'auth' ])->group(function() {
        Route::get('/logout', [ AuthController::class, 'doLogout' ])->name('auth.logout');
        Route::get('/change-password', [ AuthController::class, 'viewChangePwd' ])->name('auth.change_pwd');
        Route::post('/change-password', [ AuthController::class, 'doChangePwd' ])->middleware('protect')->name('auth.do_change_pwd');

        Route::get('/', [ DashboardController::class, 'index' ])->name('dashboard.index');

        Route::get('/customers', [ CustomerController::class, 'index' ])->name('customer.index');
        Route::get('/customers/add', [ CustomerController::class, 'viewAdd' ])->name('customer.add');
        Route::post('/customers/add', [ CustomerController::class, 'doAdd' ])->middleware('protect')->name('customer.add');
        Route::get('/customer/{id}', [ CustomerController::class, 'customerProfile' ])->name('customer.profile');
        Route::get('/customer/{id}/delete', [ CustomerController::class, 'delete' ])->middleware('protect')->name('customer.delete');
        Route::get('/customer/{id}/edit', [ CustomerController::class, 'edit' ])->name('customer.edit');
        Route::post('/customer/{id}/save', [ CustomerController::class, 'save' ])->middleware('protect')->name('customer.save');
    
        Route::get('/products', [ ProductController::class, 'index' ])->name('product.index');
        Route::post('/products', [ ProductController::class, 'addProduct' ])->middleware('protect')->name('product.add');
        Route::get('/product/{id}', [ ProductController::class, 'edit' ])->name('product.edit');
        Route::get('/product/{id}/delete', [ ProductController::class, 'delete' ])->middleware('protect')->name('product.delete');
        Route::post('/product/{id}/save', [ ProductController::class, 'save' ])->middleware('protect')->name('product.save');
        
        Route::get('/product/version-log/{id}', [ ProductController::class, 'version_log' ])->name('product.version_log');
        Route::post('/product/version-log/{id}', [ ProductController::class, 'addVersion' ])->middleware('protect')->name('product.version.add');
        Route::get('/product/version-log/{id}/edit', [ ProductController::class, 'editVersion' ])->name('product.version.edit');
        Route::get('/product/version-log/{id}/delete', [ ProductController::class, 'deleteVersion' ])->middleware('protect')->name('product.version.delete');
        Route::get('/product/version-log/{id}/save', [ ProductController::class, 'saveVersion' ])->middleware('protect')->name('product.version.save');
    
        Route::get('/licenses', [ LicenseController::class, 'index' ])->name('license.index');
        Route::get('/license/add', [ LicenseController::class, 'viewAdd' ])->name('license.add');
        Route::post('/license/add', [ LicenseController::class, 'doAdd' ])->name('license.do_add');
        Route::get('/license/{id}/edit', [ LicenseController::class, 'edit' ])->name('license.edit');
        Route::post('/license/{id}/save', [ LicenseController::class, 'save' ])->name('license.save');
        Route::get('/license/{id}/delete', [ LicenseController::class, 'delete' ])->name('license.delete');
    });
});