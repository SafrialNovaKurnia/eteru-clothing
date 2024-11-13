<?php

use function PHPSTORM_META\type;

session_start();
include 'koneksi.php';

//JIKA TIDAK ADA SESSION PELANGGAN(BELUM LOGIN). MAKA DILARANG KE login.php
if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silakan login'); </script>";
    echo "<script>location='login.php'; </script>";
}
if (empty($_SESSION["keranjang"]) or !isset($_SESSION["keranjang"])) {
    echo "<script>alert('Keranjang kosong, silakan belanja dahulu');</script>";
    echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <script src="admin/assets/js/jquery.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>


    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalberat = 0; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                    <!-- menampilkan produk yang sedang diperulang berdasarkan id_produk -->
                    <?php
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah["harga_produk"] * $jumlah;
                        //subberat diperoleh dari berat produk x jumlah
                        $subberat = $pecah["berat_produk"] * $jumlah;
                        //total berat
                        $totalberat += $subberat;

                        ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah["nama_produk"]; ?></td>
                        <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja += $subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>

            <form method="post">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly
                                value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value="">Pilih Ongkos Kirim</option>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while ($perongkir = $ambil->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $perongkir['id_ongkir'] ?>">
                                    <?php echo $perongkir['nama_kota'] ?> -
                                    Rp. <?php echo number_format($perongkir['tarif']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div> -->
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap Pengiriman</label>
                    <textarea class="form-control" name="alamat_pengiriman" pengiriman
                        placeholder="masukan alamat lengkap(termasuk kode pos)"></textarea><br>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select class="form-control" name="nama_provinsi">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Distrik</label>
                            <select class="form-control" name="nama_distrik">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ekspedisi</label>
                            <select class="form-control" name="nama_ekspedisi">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Paket</label>
                            <select class="form-control" name="nama_paket">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-2 mb-3">
                    <h5>Berat</h5>
                <input type="text" name="total_berat" value="<?php echo $totalberat; ?>">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Provinsi</h5>
                <input type="text" name="provinsi">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Distrik</h5>
                <input type="text" name="distrik">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Tipe</h5>
                <input type="text" name="tipe">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Kodepos</h5>
                <input type="text" name="kodepos">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Ekspedisi</h5>
                <input type="text" name="ekspedisi">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Paket</h5>
                <input type="text" name="paket">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Ongkir</h5>
                <input type="text" name="ongkir">
                </div>
                <div class="col-md-2 mb-3">
                <h5>Estimasi</h5>
                <input type="text" name="estimasi">
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3 mt-4">
                <button class="btn btn-primary btn-block" name="checkout" style="margin-top: 10px;">Checkout</button>
                    </div>
                </div>

            </form>

            <?php
            if (isset($_POST["checkout"])) {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

                $tanggal_pembelian = date("y-m-d");
                $alamat_pengiriman = $_POST["alamat_pengiriman"];

                $totalberat = $_POST["total_berat"];
                $provinsi = $_POST["provinsi"];
                $distrik = $_POST["distrik"];
                $tipe = $_POST["tipe"];
                $kodepos = $_POST["kodepos"];
                $ekspedisi = $_POST["ekspedisi"];
                $paket = $_POST["paket"];
                $ongkir = $_POST["ongkir"];
                $estimasi = $_POST["estimasi"];

                $total_pembelian = $totalbelanja + $ongkir;

                // 1. MENYIMPAN DATA KE TABEL PEMBELIAN
                $koneksi->query("INSERT INTO pembelian (id_pelanggan,tanggal_pembelian,total_pembelian,alamat_pengiriman,total_berat,provinsi,distrik,tipe,kodepos,ekspedisi,paket,ongkir,estimasi) VALUES ('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$alamat_pengiriman','$totalberat','$provinsi','$distrik','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi') ");

                //MENDAPATKAN id_pembelian BARUSAN TERJADI
                $id_pembelian_barusan =  $koneksi->insert_id;




                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                    //MENDAPATKAN DATA PRODUK BERDASARKAN id_produk
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id_produk");
                    $perproduk = $ambil->fetch_assoc();

                    // $ambil = $koneksi->prepare("SELECT * FROM produk WHERE id_produk ='$id_produk'");
                    // $ambil->execute([$id_produk]);
                    // $perproduk = $ambil->fetch(PDO::FETCH_ASSOC);


                    $nama = $perproduk['nama_produk'];
                    $harga = intval($perproduk['harga_produk']); //INGET PESAN ANWAR
                    $berat = intval($perproduk['berat_produk']); //INGET PESAN ANWAR

                    $subberat = intval($perproduk['berat_produk']) * intval($jumlah); //INGET PESAN ANWAR
                    $subharga = intval($perproduk['harga_produk']) * intval($jumlah); //INGET PESAN ANWAR

                    $sql = "INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah, nama, harga, berat, subberat, subharga) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; //INGET PESAN ANWAR
                    $stmt = $koneksi->prepare($sql); //INGET PESAN ANWAR
                    $stmt->bind_param("iiisiiii", $id_pembelian_barusan, $id_produk, $jumlah, $nama, $harga, $berat, $subberat, $subharga); //INGET PESAN ANWAR
                    $stmt->execute(); //INGET PESAN ANWAR

                    //SKRIP UPDATE STOK
                    $koneksi->query("UPDATE produk SET stok_produk =stok_produk -$jumlah WHERE id_produk ='$id_produk'");
                }

                //MENGKOSONGKAN KERANJANG BELANJA
                unset($_SESSION["keranjang"]);

                //TAMPILAN DIALIHKAN KE HALAMAN NOTA, NOTA DARI PEMBELIAN YANG BARUSAN
                echo "<script>alert('Pembelian sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }
            ?>

        </div>
    </section>

    <!-- <pre><?php print_r($_SESSION['pelanggan']) ?></pre>
    <pre><?php print_r($_SESSION["keranjang"]) ?></pre> -->

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- footer -->

</body>

</html>

<script>
$(document).ready(function() {
    $.ajax({
        type: 'post',
        url: 'dataprovinsi.php',
        success: function(hasil_provinsi) {
            $(" select[name=nama_provinsi]").html(hasil_provinsi);
        }
    });
    $("select[name=nama_provinsi]").on("change",
        function() { //ambil id_provinsi yang dipilih, dari atribut yang pribadi var
            id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
                type: 'post',
                url: 'datadistrik.php',
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(hasil_distrik) {
                    $("select[name=nama_distrik]").html(hasil_distrik);
                }
            });
        });
    $.ajax({
        type: 'post',
        url: 'dataekspedisi.php',
        success: function(hasil_ekspedisi) {
            $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
        }
    });
    $("select[name=nama_ekspedisi]").on("change", function() {
        //mendapatkan data ongkos kirim

        //mendapatkan ekspedisi yang dipilih
        var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();

        //mendapatkan id_distrik yang dipilih pengguna
        var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");

        //mendapatkan total berat dari inputaan var
        total_berat = $("input[name=total_berat]").val();
        $.ajax({
            type: 'post',
            url: 'datapaket.php',
            data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih +
                '&berat=' + total_berat,
            success: function(hasil_paket) { // console.log(hasil_paket);
                $("select[name=nama_paket]").html(
                    hasil_paket); //letakan nama ekspedisi terpilih di input ekspedisi
                $("input[name=ekspedisi]").val(ekspedisi_terpilih);
            }
        })
    });
    $("select[name=nama_distrik]").on("change", function() {
        var prov = $("option:selected",
            this).attr("nama_provinsi");
        var dist = $("option:selected", this).attr("nama_distrik");
        var
            tipe = $("option:selected", this).attr("tipe_distrik");
        var kodepos = $("option:selected",
            this).attr("kodepos");
        $("input[name=provinsi]").val(prov);
        $("input[name=distrik]").val(dist);
        $("input[name=tipe]").val(tipe);
        $("input[name=kodepos]").val(kodepos);
    });
    $("select[name=nama_paket]").on("change", function() {
        var paket = $("option:selected",
            this).attr("paket");
        var ongkir = $("option:selected", this).attr("ongkir");
        var
            etd = $("option:selected", this).attr("etd");
        $("input[name=paket]").val(paket);
        $("input[name=ongkir]").val(ongkir);
        $("input[name=estimasi]").val(etd);
    })
});
</script>