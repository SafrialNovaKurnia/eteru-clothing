<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
    /* Memberikan padding di atas dan di bawah body */
    body {
        padding-top: 70px;
        /* Tinggi navbar */
        padding-bottom: 50px;
        /* Padding bawah */
    }

    /* Menyesuaikan lebar kolom pencarian */
    .navbar-form .form-control {
        width: 800px;
        /* Sesuaikan lebar input sesuai kebutuhan */
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-center" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="./asset/logo/Red White opac.png" width="125" height="35" class="me-2"
                        style="margin-top: -7px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li><a href="riwayat.php">Riwayat Belanja</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="daftar.php">Daftar</a></li>
                    <?php endif ?>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>

                <form class="navbar-form navbar-right" role="search" action="pecarian.php" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari di eteru...">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Masukkan file Bootstrap JavaScript di akhir halaman (sebelum tag penutup </body>) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
</body>

</html>