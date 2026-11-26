<?php
session_start();
// Proteksi Halaman (Poin 2)
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include "../koneksi.php";
/** @var mysqli $koneksi */

// Fitur Delete Skill (Poin 3)
if (isset($_GET['hapus_skill'])) {
    $id = intval($_GET['hapus_skill']);
    mysqli_query($koneksi, "DELETE FROM skill WHERE id = $id");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="padding: 40px 20px;">
<div class="wrap">
  <div class="row" style="align-items: center; justify-content: space-between; margin-bottom: 30px;">
    <h2>Dashboard Admin Portfolio</h2>
    <div>
        <a href="../index.php" target="_blank" class="btn" style="margin-right: 10px;">Lihat Web</a>
        <!-- Logout (Poin 5) -->
        <a href="logout.php" class="btn" style="background:#dc2626; color:#fff; border:0;">Logout</a>
    </div>
  </div>

  <!-- CRUD Read & Delete Skill -->
  <div class="card big" style="margin-bottom: 30px;">
    <div class="row" style="justify-content: space-between; align-items: center; margin-bottom: 15px;">
      <h4>Manajemen Keahlian (Skills)</h4>
      <a href="tambah_skill.php" class="btn primary" style="padding: 6px 14px; font-size:0.75rem;">+ Tambah Skill</a>
    </div>
    <table style="width:100%; border-collapse: collapse; font-size: 0.85rem;">
      <thead>
        <tr style="border-bottom: 1px solid var(--bd); text-align: left;">
          <th style="padding: 8px;">No</th>
          <th style="padding: 8px;">Nama Skill</th>
          <th style="padding: 8px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        $data_skill = mysqli_query($koneksi, "SELECT * FROM skill");
        if ($data_skill && mysqli_num_rows($data_skill) > 0):
            while($row = mysqli_fetch_assoc($data_skill)): 
        ?>
        <tr style="border-bottom: 1px solid var(--bd);">
          <td style="padding: 8px;"><?= $no++ ?></td>
          <td style="padding: 8px;"><?= htmlspecialchars($row['nama_skill']) ?></td>
          <td style="padding: 8px;">
            <a href="edit_skill.php?id=<?= $row['id'] ?>" style="color:#0ea5e9; margin-right:10px;">Edit</a>
            <a href="dashboard.php?hapus_skill=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" style="color:#dc2626;">Hapus</a>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="3" style="padding: 12px; text-align:center;" class="mut">Belum ada data skill.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Membaca Pesan Kontak Terproteksi (Poin 4) -->
  <div class="card big">
    <h4 style="margin-bottom: 15px;">Daftar Pesan Masuk (Pesan Kontak)</h4>
    <?php
    $query_pesan = "SELECT * FROM pesan_kontak ORDER BY id DESC";
    $hasil_pesan = mysqli_query($koneksi, $query_pesan);

    if ($hasil_pesan && mysqli_num_rows($hasil_pesan) > 0):
        while ($baris = mysqli_fetch_assoc($hasil_pesan)):
    ?>
    <p style="font-size: 0.85rem; margin-bottom: 8px;">
      <strong><?= htmlspecialchars($baris['nama']) ?></strong> 
      (<?= htmlspecialchars($baris['email']) ?>) - 
      <small class="mut"><?= $baris['tanggal'] ?></small><br>
      <?= htmlspecialchars($baris['pesan']) ?>
    </p>
    <hr style="border:0; border-top:1px solid var(--bd); margin: 10px 0;">
    <?php endwhile; else: ?>
    <p style="font-size: 0.85rem;" class="mut">Belum ada pesan masuk.</p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>