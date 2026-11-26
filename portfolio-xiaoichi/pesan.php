<?php 
session_start();

// Mencegah akses jika belum login sebagai admin
if (!isset($_SESSION['login'])) {
    header("Location: admin/login.php");
    exit();
}

include "koneksi.php"; 
/** @var mysqli $koneksi */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesan Masuk</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="padding: 40px 20px;">
<div class="wrap">
    <div class="card big">
        <div class="row" style="justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Pesan Masuk (Admin Only)</h2>
            <a href="admin/dashboard.php" class="btn">Kembali ke Dashboard</a>
        </div>

        <?php
        $query_pesan = "SELECT * FROM pesan_kontak ORDER BY id DESC";
        $hasil_pesan = mysqli_query($koneksi, $query_pesan);

        if ($hasil_pesan && mysqli_num_rows($hasil_pesan) > 0) {
            while ($baris = mysqli_fetch_assoc($hasil_pesan)) {
                ?>
                <div style="margin-bottom: 15px;">
                    <p style="font-size: 0.9rem; margin-bottom: 6px;">
                        <strong><?= htmlspecialchars($baris['nama']) ?></strong> 
                        (<?= htmlspecialchars($baris['email']) ?>) — 
                        <small class="mut"><?= $baris['tanggal'] ?></small>
                    </p>
                    <p style="font-size: 0.85rem; color: var(--mut);">
                        <?= htmlspecialchars($baris['pesan']) ?>
                    </p>
                </div>
                <hr style="border:0; border-top:1px solid var(--bd); margin: 15px 0;">
                <?php
            }
        } else {
            echo "<p class='mut' style='font-size: 0.85rem;'>Belum ada pesan yang tersimpan.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>