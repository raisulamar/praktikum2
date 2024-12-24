<?php

$conn = new mysqli("localhost", "root", "", "crudprak2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM mahasiswa WHERE nim=$nim";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nim = $row['nim'];
        $nama = $row['nama'];
        $email = $row['email'];
        $telepon = $row['telepon'];
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $sql = "UPDATE mahasiswa SET nama='$nama', email='$email', telepon='$telepon' WHERE nim=$nim";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update mahasiswa</title>
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
</style>

</head>
<body>
    <form method="POST" action="">

        <label for="nim">Nim :</label>
        <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>" required><br>
        
        <label for="name">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>
        
        <label for="telepon">Telepon:</label>
        <input type="text" id="telepon" name="telepon" value="<?php echo $telepon; ?>" required><br>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
