<?php
session_start();
include 'koneksi.php'; ?>


<!DOCTYPE html>
<html>

<head>
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>
    <!-- navbar -->

    <!-- konten -->
    <section class="konten">
        <div class="container">

            <!-- NOTA DISINI COPAS SAJA DARI NOTA YANG ADA DI ADMIN -->
            <h2>Detail Pembelian</h2>
            <?php
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            ?>
            <!-- <h1>Data orang yang beli $detail</h1>
            <pre><?php print_r($detail); ?></pre>
            <h1>Data orang yang login di session</h1>
            <pre><?php print_r($_SESSION); ?></pre> -->

            <!-- JIKA PELANGGAN YANG BELI TIDAK SAMA DENGAN PELANGGAN YANG LOGIN, MAKA DILARIKAN KE riwayat.php KARENA DIA
            TIDAK BERHAK MELIHAT NOTA ORANG LAIN -->
            <!-- PELANGGAN YANG BELI HARUS PELANGGAN YANG LOGIN -->
            <?php
            //MENDAPATKAN id_pelanggan YANG BELI
            $idpelangganyangbeli = $detail["id_pelanggan"];

            //MEDAPATKAN ID PELANGGAN YANG LOGIN
            $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

            if ($idpelangganyangbeli !== $idpelangganyanglogin) {
                echo "<script>alert('Jangan nakal');</script>";
                echo "<script>location='riwayat.php';</script>";
            }
            ?>


            <div class="row">
                <div class="col-md-4">
                    <!-- <h3>Pembelian</h3> -->
                    <strong>No. Pembelian : <?php echo $detail['id_pembelian']; ?></strong> <br>
                    Tanggal : <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?><br>
                    Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
                </div>
                <div class="col-md-4">
                    <!-- <h3>Pelanggan</h3> -->
                    <Strong>Nama : <?php echo $detail['nama_pelanggan']; ?></Strong> <br>
                    No.Telp : <?php echo $detail['telepon_pelanggan']; ?> <br>
                    E-Mail : <?php echo $detail['email_pelanggan']; ?>

                </div>
                <div class="col-md-4">
                    <!-- <h3>Pengiriman</h3> -->
                    <strong>Kota/Kabupaten : <?php echo $detail['tipe']; ?>
                        <?php echo $detail['distrik']; ?>, <?php echo $detail['provinsi']; ?></strong>
                    <br>
                    Ongkos Kirim : Rp. <?php echo number_format($detail['ongkir']); ?> <br>
                    Ekspedisi :
                    <?php echo $detail['ekspedisi']; ?>, <?php echo $detail['paket']; ?>,
                    <?php echo $detail['estimasi']; ?> hari<br>
                    Alamat : <?php echo $detail['alamat_pengiriman']; ?>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Subberat</th>
                        <th>Subtotal</th>
                    </tr>
                    <thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                                <td><?php echo $pecah['berat']; ?>g</td>
                                <td><?php echo $pecah['jumlah']; ?></td>
                                <td><?php echo $pecah['subberat']; ?>g</td>
                                <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
                            </tr>
                            <?php $nomor++; ?>
                        <?php } ?>

                    </tbody>
            </table>


            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan melakukan pembayaran Rp.
                            <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                            <strong>BANK BCA 8660261835 A.N. Safrial Nova Kurnia</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- konten -->

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- footer -->
</body>

</html>