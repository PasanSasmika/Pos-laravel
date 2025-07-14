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

    Route::get('/admin/reports/daily', [AdminController::class, 'dailySales'])->name('admin.reports.daily');
    Route::get('/admin/reports/weekly', [AdminController::class, 'weeklySales'])->name('admin.reports.weekly');
    Route::get('/admin/reports/monthly', [AdminController::class, 'monthlySales'])->name('admin.reports.monthly');
    Route::get('/admin/reports/best-selling', [AdminController::class, 'bestSellingProducts'])->name('admin.reports.best_selling');
    Route::get('/admin/reports/low-selling', [AdminController::class, 'lowSellingProducts'])->name('admin.reports.low_selling');
    Route::get('/admin/reports/revenue-profit', [AdminController::class, 'revenueProfit'])->name('admin.reports.revenue_profit');
    Route::get('/admin/reports/summary', [AdminController::class, 'salesSummary'])->name('admin.reports.summary');

    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
});

Route::middleware(['auth', 'role:manag'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/reports/daily', [ManagerController::class, 'dailySales'])->name('manager.reports.daily');
    Route::get('/manager/reports/weekly', [ManagerController::class, 'weeklySales'])->name('manager.reports.weekly');
    Route::get('/manager/reports/monthly', [ManagerController::class, 'monthlySales'])->name('manager.reports.monthly');
    Route::get('/manager/reports/best-selling', [ManagerController::class, 'bestSellingProducts'])->name('manager.reports.best_selling');
    Route::get('/manager/reports/low-selling', [ManagerController::class, 'lowSellingProducts'])->name('manager.reports.low_selling');
    Route::get('/manager/reports/revenue-profit', [ManagerController::class, 'revenueProfit'])->name('manager.reports.revenue_profit');
    Route::get('/manager/reports/summary', [ManagerController::class, 'salesSummary'])->name('manager.reports.summary');
});

Route::middleware(['auth', 'role:cash'])->group(function () {
    Route::get('/cashier/sales/create', [CashierController::class, 'create'])->name('cashier.sales.create');
    Route::post('/cashier/sales', [CashierController::class, 'store'])->name('cashier.sales.store');
    Route::get('/cashier/receipt/{sale_id}/print', [CashierController::class, 'printReceipt'])->name('cashier.receipt.print');
    Route::get('/cashier/daily/closing', [CashierController::class, 'dailyClosingReport'])->name('cashier.daily.closing');
});

require __DIR__.'/auth.php';