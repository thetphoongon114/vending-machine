<?php

namespace App\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController {
    public function index(Request $request) {
        $model = new User();
        $users = $model->all();

        ob_start();
        include '../src/Views/user/index.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function edit($id) {
        $model = new User();
        $user = $model->find($id);

        ob_start();
        include '../src/Views/user/edit.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function update(Request $request, $id) {
        $data = [
            'name' => $request->request->get('name'),
            'role' => $request->request->get('role')
        ];
        $model = new User();
        $model->update($id, $data);
        unset($_SESSION['role']); 
        $_SESSION['role'] = $request->request->get('role');
        return new RedirectResponse('/users');
    }
}