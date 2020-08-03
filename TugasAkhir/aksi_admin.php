<?php 
session_start();

include 'koneksi.php';

if(!isset($_SESSION['login'])){
  header("Location: login.php");
}

// jika ada get act
if(isset($_GET['act'])){

// jika act = insert
  if($_GET['act'] == 'insert'){
    // simpan inputan form ke variabel
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama     = $_POST['nama'];

    // apabila form kosong / belum lengkap
    if($username=='' || $_POST['password']=='' || $nama==''){
      // header("Location: admin.php?view=tambah");
      echo "Data Belum Lengkap..!";
    }else{
      // proses simpan data
      $simpan = mysqli_query($con, "INSERT INTO user VALUES (null, '$username', '$password', '$nama') ");

      if($simpan){
        header("Location: admin.php?e=sukses");
      }else{
        header("Location: admin.php?e=gagal");
      }
    }

    // jika act = update
  }elseif($_GET['act']=='update'){
    $id = $_POST['idadmin'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama     = $_POST['nama'];

    // apabila form kosong / belum lengkap
    if($username=='' || $nama==''){
      // header("Location: admin.php?view=tambah");
      echo "Data Belum Lengkap..!";
    }else{
      if($_POST['password']==''){
        $query1 = "UPDATE user SET user_admin = '$username',
                                   nama_admin = '$nama'
                               WHERE id_admin = '$id' ";
        $update = mysqli_query($con, $query1);
      }else{
        $query2 = "UPDATE user SET user_admin = '$username',
                                   pass_admin = '$password',
                                   nama_admin = '$nama'
                               WHERE id_admin = '$id' ";
        $update = mysqli_query($con, $query2);
      }
      if($update){
        header("Location: admin.php?e=sukses");
      }else{
        header("Location: admin.php?e=gagal");
      }
    }

    // jika act = delete
  }elseif($_GET['act']=='delete'){
    $query = "DELETE FROM user WHERE id_admin = '$_GET[id]' AND id_admin!='1'";
    $hapus = mysqli_query($con, $query);

    if($hapus){
        header("Location: admin.php?e=sukses");
      }else{
        header("Location: admin.php?e=gagal");
      }

  }else{ //jika act bukan insert, update, delete
    header("Location: admin.php");
  }
}else{ //jika tidak ada get act
    header("Location: admin.php");
}
?>