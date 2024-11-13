<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $datakategori[] = $tiap;
}

?>
<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="id_kategori">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>

            <option value="<?php echo $value["id_kategori"] ?>"><?php echo $value["nama_kategori"] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class=" form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Berat (Gr)</label>
        <input type="number" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="20"></textarea>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <div class="letak-input" style="margin-bottom: 10px;">
            <input type="file" class="form-control" name="foto[]">
        </div>
        <span class="btn btn-primary btn-tambah">
            <i class="fa fa-plus"></i>
        </span>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php
if (isset($_POST['save'])) {
    $lokasi = $_FILES['foto']['tmp_name'];
    $file_foto = $_FILES['foto']['name'];
    $target_directory = "../foto_produk/";

    // Proses penyimpanan informasi produk ke dalam tabel produk
    $sql_produk = "INSERT INTO produk (nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk, stok_produk, id_kategori) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_produk = $koneksi->prepare($sql_produk);
    $stmt_produk->bind_param("sdisssi", $_POST['nama'], $_POST['harga'], $_POST['berat'], $file_foto[0], $_POST['deskripsi'], $_POST['stok'], $_POST['id_kategori']);
    $stmt_produk->execute();

    // Mendapatkan ID produk yang baru saja dimasukkan
    $id_produk_barusan = $koneksi->insert_id;

    // Proses penyimpanan foto produk ke dalam tabel produk_foto
    foreach ($file_foto as $key => $tiap_nama) {
        $tiap_lokasi = $lokasi[$key];
        $file_target = $target_directory . $tiap_nama;

        move_uploaded_file($tiap_lokasi[$key], $file_target);

        // Simpan informasi foto produk ke dalam tabel produk_foto
        $koneksi->query("INSERT INTO produk_foto (id_produk, nama_produk_foto) VALUES ('$id_produk_barusan', '$tiap_nama')");
    }

    // Tutup statement dan koneksi
    $stmt_produk->close();
    $koneksi->close();

    // Menampilkan pesan berhasil
    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}

?>

<script>
$(document).ready(function() {
    $(".btn-tambah").on("click", function() {
        $(".letak-input").append("<input type='file' class='form-control' name='foto[]'> ");
    })
})
</script>