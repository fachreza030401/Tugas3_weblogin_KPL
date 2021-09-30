<?php
// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

// if (!isset($_GET["code"])) {
//     echo "<script>
//         alert( 'The link has expired' );
//         document.location.href = 'login.php';
//     </script>";
// }

// //$code = $_GET["code"];

// $getEmailQuery = mysqli_query($conn, "SELECT * FROM tb_reset_password WHERE code='$code'");

// if (mysqli_num_rows($getEmailQuery) === 0) {
//     echo "<script>
//         alert( 'The link has expired' );
//         document.location.href = 'login.php';
//     </script>";
// }
?>

<?php
if (isset($_POST["change_password"])) {
    // CEK APAKAH BERHASIL DIUBAH ATAU TIDAK
    if (forgot_password($_POST) > 0) {
        echo "<script>
            alert( 'recovery password success !' );
            document.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert( 'recovery password failed !' );
            document.location.href = 'new-password.php?code=" . $code . " ';
        </script>";
    }
}
?>






<!DOCTYPE html>
<html>
<head>
	<title>Form Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="short icon"  href="gambar/crop.jpg">
</head>
<body>
	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
					<button type="button" class="toggle-btn" onclick="login">Password Baru</button>
					
				</div>
			
			<div class="social-icons">
			<img src="gambar/fb.png">
			<img src="gambar/tw3.png">
			<img src="gambar/gg.png">
		</div>
		<form id="login"class="input-group" action="new-password.php" method="POST">
			<input type="password" class="input-field" placeholder="Password Baru" required name="password1">
			<input type="password" class="input-field" placeholder="Konfirmasi Password" required name="password2">
			<input type="text" class="input-field" placeholder="Code OTP" required name="otp">
			
			<button type="submit" class="submit-btn" name="change_password">KIRIM KE EMAIL</button>
			

		</form>
		

		</div>
		
	</div>
</body>
</html>