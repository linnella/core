<?php

namespace Core\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        'Core\Admin\Console\MakeCommand',
        'Core\Admin\Console\MenuCommand',
        'Core\Admin\Console\InstallCommand',
        'Core\Admin\Console\UninstallCommand',
        'Core\Admin\Console\ImportCommand',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin.auth'       => \Core\Admin\Middleware\Authenticate::class,
        'admin.pjax'       => \Core\Admin\Middleware\Pjax::class,
        'admin.log'        => \Core\Admin\Middleware\LogOperation::class,
        'admin.permission' => \Core\Admin\Middleware\Permission::class,
        'admin.bootstrap'  => \Core\Admin\Middleware\Bootstrap::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.auth',
            'admin.pjax',
            'admin.log',
            'admin.bootstrap',
            'admin.permission',
        ],
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin');

        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'admin-config');
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'admin-lang');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'admin-migrations');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/admin')], 'admin-assets');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadAdminAuthConfig();

        $this->registerRouteMiddleware();

        $this->commands($this->commands);
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(array_dot(config('admin.auth', []), 'auth.'));
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
