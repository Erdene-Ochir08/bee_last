<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Paginator::useBootstrap();

       View::composer('layouts.inc.frontend.navbar', function ($view) {
            $categories = Category::where('status', '0')->get();
            $view->with('categories', $categories);
       });

        View::composer('layouts.inc.frontend.navbar', function ($view) {
            $client = Client::findOrFail('d03a7f43-f1e3-47b0-8a61-21e79df08c7f');
            $view->with('client', $client);
        });

        View::composer('layouts.inc.frontend.footer', function ($view) {
            $client = Client::findOrFail('d03a7f43-f1e3-47b0-8a61-21e79df08c7f');
            $view->with('client', $client);
        });


    }
}
