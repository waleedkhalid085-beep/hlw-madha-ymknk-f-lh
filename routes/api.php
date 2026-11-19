<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\InventoryController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kpis/live', [DashboardController::class, 'getLiveKpis']);
    Route::get('/wells/{well}/tree-data', [WellController::class, 'getTreeTelemetry']);
    Route::post('/inventory/quick-issue', [InventoryController::class, 'quickIssueApi']);
});
