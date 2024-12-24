<?php
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = "";     // Sesuaikan dengan password MySQL Anda
$dbname = "crudprak2"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Membuat database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database berhasil dibuat<br>";
} else {
    echo "Error membuat database: " . $conn->error;
}

// Pilih database
$conn->select_db($dbname);

// Membuat tabel
$sql = "CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(15) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telepon VARCHAR(15) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel mahasiswa berhasil dibuat<br>";
} else {
    echo "Error membuat tabel: " . $conn->error;
}

$conn->close();
?>
