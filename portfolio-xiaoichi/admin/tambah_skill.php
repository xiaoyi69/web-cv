<?php
session_start();
// Proteksi Session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php";
/** @var mysqli $koneksi */

if (isset($_POST['simpan'])) {
    $nama_skill = mysqli_real_escape_string($koneksi, $_POST['nama_skill']);
    if (!empty($nama_skill)) {
        mysqli_query($koneksi, "INSERT INTO skill (nama_skill) VALUES ('$nama_skill')");
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Skill</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
<div class="card big" style="max-width: 400px; width: 100%;">
    <h3 style="margin-bottom: 20px;">Tambah Skill Baru</h3>
    <form method="POST">
        <label>NAMA SKILL
            <input type="text" name="nama_skill" required placeholder="Contoh: React.js">
        </label>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <button type="submit" name="simpan" class="btn primary">Simpan</button>
            <a href="dashboard.php" class="btn">Batal</a>
        </div>
    </form>
</div>
</body>
</html>