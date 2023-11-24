<?php
session_start();

if(!isset($_SESSION["Login"])){
  header("Location: indexsesi.php");
  exit;
}
require 'functions.php';

// Ubah query SQL untuk melakukan join antara tabel sesi dan tabel user
$sesi = query("SELECT sesi.*, user.username FROM sesi INNER JOIN user ON sesi.user_id = user.user_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User session</title>

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
  header {
    background-color: #2e3a4e; /* Warna latar belakang header */
    color: white; /* Warna teks header */
    padding: 10px; /* Ruang dalam header */
    text-align: center; /* Tengah teks header */
  }
</style>
</head>
<body>
<header>
    <div >
        <a href="indexsesi.php">
            <img src="assets/icon/EFTlogo.JPG" style="width: 80px; height: 40px; cursor: pointer;" />
        </a>
    </div>
        <button class="btn-cta2" onclick="redirLogout()">Logout</button>
        <button class="btn-cta2" onclick="redirUser()">List User</button>
</header>
<div id="container" class="container">

<h1>ADMIN - List of registered sessions</h1>


<br>

  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Jenis Training</th>
        <th>Username</th>
        <th>Token</th>
        <th>Tanggal Pelaksanaan</th>
        <th>Waktu Pelaksanaan</th>
        <th>Status pelaksanan</th>
        <th>Status pelaksanan</th>
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
      function redirUser() {
				window.location.href = "indexuser.php"
			}
</script>
</body>
</html>
