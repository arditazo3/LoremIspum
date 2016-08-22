<?php

namespace App\Providers;

use App\Patient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using event to delete all the child of patient (the events)
        Patient::deleted(function($patient) {
            $patient->events()->delete();
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
