<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Log Viewer dostupan samo adminima
        Gate::define('viewLogViewer', function ($user) {
            return $user->hasRole('admin');
        });
    }
}
