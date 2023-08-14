<?php
require_once("inc/header.php");
require_once("app/classes/User.php");

if($user->is_logged()) {
    header("location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $created = $user->create($name, $username, $email, $password);

    if ($created) {
        $_SESSION['message']['type'] = "success";
        $_SESSION['message']['text'] = "Successfully registered user";
        header("location: login.php");
        exit();
    } 
    else {
        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Failed to registered user";
        header("location: register.php");
        exit();
    }
}


?>




<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow bg-black text-white">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Register</h2>
                <form action="" method="POST" class="needs-validation" >
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <div class="invalid-feedback">Please enter your full name.</div>
                    </div> 

                    <div class="mb-3">
                        <label for="username" name="username" id="username" class="form-label" required>Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">Please enter your email address.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <br>
                    <a href="login.php" class="text-white">Already have an account?</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("inc/footer.php"); ?>
