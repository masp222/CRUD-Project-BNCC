<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari id dengan fungsi get
$id = $_GET['id'];

// Validasi apakah ID ada dalam database
$siswa = query("SELECT * FROM mahasiswa WHERE id = '$id'");


if (!$siswa) {
    echo "<script>
            alert('Data tidak ditemukan!');
            document.location.href = 'index.php';
          </script>";
    exit;
}

$siswa = $siswa[0];

// Jika tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (ubah($_POST, $_FILES['photo']) > 0) { 
        echo "<script>
                alert('Data mahasiswa berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data mahasiswa gagal diubah!');
            </script>";
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Ubah Data Mahasiswa</title>
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
                <h3 class="text-center fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data Mahasiswa</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control w-50" id="first_name" value="<?= $siswa['first_name']; ?>" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control w-50" id="last_name" value="<?= $siswa['last_name']; ?>" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control w-50" id="email" value="<?= $siswa['email']; ?>" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <input type="bio" class="form-control w-50" id="bio" value="<?= $siswa['bio']; ?>" name="bio">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" class="form-control w-50" name="photo">
                    </div>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
