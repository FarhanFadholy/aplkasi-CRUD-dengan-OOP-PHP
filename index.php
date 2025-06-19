<?php
require_once 'Database.php'; // Alternatif lain selain include/include_once
require_once 'Pegawai.php';

// Inisialisasi database dan objek Pegawai
$database = new Database();
$db = $database->getConnection();
$pegawai = new Pegawai($db);

// Ambil data pegawai
$stmt = $pegawai->read();
$num = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi SIMPEG</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            margin: 20px;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        .btn-edit {
            background-color: #008CBA;
        }

        .btn-delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Pegawai</h1>
        <a href="tambah.php" class="btn">Tambah Pegawai</a>
        <?php
        if ($num > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID Pegawai</th>";
            echo "<th>Nama</th>";
            echo "<th>Alamat</th>";
            echo "<th>Email</th>"; //email
            echo "<th>Aksi</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row); // Membuat variabel langsung dari array $row

                echo "<tr>";
                echo "<td>{$id_pegawai}</td>";
                echo "<td>{$nama}</td>";
                echo "<td>{$alamat}</td>";
                echo "<td>{$email}</td>"; //email
                echo "<td>";
                echo "<a href='edit.php?id={$id_pegawai}' class='btn btn-edit'>Edit</a> ";
                echo "<a href='hapus.php?id={$id_pegawai}' class='btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Belum ada data pegawai.</p>";
        }
        ?>
    </div>
</body>
</html>
