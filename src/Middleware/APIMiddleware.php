<?php

namespace App\Middleware;

use App\Services\JwtService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class APIMiddleware
{
    private $jwtService;

    public function __construct()
    {
        $this->jwtService = new JwtService();
    }

    public function handle(Request $request, callable $next)
    {
        $authHeader = $request->headers->get('Authorization');
        if (!$authHeader || strpos($authHeader, 'Bearer ') !== 0) {
            return new JsonResponse('Unauthorized: No Bearer token provided', 401);
        }
        $token = str_replace('Bearer ', '', $authHeader);
        if (!$token || !$this->jwtService->validateToken($token)) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
