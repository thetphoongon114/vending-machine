<?php
namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(Request $request, callable $next): Response {
        if (!$this->isAuthenticated()) {
            return new RedirectResponse('/login');
        }

        return $next($request);
    }

    private function isAuthenticated() {
        return isset($_SESSION['user']);
    }
}
