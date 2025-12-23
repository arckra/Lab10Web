<?php
session_start();
include "config/database.php";

// Jika user belum login dan buka selain login
if (!isset($_SESSION['login']) && (!isset($_GET['page']) || $_GET['page'] !== 'auth/login')) {
    header("Location: index.php?page=auth/login");
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// ==== FIX DASHBOARD TIDAK KETEMU ====
if ($page === "dashboard") {
    include "views/header.php";
    include "views/$page.php";
    include "views/dashboard.php";
    include "views/footer.php";
    exit;
}
// ===================================

// Routing default modules
$parts = explode("/", $page);
$folder = $parts[0];
$file   = isset($parts[1]) ? $parts[1] : "index";

$target = "modules/$folder/$file.php";

// Jika halaman login → tampilkan halaman login tanpa template
if ($page === "auth/login") {
    include $target;
    exit;
}

include "views/header.php";

if (file_exists($target)) {
    include $target;
} else {
    echo "<h2>Halaman tidak ditemukan</h2>";
}

include "views/footer.php";
?>
