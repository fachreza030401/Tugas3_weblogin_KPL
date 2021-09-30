<?php

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// CEK COOKIE
// checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM INDEX
if (isset($_SESSION["user"])) {
    header('location: index-user.php');
    exit;
} elseif (isset($_SESSION["admin"])) {
    header('location: index-admin.php');
    exit;
} 
?>

<?php
// APABILA BUTTON LOGIN DI KLIK
if (isset($_POST["login"])) {
    // TRY AND CATCH
    try {
        //code...
        global $conn;

        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM tb_masuk WHERE email = '$email' ") or die(mysqli_error($conn));

        // CEK USERNAME APAKAH ADA PADA TABEL TB_REGIS_MHS
        if (mysqli_num_rows($result) === 1) {

            // CEK APAKAH PASSWORD BENAR 
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["password"])) {

                if ($row["verification"] == "yes") {

                    // SET SESSION USER
                    $_SESSION["id"] = $row["id"];

                    if ($row["level"] == "admin") {
                        // SET SESSION FREE
                        $_SESSION["admin"] = true;

                        // QUERY LOG ACTIVITY
                        $userLog = $row["id"];
                        $timeLog = date("Y-m-d H:i:s");
                        $query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

                        mysqli_query($conn, $query_log) or die(mysqli_error($conn));

                        // // Cek Remember
                        // if (isset($_POST['remember_me'])) {
                        //     // Buat Cookie
                        //     setcookie('id_user', $row['id_user'], time() + 86400, '/');
                        //     setcookie('key', hash('sha256', $row['username']), time() + 86400, '/');
                        // }

                        header('location: index-admin.php');
                    } else if ($row["level"] == "user") {
                        // SET SESSION FREE
                        $_SESSION["user"] = true;

                        // QUERY LOG ACTIVITY
                        $userLog = $row["id"];
                        $timeLog = date("Y-m-d H:i:s");
                        $query_log = "INSERT INTO tb_log(id_user, time_log)	VALUES('$userLog', '$timeLog')";

                        mysqli_query($conn, $query_log) or die(mysqli_error($conn));

                        // // Cek Remember
                        // if (isset($_POST['remember_me'])) {
                        //     // Buat Cookie
                        //     setcookie('id_user', $row['id_user'], time() + 86400, '/');
                        //     setcookie('key', hash('sha256', $row['username']), time() + 86400, '/');
                        // }

                        header('location: index-user.php');
                    } else {
                        throw new Exception("Level akses account anda tidak terdaftar !!");
                    }
                } else {
                    throw new Exception("Anda belum melakukan verifikasi account. Silahkan cek email !!");
                }
            } else {
                throw new Exception("Password yang anda masukkan salah !!");
            }
        } else {
            throw new Exception("Email yang anda masukkan tidak terdaftar !!");
        }
        exit;
    } catch (Exception $error) {
        echo "<script>
        alert ('" . $error->getMessage() . "');
            document.location.href = 'login.php';
        </script>";
    }
}
?>






<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="short icon"  href="gambar/crop.jpg">
</head>
<body>
	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
						<button type="button" class="toggle-btn" onclick="login">Log In</button>
					
				</div>
			
			<div class="social-icons">
			<img src="gambar/fb.png">
			<img src="gambar/tw3.png">
			<img src="gambar/gg.png">
		</div>
		<form id="login"class="input-group" action="login.php" method="POST">
			<input type="email" class="input-field" placeholder="Email" required name="email">
			<input type="Password" class="input-field" placeholder="Enter Password" required name="password">
			<div class="chech-box">	
				<span >Belum punya akun? <a href="register.php">Register</a></span> 
			</div>
			<div class="chek-lupa" style="font-size: 12px;color: #777; padding-bottom: 10px;">
				<p>lupa Password ? <a href="forgot-password.php">Forgot</a></p>
			</div>
			
			<button type="submit" class="submit-btn" name="login">Log In</button>
			

		</form>
		

		</div>
		
	</div>
</body>
</html>