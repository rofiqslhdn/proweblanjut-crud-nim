<?php
include 'koneksi.php';

// ambil id dari url
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {

    $_SESSION['pesan'] = "ID tidak valid!";
    $_SESSION['tipe']  = "error";

    header("Location: index.php?page=data_barang");
    exit();
}

// cek apakah barang ada
$stmt = $pdo->prepare("SELECT id FROM barang WHERE id = ?");
$stmt->execute([$id]);

$barang = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$barang) {
    $_SESSION['pesan'] = "Barang tidak ditemukan!";
    $_SESSION['tipe']  = "error";
} else {

    // hapus barang
    $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");

    if ($stmt->execute([$id])) {
        $_SESSION['pesan'] = "Barang berhasil dihapus!";
        $_SESSION['tipe']  = "success";
    } else {
        $_SESSION['pesan'] = "Gagal menghapus barang!";
        $_SESSION['tipe']  = "error";
    }
}

header("Location: index.php?page=data_barang");
exit();
