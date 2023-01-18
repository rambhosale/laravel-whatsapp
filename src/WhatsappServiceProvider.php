<?php

namespace Rambhosale\LaravelWhatsapp;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WhatsappServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-whatsapp')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this->app->singleton('laravel-whatsapp', function ($app) {
            return new Whatsapp($app['config']->get('whatsapp'));
        });
    }
}
