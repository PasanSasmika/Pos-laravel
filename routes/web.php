<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
    Route::get('/inventory/create', [InventoryController::class, 'create'])->name('admin.inventory.create');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('admin.inventory.store');
    Route::get('/inventory/{product}/edit', [InventoryController::class, 'edit'])->name('admin.inventory.edit');
    Route::put('/inventory/{product}', [InventoryController::class, 'update'])->name('admin.inventory.update');
    Route::delete('/inventory/{product}', [InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
    Route::get('/inventory/{product}/barcode', [InventoryController::class, 'barcode'])->name('admin.inventory.barcode');
});

Route::middleware(['auth', 'role:manag'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard']);
});

Route::middleware(['auth', 'role:cash'])->group(function () {
    Route::get('/cashier/sales/create', [CashierController::class, 'create'])->name('cashier.sales.create');
    Route::post('/cashier/sales', [CashierController::class, 'store'])->name('cashier.sales.store');
});

require __DIR__.'/auth.php';