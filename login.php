<?php
require 'proses/init.php';

if (isset($_SESSION['is_login'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css 4 -->
    <link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
    <!-- My Style -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Login - Restomenu</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">Restomenu</a>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 mx-auto bg-light p-5 shadow-sm border">
                <h1 class="text-center mb-4">Login</h1>
                <form action="proses/login_proses.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" autocomplete="off" name="password">
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="showPass">
                        <label class="custom-control-label" for="showPass">Lihat password</label>
                    </div>
                    <button type="submit" class="btn btn-my-color" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="vendor/Jquery/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap Js 4 -->
    <script src="vendor/bootstrap4/js/bootstrap.min.js"></script>
    <!-- My Script -->
    <script src="assets/js/script.js"></script>
</body>

</html>