<?php 
require_once "../app/config/config.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Product.php";

$user = new User();
$products = new Product();
$products = $products->fetch_all();


if($user->is_logged() && $user->is_admin()) : 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Elite Shop</title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>


<?php require_once "nav.php"; ?>

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
            fit: cover; /* Ensure the image retains its aspect ratio */
        }
    </style>

    <div class="container">
        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">
                <?php
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 text-center">
                <a href="add_product.php" class="btn border border-primary hover-gray btn-warning"><i class="bi"> Add Product</i></a>    
            </div>
            <br></br>
            <br></br>
            <?php foreach($products as $product) : ?>
                <div class="col-md-3">
                    <div class="card border-3 border-primary">
                        <div class="card-body text-white">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <img src="../public/product_images/<?= $product['image']  ?>" class="card-img-top" alt="">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text">Size: <?= $product['size'] ?></p>
                            </div>
                            <p class="card-text">$<?= $product['price'] ?></p>
                            <a href="edit_product.php?id=<?= $product['product_id'] ?>" class="btn border border-primary hover-gray btn-primary">Edit</a>   
                            <a href="delete_product.php?id=<?= $product['product_id'] ?>" class="btn border border-primary hover-gray btn-danger">Delete</a>     
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>



<?php 
endif; 
?>