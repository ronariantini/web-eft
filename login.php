<?php
session_start();
require 'functions.php';

// Periksa apakah pengguna sudah login, jika ya, alihkan ke halaman yang sesuai
if (isset($_SESSION["Login"])) {
    if ($_SESSION["status"] === "admin") {
        header("Location: index.php");
    } else {
        header("Location: indexuser.html");
    }
    exit;
}

$error = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Jalankan query SQL untuk mencari pengguna berdasarkan username
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' LIMIT 1");

    // Pastikan query berhasil dijalankan
    if ($result) {
        // Cek apakah ada hasil yang ditemukan
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Memeriksa kata sandi
            if (password_verify($password, $row["password"])) {
                $_SESSION["Login"] = true;
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["status"] = $row["status"]; // Simpan status pengguna di sesi

                if ($row["status"] === "admin") {
                    header("Location: indexsesi.php");
                } else {
                    header("Location: indexuser.html");
                }
                exit;
            } else {
                $error = "Kombinasi username dan password salah.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
    } else {
        $error = "Query gagal: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="parallax">
        <header>
            <div>
                <a href="index.html">
                    <img src="assets/icon/EFTlogo.JPG" style="width: 80px; height: 40px; cursor: pointer;" />
                </a>
            </div>
            <h1>User Login</h1>
        </header>
        <div class="card-item3">
    <li></li>
    <form action="" method="post">
        <div class="form">
            <li>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li></li>
            <li class="center"><button type="submit" name="login">Login</button></li>
            <li></li>
            <li class="center"> <!-- Tulisan ini akan ditempatkan di bawah tombol login -->
                Never register before? <a href="registration.php" style="color: blue;">Register now</a>
            </li>
        </div>
    </form>
    <li></li>
</div>
    </div>
</body>
</html>
