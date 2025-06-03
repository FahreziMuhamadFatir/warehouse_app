<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CategoryController;

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
// Route::resource('barang-masuk', BarangMasukController::class);
Route::get('/', function () {
    return view('welcome');
});

Route::resource('items', ItemController::class);
Route::resource('barang-masuk', BarangMasukController::class);

Route::resource('category', CategoryController::class);
