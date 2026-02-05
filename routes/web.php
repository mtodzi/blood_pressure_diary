<?php

use App\Http\Controllers\PressureMeasurementController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.hpme');

Route::get('/pressure-measurements/create', [PressureMeasurementController::class, 'create'])->name('pressure-measurements.create');
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru'])) { // Список разрешенных языков
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
