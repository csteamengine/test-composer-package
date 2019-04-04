<?php

namespace Csteamengine\ProjectManager;

use Illuminate\Support\ServiceProvider;

class ProjectManagerServiceProvider extends ServiceProvider
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
            __DIR__.'/config/project-manager.php' => config_path('project-manager.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'ProjectManager');
    }
}
