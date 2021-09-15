<?php

namespace App\Components\Products;

use App\Components\Traits\WithPagination;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';

    protected $listeners = [
        'pagination:updated' => 'paginationUpdated',
    ];

    public function paginationUpdated(int $page)
    {
        $this->emitUp('$refresh');
    }

    protected function query(): Builder
    {
        return Product::query()->when(!empty($this->search), function (Builder $builder) {
            $search = $this->search;
            $builder->where('name->'.app()->getLocale(), 'like', "%$search%");
        });
    }

    public function route()
    {
        return Route::get('/products', static::class)
            ->name('products.index')
            ->middleware([
                'localize',
                'localizationRedirect',
                'localeSessionRedirect',
                'auth',
            ])
            ->prefix(LaravelLocalization::setLocale());
    }

    public function render()
    {
        return view('products.index')->with([
            'products' => $this->query()->paginate(),
        ]);
    }
}
