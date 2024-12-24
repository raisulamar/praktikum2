<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $telepon = substr(preg_replace('/[^0-9]/', '', $_POST["telepon"]), 0, 13);

    $conn = new mysqli("localhost", "root", "", "crudprak2");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $check_sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {

        $error_message = "NIM sudah ada! Silakan gunakan NIM lain.";
    } else {
   
        $sql = "INSERT INTO mahasiswa (nim, nama, email, telepon) VALUES ('$nim', '$nama', '$email', '$telepon')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Terjadi kesalahan: " . $conn->error;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
        form label {
            font-weight: bold;
        }
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            text-align: center;
            z-index: 1000;
        }
        .popup button {
            background-color: #ff4b5c;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .popup button:hover {
            background-color: #ff3b4c;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="nim">Nim:</label>
        <input type="text" id="nim" name="nim" required>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Telepon:</label>
        <input type="text" id="telepon" name="telepon" required>

        <button type="submit">Simpan</button>
    </form>

    <?php if (!empty($error_message)): ?>
        <div class="overlay"></div>
        <div class="popup">
            <p><?php echo $error_message; ?></p>
            <button onclick="closePopup()">OK</button>
        </div>
    <?php endif; ?>

    <script>
        // Fungsi untuk menutup popup
        function closePopup() {
            document.querySelector('.popup').style.display = 'none';
            document.querySelector('.overlay').style.display = 'none';
        }
    </script>
</body>
</html>
