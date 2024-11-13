<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Eteru Clothing</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        background-color: #EAEAEA;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #2D2D2D;
    } .form-container {
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
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include 'menu.php'; ?>
    <!-- navbar -->

    <!-- Banner -->
    <div class="container">
    <div id="shoeCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indikator -->
        <ol class="carousel-indicators">
            <li data-target="#shoeCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#shoeCarousel" data-slide-to="1"></li>
            <li data-target="#shoeCarousel" data-slide-to="2"></li>
            <!-- Tambahkan indikator lebih banyak untuk slide tambahan -->
        </ol>

        <!-- Wrapper untuk slide -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="./asset/banner/banner4.png" alt="Converse">
                <div class="carousel-caption">
                    <h3>Murasaki</h3>
                    <p>Tinggalkan Jejak Elegansi Berwarna</p>
                </div>
            </div>
            <div class="item">
                <img src="./asset/banner/banner1.png" alt="Converse">
                <div class="carousel-caption">
                    <h3>Genjutsu</h3>
                    <p>Menguasai pikiran, memutar realitas</p>
                </div>
            </div>
            <div class="item">
                <img src="./asset/banner/banner2.png" alt="Converse">
                <div class="carousel-caption">
                    <h3>Maiki</h3>
                    <p>Inspirasi Tersembunyi, Cerita yang Terucap</p>
                </div>
            </div>
            <!-- Tambahkan slide tambahan di sini -->
        </div>

        <!-- Kontrol -->
        <a class="left carousel-control" href="#shoeCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Sebelumnya</span>
        </a>
        <a class="right carousel-control" href="#shoeCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Selanjutnya</span>
        </a>
    </div>
</div>
<!-- Banner -->

    <!-- Tentang -->
    <div class="container">
    <style>
        
        .judul-kategori {
            background-color: #f36f6f;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        p {
            line-height: 1.6;
        }
    </style>
        <div class="judul-kategori">
            <h2 class="text-center">TENTANG ETERU</h2>
        </div>
        <div class="text-center">
            <img src="./asset/logo/Square Full Color Logo.png" class="img-fluid" alt="Logo Eteru">
        </div>
        <br>
        <div>
            <h3>Visi Eteru:</h3>
            <p>
                "Menjadi tonggak dalam industri fashion dengan menghadirkan koleksi pakaian yang tidak hanya
                menawarkan gaya yang elegan dan inovatif, tetapi juga memperjuangkan nilai-nilai keberlanjutan dan
                kualitas tak tergantikan."
            </p>
        </div>
        <br>
        <div>
            <h3>Misi Eteru:</h3>
            <ul>
                <li>
                    <p>
                        Menciptakan pakaian berkualitas tinggi yang tidak hanya menonjolkan keindahan desainnya,
                        tetapi juga memprioritaskan kenyamanan dan kepraktisan bagi para penggunanya.
                    </p>
                </li>
                <li>
                    <p>
                        Menginspirasi individu untuk mengekspresikan jati diri mereka melalui pakaian yang menjadi
                        cerminan gaya personal yang unik dan elegan.
                    </p>
                </li>
                <li>
                    <p>
                        Berkomitmen pada praktik keberlanjutan, mulai dari rantai pasok hingga material yang digunakan,
                        guna mendukung lingkungan dan masyarakat.
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <!-- Tentang -->

    <!-- Produk -->
    <div class="container">
        <section class="konten">
            <div class="container">
                <div class="judul-kategori">
                <h2 class="text-center">PRODUK TERBARU</h2>
                </div>

                <div class="row">

                    <?php $ambil = $koneksi->query("SELECT * FROM produk "); ?>
                    <?php while ($perproduk = $ambil->fetch_assoc()) { ?>

                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
                            <div class="caption">
                                <h3><?php echo $perproduk['nama_produk']; ?></h3>
                                <h5><?php echo number_format($perproduk['harga_produk']); ?></h5>
                                <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"
                                    class="btn btn-primary">Beli</a>
                                <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>"
                                    class="btn btn-default">Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </section>
    </div>
    <!-- Produk -->

    <!-- Kontak -->
    <div id="kontak" class="title container mt-5">
        <div class="judul-kategori" style="background-color: #FFF; padding: 5px 10px;">
            <h5 class="text-center" style="margin-top: 5px;">KONTAK</h5>
        </div>
        <div class="judul-kategori">
                <h2 class="text-center">ALAMAT</h2>
                </div>
    </div>

    <div class="container mt-3">
        <style>
        .google-maps {
            position: relative;
            padding-bottom: 75%;
            height: 0;
            overflow: hidden;
        }

        .google-maps iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
        }
        </style>
        <div class="google-maps">
            <iframe
                src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=6, Jl. Beringin II No.19, RT.11/RW.11, Kalideres, Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11840, Indonesia&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                width="60" height="450" frameborder="0" style="border: 0;"></iframe>
        </div>
    </div>

    <div class="container mt-3">
        <h5 class="text" style="margin-top: 5px;">KONTAK</h5>
        <p>Jl. Beringin II No.19, RT.11/RW.11, Kalideres, Kec. Kalideres, Kota Jakarta Barat, Daerah Khusus Ibukota
            Jakarta 11840, Indonesia.</p>
    </div>
    <!-- Kontak -->

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->

</body>

</html>