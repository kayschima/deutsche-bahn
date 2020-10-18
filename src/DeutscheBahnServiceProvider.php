<?php

namespace Kayschima\DeutscheBahn;

use Illuminate\Support\ServiceProvider;

class DeutscheBahnServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kayschima');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kayschima');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/deutsche-bahn.php' => config_path('deutsche-bahn.php'),
        ], 'deutsche-bahn.config');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {

        // Register the service the package provides.
        $this->app->singleton('deutsche-bahn', function ($app) {
            return new DeutscheBahn;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['deutsche-bahn'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kayschima'),
        ], 'deutsche-bahn.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kayschima'),
        ], 'deutsche-bahn.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kayschima'),
        ], 'deutsche-bahn.views');*/

        // Registering package commands.
        $this->commands([
            DeutscheBahnCommand::class,
        ]);
    }
}
