<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');

Route::post('/list', [App\Http\controllers\ProductController::class, 'showSearchList'])->name('listSearch');

Route::get('/new', [App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('new');

Route::post('/new', [App\Http\Controllers\ProductController::class, 'registSubmit'])->name('newRegist');

Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('details');

Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'showEdit'])->name('edit');

Route::post('/edit/{id}', [App\Http\Controllers\ProductController::class, 'UpdateSubmit'])->name('updateList');

Route::post('/delete/{id}', [App\Http\Controllers\ProductController::class, 'deleteSubmit'])->name('deleteList');