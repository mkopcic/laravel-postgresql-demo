<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Log Viewer dostupan samo prijavljenim adminima
        LogViewer::auth(function ($request) {
            return $request->user()?->hasRole('admin') ?? false;
        });
    }
}
