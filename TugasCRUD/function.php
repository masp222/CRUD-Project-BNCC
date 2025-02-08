<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "db_mahasiswa");

// membuat fungsi query dalam bentuk array
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function login($email, $password, $remember)
{
    global $koneksi;

    // Cari pengguna berdasarkan email
    $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    // Jika pengguna ditemukan dan password cocok
    if ($user['id'] && $user['password'] === $password) {
        // Set session login
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];

        // Jika "Remember Me" dicentang
        if ($remember) {
            $token = bin2hex(random_bytes(32)); // Token acak 64 karakter
            setcookie('remember_token', $token, time() + (86400 * 30), "/"); // Simpan cookie 30 hari

            // Simpan token ke database
            mysqli_query($koneksi, "UPDATE mahasiswa SET remember_token = '$token' WHERE id = '{$user['id']}'");
        }

        return true;
    }

    return false;
}
        
// Fungsi upload gambar
function uploadPhoto($file)
{
    $targetDir = "uploads/";
    $fileName = basename($file['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    // Cek apakah file adalah gambar
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        return false;
    }
    
    // Pindahkan file yang diunggah ke folder tujuan
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        return $fileName;
    }
    return false;
}

// Membuat fungsi tambah
function tambah($data, $file)
{
    global $koneksi;

    // Ambil ID terakhir dari database
    $result = mysqli_query($koneksi, "SELECT id FROM mahasiswa ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);

    // Generate Auto-Incremented String ID
    if ($row) {
        $lastId = $row['id'];  // Example: "MHS005"
        $num = (int)substr($lastId, 3); // Extract number: 5
        $newId = "MHS" . str_pad($num + 1, 3, "0", STR_PAD_LEFT); // Result: "MHS006"
    } else {
        $newId = "MHS001"; // If no data, start from "MHS001"
    }

    $first_name = htmlspecialchars($data['first_name']);
    $last_name = htmlspecialchars($data['last_name']);
    $email = htmlspecialchars($data['email']);
    $bio = htmlspecialchars($data['bio']);
    $password = md5($first_name);

    //  Prevent Duplicate Email
    $checkEmail = mysqli_query($koneksi, "SELECT email FROM mahasiswa WHERE email = '$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        return -2; // Email already exists
    }

    //  Prevent Duplicate Full Name
    $checkName = mysqli_query($koneksi, "SELECT first_name, last_name FROM mahasiswa 
                                         WHERE first_name = '$first_name' AND last_name = '$last_name'");
    if (mysqli_num_rows($checkName) > 0) {
        return -3; // Name already exists
    }

    // Upload Photo
    $photo = uploadPhoto($file);
    if (!$photo) {
        return -1; // Upload failed
    }

    // Prevent Duplicate Photo Name
    $checkPhoto = mysqli_query($koneksi, "SELECT photo FROM mahasiswa WHERE photo = '$photo'");
    if (mysqli_num_rows($checkPhoto) > 0) {
        return -4; // Photo name already exists
    }

    // Insert Data
    $sql = "INSERT INTO mahasiswa (id, first_name, last_name, email, bio, photo, password) 
            VALUES ('$newId', '$first_name', '$last_name', '$email', '$bio', '$photo', '$password')";

    mysqli_query($koneksi, $sql);
    return mysqli_affected_rows($koneksi);
}


// Membuat fungsi hapus
function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id = '$id'");
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi ubah
function ubah($data, $file)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $first_name = htmlspecialchars($data['first_name']);
    $last_name = htmlspecialchars($data['last_name']);
    $email = htmlspecialchars($data['email']);
    $bio = htmlspecialchars($data['bio']);
    $password = md5($first_name);

    // Cek apakah email baru sudah digunakan oleh orang lain
    $checkEmail = mysqli_query($koneksi, "SELECT email FROM mahasiswa WHERE email = '$email' AND id != '$id'");
    if (mysqli_num_rows($checkEmail) > 0) {
        return -2; // Email sudah dipakai oleh user lain
    }

    // Cek apakah nama sudah digunakan
    $checkName = mysqli_query($koneksi, "SELECT first_name, last_name FROM mahasiswa 
                                         WHERE first_name = '$first_name' AND last_name = '$last_name' AND id != '$id'");
    if (mysqli_num_rows($checkName) > 0) {
        return -3; // Nama sudah ada
    }

    // Cek apakah user mengunggah foto baru
    $photo = uploadPhoto($file);
    if ($photo) {
        // Jika ada foto baru, cek apakah nama foto sudah digunakan
        $checkPhoto = mysqli_query($koneksi, "SELECT photo FROM mahasiswa WHERE photo = '$photo' AND id != '$id'");
        if (mysqli_num_rows($checkPhoto) > 0) {
            return -4; // Nama foto sudah ada
        }
        // Update dengan foto baru
        $sql = "UPDATE mahasiswa SET 
                first_name = '$first_name',
                last_name = '$last_name',
                email = '$email',
                bio = '$bio',
                photo = '$photo',
                password = '$password'
                WHERE id = '$id'";
    } else {
        // Update tanpa mengganti foto
        $sql = "UPDATE mahasiswa SET 
                first_name = '$first_name',
                last_name = '$last_name',
                email = '$email',
                bio = '$bio',
                password = '$password'
                WHERE id = '$id'";
    }

    mysqli_query($koneksi, $sql);
    return mysqli_affected_rows($koneksi);
}
