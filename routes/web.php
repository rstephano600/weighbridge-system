<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('in.dashboard');
})->middleware('auth');

use App\Http\Controllers\TruckController;

Route::resource('trucks', TruckController::class)->middleware('auth');
use App\Http\Controllers\DriverController;

Route::resource('drivers', DriverController::class)->middleware('auth');
use App\Http\Controllers\TruckVisitController;

Route::resource('truck_visits', TruckVisitController::class)->middleware('auth');

use App\Http\Controllers\WeighInController;
use App\Http\Controllers\WeighOutController;
use App\Http\Controllers\WeightInformationController;

// Weigh In
Route::get('/weigh-in', [WeighInController::class, 'index'])->name('weigh.in.index');
Route::get('/weigh-in/create', [WeighInController::class, 'create'])->name('weigh.in.create');
Route::post('/weigh-in', [WeighInController::class, 'store'])->name('weigh.in.store');
Route::get('/weigh-in/{id}/edit', [WeighInController::class, 'edit'])->name('weigh.in.edit');
Route::put('/weigh-in/{id}', [WeighInController::class, 'update'])->name('weigh.in.update');

Route::get('/weighInputTruck', [WeightInformationController::class, 'weighInputTruck'])->name('weighInputTruck');
Route::get('/weighInputTruckCreate', [WeightInformationController::class, 'weighInputTruckCreate'])->name('weighInputTruckCreate');
Route::post('/weighInputTruckStore', [WeightInformationController::class, 'weighInputTruckStore'])->name('weighInputTruckStore');
Route::get('/weighInputTruckPack/{id}', [WeightInformationController::class, 'weighInputTruckPack'])->name('weighInputTruckPack');
Route::put('/weighInputTruckPackStore/{id}', [WeightInformationController::class, 'weighInputTruckPackStore'])->name('weighInputTruckPackStore');

// Weigh Out
Route::get('/weigh-out', [WeighOutController::class, 'index'])->name('weigh.out.index');
Route::get('/weigh-out/create', [WeighOutController::class, 'create'])->name('weigh.out.create');
Route::post('/weigh-out', [WeighOutController::class, 'store'])->name('weigh.out.store');

