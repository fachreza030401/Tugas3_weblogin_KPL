<?php
// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";

if (!isset($_GET["code"])) {
    echo "<script>
        alert( 'The link has expired' );
        document.location.href = 'login.php';
    </script>";
}

$code = $_GET["code"];
$email = $_GET["email"];

$getEmailQuery = mysqli_query($conn, "SELECT * FROM tb_masuk WHERE email='$email'");

if (mysqli_num_rows($getEmailQuery) === 0) {
    echo "<script>
        alert( 'The link has expired' );
        document.location.href = 'login.php';
    </script>";
}

if (verification_account($email) > 0) {
    echo "<script>
        alert ('Email anda sudah terverifikasi !!');
        document.location.href = 'login.php';
    </script>";
} else {
    echo "<script>
        alert ('Error. Silahkan coba lagi !!');
        document.location.href = 'login.php';
    </script>";
    
}

?>