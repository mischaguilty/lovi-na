<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('companies')) {
            $company = optional(company() ?? null, function (Company $company) {
                return $company;
            });
            View::share('company', $company);
        }
    }
}
