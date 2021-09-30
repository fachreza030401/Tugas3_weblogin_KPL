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

// CEK COOKIE
//checkCookie();

// JIKA SUDAH LOGIN MASUKKAN KEDALAM INDEX
if (isset($_SESSION["admin"])) {
    header('location: index-admin.php');
    exit;
} elseif (isset($_SESSION["user"])) {
    header('location: index-user.php');
    exit;
} 
?>

<?php
// APABILA TOMBOL RESET DITEKAN
if (isset($_POST["Reset"])) {

    global $conn;
    $emailTo = $_POST["email"];

    $result = mysqli_query($conn, "SELECT * FROM tb_masuk WHERE email = '$emailTo' ");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        $code = uniqid();
        $otp = mt_rand(100000, 999999);

        // BUAT KODE OTP UNTUK VERIFIKASI
        $query = "INSERT INTO tb_reset_password(code, id_user, otp) VALUES('$code', '" . $row["id"] . "', '$otp')";
        mysqli_query($conn, $query) or die(mysqli_error($conn));


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
            $mail->setFrom('hweb0304@gmail.com', 'Fachreza');
            $mail->addAddress($emailTo);                     //Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

            //Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/new-password.php?code=$code";
            $mail->isHTML(true);                              //Set email format to HTML
            $mail->Subject = 'Your Password Reset Link';
            $mail->Body    = "<h1>You Requested a password reset</h1><br>
            <h3>Kode OTP : " . $otp . "</h3>
            Click <a href='$url'>This Link</a> to do so";
            $mail->AltBody = 'Thankyou.';

            $mail->send();
            echo "<script>
                    alert ('Reset Password link has been sent to your email');
                    document.location.href = 'login.php';
                </script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>
            alert ('Email yang anda masukkan tidak terdaftar !');
            document.location.href = 'forgot-password.php';
        </script>";
    }
    exit();
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
						<button type="button" class="toggle-btn" onclick="login">Forgot Password</button>
					
				</div>
			
			<div class="social-icons">
			<img src="gambar/fb.png">
			<img src="gambar/tw3.png">
			<img src="gambar/gg.png">
		</div>
		<form id="login"class="input-group" action="forgot-password.php" method="POST">
			<input type="email" class="input-field" placeholder="Email" required name="email">
			
			
			<button type="submit" class="submit-btn" name="Reset">KIRIM</button>
			

		</form>
		

		</div>
		
	</div>
</body>
</html>