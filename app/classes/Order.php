<?php

require_once "Cart.php";

class Order extends Cart {
    protected $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function create($delivery_address) {
        $run = $this->conn->prepare("INSERT INTO orders (user_id, delivery_address) VALUES (? , ?)");
        $run->bind_param("is", $_SESSION['user_id'], $delivery_address);
        $run->execute();

        $order_id = $this->conn->insert_id;

        $cart_items = $this->get_cart_items();

        $run = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (? , ?, ?)");

        foreach ($cart_items as $item) {
            $run->bind_param("iis", $order_id, $item['product_id'], $item['quantity']);
            $run->execute();
        }
    }

    public function clear_orders($user_id) {
        $run = $this->conn->prepare("DELETE FROM orders WHERE user_id = ?");
        $run->bind_param("i", $user_id);
        $run->execute();
    }

    public function set_ordered($order_id) {
        $run = $this->conn->prepare("UPDATE orders SET is_ordered = 1 WHERE order_id = ?");
        $run->bind_param("i", $order_id);
        $run->execute();
    }

    public function is_ordered($order_id) {
        $run = $this->conn->prepare("SELECT is_ordered FROM orders WHERE order_id = ?");
        $run->bind_param("i", $order_id);
        $run->execute();

        $result = $run->get_result();

        if ($result->fetch_assoc() == 1){
            return true;
        }

        return false;
    }

    public function get_orders($user_id) {
        $run = $this->conn->prepare("SELECT * FROM orders WHERE user_id = ?");
        $run->bind_param("i", $user_id);
        $run->execute();
        $results = $run->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function get_all_orders() {
        $run = $this->conn->prepare("SELECT * FROM orders");
        $run->execute();
        $results = $run->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function get_products($order_id) {
        $run = $this->conn->prepare("SELECT p.name, p.price, p.size, p.image, oi.quantity FROM products p INNER JOIN order_items oi ON p.product_id = oi.product_id WHERE oi.order_id = ?");

        $run->bind_param("i", $order_id);
        $run->execute();
        $result = $run->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>