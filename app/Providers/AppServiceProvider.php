<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); 
        Relation::morphMap([
            'user' => 'App\User',
            'lead' => 'App\Lead',
            'agent' => 'App\Agent',
            'company' => 'App\Company',
            'admin' => 'App\Admin',
        ]);

    }
}
