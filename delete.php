<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $nim = $_GET['id'];

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "DELETE FROM mahasiswa WHERE nim=$nim";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
else {
    echo "Parameter 'nim' tidak ditemukan!";
}
?>