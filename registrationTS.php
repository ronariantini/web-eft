<?php
require 'functions.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["Login"])) {
    // Redirect jika pengguna belum login
    header("Location: login.php");
    exit;
}

if (isset($_POST["registerTS"])) {
    $user_id = $_SESSION["user_id"]; // Ambil user_id dari sesi
    if (registrasiTS($user_id, $_POST) > 0) {
        // Registrasi berhasil
        echo "<script>alert('Training station Session berhasil didaftarkan! Catat kode token yang diberikan, untuk dapat menggunakan training station');</script>";
    }
    header("Location: indexUserSesi.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Training Station Session Registration</title>
		<link rel="stylesheet" href="style.css"/>
	</head>

    
<body>
    <div class="parallax">
        <header>
        <div >
        <a href="indexuser.html">
        <img src="assets/icon/EFTlogo.JPG" style="width: 80px; height: 40px; cursor: pointer;" />
        </a>
			</div>  <h1>Training Station Session Registration</h1>
        </header>
		<div class="card-item3">
				<li></li>
                
		<form action="" method="post">
		<div class="form">
			 
        <img src="assets/training.JPG" alt="icon 1" class="icon"/>
                <li>
                    <label for="sesi_date">Session Date</label>
                    <input type="date" name="sesi_date" id="sesi_date" required>
                </li>
                <li>
                    <label for="sesi_time">Preference time:</label>
                    <select name="sesi_time" id="sesi_time" required>
                        <option value="09.00-10.30">09.00-10.30</option>
                        <option value="13.00-14.30">13.00-14.30</option>
                   </select>
                </li>
            </ul>
            <button type="submit" name="registerTS">Register for a session now</button>
			</div>
		</form>
		<li></li>
			</div>
    </div>
</body>
</html>