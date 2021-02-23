<?php

namespace App\Providers;

use App\Http\Livewire\NavigationDropdown;
use App\View\Components\AdminLayout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('admin', AdminLayout::class);
        View::share('nav', NavigationDropdown::class);
    }
}
