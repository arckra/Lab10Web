<?php
require_once __DIR__ . "/../../config/database.php";

$db = new Database();

$sql = "SELECT * FROM data_barang";
$result = $db->query($sql);
?>

<!DOCTYPE html> 
<html lang="en"> 
<head>
    <meta charset="UTF-8"> 
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" /> 
    <title>Data Barang</title> 
</head> 
<body> 
    <div class="container"> 
        <h1>Data Barang</h1> 
        <div class="main"> 
            <table> 
            <tr> 
                <th>Gambar</th> 
                <th>Nama Barang</th> 
                <th>Kategori</th> 
                <th>Harga Jual</th> 
                <th>Harga Beli</th> 
                <th>Stok</th> 
                <th>Aksi</th> 
            </tr> 

            <?php if ($result && $result->num_rows > 0): ?> 
                <?php while ($row = $result->fetch_assoc()): ?> 
                <tr> 
                    <td>
                        <img src="assets/gambar/<?= $row['gambar']; ?>" 
                             alt="<?= $row['nama']; ?>" width="80">
                    </td> 
                    <td><?= $row['nama']; ?></td> 
                    <td><?= $row['kategori']; ?></td> 
                    <td><?= $row['harga_jual']; ?></td> 
                    <td><?= $row['harga_beli']; ?></td> 
                    <td><?= $row['stok']; ?></td> 
                    <td>
                        <a class="btn edit"
                           href="index.php?page=user/edit&id=<?= $row['id_barang']; ?>">
                           Edit
                        </a>
                        <a class="btn delete"
                           href="index.php?page=user/delete&id=<?= $row['id_barang']; ?>"
                           onclick="return confirm('Hapus data?')">
                           Hapus
                        </a>
                    </td>
                </tr> 
                <?php endwhile; ?> 
            <?php else: ?> 
                <tr> 
                    <td colspan="7">Belum ada data</td> 
                </tr> 
            <?php endif; ?> 

            </table> 
        </div> 
    </div> 
</body> 
</html>
