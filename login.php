<?php

require_once("inc/header.php"); 
require_once("app/classes/User.php"); 

if($user->is_logged()) {
    header("location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $user->login($username, $password);

    if(!$result) {
        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Invalid username or password!"; 
        header("Location: login.php");
        exit();
    }

    header("Location: index.php");
    exit();
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow bg-black text-white">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Login</h2>
                <form action="" method="POST" class="needs-validation">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <br>
                    <a href="register.php" class="text-white">Create an account</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("inc/footer.php"); ?>
