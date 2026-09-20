<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', '\App\Http\Controllers\UserController@loginForm')->name('login.create');
    Route::post('/login', '\App\Http\Controllers\UserController@login')->name('login');
});

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/pages/{id}', [\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');

Route::group(['prefix'=> 'admin', 'middleware' => 'auth', 'as' => 'admin.'], function (){
//Route::group(['prefix'=> 'admin', 'as' => 'admin.'], function (){
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoriesController::class);
    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/pages', \App\Http\Controllers\Admin\PageController::class);

    Route::post('/upload-image', [\App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('ckeditor.upload');
});
