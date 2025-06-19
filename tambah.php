<?php
include_once 'Database.php';
include_once 'Pegawai.php';

// Inisialisasi koneksi database dan objek Pegawai
$database = new Database();
$db = $database->getConnection();
$pegawai = new Pegawai($db);

// Proses jika form disubmit
if ($_POST) {
    $pegawai->nama = $_POST['nama'];
    $pegawai->alamat = $_POST['alamat'];
    $pegawai->email = $_POST['email']; // tambah email

    if ($pegawai->create()) {
        echo "<script>
                alert('Data pegawai berhasil ditambahkan!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data pegawai.');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
    <style>
        .container {
            margin: 20px;
        }

        form {
            margin-top: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn-back {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Pegawai Baru</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nama">Nama : </label>
            <input type="text" id="nama" name="nama" required>

            <label for="alamat">Alamat : </label>
            <textarea id="alamat" name="alamat" required></textarea>
            
            <label for="email">Email : </label>
            <input type="text" id="email" name="email" required>  <!-- tambah email -->

            <input type="submit" value="Simpan">
        </form>

        <a href="index.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>
