<?php

namespace App\Providers;

use App\Models\ProductCart;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $cartCount = ProductCart::where('user_id',auth()->id())->count();
            $view->with('cartCount',$cartCount);
        });
    }
}
