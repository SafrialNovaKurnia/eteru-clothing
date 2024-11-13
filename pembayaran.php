<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//JIKA TIDAK ADA SESSION PELANGGAN (BELUM LOGIN)
if (isset($_SESSION["pelanggan_login"]) or empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

//MEMDAPATKAN id_pembelian DARI URL
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//MENDAPATKAN id_pelanggan YANG BELI
$id_pelanggan_beli = $detpem["id_pelanggan"];
//MENDAPATKAN id_pelanggan YANG LOGIN
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli) {
    echo "<script>alert('Jangan nakal');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>
    <!-- navbar -->

    <!-- konten -->
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim bukti pembayaran anda disini</p>
        <div class="alert alert-info">Total tagihan anda <strong>Rp.
                <?php echo number_format($detpem["total_pembelian"]) ?></strong>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" name="bank">
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" min="1">
            </div>
            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="bukti">
                <p class="text-danger">foto bukti harus JPG maksimal 2MB</p>
            </div>
            <button class="btn btn-primary" name="kirim">Kirim</button>

        </form>
    </div>

    <?php
    //JIKA ADA TOMBOL KIRIM DITEKAN
    if (isset($_POST["kirim"])) {
        //UPLOAD DULU FOTO BUKTI
        $namabukti = $_FILES["bukti"]["name"];
        $lokasibukti = $_FILES["bukti"]["tmp_name"];
        $namafiks = date("YmdHis") . $namabukti;
        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

        $nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("y-m-d");

        //SIMPAN PEMBAYARAN
        $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

        //DARI PENDING JADI SUDAH DI BAYAR
        $koneksi->query("UPDATE pembelian SET status_pembelian ='sudah kirim pembayaran' WHERE id_pembelian=$idpem");
        echo "<script>alert('terimakasih sudah mengirimkan bukti pembayaran');</script>";
        echo "<script>location='riwayat.php';</script>";
    }
    ?>
    <!-- konten -->

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- footer -->

</body>

</html>