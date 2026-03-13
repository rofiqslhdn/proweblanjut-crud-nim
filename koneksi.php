<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host   = getenv('DB_HOST') ?: "127.0.0.1";
$user   = "root";
$pass   = "";
$dbname = "inventaris_db";

try {
    $ports = [];
    $envPort = getenv('DB_PORT');
    if ($envPort !== false && $envPort !== '') {
        $ports[] = (int) $envPort;
    }
    $ports[] = 3306;
    $ports[] = 3307;

    $lastError = null;
    foreach ($ports as $port) {
        try {
            $pdo = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
            $lastError = null;
            break;
        } catch (PDOException $e) {
            $lastError = $e;
        }
    }

    if ($lastError) {
        throw $lastError;
    }
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage() . " (host: $host, db: $dbname). Pastikan MySQL XAMPP sudah RUNNING dan portnya benar (umum: 3306/3307).");
}
?>