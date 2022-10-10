<?php

use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\Splade\SpladeTable;


Route::get('/', function () {

    $wilayas = Wilaya::paginate(10);

    return view('home')
        ->with(
            'wilayas',
            SpladeTable::for($wilayas)
                ->column('id')
                ->column('fr_name')
                ->column('ar_name')
        );
})
    ->middleware(['splade'])
    ->name('home');


Route::middleware(['splade'])
    ->group(function () {
        Route::get('/docs', fn () => view('docs'))->name('docs');
    });
