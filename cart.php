<?php
require_once "inc/header.php";
require_once "app/classes/Cart.php";

if(!$user->is_logged()){
    header("location: login.php");
    exit();
}

$cart = new Cart();
$cart_items = $cart->get_cart_items();




?>
<style>
    .hover-gray {
        color: cyan;
        margin-bottom: 3%;
    }
    .hover-gray:hover {
        background-color: black;
        color: white;
    }
    .card {
        background-color: black;
        margin-bottom: 3%;
    }
    .card:hover {
        background-color: darkcyan;
    }
    .card-img-top {
        width: 10vw;
        height: 10vw;
    }
</style>

<div class="row">
    <div class="col-12 text-center mb-3">
        <a href="checkout.php" class="btn border border-primary hover-gray">Purchase All</a>
    </div>
    <?php foreach ($cart_items as $items) : ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-white">
                    <h2 class="card-text"><?php echo $items['name']; ?></h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-text"><?php echo "$" . $items['price'] . ", Size: <b>" . $items['size'] . "</b>"; ?></p>
                    </div>
                    <p class="card-text">Quantity: <?php echo $items['quantity']; ?></p>
                    <img src="public/product_images/<?= $items['image']  ?>" class="card-img-top" alt="">
                </div>
                <div class="text-center">
                    <a href="remove_from_cart.php?id=<?= $items['product_id'] ?>" class="btn border border-primary hover-gray col-5">Remove from Cart</a>     
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php require_once "app/classes/Cart.php"; ?>