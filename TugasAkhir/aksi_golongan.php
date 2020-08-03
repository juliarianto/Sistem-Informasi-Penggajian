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
    $kode           = $_POST['kodegolongan'];
    $nama           = $_POST['namagolongan'];
    $tunjangan      = $_POST['tunjangan'];
    $tunjangananak  = $_POST['tunjangananak'];
    $makan          = $_POST['uangmakan'];
    $lembur         = $_POST['uanglembur'];
    $askes          = $_POST['askes'];


    // apabila form kosong / belum lengkap
    if($kode=='' || $nama=='' || $tunjangan=='' || $tunjangananak=='' || $makan=='' || $lembur=='' || $askes==''){
      // header("Location: jabatan.php?view=tambah&e=bl");
      if(isset($_GET['e']) && $_GET['e']=='bl'){
       echo "<script>
          alert('Data Belum Lengkap...!');
          document.location.href = 'golongan.php';
          </script>";
      }
    }else{
      // proses simpan data
      $query = "INSERT INTO golongan VALUES ('$kode', '$nama', '$tunjangan', '$tunjangananak', '$makan', '$lembur', '$askes')";
      $simpan = mysqli_query($con, $query);

      if($simpan){
        header("Location: golongan.php?e=sukses");
      }else{
        header("Location: golongan.php?e=gagal");
      }
    }

    // jika act = update
  }elseif($_GET['act']=='update'){
     // simpan inputan form ke variabel
    $kode           = $_POST['kodegolongan'];
    $nama           = $_POST['namagolongan'];
    $tunjangan      = $_POST['tunjangan'];
    $tunjangananak  = $_POST['tunjangananak'];
    $makan          = $_POST['uangmakan'];
    $lembur         = $_POST['uanglembur'];
    $askes          = $_POST['askes'];

     // apabila form kosong / belum lengkap
    if($kode=='' || $nama=='' || $tunjangan=='' || $tunjangananak=='' || $makan=='' || $lembur=='' || $askes==''){
      // header("Location: jabatan.php?view=update&e=bl");
      if(isset($_GET['e']) && $_GET['e']=='bl'){
       echo "<script>
          alert('Data Belum Lengkap...!');
          document.location.href = 'golongan.php';
          </script>";
      }
    }else{
         // proses simpan data
      $query = "UPDATE golongan SET nama_golongan           = '$nama',
                                    tunjangan_suami_istri   = '$tunjangan',
                                    tunjangan_anak          = '$tunjangananak',
                                    uang_makan              = '$makan',
                                    uang_lembur             = '$lembur',
                                    askes                   = '$askes'
                                        WHERE kode_golongan = '$kode' ";
      $simpan = mysqli_query($con, $query);
      if($simpan){
        header("Location: golongan.php?e=sukses");
      }else{
        header("Location: golongan.php?e=gagal");
      }
    }

  // jika act = del
  }elseif($_GET['act']=='del'){
    $id = $_GET['id'];
    $query = "DELETE FROM golongan WHERE kode_golongan = '$id' ";
    $hapus = mysqli_query($con, $query);

    if($hapus){
        header("Location: golongan.php?e=sukses");
      }else{
        header("Location: golongan.php?e=gagal");
      }

  }else{ //jika act bukan insert, update, delete
    header("Location: golongan.php");
  }
}else{ //jika tidak ada get act
    header("Location: golongan.php");
}
?>