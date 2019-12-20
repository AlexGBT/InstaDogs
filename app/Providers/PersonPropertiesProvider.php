<?php

namespace App\Providers;

use App\Helpers\AdminProperties;
use App\Helpers\UserProperties;
use Illuminate\Support\ServiceProvider;

class PersonPropertiesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\PersonPropertiesContract', function () {
            if (auth()->user()->role == 'user') {
                return new UserProperties();
            } else {
                return new AdminProperties();
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
