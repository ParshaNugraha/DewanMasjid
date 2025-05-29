<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $middlewares = config('middleware', []);

        foreach ($middlewares as $alias => $class) {
            $router->aliasMiddleware($alias, $class);
        }
    }

    public function register()
    {
        //
    }
}
