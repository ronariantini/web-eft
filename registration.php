<?php
require 'functions.php';

if( isset($_POST["register"])) {

       if(registrasi($_POST)>0) {
        echo "<script>
        alert('User baru berhasil ditambahkan!'); </script>";
    }
    header("Location: login.php");
} else {
        echo mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8" />
		<link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>User Registration</title>
		<link rel="stylesheet" href="style.css"/>
	</head>

    
<body>
    <div class="parallax">
        <header>
        <div >
        <a href="index.html">
        <img src="assets/icon/EFTlogo.JPG" style="width: 80px; height: 40px; cursor: pointer;" />
        </a>
			</div>  <h1>User Registration</h1>
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
                    <input type="password" name="password" id="password"required>
                </li>
                <li>
                    <label for="password2">Konfirmasi Password:</label>
                    <input type="password" name="password2" id="password2"required>
                </li>
                <li>
                    <label for="user_fullname">Full Name:</label>
                    <input type="text" name="user_fullname" id="user_fullname"required>
                </li>
                <li>
                    <label for="user_email">Email:</label>
                    <input type="email" name="user_email" id="user_email"required>
                </li>
            </ul>
            <button type="submit" name="register">Register now</button>
			</div>
		</form>
		<li></li>
			</div>
    </div>
</body>
</html>