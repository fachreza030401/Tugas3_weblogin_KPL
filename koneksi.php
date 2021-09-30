<?php
// MENGHUBUNGKAN KONEKSI COMPOSER
require "vendor/autoload.php";



//setting default timezone
date_default_timezone_set('Asia/Jakarta');

//start session
session_start();


//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_login");

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}





// FUNCTION LOGIN
function login($data)
{
    global $conn;

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tb_masuk WHERE email = '$email' ") or die(mysqli_error($conn));

    // CEK USERNAME APAKAH ADA PADA TABEL TB_REGIS_MHS
    if (mysqli_num_rows($result) === 1) {

        // CEK APAKAH PASSWORD BENAR 
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            // SET SESSION LOGIN
            $_SESSION["login"] = true;

            // SET SESSION USER
            $_SESSION["id_user"] = $row["id_user"];

            
        } else {
            return false;
        }
    }
    return mysqli_affected_rows($conn);
}








// FUNCTION REGISTER
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripcslashes($data["username"]));
    $email = strtolower(stripcslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
   

    // CEK EMAIL SUDAH ADA ATAU BELUM
    $result = mysqli_query($conn, "SELECT email FROM tb_masuk WHERE email = '$email' ");

    // CHECK EMAIL
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
		alert('Email yang dibuat sudah ada !');
		</script>";

        return false;
    }

    

    // ENSKRIPSI PASSWORD
    $passwordValid =  password_hash($password, PASSWORD_DEFAULT);

    

    // TAMBAHKAN USER BARU KEDATABASE
    $query = "INSERT INTO tb_masuk(email, username, password, level, verification) 
    VALUES('$email', '$username', '$passwordValid', 'user', 'no')";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_affected_rows($conn);



}





// MEMBUAT FUNCTION SHOW DATA (READ)
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $boxs = [];

    // AMBIL DATA (FETCH) DARI VARIABEL RESULT DAN MASUKKAN KE ARRAY
    while ($box = mysqli_fetch_assoc($result)) {
        $boxs[] = $box;
    }
    return $boxs;
}


// *************** MEMBUAT FUNCTION DELETE PRODUCT  *************** //
function verification_account($email)
{
    global $conn;

    //query update data tb_user
    $query = "UPDATE tb_masuk SET verification = 'yes' WHERE email = '$email' ";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    // MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
    return mysqli_affected_rows($conn);
}

//MEMBUAT FUNCTION CHANGE PASSWORD
function forgot_password($data)
{
    global $conn;

    $otp = mysqli_real_escape_string($conn, $data["otp"]);
    $new_pwd = mysqli_real_escape_string($conn, $data["password1"]);
    $new_pwd2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT * FROM tb_reset_password WHERE otp = '$otp' ");

    if (mysqli_num_rows($result) === 0) {
        echo "<script>
        alert('Incorrect OTP code');
        </script>";

        return false;
    }

    // CEK APAKAH PASSWORD BENAR 
    $row = mysqli_fetch_assoc($result);

    // CEK KONFIRMASI PASSWORD 
    if ($new_pwd !== $new_pwd2) {
        echo "<script>
        alert('Konfirmasi password salah');
        </script>";

        return false;
    }

    // ENSKRIPSI PASSWORD
    $passwordValid = password_hash($new_pwd2, PASSWORD_DEFAULT);

    // QUERY
    $query_delete = "DELETE FROM tb_reset_password WHERE otp = '$otp' ";
    mysqli_query($conn, $query_delete) or die(mysqli_error($conn));

    $query_reset = "UPDATE tb_masuk SET password = '$passwordValid' WHERE id = '" . $row["id_user"] . "' ";
    mysqli_query($conn, $query_reset) or die(mysqli_error($conn));

    // MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
    return mysqli_affected_rows($conn);
}


?>