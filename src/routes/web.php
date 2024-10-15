<?php

use App\Controllers\AuthController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('login', '/login')
        ->controller([AuthController::class, 'login'])
        ->methods(['GET', 'HEAD']);

    $routes->add('postLogin', '/login')
        ->controller([AuthController::class, 'postLogin'])
        ->methods(['POST']);

    $routes->add('logout', '/logout')
        ->controller([AuthController::class, 'logout'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware']]);

    $routes->add('home', '/')
        ->controller([ProductController::class, 'index']);

    $routes->add('prducsts', '/products')
        ->controller([ProductController::class, 'index'])
        ->methods(['GET']);

    $routes->add('productCreate', '/product')
        ->controller([ProductController::class, 'create'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['GET']);

    $routes->add('productStore', '/product')
        ->controller([ProductController::class, 'store'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['POST']);

    $routes->add('productEdit', '/product/{id}')
        ->controller([ProductController::class, 'edit'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['GET']);

    $routes->add('productUpdate', '/product/{id}')
        ->controller(([ProductController::class, 'update']))
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['POST']);

    $routes->add('productDelete', '/product/{id}/delete')
        ->controller(([ProductController::class, 'destory']))
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['POST']);

    $routes->add('productDetail', '/product/{id}/detail')
        ->controller(([ProductController::class, 'show']))
        ->methods(['GET']);

    $routes->add('productPurchase', '/product/{id}/purchase')
        ->controller(([ProductController::class, 'purchase']))
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware']])
        ->methods(['POST']);

    $routes->add('users', 'users')
        ->controller([UserController::class, 'index'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['GET']);

    $routes->add('userEdit', 'user/{id}')
        ->controller([UserController::class, 'edit'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['GET']);

    $routes->add('userUpdate', 'user/{id}/update')
        ->controller([UserController::class, 'update'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['POST']);

    $routes->add('transactions', 'transactions')
        ->controller([ProductController::class, 'transactions'])
        ->defaults(['_middleware' => ['App\Middleware\AuthMiddleware', 'App\Middleware\CheckAdminMiddleware']])
        ->methods(['GET']);
};
