<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "eft");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows =[];
    while( $row=mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah ($data){
    global $conn;

$user_name = htmlspecialchars($data["user_name"]);
$training_id = htmlspecialchars($data["training_id"]);
$user_email = htmlspecialchars($data ["user_email"]);
$sesi_token = htmlspecialchars($data ["sesi_token"]);
    $query = "INSERT INTO sesi
VALUES
('', '$user_name', '$training_id', '$user_email', '$sesi_token','','','')
";
mysqli_query ($conn, $query);
return mysqli_affected_rows($conn);

}


function hapus ($id){
    global $conn;

mysqli_query ($conn, "DELETE FROM `sesi`  WHERE sesi_id = $id");
return mysqli_affected_rows($conn);
}

function ubah ($data){
    global $conn;
$id = $data["id"];
$user_name = htmlspecialchars($data["user_name"]);
$training_id = htmlspecialchars($data["training_id"]);
$user_email = htmlspecialchars($data ["user_email"]);
$sesi_token = htmlspecialchars($data ["sesi_token"]);
    $query = "UPDATE sesi SET 
    user_name='$user_name', 
    training_id='$training_id',
    user_email= '$user_email',
    sesi_token= '$sesi_token'
WHERE sesi_id =$id
";
mysqli_query ($conn, $query);
return mysqli_affected_rows($conn);

}


function registrasi($data) {
    global $conn;

    $username = htmlspecialchars(strtolower(stripslashes ($data["username"])));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data ["password"]));
    $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data ["password2"]));
    $user_email = htmlspecialchars(strtolower(stripslashes ($data["user_email"])));
    $user_fullname = htmlspecialchars(stripslashes ($data["user_fullname"]));
    
    //cek username sudah aada atau belum
$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

if (mysqli_fetch_assoc($result)){
    echo "<script>
    alert ('Username sudah terdaftar gunakan username lain') 
    </script>";
    return false;
}

    //cek konfirmasi password
    if($password !== $password2) {
        echo "<script>
        alert('Konfirmasi password tidak sama dengan password yang diisikan sebelumnya') 
        </script>";
    return false;
    }

    //enkripsi password
    $password =password_hash ($password, PASSWORD_DEFAULT);
    
    //tambahkan userbaru ke database
    mysqli_query ($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$user_email', '$user_fullname', '') ");

    return mysqli_affected_rows ($conn);
}

function generateRandomToken($length = 6) {
    $characters = '0123456789ABCD';
    $token = '';
    
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $token;
}

// Menggunakan fungsi untuk menghasilkan token

function registrasiTS($user_id, $data) {
    global $conn;
    $sesi_token = generateRandomToken(6);
    $sesi_date = $data["sesi_date"];
    $sesi_time = $data["sesi_time"];

    // Cek apakah pengguna memiliki sesi aktif dengan sesi_status = 0
    $result = mysqli_query($conn, "SELECT sesi_id FROM sesi WHERE user_id = '$user_id' AND sesi_status = '0'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Anda masih memiliki Sesi Aktif Training yang sama yang belum diselesaikan. Hubungi admin untuk merubah data.');</script>";
        return false;
    }

    // Cek apakah tanggal sudah ada
    $result = mysqli_query($conn, "SELECT sesi_date FROM sesi WHERE sesi_date = '$sesi_date' ");

    if (mysqli_fetch_assoc($result)){
        echo "<script>alert('Tanggal tersebut sudah penuh');</script>";
        return false;
    }

    // Tambahkan session baru ke database
    $insertQuery = "INSERT INTO sesi (sesi_id, user_id, training_id, sesi_token, sesi_status, sesi_date, sesi_time, rowstatus) VALUES ('','$user_id', 'EFT Training Station', '$sesi_token', '0', '$sesi_date', '$sesi_time', '1')";
    if (mysqli_query($conn, $insertQuery)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}


?>