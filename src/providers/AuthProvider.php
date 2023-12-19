<?php

namespace Elokaily\Auth\Providers;


use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");
        $this->loadViewsFrom(__DIR__ . "/../resources/views" , "auth");
    }
}
