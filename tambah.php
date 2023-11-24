<?php
session_start();

if(!isset($_SESSION["Login"])){
  header("Location: login.php");
  exit;
}
require 'functions.php';

//cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST['submit'])){


// query insert data
if(tambah($_POST)>0) {
    echo "
    <script>
    alert('Data berhasil ditambahkan');
    document.location.href = 'index.php';
    </script>
    ";
}
else {
    echo "
    <script>
    alert('Data gagal ditambahkan');
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
<title>Tambah data peserta training</title>
</head>

<body>
    <h1>Tambah data peserta training</h1>

    <form action="" method ="post">
    <ul>
        <li>
            <label for="user_name"> User Name : </label>
            <input type="text" name="user_name" id="user_name" required>
        </li>
        <li>
            <label for="training_id"> Jenis Training : </label>
            <input type="text" name="training_id" id="training_id" required>
        </li>
        <li>
            <label for="user_email"> Email : </label>
            <input type="text" name="user_email" id="user_email" required>
        </li>
        <li>
            <label for="session_token"> Token : </label>
            <input type="text" name="session_token" id="session_token" required>
        </li>
        <li>
            <button type="submit" name="submit">Tambah Data </button>
        </li>
    </ul>

</form>