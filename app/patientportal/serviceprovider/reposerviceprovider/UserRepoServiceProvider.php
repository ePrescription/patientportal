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
       

        $this->app->bind('App\patientportal\repositories\repoInterface\UserInterface',
            'App\patientportal\repositories\repositoryImpl\UserImpl');
        $this->app->bind('App\patientportal\repositories\repoInterface\DoctorInterface',
            'App\patientportal\repositories\repositoryImpl\DoctorImpl');
        $this->app->bind('App\patientportal\repositories\repoInterface\LabInterface',
            'App\patientportal\repositories\repositoryImpl\LabImpl');
        $this->app->bind('App\patientportal\repositories\repoInterface\PharmaInterface',
            'App\patientportal\repositories\repositoryImpl\PharmaImpl');






    }
}
