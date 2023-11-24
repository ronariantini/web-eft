<?php
session_start();

if(!isset($_SESSION["Login"])){
  header("Location: login.php");
  exit;
}
require 'functions.php';

//ambil data di URL
$id = $_GET["id"];
//query data  berdasarkan id
$sesi = query("SELECT * FROM session WHERE session_id = $id")[0];


//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST['submit'])){


// cek apakah data berhasil di ubah
if(ubah($_POST)>0) {
    echo "
    <script>
    alert('Data berhasil diubah');
    document.location.href = 'index.php';
    </script>
    ";
}
else {
    echo "
    <script>
    alert('Data gagal diubah');
    document.location.href = 'index.php';
    </script>
    ";
}

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ubah data peserta training</title>
</head>

<body>
    <h1>Ubah data peserta training</h1>

    <form action="" method ="post">
        <input type="hidden" name="id" value="<?=$sesi["session_id"]; ?>">
    <ul>
        <li>
            <label for="user_name"> User Name : </label>
            <input type="text" name="user_name" id="user_name" required 
            value="<?= $sesi["user_name"]; ?>">
        </li>
        <li>
            <label for="training_id"> Jenis Training : </label>
            <input type="text" name="training_id" id="training_id" required
            value="<?= $sesi["training_id"]; ?>">
        </li>
        <li>
            <label for="user_email"> Email : </label>
            <input type="text" name="user_email" id="user_email" required
            value="<?= $sesi["user_email"]; ?>">
        </li>
        <li>
            <label for="session_token"> Token : </label>
            <input type="text" name="session_token" id="session_token" 
            required value="<?= $sesi["session_token"]; ?>">
        </li>
        <li>
            <button type="submit" name="submit">Ubah Data </button>
        </li>
    </ul>

</form>