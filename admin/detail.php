<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
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
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        <thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td><?php echo $pecah['harga_produk']; ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td>
                    <?php echo $pecah['harga_produk'] * $pecah['jumlah']; ?>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>

        </tbody>
</table>