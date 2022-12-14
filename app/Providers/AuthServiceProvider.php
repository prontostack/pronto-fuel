<?php

namespace App\Providers;

use App\Auth\Guards\SharedSessionGuard;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Share Laravel Session on subdomains with different guards
         * @see https://stackoverflow.com/questions/46074872/share-laravel-session-on-subdomains-with-different-guards
         */
        Auth::extend('shared_session', function ($app, $name, $config) {
            $providerConfig = $this->app['config']['auth.providers.' . $config['provider']];

            $provider = new EloquentUserProvider($app['hash'], $providerConfig['model']);

            return new SharedSessionGuard('shared_session', $provider, $this->app['session.store']);
        });

        $this->registerPolicies();
    }
}
