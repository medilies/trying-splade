<?php

namespace App\Http\Controllers;

use ElaborateCode\AlgerianEducationSystem\Models\ClassType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class ClassTypeIndexController extends Controller
{
    public function __invoke(): View|Factory
    {
        SpladeTable::defaultPerPageOptions([10, 100]);
        // SpladeTable::hidePaginationWhenResourceContainsOnePage();

        $perPage = request()->query('perPage', 10);

        $class_types = QueryBuilder::for(ClassType::class)
            ->allowedSorts(['level', 'name', 'alias'])
            ->allowedFilters(['level', 'name', 'alias', 'cycle_id'])
            ->paginate($perPage)
            ->withQueryString();

        return view('class-types.index')
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
    }
}
