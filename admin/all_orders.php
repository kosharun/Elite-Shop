<?php
require_once "../app/config/config.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Order.php";



$user = new User();

if(!$user->is_admin()) {
    header("location: login.php");
    exit();
}

$order = new Order();

$orders = $order->get_all_orders();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $order_id = $_POST['order_id'];
    $order->set_ordered($order_id);

    header("location: all_orders.php");
    exit();
}
?>

<style>
    /* Additional style for table layout */
    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .order-table th,
    .order-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
    .hover-gray:hover {
        background-color: black;
    }
</style>

<!DOCTYPE html>
<html>
<head>
    <title>Elite Shop</title>
    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- dropzone -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<?php require_once "nav.php"; ?>

<div class="row">
    
    <?php foreach ($orders as $this_order) : $products = $order->get_products($this_order['order_id']); ?>
        <?php if(!$this_order['is_ordered'] == 1) : ?>
            <div class="col-md-4">
                <div class="card bg-dark border-primary mb-4">
                    <div class="card-body text-white">
                        <h2 class="card-text">Order</h2>
                        <div class="position-absolute end-0 bg-dark text-white p-2">
                            <?php
                                $orderDate = new DateTime($this_order['created_at']);
                                echo "Ordered: " . $orderDate->format('jS F, Y');
                            ?>                    
                        </div>
                        <br><br>
                        <!-- Display products in a table -->
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Delivery Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td><?php echo $product['name']; ?></td>
                                        <td><?php echo $product['quantity']; ?></td>
                                        <td><?php echo "$" . $product['price']; ?></td>
                                        <td><?php echo $product['size']; ?></td>
                                        <td><?php echo $this_order['delivery_address']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                        <form action="" method="post">
                            <div class="col-12 text-center mb-3">
                                <input type="hidden" name="order_id" value="<?php echo $this_order['order_id']; ?>">
                                <button type="submit" class="btn border border-primary hover-gray text-white btn-danger">Set As Ordered</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>