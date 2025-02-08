<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika fungsi tambah jika data tersimpan, maka munculkan alert dibawah
if (isset($_POST['simpan'])) {
    $result = tambah($_POST, $_FILES['photo']);

    if ($result > 0) {
        echo "<script>
                alert('Data Mahasiswa berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    } elseif ($result == -2) {
        echo "<script>alert('Gagal! Email sudah terdaftar.');</script>";
    } elseif ($result == -3) {
        echo "<script>alert('Gagal! Nama sudah ada.');</script>";
    } elseif ($result == -4) {
        echo "<script>alert('Gagal! Nama file foto sudah ada, coba rename foto.');</script>";
    } else {
        echo "<script>alert('Data Mahasiswa gagal ditambahkan!');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>Tambah Data</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">BNCC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="text-center fw-bold text-uppercase"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah Data Member</h3>
                <hr>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control w-50" id="first_name" placeholder="Masukkan Nama Depan" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control w-50" id="last_name" placeholder="Masukkan Nama Belakang" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control w-50" id="email" placeholder="Masukkan Email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control w-50" id="bio" placeholder="Masukkan Bio" name="bio"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" class="form-control w-50" id="photo" name="photo">
                    </div>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->

</body>
</html>
