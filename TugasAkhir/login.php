<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>LOGIN SISTEM INFORMASI PENGGAJIAN KARYAWAN</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/materialize.css">
  </head>

  <body>
     <div class="container">
        <div class="row">
          <h3 class="center light grey-text text-darken-4">Sistem Informasi Penggajian Karyawan Mini Market Berbasis Web</h3>
        </div>
      </div>

<div class="login-page">
<div class="form">   
      <?php 
      // mengecek apakah ada request POST dari form sama seperti isset
      // jika ada tampung data ke variabel dan enkripsi password MD5
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $p    = md5($pass);

        // cek jika username / password kosong akan tampil pesan
        if($user=='' || $pass==''){
          ?>
            <div class="alert alert-warning" role="alert"><b>WARNING.</b> Silakan isi data valid!</div>
          <?php
        // ketika inputan data sudah lengkap, lakukan query atau cek data dari database
        }else{
          include 'koneksi.php';
          $query = mysqli_query($con, "SELECT * FROM user WHERE user_admin='$user' AND pass_admin='$p'");
          $result = mysqli_num_rows($query);
          $d = mysqli_fetch_array($query);

          // cek jumlah data user, lalu set session
          if($result > 0){
            session_start();
            $_SESSION['login']      = TRUE;
            $_SESSION['id']         = $id['idadmin'];
            $_SESSION['username']   = $id['username'];
            $_SESSION['nama']       = $id['nama'];

            // apabila ditemukan alihkan ke halaman index
            header("Location: index.php");
            // jika username / password salah akan tampil pesan
          }else{
             ?>
            <div class="alert alert-danger" role="alert"><b>ERROR!</b> Username / Password Salah...</div>
          <?php
          }
        }
      }
      ?>

   
    <form method="post" class="login-form" action="">
      <input type="text" name="username" placeholder="Username" autofocus class="validate"/>
      <input type="password" name="password" placeholder="Password" class="validate"/>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>

</html>