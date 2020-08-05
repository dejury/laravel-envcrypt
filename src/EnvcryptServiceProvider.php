<?php

namespace Dejury\Envcrypt;

use Dejury\Envcrypt\Console\Add;
use Dejury\Envcrypt\Console\Remove;
use Dejury\Envcrypt\Console\View;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class EnvcryptServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('envcrypt.php'),
            ], 'config');

            $this->commands([
                Add::class,
                View::class,
                Remove::class,
            ]);
        }

        app(Envcrypt::class)->init();

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'envcrypt');

        // Register the main class to use with the facade
        $this->app->singleton(Envcrypt::class, function () {

            // If the key starts with "base64:", we will need to decode the key before handing
            // it off to the encrypter. Keys may be base-64 encoded for presentation and we
            // want to make sure to convert them back to the raw bytes before encrypting.
            if (Str::startsWith($key = config('envcrypt.key'), 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            $encrypter = new Encrypter($key, config('envcrypt.cipher'));

            return new Envcrypt($encrypter);
        });
    }
}
