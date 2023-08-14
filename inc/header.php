<?php 
require_once "app/config/config.php";
require_once "app/classes/User.php";

$user = new User();
if($user->is_logged()) {
    $username = $user->read($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Elite Shop</title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="bg-dark" style="padding: 1%; color: white;">

<nav class="navbar navbar-expand-lg navbar-light bg-black border border-primary" style="margin-bottom: 5%; padding: 0.5%;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        
        <a class="nav-link navbar-brand bg-black text-white" href="index.php" id="" role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
            Elite Shop
        </a>
        <?php if(!$user->is_logged()) : ?>
            <a class="nav-link nav-item bg-black text-white" href="login.php">Login</a>
            <a class="nav-link nav-item bg-black text-white" href="register.php">Register</a>
        <?php endif; ?>
        <?php if($user->is_admin()) : ?>
            <a class="nav-link nav-item bg-black text-white" href="admin/index.php" id="" role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
                Admin Dashboard
            </a> 
        <?php elseif($user->is_logged()) : ?>
            <a class="nav-link nav-item bg-black text-white" href="index.php" id="" role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
                <?php echo $username['username']; ?>
            </a> 
        <?php endif; ?>
    </div>
    <?php if($user->is_logged()) : ?>
        <a class="nav-link nav-item bg-black text-white" href="cart.php"><i class="bi bi-cart4"></i> Cart</a> &nbsp;&nbsp;
        <a class="nav-link nav-item bg-black text-white" href="orders.php">My Orders</a>  &nbsp;&nbsp;
        <a class="nav-link nav-item bg-black text-white" href="logout.php">Log Out</a>  &nbsp;&nbsp;
    <?php endif; ?>
</nav>


    <div class="container">

        <?php if(isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> alert-dismissible fade show" role="alert">
                <?php
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
