<h3>Data Kategori</h3>
<hr>

<?php
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
    $semuadata[] = $tiap;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
    </thead>
    <tbody>
        <?php foreach ($semuadata as $key => $value) : ?>
        <tr>
            <td><?php echo $key + 1 ?></td>
            <td><?php echo $value["nama_kategori"] ?></td>
            <td>
                <a href="ubah_kategori.php?id=<?php echo $value['id_kategori']; ?>" class="btn-warning btn-sm">Ubah</a>
                <a href="hapus_kategori.php?id=<?php echo $value['id_kategori']; ?>" class="btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<a href="tambah_kategori.php" class="btn btn-default">Tambah Data</a>