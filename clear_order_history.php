<?php

require_once "app/config/config.php";
require_once "app/classes/Order.php";

$user_id = $_SESSION['user_id'];

$orders = new Order();
$orders->clear_orders($user_id);

$_SESSION['message']['type'] = "success";
$_SESSION['message']['text'] = "Successfully removed order history!";
header("location: orders.php");
exit();