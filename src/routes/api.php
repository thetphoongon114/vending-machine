<?php

use App\Controllers\Api\AuthController;
use App\Controllers\Api\ProductController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {

    $routes->add('api-login', '/api/login')
        ->controller([AuthController::class, 'login'])
        ->methods(['POST']);

    $routes->add('api-products', '/api/products')
        ->defaults(['_middleware' => ['App\Middleware\APIMiddleware']])
        ->controller([ProductController::class, 'index'])
        ->methods(['GET']);

    $routes->add('api-show-product', '/api/products/{id}')
        ->controller([ProductController::class, 'show'])
        ->defaults(['_middleware' => ['App\Middleware\APIMiddleware']])
        ->methods(['GET']);
};
