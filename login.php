<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        background-color: #EAEAEA;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #2D2D2D;
    }

    .form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 30px 100px;
        box-shadow: 3px 3px 10px 0px #000;
        border-radius: 10px;
        width: 70vw;
        height: 550px;
        background-color: #FFFFFF;
    }

    .text-judul {
        font-weight: bold;
        font-size: 30px;
    }

    .form-control {
        font-size: 12px;
    }

    .text-login {
        text-decoration: none;
        color: #2D2D2D;
    }

    .text-merah {
        color: red;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <div class="text-end">
                                    <a href class="textForm text-hover"="#">Lupa Password?</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary form-control" name="login">Login</button>
                            </div>
                            <div class="mt-3">
                                <span class="textForm">Belum Punya Akun? <a href="daftar.php"
                                        class="text-hover">Daftar</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    //JIKA ADA TOMBOL LOGIN(TOMBOL LOGIN DI TEKAN)
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        //LAKUKAN QUERY CEK AKUN DI TABEL PELANGGAN DI DATA BASE
        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

        //NGTUNG AKUN YANG TERAMBIL
        $akunyangcocok = $ambil->num_rows;

        //JIKA 1 AKUN YANG COCOK, MAKA DILOGINKAN
        if ($akunyangcocok == 1) {
            //ANDA SUKSES LOGIN
            //MENDAPATKAN AKUN DALAM BENTUK ARRAY
            $akun = $ambil->fetch_assoc();
            //SIMPAN DI SESSION PELANGGAN
            $_SESSION["pelanggan"] = $akun;
            echo "<script>alert('Anda sukses login');</script>";

            //JIKA SUDAH BELANJA
            if (isset($_SESSION["keranjang"]) or !empty($_SESSION["keranjang"])) {
                echo "<script>location='checkout.php';</script>";
            } else
                echo "<script>location='riwayat.php';</script>";
        } else {
            //ANDA GAGAL LOGIN
            echo "<script>alert('Anda gagal login, periksa akun anda');</script>";
            echo "<script>location='login.php';</script>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>