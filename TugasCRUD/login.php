<?php
session_start();
require 'function.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $remember = isset($_POST['remember']); // True jika checkbox dicentang

    if (login($email, $password, $remember)) {
        header("Location: index.php"); // Arahkan ke halaman utama
        exit;
    } else {
        echo "<script>alert('Email atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">BNCC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 text-center login" style="background-image: url('img/bg/memphis-colorful.png');">
                <h4 class="fw-bold">Login</h4>
                <?php if (isset($error)) : ?>
                    <script>alert("Email atau Password Salah!");</script>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group user">
                        <input type="email" class="form-control w-50" placeholder="Masukkan Email" name="email" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="password" class="form-control w-50" placeholder="Masukkan Password" name="password" required>
                    </div>
                    <div class="form-group my-2">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                    <button class="btn btn-primary text-uppercase" type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
