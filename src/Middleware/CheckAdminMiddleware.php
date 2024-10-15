<?php
namespace App\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminMiddleware implements MiddlewareInterface {
    public function handle(Request $request, callable $next): Response {
        if (!$this->checkAdmin()) {
            return new Response('Unauthorized', 403);
        }
        return $next($request);
    }

    private function checkAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
            return false;
            exit();
        }
    
        return true;
    }
}
