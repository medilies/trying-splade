<?php

use ElaborateCode\AlgerianEducationSystem\Models\ClassType;
use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

SpladeTable::defaultPerPageOptions([10, 100]);
// SpladeTable::hidePaginationWhenResourceContainsOnePage();

Route::get('/', function () {
    $perPage = request()->query('perPage', 10);

    $default_sort = 'fr_name';

    $wilayas = QueryBuilder::for(Wilaya::class)
        ->defaultSort($default_sort)
        ->allowedSorts(['id', 'fr_name', 'ar_name'])
        ->allowedFilters(['id', 'fr_name', 'ar_name'])
        ->paginate($perPage)
        ->withQueryString();

    return view('home')
        ->with(
            'wilayas',
            SpladeTable::for($wilayas)
                ->perPageOptions([5, 10, 20, 100])
                ->column('id', 'ID', false, sortable: true, searchable: true)
                ->column('fr_name', 'Larin name', false, sortable: true, searchable: true)
                ->column('ar_name', 'Arabic name', true, sortable: true, searchable: true)
                ->defaultSort($default_sort)
            // ->searchInput('fr_name', 'Wilaya latin name', 'Oran')
        );
})
    ->middleware(['splade'])
    ->name('home');

Route::get('class-types', function () {
    $perPage = request()->query('perPage', 10);

    $class_types = QueryBuilder::for(ClassType::class)
        ->allowedSorts(['level', 'name', 'alias'])
        ->allowedFilters(['level', 'name', 'alias', 'cycle_id'])
        ->paginate($perPage)
        ->withQueryString();

    return view('class-types')
        ->with(
            'class_types',
            SpladeTable::for($class_types)
                ->column('level', 'Level', false, sortable: true, searchable: true)
                ->column('cycle_id', 'Cycle', false, sortable: true)
                ->column('name', 'Name', true, sortable: true, searchable: true)
                ->column('alias', 'Alias', false, sortable: true, searchable: true)
                ->column('actions', '')
                ->selectFilter(
                    'cycle_id',
                    [
                        'pre-scolaire' => 'Prescolaire',
                        'primaire' => 'Primaire',
                        'moyen' => 'Moyen',
                        'secondaire' => 'Secondaire',
                    ],
                    'Cycle',
                    noFilterOptionLabel: 'All cycles'
                )
        );
})
    ->middleware(['splade'])
    ->name('class_types.index');

Route::middleware(['splade'])
    ->group(function () {
        Route::get('/docs', fn () => view('docs'))->name('docs');
    });
