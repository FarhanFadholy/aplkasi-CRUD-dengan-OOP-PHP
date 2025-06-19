<?php
include_once 'Database.php';
include_once 'Pegawai.php';

// Inisialisasi koneksi ke database dan objek Pegawai
$database = new Database();
$db = $database->getConnection();
$pegawai = new Pegawai($db);

// Cek apakah parameter ID tersedia
if (isset($_GET['id'])) {
    $pegawai->id_pegawai = $_GET['id'];

    if ($pegawai->delete()) {
        echo "<script>
                alert('Data pegawai berhasil dihapus!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data pegawai.');
                window.location.href='index.php';
              </script>";
    }
} else {
    die('ERROR: ID tidak ditemukan.');
}
?>
