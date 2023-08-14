<?php

require_once "Cart.php";

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$cart = new Cart();
$cart->remove_from_cart($user_id, $product_id);

header("location: cart.php");
exit();