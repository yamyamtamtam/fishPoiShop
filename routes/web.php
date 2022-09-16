<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm']);
Route::get('/admin/produst/list/', [App\Http\Controllers\ProductController::class, 'showAdminProductList']);
Route::get('/admin/produst/create/', [App\Http\Controllers\ProductController::class, 'showAdminProductCreate']);
Route::get('/admin/produst/edit/', [App\Http\Controllers\ProductController::class, 'showAdminProductEdit']);

Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);
Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'registerAdmin'])->name('admin-register');
Route::post('/admin/produst/create/', [App\Http\Controllers\ProductController::class, 'AdminProductStore'])->name('product-store');
Route::post('/admin/produst/edit/', [App\Http\Controllers\ProductController::class, 'AdminProductEdit'])->name('product-edit');

Route::view('/admin', 'admin.home')->middleware('auth:admin')->name('admin-home');