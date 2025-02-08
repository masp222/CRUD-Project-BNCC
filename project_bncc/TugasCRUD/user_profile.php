<?php
session_start();
require 'function.php';

// Cek apakah ID dikirim dari tabel
if (!isset($_GET['id'])) {
    echo "<script>alert('User tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

$id = $_GET['id'];

// Ambil data user berdasarkan ID yang dikirim dari tabel
$user = query("SELECT * FROM mahasiswa WHERE id = '$id'");

if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

$user = $user[0]; // Ambil data pertama
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">BNCC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="text-center fw-bold text-uppercase"><i class="bi bi-person-plus-fill"></i>&nbsp;Profile</h3>
            </div>
            <hr>
        </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body text-center">
                    <img src="uploads/<?= htmlspecialchars($user['photo']); ?>" class="rounded-circle" width="150" height="150" alt="Profile Photo">
                </div>
                    <div class="card-body">
                        <p><strong>Nama Depan:</strong> <?= htmlspecialchars($user['first_name']); ?></p>
                        <p><strong>Nama Belakang:</strong> <?= htmlspecialchars($user['last_name']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
                        <p><strong>Bio:</strong> <?= htmlspecialchars($user['bio']); ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Close Container -->
</body>
</html>
