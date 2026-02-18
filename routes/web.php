<?php

use App\Http\Controllers\PressureMeasurementController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/pressure-measurements/create', [PressureMeasurementController::class, 'create'])->name('pressure-measurements.create');
Route::post('/pressure-measurements', [PressureMeasurementController::class, 'store'])->name('pressure-measurements.store');
Route::post('/pressure-measurements/data-table', [PressureMeasurementController::class, 'dataTable'])->name('pressure-measurements.data_table');
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru'])) { // Список разрешенных языков
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    if (App::isLocale('ru')) {
        return view('welcome_ru');
    } else {
        return view('welcome_en');
    }
})->name('start');
