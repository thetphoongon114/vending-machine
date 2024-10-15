<?php

namespace App\Controllers\Api;

use App\Models\Product;
use App\Services\JwtService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController {
    public function index(Request $request) {
        $model = new Product();
        $products = $model->all();
        return new JsonResponse(['data' => $products], 200);
    }

    public function show($id) {
        $model = new Product();
        $product = $model->find($id);
        if($product) {
            return new JsonResponse(['data' => $product], 200);
        } else {
            return new JsonResponse(['message' => "Product not found"], 404);
        } 
    }
}