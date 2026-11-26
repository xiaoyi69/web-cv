<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host     = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'localhost');
$user     = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root');
$password = getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? '');
$database = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'db_cv');
$port     = (int)(getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306));

$koneksi = @mysqli_connect($host, $user, $password, $database, $port);
?>