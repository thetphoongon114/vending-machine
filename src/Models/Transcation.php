<?php

namespace App\Models;

use PDO;

class Transcation
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO transactions (user_id, product_id) VALUES (:user_id, :product_id)");
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':product_id', $data['product_id']);
        $stmt->execute();

        $quantity = 1;
        $product = $this->db->prepare("UPDATE products SET quantity_available = quantity_available - :quantity WHERE id = :product_id");
        $product->bindParam(':quantity', $quantity);
        $product->bindParam(':product_id', $data['product_id']);
        return $product->execute();    
    }

    public function all() {
        $stmt = $this->db->prepare("SELECT products.name AS product_name, users.name AS user_name FROM transactions LEFT JOIN products ON products.id = transactions.product_id LEFT JOIN users ON users.id = transactions.user_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}