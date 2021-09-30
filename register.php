<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

;

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
// APABILA TOMBOL CONFIRM DITEKAN
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {

        global $conn;
        $emailTo = $_POST["email"];

        $result = mysqli_query($conn, "SELECT * FROM tb_masuk WHERE email = '$emailTo' ");

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            $code = uniqid();

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                //Server settings
                $mail->isSMTP();                                          //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
                $mail->Username   = 'hweb0304@gmail.com';     //SMTP username
                $mail->Password   = 'fachreza0304';               //SMTP password
                $mail->SMTPSecure = 'ssl';                                //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('hweb0304@gmail.com', 'fachreza');
                $mail->addAddress($emailTo);                     //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

                //Content
                $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/register-verification.php?code=$code&email=$emailTo";
                $mail->isHTML(true);                              //Set email format to HTML
                $mail->Subject = 'Your Verification Account Link';
                $mail->Body    = "<h1>Please click this link to verification your account</h1><br>
                    Click <a href='$url'>This Link</a> to verification your account";
                $mail->AltBody = 'Welcome to our site.';

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        echo "<script>
			alert ('Silahkan lakukan verifikasi di email anda.');
		 	document.location.href = 'login.php';
        </script>";
    } else {
        echo mysqli_error($conn);
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
						<button type="button" class="toggle-btn" onclick="login">Register</button>
						
				</div>	
			<div class="social-icons">
			<img src="gambar/fb.png">
			<img src="gambar/tw3.png">
			<img src="gambar/gg.png">
		</div>
		<form id="login"class="input-group" action="register.php" method="POST">
			<input type="text" class="input-field" placeholder="Username" required name="username">
			<input type="email" class="input-field" placeholder="Email" required name="email">
			<input type="Password" class="input-field" placeholder="Enter Password" required name="password">
			<div class="chech-box">	
				<span >Sudah punya akun? <a href="login.php">Login</a></span>
			</div>
			<button type="submit" class="submit-btn" name="register">Register</button>

		</form>

		</div>
		
	</div>

	

</body>
</html>