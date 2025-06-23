<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\DoItemController;
use App\Http\Controllers\InItemController;
use App\Http\Controllers\StockController;


// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resource utama
Route::resource('items', ItemController::class);
Route::resource('barang_masuk', BarangMasukController::class);
Route::resource('category', CategoryController::class);
Route::resource('delivery_order', DeliveryOrderController::class);

// Update status pengambilan DO
Route::patch('/delivery_order/{id}/status', [DeliveryOrderController::class, 'updateStatus'])->name('delivery_order.update_status');

// ===============================
// DO Items (Barang Keluar per DO)
// ===============================
Route::prefix('do_items')->group(function () {
    // Detail semua item dari 1 DO
    Route::get('{do}/detail', [DoItemController::class, 'do_detail'])->name('do_items.detail');

    // Form tambah item ke DO tertentu
    Route::get('{do}/create', [DoItemController::class, 'create'])->name('do_items.create');

    // Simpan item ke DO
    Route::post('{do}', [DoItemController::class, 'store'])->name('do_items.store');

    // Edit/update/hapus item dari DO
    Route::get('edit/{id}', [DoItemController::class, 'edit'])->name('do_items.edit');
    Route::put('{id}', [DoItemController::class, 'update'])->name('do_items.update');
    Route::delete('{id}', [DoItemController::class, 'destroy'])->name('do_items.destroy');
});

// ===============================
// InItems (Barang Masuk per Transaksi)
// ===============================
Route::prefix('in_items')->group(function () {
    // Create item barang masuk
    Route::get('{in}/InItem/create', [InItemController::class, 'create'])->name('in_items.create');
    Route::post('{in}/InItem', [InItemController::class, 'store'])->name('in_items.store');

    // Detail item barang masuk
    Route::get('{in}/InItem', [InItemController::class, 'in_detail'])->name('in_items.in_detail');
});

// Edit, update, delete InItem
Route::resource('in_items', InItemController::class)->only(['edit', 'update', 'destroy']);

// Update status barang masuk
Route::patch('barang_masuk/{id}/status', [BarangMasukController::class, 'updateStatus'])->name('barang_masuk.update_status');


Route::get('/stok', [StockController::class, 'index'])->name('stok.index');


// // Auth (Login)
// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'loginWithUsertype'])->name('login.post');

// // Logout
// Route::post('/logout', function () {
//     \Illuminate\Support\Facades\Auth::logout();
//     return redirect('/login');
// })->name('logout');
