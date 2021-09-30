
<?php
// MENGHUBUNGKAN KONEKSI DATABASE
require "koneksi.php";


// JIKA SUDAH LOGIN MASUKKAN KEDALAM SHOWDATA
if (!isset($_SESSION["admin"])) {
    header('location: login.php');
    exit;
} else {
    if (isset($_SESSION['id'])) {
        // var_dump($_SESSION['id_user']); die;
        $my_id = $_SESSION['id'];
    }
    // QUERY MAHASISWA
    $user = query("SELECT * FROM tb_masuk WHERE id = '$my_id' ")[0];
}
?>

<?php
// // KONFIGURASI PAGINATION
// $jumlahDataPerHalaman = 10;
// $jumlahData = count(query("SELECT * FROM tb_user WHERE level = 'FREE' OR level = 'PREMIUM' "));
// $jumlahHalaman =  ceil($jumlahData / $jumlahDataPerHalaman);
// $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

//QUERY :
$data_log = query("SELECT tb_masuk.email, tb_masuk.username, tb_log.time_log FROM tb_log INNER JOIN tb_masuk ON tb_log.id_user = tb_masuk.id WHERE level = 'admin' OR level = 'user' ");
?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="short icon"  href="gambar/crop.jpg">
    <link rel="stylesheet" type="text/css" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>User Log</title>
  </head>
  <body>
     <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="gambar/crop.jpg" alt="" width="30" height="24" class="d-inline-block align-text-top">
          Fachreza 
        </a>
        <span class="navbar-text" style="margin-right: 10px">
        <a href="logout.php"><i class="fa fa-power-off"></i></a>
      </span>
      </div>
    </nav>



      <table class="table table-dark table-striped">
        <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Log activity</th>
          </tr>
        </thead>
     <tbody>
      <?php $no = 1; ?>
               <?php foreach ($data_log as $dl) : ?>
        <tr>
          <th scope="row"><?= $no; ?></th>
           <td><?= $dl["email"]; ?></td>
          <td><?= $dl["username"]; ?></td>
          <td><?= $dl["time_log"]; ?></td>
        
        </tr>
        <?php $no++ ?>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>