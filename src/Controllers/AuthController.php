<?php

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController
{
    public function login()
    {
        ob_start();
        include '../src/Views/auth/login.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function logout() {
        session_destroy();
        return new RedirectResponse('/');
    }

    public function postLogin(Request $request)
    {
        $email = $request->request->get('email'); 
        $password = $request->request->get('password');
        $model = new User();
        $me = $model->login([
            'email' => $email,
            'password' => $password,
        ]);
        $_SESSION['user'] = $me;
        $_SESSION['email'] = $me['email'];
        $_SESSION['role'] = $me['role'];
        return new RedirectResponse('/');
    }
}
