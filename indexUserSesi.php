<?php
session_start();

if(!isset($_SESSION["Login"])){
  header("Location: indexuser.html");
  exit;
}

require 'functions.php';

// Ambil user_id dari sesi
$user_id = $_SESSION["user_id"];

// Ubah query SQL untuk hanya mengambil data sesi yang sesuai dengan user_id
$sesi = query("SELECT sesi.*, user.username FROM sesi INNER JOIN user ON sesi.user_id = user.user_id WHERE sesi.user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your session</title>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  .container {
    width: 80%;
    margin: auto;
    overflow: hidden;
    padding: 20px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid #b0bec5; /* Warna abu-abu */
  }
  th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #b0bec5; /* Warna abu-abu */
  }
  th {
    background-color: #e1f5fe; /* Warna biru muda */
    border-right: 1px solid #b0bec5; /* Warna abu-abu */
  }
  tr:hover {
    background-color: #eceff1; /* Warna abu-abu muda saat dihover */
  }
  /* Tambahkan gaya CSS untuk header */
  header {
    background-color: #2e3a4e; /* Warna latar belakang header */
    color: white; /* Warna teks header */
    padding: 10px; /* Ruang dalam header */
    text-align: center; /* Tengah teks header */
  }
</style>
</head>
<body>

<!-- Header yang sama dengan login.php -->
<header>
    <div >
        <a href="indexuser.html">
            <img src="assets/icon/EFTlogo.JPG" style="width: 80px; height: 40px; cursor: pointer;" />
        </a>
    </div>
        <button class="btn-cta2" onclick="redirLogout()">Logout</button>
</header>

<div id="container" class="container">

<h1>List of your registered sessions</h1>
<br><br>

<!-- Tabel yang tetap seperti yang sudah Anda buat sebelumnya -->
<table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Jenis Training</th>
        <th>Username</th>
        <th>Token</th>
        <th>Tanggal Pelaksanaan</th>
        <th>Waktu Pelaksanaan</th>
        <th>Status pelaksanaan</th>
        <th>Status pelaksanaan</th>
      </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach($sesi as $row ):   ?>
      <tr>
        <td><?= $i; ?></td>
        <td><?= $row["training_id"]; ?></td>
        <td><?= $row["username"]; ?></td>
        <td><?= $row["sesi_token"]; ?></td>
        <td><?= $row["sesi_date"]; ?></td>
        <td><?= $row["sesi_time"]; ?></td>
        <td>
          <?php if ($row["sesi_status"] == '0'): ?>
            Belum dilaksanakan
          <?php else: ?>
            Sudah terlaksana
          <?php endif; ?>
        </td>
        <td>
            <a href="detailSesi.php?id=<?= $row["sesi_id"]; ?>">Detail</a>
        </td>
      </tr>
      <?php $i++; ?>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script>
			
			function redirLogout() {
				window.location.href = "logout.php"
			}
</script>
</body>
</html>
