<?php

use App\Http\Controllers\ClassTypeIndexController;
use App\Http\Controllers\WilayaIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['splade'])->group(function () {
    Route::get('/', fn () => view('home'))->name('home');

    Route::get('/wilayas', WilayaIndexController::class)->name('wilayas.index');

    Route::get('class-types', ClassTypeIndexController::class)->name('class_types.index');

    Route::get('/docs', fn () => view('docs'))->name('docs');
});
