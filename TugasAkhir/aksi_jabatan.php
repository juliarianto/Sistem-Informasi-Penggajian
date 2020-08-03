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
    $kode       = $_POST['kodejabatan'];
    $nama       = $_POST['namajabatan'];
    $gapok      = $_POST['gajipokok'];
    $tunjangan  = $_POST['tunjangan'];

    // apabila form kosong / belum lengkap
    if($kode=='' || $nama=='' || $gapok=='' || $tunjangan==''){
      // header("Location: jabatan.php?view=tambah&e=bl");
      if(isset($_GET['e']) && $_GET['e']=='bl'){
       echo "<script>
          alert('Data Belum Lengkap...!');
          document.location.href = 'jabatan.php';
          </script>";
      }
    }else{
      // proses simpan data
      $query = "INSERT INTO jabatan VALUES ('$kode', '$nama', '$gapok', '$tunjangan')";
      $simpan = mysqli_query($con, $query);

      if($simpan){
        header("Location: jabatan.php?e=sukses");
      }else{
        header("Location: jabatan.php?e=gagal");
      }
    }

    // jika act = update
  }elseif($_GET['act']=='update'){
     // simpan inputan form ke variabel
    $kode       = $_POST['kodejabatan'];
    $nama       = $_POST['namajabatan'];
    $gapok      = $_POST['gajipokok'];
    $tunjangan  = $_POST['tunjangan'];

     // apabila form kosong / belum lengkap
    if($kode=='' || $nama=='' || $gapok=='' || $tunjangan==''){
      // header("Location: jabatan.php?view=update&e=bl");
      if(isset($_GET['e']) && $_GET['e']=='bl'){
       echo "<script>
          alert('Data Belum Lengkap...!');
          document.location.href = 'jabatan.php';
          </script>";
      }
    }else{
         // proses simpan data
      $query = "UPDATE jabatan SET nama_jabatan = '$nama',
                                   gaji_pokok   = '$gapok',
                                   tunjangan    = '$tunjangan'
                             WHERE kode_jabatan = '$kode'
                                   ";
      $simpan = mysqli_query($con, $query);
      if($simpan){
        header("Location: jabatan.php?e=sukses");
      }else{
        header("Location: jabatan.php?e=gagal");
      }
    }

  // jika act = del
  }elseif($_GET['act']=='del'){
    $id = $_GET['id'];
    $query = "DELETE FROM jabatan WHERE kode_jabatan = '$id' ";
    $hapus = mysqli_query($con, $query);

    if($hapus){
        header("Location: jabatan.php?e=sukses");
      }else{
        header("Location: jabatan.php?e=gagal");
      }

  }else{ //jika act bukan insert, update, delete
    header("Location: jabatan.php");
  }
}else{ //jika tidak ada get act
    header("Location: jabatan.php");
}
?>