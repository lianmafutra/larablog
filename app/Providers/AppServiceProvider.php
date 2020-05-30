<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::include('admin.includes.include', 'textinput');
        // Blade::include('components.modal', 'modal');  
        // Blade::component('components.modal', 'modal'); 
        Blade::component('components.modal', 'modal');

        Blade::component('components.alert', 'alert');

        Blade::include('admin.category.create', 'create');
        Blade::include('admin.category.edit', 'edit');
        Blade::include('admin.category.delete', 'delete');
        Blade::include('admin.category.data', 'data');

        Blade::include('components.table', 'table');
    }
}
