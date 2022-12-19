<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Inertia\ResponseFactory as InertiaResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Request::macro('isAdmin', function () {
            return $this->getHost() === config('admin.host');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        InertiaResponse::macro('renderEndpoint', function ($view, $params) {
            $endpointDirectory = request()->isAdmin()
                ? 'Admin'
                : 'Subscriber';

            return Inertia::render($endpointDirectory . '/' . $view, $params);
        });
    }
}
