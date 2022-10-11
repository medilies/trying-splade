<?php

namespace App\Http\Controllers;

use ElaborateCode\AlgerianProvinces\Models\Wilaya;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class WilayaIndexController extends Controller
{
    public function __invoke(): View|Factory
    {
        Toast::title('Yay!')
            ->message('Neet frontend tricks')
            ->Info()
            ->rightBottom()
            ->backdrop()
            ->autoDismiss(7);

        // Splade::share('adminLastSeenAt', now()->toDateTimeString());

        SEO::title('Splade')
            ->description('Become the Splade expert!')
            ->keywords('laravel, splade, course');
        // ...

        SpladeTable::defaultPerPageOptions([10, 100]);
        // SpladeTable::hidePaginationWhenResourceContainsOnePage();

        $perPage = request()->query('perPage', 10);

        $default_sort = 'fr_name';

        $wilayas = QueryBuilder::for(Wilaya::class)
            ->defaultSort($default_sort)
            ->allowedSorts(['id', 'fr_name', 'ar_name'])
            ->allowedFilters(['id', 'fr_name', 'ar_name'])
            ->paginate($perPage)
            ->withQueryString();

        return view('wilayas.index')
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
    }
}
