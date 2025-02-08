<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Menampilkan semua data dari tabel mahasiswa berdasarkan id secara descending
$siswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

// Membuat nama file
$filename = "data_mahasiswa_fti-" . date('Ymd') . ".xls";

// Export ke Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>ID Mahasiswa</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Bio</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($siswa as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id']; ?></td>
                <td><?= $row['first_name'] . ' ' . $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['bio']; ?></td>
                <td>
                    <?php if ($row['photo']) : ?>
                        <img src="uploads/<?= $row['photo']; ?>" width="50">
                    <?php else : ?>
                        Tidak ada foto
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
