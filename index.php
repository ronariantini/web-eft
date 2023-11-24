<?php
session_start();

if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
    exit;
}

// Cek status admin
if ($_SESSION["status"] === "admin") {
    $user_menu = '<li><a href="indexuser.php">User</a></li>';
} else {
    $user_menu = ''; // Tidak menampilkan menu User untuk pengguna non-admin
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <header>
        <h1>Halaman Admin</h1>
        <nav>
            <ul>
                <li><a href="indexUserSesi.php">Sesi</a></li>
                <?= $user_menu ?> <!-- Tampilkan menu User hanya untuk admin -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Konten dashboard Anda di sini -->
    </main>
</body>
</html>
