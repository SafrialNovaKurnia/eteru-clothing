<!-- <h1>
    <b>DAFTAR SESI AKUN YANG LOGIN</b>
</h1>
<pre><?php print_r($_SESSION); ?></pre> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Semua Akun</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }
    </style>
</head>

<body>
    <h1>Daftar Semua Akun</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username/Email</th>
                <th>Password</th>
                <th>Nama Lengkap</th>
                <th>Telepon/Alamat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Isi tabel -->
            <!-- Ganti bagian ini dengan data yang ingin ditampilkan -->
            <tr>
                <td>1</td>
                <td>eteru</td>
                <td>eteru</td>
                <td>Eteru Clothing</td>
                <td>089601082022 / Jakarta</td>
            </tr>
            <!-- Akhir isi tabel -->
        </tbody>
    </table>
</body>

</html>