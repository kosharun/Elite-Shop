<?php
require_once "inc/header.php";
require_once "app/classes/Cart.php";
require_once "app/classes/Order.php";

if(!$user->is_logged()){
    header("location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $delivery_address = $_POST['country'] . ", " . $_POST['city'] . ", " . $_POST['zip'] . ", " . $_POST['address'];

    $order = new Order();
    $order = $order->create($delivery_address);

    $_SESSION['message']['type'] = "success";
    $_SESSION['message']['text'] = "Successfully ordered T-Shirts";
    
    $cart = new Cart();
    $cart->delete_from_cart($user_id);

    header("location: orders.php");
    exit();
}

?>
<style>
    .hover-gray {
        color: white;
        background-color: black;
        margin-bottom: 3%;
        border: solid cyan;
    }
    .hover-gray:hover {
        border: solid blue;
    }
</style>

<form method="POST" action="" class="text-white">
    <div class="form-group mb-3">
        <label for="country">Country</label>
        <input type="text" name="country" id="country" class="bg-black text-white form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="country">City</label>
        <input type="text" name="city" id="city" class="bg-black text-white form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="zip">Zip</label>
        <input type="text" name="zip" id="zip" class="bg-black text-white form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="bg-black text-white form-control" required>
    </div>
    <button type="submit" class="btn hover-gray">Order</button>
</form>



<?php require_once("inc/footer.php"); ?>
