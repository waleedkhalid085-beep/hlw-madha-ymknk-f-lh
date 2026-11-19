<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\WorkforceController;
use App\Http\Controllers\PermitController;

/*
|--------------------------------------------------------------------------
| Web Routes - COREX Enterprise Platform (Lion Oilfield Services)
|--------------------------------------------------------------------------
*/

// Authentication
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [DashboardController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

// Protected Operations Dashboard
Route::middleware(['auth'])->group(function () {
    
    // Executive Overview
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/kpis', [DashboardController::class, 'getLiveKpis'])->name('dashboard.kpis');
    Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportExecutivePdf'])->name('dashboard.export-pdf');

    // Wellhead Maintenance & Xmas Tree Integrity
    Route::prefix('wells')->name('wells.')->group(function () {
        Route::get('/', [WellController::class, 'index'])->name('index');
        Route::get('/{well}/tree', [WellController::class, 'treeSimulator'])->name('tree');
        Route::get('/{well}/passport', [WellController::class, 'passport'])->name('passport');
        Route::post('/{well}/valves/{valve}/service', [WellController::class, 'recordValveService'])->name('valves.service');
        Route::get('/{well}/passport/pdf', [WellController::class, 'downloadPassportPdf'])->name('passport.pdf');
    });

    // Warehouses & Stock Control (WHM)
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('index');
        Route::post('/material-requests', [InventoryController::class, 'storeRequest'])->name('requests.store');
        Route::post('/goods-issue', [InventoryController::class, 'storeGoodsIssue'])->name('goods-issue.store');
        Route::post('/goods-receipt', [InventoryController::class, 'storeGoodsReceipt'])->name('goods-receipt.store');
        Route::get('/export-excel', [InventoryController::class, 'exportExcel'])->name('export.excel');
    });

    // Workforce & Training Matrix
    Route::prefix('workforce')->name('workforce.')->group(function () {
        Route::get('/matrix', [WorkforceController::class, 'trainingMatrix'])->name('matrix');
        Route::get('/employees/{employee}/certificates', [WorkforceController::class, 'certificates'])->name('certificates');
        Route::get('/certificates/{certificate}/pdf', [WorkforceController::class, 'downloadCertificatePdf'])->name('certificate.pdf');
    });

    // QHSE & Work Permits (e-PTW)
    Route::prefix('hse')->name('hse.')->group(function () {
        Route::get('/permits', [PermitController::class, 'index'])->name('permits.index');
        Route::post('/permits', [PermitController::class, 'store'])->name('permits.store');
        Route::get('/radiation-dosimeters', [PermitController::class, 'dosimeterLog'])->name('dosimeters.index');
    });

});
