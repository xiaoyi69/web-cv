<?php
session_start();

$koneksiPaths = [
    __DIR__ . "/../koneksi.php",
    dirname(__DIR__) . "/koneksi.php",
    ($_SERVER["DOCUMENT_ROOT"] ?? "") . "/koneksi.php",
    "/var/task/user/koneksi.php",
];

$koneksi = false;
foreach ($koneksiPaths as $path) {
    if ($path !== "" && file_exists($path)) {
        include $path;
        break;
    }
}

/** @var mysqli|false $koneksi */

// Jika sudah login, langsung lempar ke dashboard
if (!empty($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit();
}

// Kredensial cadangan jika database gagal terhubung
$fallbackUser = getenv('ADMIN_USER') ?: 'admin';
$fallbackPass = getenv('ADMIN_PASS') ?: 'admin123';

$error = "";
if (isset($_POST['login'])) {
    $usernameInput = trim($_POST['username'] ?? '');
    $passwordInput = (string)($_POST['password'] ?? '');

    if ($usernameInput === '' || $passwordInput === '') {
        $error = "Username dan password wajib diisi!";
    } elseif ($koneksi) {
        $username = mysqli_real_escape_string($koneksi, $usernameInput);
        $password = md5($passwordInput);

        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
        $result = @mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $usernameInput;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        // Fallback saat koneksi DB gagal
        if ($usernameInput === $fallbackUser && $passwordInput === $fallbackPass) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $usernameInput;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Username atau password salah! (Mode fallback aktif karena DB belum terhubung)";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 24px;">
<div class="card big" style="max-width: 400px; width: 100%;">
    <h3 style="margin-bottom: 20px; text-align: center;">Login Admin</h3>
    <?php if (!$koneksi): ?>
        <p style="color: #d97706; font-size: 0.85rem; margin-bottom: 12px;">Koneksi database gagal. Menggunakan kredensial cadangan.</p>
    <?php endif; ?>
    <?php if ($error !== ""): ?>
        <p style="color: #dc2626; font-size: 0.85rem; margin-bottom: 15px;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>USERNAME
            <input type="text" name="username" required placeholder="Masukkan username">
        </label>
        <label>PASSWORD
            <input type="password" name="password" required placeholder="Masukkan password">
        </label>
        <button type="submit" name="login" class="btn primary full" style="margin-top: 15px;">Login</button>
    </form>
</div>
</body>
</html>