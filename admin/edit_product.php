<?php

require_once "../app/config/config.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Product.php";


$user = new User();

if($user->is_logged() && $user->is_admin()) :

    $product_obj = new Product();
    $product = $product_obj->read($_GET['id']);

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $product_id = $_GET['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $image = $_POST['photo_path'];

        $product_obj->update($product_id, $name, $price, $size, $image);

        $_SESSION['message']['type'] = "success";
        $_SESSION['message']['text'] = "Successfully updated product!";

        header("location: index.php");
        exit();
    }

endif;

?>
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

</head>

<?php require_once "nav.php"; ?>

<div class="container d-flex justify-content-center align-items-center vh-80">
    <form class="bg-dark p-5 rounded border border-primary" action="" method="post" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control bg-dark text-white" name="name" placeholder="Name" value="<?php echo $product['name']; ?>">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control bg-dark text-white" name="price" placeholder="Price" value="<?php echo $product['price']; ?>">
        </div>

        <div class="mb-3">
            <label for="size" class="form-label">Size</label>
            <input type="text" class="form-control bg-dark text-white" name="size" placeholder="Size" value="<?php echo $product['size']; ?>">
        </div>

        <div class="mb-3">
            <input type="hidden" name="photo_path" id="photoPathInput" value="<?php echo $product['image']; ?>">
            <div id="dropzone-upload" class="dropzone bg-dark border rounded"></div>
        </div>
        
        <br>
        <div class="row">
            <div class="col text-start">
                <button type="submit" class="btn btn-primary">Finish</button>
            </div>
            <div class="col text-end">
                <a type="button" class="btn btn-danger" href="index.php">Cancel</a>
            </div>
        </div>
        
    </form>
</div>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>

        Dropzone.options.dropzoneUpload={
            url: "upload_photo.php",
            paramName: "photo",
            maxFilesize: 20, // MB
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function (file, response) { 
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        document.getElementById('photoPathInput').value = jsonResponse.photo_path;
                    } else { 
                        console.error(jsonResponse.error);
                    }
                });
            }
        };
    </script> 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
