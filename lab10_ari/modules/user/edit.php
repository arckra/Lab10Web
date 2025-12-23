<?php
require_once __DIR__ . "/../../config/database.php";
$db = new Database();

$id = $_GET['id'];
$data = $db->query("SELECT * FROM data_barang WHERE id_barang='$id'")
           ->fetch_assoc();

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok  = $_POST['stok'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/gambar/" . $gambar);

        $sql = "UPDATE data_barang SET 
                nama='$nama',
                kategori='$kategori',
                harga_beli='$harga_beli',
                harga_jual='$harga_jual',
                stok='$stok',
                gambar='$gambar'
                WHERE id_barang='$id'";
    } else {
        $sql = "UPDATE data_barang SET 
                nama='$nama',
                kategori='$kategori',
                harga_beli='$harga_beli',
                harga_jual='$harga_jual',
                stok='$stok'
                WHERE id_barang='$id'";
    }

    if ($db->query($sql)) {
        header("Location: index.php?page=user/list");
        exit;
    }
}
?>

<!-- CSS GLOBAL -->
<link rel="stylesheet" href="assets/css/style.css">

<div class="container">
    <h2>Edit Data Barang</h2>

    <form method="post" enctype="multipart/form-data" class="form">
    
        <label>Nama Barang</label>
        <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
    
        <label>Kategori</label>
        <select name="kategori" required>
            <option <?= $data['kategori']=='Komputer'?'selected':'' ?>>Komputer</option>
            <option <?= $data['kategori']=='Elektronik'?'selected':'' ?>>Elektronik</option>
            <option <?= $data['kategori']=='Hand Phone'?'selected':'' ?>>Hand Phone</option>
        </select>
    
        <label>Harga Jual</label>
        <input type="text" name="harga_jual" value="<?= $data['harga_jual']; ?>" required>
    
        <label>Harga Beli</label>
        <input type="text" name="harga_beli" value="<?= $data['harga_beli']; ?>" required>
    
        <label>Stok</label>
        <input type="text" name="stok" value="<?= $data['stok']; ?>" required>
    
        <label>Gambar</label>

        <!-- PREVIEW GAMBAR LAMA -->
        <img 
            id="preview-gambar"
            src="assets/gambar/<?= $data['gambar']; ?>" 
            class="img-preview"
        >

        <!-- INPUT GAMBAR BARU -->
        <input 
            type="file" 
            name="file_gambar"
            accept="image/*"
            onchange="previewGambar(this)"
        >
    
        <button class="btn edit" name="submit">Simpan</button>
    </form>
</div>

<script>
function previewGambar(input) {
    const preview = document.getElementById('preview-gambar');
    const file = input.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    }
}
</script>

