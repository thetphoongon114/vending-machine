<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Transcation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController
{
    public function index(Request $request)
    {
        $model = new Product();
        $products = $model->all();

        ob_start();
        include '../src/Views/product/index.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function show($id)
    {
        $model = new Product();
        $product = $model->find($id);

        ob_start();
        include '../src/Views/product/detail.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function create(Request $request)
    {
        ob_start();
        include '../src/Views/product/create.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function store(Request $request)
    {
        $name = $request->request->get('name');
        $price = $request->request->get('price');
        $quantity_available = $request->request->get('quantity_available');
        $data = ['name' => $name, 'price' => $price, 'quantity_available' => $quantity_available];
        if(empty($name) || empty($price) || empty($quantity_available)) {
            $_SESSION['validation'] = "All fields are required!";
            return new RedirectResponse('/product');
        }
        $product = new Product();
        $product->store($data);
        return new RedirectResponse('/');
    }

    public function edit($id)
    {
        $model = new Product();
        $product = $model->find($id);

        ob_start();
        include '../src/Views/product/edit.php';
        $content = ob_get_clean();
        return new Response($content);
    }

    public function update(Request $request, $id)
    {
        $name = $request->request->get('name');
        $price = $request->request->get('price');
        $quantity_available = $request->request->get('quantity_available');
        if(empty($name) || empty($price) || empty($quantity_available)) {
            $_SESSION['validation'] = "All fields are required!";
            return new RedirectResponse("/product/{$id}");
        }
        $model = new Product();
        $model->update($id, ['name' => $name, 'price' => $price, 'quantity_available' => $quantity_available]);
        return new RedirectResponse('/');
    }

    public function destory(Request $request, $id)
    {
        if ($request->request->get('_method') === 'DELETE') {
            $model = new Product();
            $model->delete($id);
            ob_get_clean();
            return new RedirectResponse('/');
        }
    }

    public function purchase(Request $request, $id)
    {
        $user_id = $_SESSION['user']['id'];
        $transcation = new Transcation();
        $transcation->create(['product_id' => $id, 'user_id' => $user_id]);
        $model = new Product();
        $product = $model->find($id);

        ob_start();
        $content = ob_get_clean();

        return new RedirectResponse("/product/{$id}/detail");
    }


    public function transactions(Request $request)
    {
        $model = new Transcation();
        $transactions = $model->all();

        ob_start();
        include '../src/Views/product/transaction.php';
        $content = ob_get_clean();
        return new Response($content);
    }
}
