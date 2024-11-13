<?php
session_start();
//MENGHANCURKAN $_SESSION["PELANGGAN"]
session_destroy();

echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='index.php';</script>";