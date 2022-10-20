<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Pagination\Paginator;

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
        // if (env('APP_ENV') === 'production') {
        //     URL::forceScheme('https');
        // }

        // view()->composer('*', function ($view) {
        //     $authUser = auth()->user() ?? new User();
        //     $view->with('authUser', $authUser);
        // });

        // $this->app['request']->server->set('HTTPS', 'on');
    }
}
