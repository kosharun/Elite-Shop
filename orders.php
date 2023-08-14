<?php
require_once("inc/header.php");
require_once("app/classes/Order.php");

if(!$user->is_logged()) {
    header("location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order = new Order();

$orders = $order->get_orders($user_id);
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

<div class="row">
    <div class="col-12 text-center mb-3">
        <a href="clear_order_history.php" class="btn border border-primary hover-gray text-white">Clear Order History</a>
        <br></br>
    </div>
    
    <?php foreach ($orders as $this_order) : $products = $order->get_products($this_order['order_id']); ?>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td><?php echo "$" . $product['price']; ?></td>
                                    <td><?php echo $product['size']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once("inc/footer.php"); ?>
