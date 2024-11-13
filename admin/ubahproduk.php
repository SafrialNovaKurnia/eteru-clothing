<h2>Ubah Produk</h2>

<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

echo "<pre>";
print_r($pecah);
echo "</pre>";
?>

<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}

echo "<pre>";
print_r($datakategori);
echo "</pre>";

?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>

                <option value="<?php echo $value["id_kategori"] ?>" <?php if ($pecah["id_kategori"] == $value["id_kategori"]) {
                                                                        echo "selected";
                                                                    } ?>>
                    <?php echo $value["nama_kategori"] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label>
        <input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="20"><?php echo $pecah['deskripsi_produk']; ?></textarea>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_produk']; ?>">
    </div>
    <button class=" btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    // Memeriksa jika foto diubah
    if (!empty($lokasifoto)) {
        // Lakukan validasi file di sini sebelum memindahkannya
        // Misalnya, periksa tipe file, ukuran file, dll.
        $lokasi_simpan = "../foto_produk/$namafoto";
        move_uploaded_file($lokasifoto, $lokasi_simpan);

        // Menggunakan prepared statement untuk mencegah SQL Injection
        $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga_produk=?, berat_produk=?, foto_produk=?, deskripsi_produk=?, stok_produk=?, id_kategori=? WHERE id_produk=?");
        $stmt->bind_param("sdsssiii", $_POST['nama'], $_POST['harga'], $_POST['berat'], $namafoto, $_POST['deskripsi'], $_POST['stok'], $_POST['id_kategori'], $_GET['id']);
        $stmt->execute();
        $stmt->close();
    } else {
        // Jika tidak ada perubahan pada foto, gunakan juga prepared statement
        $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga_produk=?, berat_produk=?, deskripsi_produk=?, stok_produk=?, id_kategori=?  WHERE id_produk=?");
        $stmt->bind_param("sdsisii", $_POST['nama'], $_POST['harga'], $_POST['berat'], $_POST['deskripsi'], $_POST['stok'], $_POST['id_kategori'], $_GET['id']);
        $stmt->execute();
        $stmt->close();
    }

    echo "<script>alert('Data produk telah diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>