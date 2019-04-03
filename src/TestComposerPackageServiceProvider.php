<?php

namespace Csteamengine\TestComposerPackage;

use Illuminate\Support\ServiceProvider;

class TestComposerPackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/test-composer-package.php' => config_path('test-composer-package.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/csteamengine/testcomposerpackage'),
        ]);
    }
}
