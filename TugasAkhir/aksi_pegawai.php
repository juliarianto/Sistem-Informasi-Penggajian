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
    $nip             = $_POST['nip'];
    $nama            = $_POST['namapegawai'];
    $jabatan         = $_POST['jabatan'];
    $golongan        = $_POST['golongan'];
    $status          = $_POST['status'];
    $anak            = $_POST['anak'];


    // apabila form kosong / belum lengkap
    if($nip=='' || $nama=='' || $jabatan=='' || $golongan=='' || $status=='' || $anak==''){
      // header("Location: jabatan.php?view=tambah&e=bl");
      if(isset($_GET['e']) && $_GET['e']=='bl'){
       echo "<script>
          alert('Data Belum Lengkap...!');
          document.location.href = 'pegawai.php';
          </script>";
      }
    }else{
      // proses simpan data
      $query = "INSERT INTO pegawai VALUES ('$nip', '$nama', '$jabatan', '$golongan', '$status', '$anak')";
      $simpan = mysqli_query($con, $query);

      if($simpan){
        header("Location: pegawai.php?e=sukses");
      }else{
        header("Location: pegawai.php?e=gagal");
      }
    }

    // jika act = update
  }elseif($_GET['act']=='update'){
    // simpan inputan form ke variabel
    $nip             = $_POST['nip'];
    $nama            = $_POST['namapegawai'];
    $jabatan         = $_POST['jabatan'];
    $golongan        = $_POST['golongan'];
    $status          = $_POST['status'];
    $anak            = $_POST['anak'];


    // apabila form kosong / belum lengkap
    if($nip=='' || $nama=='' || $jabatan=='' || $golongan=='' || $status=='' || $anak==''){
      // header("Location: jabatan.php?view=tambah&e=bl");
      if(isset($_GET['e']) && $_GET['e']=='bl'){
       echo "<script>
          alert('Data Belum Lengkap...!');
          document.location.href = 'pegawai.php';
          </script>";
      }
    }else{
         // proses simpan data
      $query = "UPDATE pegawai SET nama_pegawai    = '$nama',
                                    kode_jabatan   = '$jabatan',
                                    kode_golongan  = '$golongan',
                                    status         = '$status',
                                    jumlah_anak    = '$anak'
                                         WHERE nip = '$nip' ";
      $simpan = mysqli_query($con, $query);
      if($simpan){
        header("Location: pegawai.php?e=sukses");
      }else{
        header("Location: pegawai.php?e=gagal");
      }
    }

  // jika act = del
  }elseif($_GET['act']=='del'){
    $id = $_GET['id'];
    $query = "DELETE FROM pegawai WHERE nip = '$id' ";
    $hapus = mysqli_query($con, $query);

    if($hapus){
        header("Location: pegawai.php?e=sukses");
      }else{
        header("Location: pegawai.php?e=gagal");
      }

  }else{ //jika act bukan insert, update, delete
    header("Location: pegawai.php");
  }
}else{ //jika tidak ada get act
    header("Location: pegawai.php");
}
?>