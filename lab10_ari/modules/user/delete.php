<?php
require_once __DIR__ . "/../../config/database.php";

$db = new Database();

$id = $_GET['id'];

$db->query("DELETE FROM data_barang WHERE id_barang='$id'");

header("Location: index.php?page=user/list");
exit;
