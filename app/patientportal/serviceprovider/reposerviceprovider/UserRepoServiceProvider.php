<?php

namespace App\patientportal\serviceprovider\reposerviceprovider;

use Illuminate\Support\ServiceProvider;

class UserRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\patientportal\repositories\repointerface\UserProfileInterface',
            'App\patientportal\repositories\repoimpl\UserProfileImpl');
    }
}
