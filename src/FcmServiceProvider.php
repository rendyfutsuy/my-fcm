<?php

namespace Angga\Fcm;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Angga\Fcm\Fcm;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class FcmServiceProvider
 * @package Angga\Fcm\Providers
 */
class FcmServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/config/my-fcm.php' => config_path('my-fcm.php'),
            ]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('my-fcm');
        }
    }

    public function register()
    {
        $this->app->bind('fcm', function ($app) {
            return new Fcm(
                config('my-fcm.server_key')
            );
        });
    }
}
