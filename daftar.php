<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>

<head>
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
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="alamat" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Telp/HP</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="telepon" required>
                                </div>
                            </div>

                            <div class="col-md-7 col-md-offset-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Saya Menyetujui <span class="text-merah">Syarat & Ketentuan</span> yang Berlaku <span class="text-merah">*</span></label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Sudah Punya Akun? <a href="login.php" class="text-login"> Login
                                        Disini</a></label>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
//JIKA ADA TOMBOL daftar(DITEKAN TOMBOL DAFTAR)
if (isset($_POST["daftar"])) {
    //MENGAMBIL ISIAN nama,email,password,alamat,telepon
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    //CEK APAKAH EMAIL SUDAH DIGUNAKAN
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan ='$email'");
    $yangcocok = $ambil->num_rows;
    if ($yangcocok == 1) {

        echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
        echo "<script>location='daftar.php';</script>";
    } else {
        //QUERY INSERT KE TABEL PELANGGAN
        $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat')");

        echo "<script>alert('pendaftaran sukses, silakan login');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>