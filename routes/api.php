<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\WeighbridgeController;

Route::post('/weighbridge/ingest', [WeighbridgeController::class, 'ingest']);

use App\Http\Controllers\WeightInformationController;

// Fetch data
Route::get('/trucks', [WeightInformationController::class, 'apiTrucks']);
Route::get('/drivers', [WeightInformationController::class, 'apiDrivers']);
Route::get('/truck-visits-in', [WeightInformationController::class, 'apiTruckVisitsIn']);

// Weigh IN (tare)
Route::post('/weigh-in', [WeightInformationController::class, 'apiWeighIn']);

// Weigh OUT (gross + net)
Route::post('/weigh-out/{id}', [WeightInformationController::class, 'apiWeighOut']);
Route::get('/pending-transaction/{visit_id}', [WeightInformationController::class, 'apiPendingTransaction']);