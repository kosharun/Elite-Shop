<?php

class Product {
    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function create($name, $price, $size, $image) {
        $sql = "INSERT INTO products (name, price, size, image) VALUES (?, ?, ?, ?)";
        $run = $this->conn->prepare($sql);
        $run->bind_param("ssss", $name, $price, $size, $image);
        $run->execute();
    }

    public function read($product_id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";

        $run = $this->conn->prepare($sql);
        $run->bind_param("i", $product_id);
        $run->execute();
    
        $results = $run->get_result();

        return $results->fetch_assoc();
    }

    public function update($product_id, $name, $price, $size, $image) {
        $sql = "UPDATE products SET name = ?, price = ?, size = ?, image = ? WHERE product_id = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("ssssi", $name, $price, $size, $image, $product_id);
        $run->execute();
    }

    public function delete($product_id) {
        $sql = "DELETE FROM products WHERE product_id = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("i", $product_id);
        $run->execute();
    }

    public function fetch_all() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}

?>