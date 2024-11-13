<?php

$id_foto = $_GET["idfoto"];
$id_produk = $_GET["idproduk"];

// AMBIL DULU DATANYA
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto = '$id_foto'");
$detailfoto = $ambilfoto->fetch_assoc();

$namafilefoto = $detailfoto["nama_produk_foto"];

// HAPUS FILE FOTO DARI FOLDER
unlink("../foto_produk/" . $namafilefoto);

// MENGHAPUS DATA DI MYSQL
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto = '$id_foto'");

echo "<script>alert('Foto produk berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
