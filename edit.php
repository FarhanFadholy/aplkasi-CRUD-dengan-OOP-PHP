<?php
include_once 'Database.php';
include_once 'Pegawai.php';

// Inisialisasi database dan objek Pegawai
$database = new Database();
$db = $database->getConnection();
$pegawai = new Pegawai($db);

// Ambil ID pegawai dari URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID tidak ditemukan.');
$pegawai->id_pegawai = $id;
$pegawai->readOne();

// Proses update jika form disubmit
if ($_POST) {
    $pegawai->nama = $_POST['nama'];
    $pegawai->alamat = $_POST['alamat'];
    $pegawai->email = $_POST['email']; //email

    if ($pegawai->update()) {
        echo "<script>
                alert('Data pegawai berhasil diupdate!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data pegawai.');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
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
            background-color: #008CBA;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #007bb5;
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
        <h1>Edit Data Pegawai</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>" method="post">
            <label for="nama">Nama : </label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($pegawai->nama); ?>" required>

            <label for="alamat">Alamat : </label>
            <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($pegawai->alamat); ?></textarea>

            <label for="email">Email : </label>  <!--tambah email-->
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($pegawai->email); ?>" required>

            <input type="submit" value="Update">
        </form>

        <a href="index.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>
