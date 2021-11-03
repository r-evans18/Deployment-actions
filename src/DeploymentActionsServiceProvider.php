<?php

namespace RC\DeploymentActions;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use RC\DeploymentActions\Components\Prompt;
use RC\DeploymentActions\Http\Middleware\DeploymentActionRun;

class DeploymentActionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require_once __DIR__.'/Helpers/helper.php';

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('deploymentActionRun', DeploymentActionRun::class);

        $this->loadViewsFrom(__DIR__ . '/views', 'deployment-actions');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewComponentsAs('deployment-action', [
            Prompt::class,
        ]);

        $this->publishes([
            __DIR__.'/config/deployment.php' => config_path('deployment.php')
        ], 'deployment-actions-config');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'deployment-actions-migrations');
    }

    public function register()
    {

    }
}
