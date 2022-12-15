<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/detail/{id?}', [App\Http\Controllers\DetailController::class, 'view'])->name('detail');
Route::post('/detail/add/{id?}', [App\Http\Controllers\DetailController::class, 'add'])->name('add');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'list'])->name('cart');
Route::post('/cart/delete/{id?}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');
Route::get('/cart/delivery', [App\Http\Controllers\CartController::class, 'delivery']);
Route::post('/cart/delivery', [App\Http\Controllers\CartController::class, 'delivery'])->name('cart-delivery');
Route::post('/cart/confirm', [App\Http\Controllers\CartController::class, 'confirm'])->name('cart-confirm');
Route::post('/cart/thanks', [App\Http\Controllers\CartController::class, 'thanks'])->name('cart-thanks');

Route::view('/about', 'about')->name('about');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/notation', 'notation')->name('notation');

Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm']);
Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);
Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'registerAdmin'])->name('admin-register');

Route::get('/admin/product/list/', [App\Http\Controllers\Admin\ProductController::class, 'list'])->name('product-list')->middleware('auth:admin');
Route::get('/admin/product/create/', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product-create')->middleware('auth:admin');
Route::get('/admin/product/edit/{id?}', [App\Http\Controllers\Admin\ProductController::class, 'editView'])->name('product-edit-view')->middleware('auth:admin');
Route::get('/admin/product/list/trash', [App\Http\Controllers\Admin\ProductController::class, 'trash'])->name('product-trash')->middleware('auth:admin');
Route::post('/admin/product/create/confirm/', [App\Http\Controllers\Admin\ProductController::class, 'confirm'])->name('product-confirm')->middleware('auth:admin');
Route::post('/admin/product/create/store/', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product-store')->middleware('auth:admin');
Route::post('/admin/product/edit/{id?}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product-edit')->middleware('auth:admin');
Route::post('/admin/product/delete/{id?}', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product-delete')->middleware('auth:admin');
Route::post('/admin/product/delete/complete/{id?}', [App\Http\Controllers\Admin\ProductController::class, 'deleteComplete'])->name('product-delete-complete')->middleware('auth:admin');
Route::post('/admin/product/delete/return/{id?}', [App\Http\Controllers\Admin\ProductController::class, 'deleteReturn'])->name('product-delete-return')->middleware('auth:admin');

Route::get('/admin/order/list/', [App\Http\Controllers\Admin\OrderController::class, 'list'])->name('order-list')->middleware('auth:admin');
Route::post('/admin/order/status/{id?}', [App\Http\Controllers\Admin\OrderController::class, 'status'])->name('order-status')->middleware('auth:admin');
Route::post('/admin/order/cancel/{id?}', [App\Http\Controllers\Admin\OrderController::class, 'cancel'])->name('order-cancel')->middleware('auth:admin');


Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index'])->middleware('auth:admin')->name('admin-home');