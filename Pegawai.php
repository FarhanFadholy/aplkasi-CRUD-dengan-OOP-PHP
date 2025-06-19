<?php
class Pegawai {
    private $conn;
    private $table_name = "pegawai";

    public $id_pegawai;
    public $nama;
    public $alamat;
    public $email; //tambah email

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method untuk membaca semua data pegawai
    public function read() {
        $query = "SELECT id_pegawai, nama, alamat, email FROM " . $this->table_name . " ORDER BY id_pegawai DESC"; // email
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method untuk membuat data pegawai baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama=:nama, alamat=:alamat, email=:email"; //email
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->email = htmlspecialchars(strip_tags($this->email)); // email

        // Bind values
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":email", $this->email); //email

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method untuk membaca satu data pegawai berdasarkan ID
    public function readOne() {
        $query = "SELECT nama, alamat, email FROM " . $this->table_name . " WHERE id_pegawai = ? LIMIT 0,1";  // tambah email
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_pegawai);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nama = $row['nama'];
            $this->alamat = $row['alamat'];
            $this->email = $row['email']; // tambah email
        }
    }

    // Method untuk mengupdate data pegawai
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama = :nama, alamat = :alamat, email=:email WHERE id_pegawai = :id_pegawai"; // tambah email
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->id_pegawai = htmlspecialchars(strip_tags($this->id_pegawai));
        $this->email = htmlspecialchars(strip_tags($this->email));  // tambah email

        // Bind values
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':id_pegawai', $this->id_pegawai);   
        $stmt->bindParam(':email', $this->email);   // tambah email

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method untuk menghapus data pegawai
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pegawai = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id_pegawai = htmlspecialchars(strip_tags($this->id_pegawai));

        // Bind ID of record to delete
        $stmt->bindParam(1, $this->id_pegawai);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
