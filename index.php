<?php 
require_once "inc/header.php"; 
require_once "app/classes/Product.php"; 

$products = new Product();
$products = $products->fetch_all(); 
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
    }
    .card:hover {
        background-color: darkcyan;
    }
    .card-img-top {
        height: 30vh; /* Set a constant image height */
        object-fit: cover;
    }
</style>

<div class="row">
    <?php foreach($products as $product) : ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-white">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <img src="public/product_images/<?= $product['image']  ?>" class="card-img-top img-fluid" alt="">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-text">Size: <?= $product['size'] ?></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-text">$<?= $product['price'] ?></p>
                        <a href="product.php?product_id=<?= $product['product_id'] ?>" class="btn border border-primary hover-gray">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once "inc/footer.php"; ?>
