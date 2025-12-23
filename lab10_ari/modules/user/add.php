<?php
require_once __DIR__ . "/../../config/database.php";
$db = new Database();

if (isset($_POST['submit'])) {
    $nama   = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok  = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/gambar/" . $gambar);

    $sql = "INSERT INTO data_barang 
            (nama, kategori, harga_beli, harga_jual, stok, gambar)
            VALUES 
            ('$nama','$kategori','$harga_beli','$harga_jual','$stok','$gambar')";

    if ($db->query($sql)) {
        header("Location: index.php?page=user/list");
        exit;
    }
}
?>

<!-- CSS GLOBAL -->
<link rel="stylesheet" href="assets/css/style.css">

<div class="container">
    <h2>Tambah Data Barang</h2>

    <form method="post" enctype="multipart/form-data" class="form">
        <label>Nama Barang</label>
        <input type="text" name="nama" required>
    
        <label>Kategori</label>
        <select name="kategori" required>
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
        </select>
    
        <label>Harga Jual</label>
        <input type="text" name="harga_jual" required>
    
        <label>Harga Beli</label>
        <input type="text" name="harga_beli" required>
    
        <label>Stok</label>
        <input type="text" name="stok" required>
    
        <label>Gambar</label>

        <!-- PREVIEW GAMBAR -->
        <img id="preview-gambar" class="img-preview" style="display:none;">
        <input type="file" name="file_gambar" 
               accept="image/*"
               onchange="previewGambar(this)" required>
    
        <button class="btn add" name="submit">Simpan</button>
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
