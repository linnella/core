<?php

namespace Core\Admin\Middleware;

use Core\Admin\Form;
use Core\Admin\Grid;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, \Closure $next)
    {
        Form::registerBuiltinFields();

        if (file_exists($bootstrap = admin_path('bootstrap.php'))) {
            require $bootstrap;
        }

        Form::collectFieldAssets();

        Grid::registerColumnDisplayer();

        return $next($request);
    }
}
