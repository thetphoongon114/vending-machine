<?php

namespace App\Controllers\Api;

use App\Services\JwtService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\User; 

class AuthController
{
    private $jwtService;

    public function __construct()
    {
        $this->jwtService = new JwtService();
    }

    public function login(Request $request): JsonResponse
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $model = new User();
        $user = $model->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return new JsonResponse(['error' => 'Invalid credentials'], 401);
        }

        $token = $this->jwtService->generateToken(['user_id' => $user['id']]);

        return new JsonResponse([
            'token' => $token->toString(),
        ]);
    }

    public function validateToken(Request $request): JsonResponse
    {
        $authHeader = $request->headers->get('Authorization');

        if (!$authHeader || strpos($authHeader, 'Bearer ') !== 0) {
            return new Response('Unauthorized: No Bearer token provided', 401);
        }
        $token = str_replace('Bearer ', '', $authHeader);
        
        if (!$token || !$this->jwtService->validateToken($token)) {
            return new JsonResponse(['error' => 'Invalid token'], 401);
        }

        return new JsonResponse(['message' => 'Token is valid']);
    }
}
