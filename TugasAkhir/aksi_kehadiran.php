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
    $bulan          = $_POST['bulan'];
    $nip            = $_POST['nip'];
    $masuk          = $_POST['masuk'];
    $sakit          = $_POST['sakit'];
    $izin           = $_POST['izin'];
    $alpha          = $_POST['alpha'];
    $lembur         = $_POST['lembur'];
    $potongan       = $_POST['potongan'];


    $count = count($nip);

         $query = "INSERT INTO gaji VALUES ";
    for($i=0; $i < $count; $i++){
         $query .= "('{$bulan[$i]}','{$nip[$i]}','{$masuk[$i]}','{$sakit[$i]}','{$izin[$i]}','{$alpha[$i]}','{$lembur[$i]}','{$potongan[$i]}')";
         $query .= " , ";
    }

    $query = rtrim($query," , ");
    $simpan = mysqli_query($con, $query);

      if($simpan){
        echo "<script>
          alert('Data Berhasil...!');
          document.location.href = 'kehadiran.php?e=sukses';
          </script>";
      }else{
        echo "<script>
          alert('Data GAGAL...!');
          document.location.href = 'kehadiran.php?e=gagal';
          </script>";
      }
    }

    // jika act = update
  elseif($_GET['act']=='update'){
    // simpan inputan form ke variabel
    $bulan          = $_POST['bulan'];
    $nip            = $_POST['nip'];
    $masuk          = $_POST['masuk'];
    $sakit          = $_POST['sakit'];
    $izin           = $_POST['izin'];
    $alpha          = $_POST['alpha'];
    $lembur         = $_POST['lembur'];
    $potongan       = $_POST['potongan'];


    
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