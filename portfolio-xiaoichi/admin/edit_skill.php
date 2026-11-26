<?php
session_start();
// Proteksi Session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php";
/** @var mysqli $koneksi */

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM skill WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['update'])) {
    $nama_skill = mysqli_real_escape_string($koneksi, $_POST['nama_skill']);
    if (!empty($nama_skill)) {
        mysqli_query($koneksi, "UPDATE skill SET nama_skill = '$nama_skill' WHERE id = $id");
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Skill</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
<div class="card big" style="max-width: 400px; width: 100%;">
    <h3 style="margin-bottom: 20px;">Edit Skill</h3>
    <form method="POST">
        <label>NAMA SKILL
            <input type="text" name="nama_skill" value="<?= htmlspecialchars($data['nama_skill']) ?>" required>
        </label>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <button type="submit" name="update" class="btn primary">Update</button>
            <a href="dashboard.php" class="btn">Batal</a>
        </div>
    </form>
</div>
</body>
</html>