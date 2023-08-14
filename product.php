<?php
require_once "inc/header.php";
require_once "app/classes/Product.php";
require_once "app/classes/Cart.php";

$product = new Product();
$product = $product->read($_GET['product_id']);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id = $product['product_id'];
    $user_id = $_SESSION['user_id'];

    $quantity = $_POST['quantity'];

    $cart = new Cart();
    $cart->add_to_cart($product_id, $user_id, $quantity);

    header("location: cart.php");
    exit();
}
?>

<style>
   .hover-gray {
        color: white;
        background-color: black;
        margin-bottom: 3%;
    }
    .card {
        background-color: black;
        margin-bottom: 3%;
        color: white;
    }
    .card-img-top {
        border: solid cyan;
        height: 100%;
        width: 100%; 
        fit: cover; 
    }
</style>


<div class="row bg-dark border">
    <div class="col-lg-6">
        <img src="public/product_images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="card-img-top">
    </div>

    <div class="col-lg-6">
        <div class="card p-3">
            <h1><?= $product['name'] ?></h1>
            <p>Size: <b><?= $product['size'] ?></b></p>
            <p>Price: <b>$<?= $product['price'] ?></b></p>
        </div>
        <?php if($user->is_logged()) : ?>
            <form action="" method="post">
                <label for="quantity">Enter Quantity (how many)</label>
                <input type="number" name="quantity" class="form-control bg-dark text-white" value="1">
                <button type="submit" class="btn border border-primary hover-gray">Add to Cart</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php
require_once "inc/footer.php";
?>