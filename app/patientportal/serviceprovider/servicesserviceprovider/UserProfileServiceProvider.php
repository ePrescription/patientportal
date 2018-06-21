<?php

namespace App\patientportal\serviceprovider\servicesserviceprovider;

use Illuminate\Support\ServiceProvider;
use App\patientportal\services\UserProfileService;

class UserProfileServiceProvider extends ServiceProvider
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
        $this->app->bind('UserService', function($app){
            //return new HospitalService($app->make('App\Treatin\Repositories\RepoInterface\HospitalProfileInterface'));
            $userProfileService = new UserProfileService($app->make('App\patientportal\repositories\repoInterface\UserInterface'));
            return $userProfileService;

        });
    }
}
