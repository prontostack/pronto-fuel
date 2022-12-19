<?php

namespace App\Providers;

use App\View\Layouts\AdminLayout;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Inertia\ResponseFactory as InertiaResponse;

class AdminServiceProvider extends ServiceProvider
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
        Inertia::composer('Admin/*', function (InertiaResponse $inertia) {
            $inertia->with([
                'layout' => new AdminLayout
            ]);
        });
    }
}
