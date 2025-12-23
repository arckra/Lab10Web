<?php
// Proteksi halaman dashboard
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php?page=auth/login");
    exit;
}

// Pakai class Database
require_once __DIR__ . "/../config/database.php";

$db = new Database();

// Total barang
$q_total = $db->query("SELECT COUNT(*) AS total FROM data_barang");
$total_barang = $q_total->fetch_assoc()['total'];

// Total stok
$q_stok = $db->query("SELECT SUM(stok) AS total_stok FROM data_barang");
$total_stok = $q_stok->fetch_assoc()['total_stok'];

// Total kategori
$q_kategori = $db->query("SELECT COUNT(DISTINCT kategori) AS kategori FROM data_barang");
$total_kategori = $q_kategori->fetch_assoc()['kategori'];
?>

<link rel="stylesheet" href="assets/css/style.css">

<div class="dashboard-container">

    <h2>Dashboard</h2>
    <p class="subtitle">Ringkasan data barang pada sistem</p>

    <div class="card-wrapper">

        <div class="card blue">
            <h3><?= $total_barang ?></h3>
            <p>Total Barang</p>
        </div>

        <div class="card green">
            <h3><?= $total_stok ?></h3>
            <p>Total Stok Barang</p>
        </div>

        <div class="card orange">
            <h3><?= $total_kategori ?></h3>
            <p>Jenis Kategori</p>
        </div>

    </div>

    <div class="welcome-box">
        <h3>Selamat Datang!</h3>
        <p>
            Aplikasi ini digunakan untuk mengelola data barang, seperti menambah,
            mengedit, dan menghapus data.
        </p>
        <a href="index.php?page=user/list" class="btn-primary">
            Lihat Data Barang
        </a>
    </div>

</div>
