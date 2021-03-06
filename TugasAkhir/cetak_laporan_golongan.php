<?php 

// memulai session
session_start();

// cek apakah ada session login
if(isset($_SESSION['login'])){

// menghubungkan ke file koneksi
include 'koneksi.php';
include 'fungsi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Data Golongan</title>
  <style>
    body{
      font-family: Arial;
    }
    table{
      border-collapse: collapse;
    }
    @media print{
      .no-print{
        display: none;
      }
    }
  </style>
</head>
<body>
  <h3 align="center">SISTEM INFORMASI<br>PENGGAJIAN KARYAWAN MINI MARKET</h3>
  <hr>
  <p>LAPORAN DATA GOLONGAN</p>

  <table border="1" cellpadding="4" cellspacing="0" width="100%">
    <tr>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Golongan</th>
      <th>Tunjangan Suami/Istri</th>
      <th>Tunjangan Anak</th>
      <th>Uang Makan</th>
      <th>Uang Lembur</th>
      <th>Askes</th>
    </tr>

<?php 
$q = "SELECT * FROM golongan ORDER BY kode_golongan ASC";
$query = mysqli_query($con, $q);
$no = 1;
while($d = mysqli_fetch_array($query)){ ?>

    <tr>
      <td align="center"><?= $no++; ?></td>
      <td align="center"><?= $d['kode_golongan']; ?></td>
      <td align="center"><?= $d['nama_golongan']; ?></td>
      <td align="center"><?= buatRp($d['tunjangan_suami_istri']) ?></td>
      <td align="center"><?= buatRp($d['tunjangan_anak']) ?></td>
      <td align="center"><?= buatRp($d['uang_makan']) ?></td>
      <td align="center"><?= buatRp($d['uang_lembur']) ?></td>
      <td align="center"><?= buatRp($d['askes']) ?></td>
    </tr>
    <?php } ?>
    <?php if(mysqli_num_rows($query) < 1){
      echo "<tr><td colspan='8'><p style='color: red; font-style: italic;'>Belum Ada Data...</p></td></tr>";
    } ?>
  </table>

  <table width="100%">
    <tr>
      <td></td>
      <td width="200px">
        <p>Berau, <?= tglIndo(date("Y-m-d")); ?><br>
                     Administrator,</p>
                     <br>
                     <br>
                     <br>
                     <p>_____________________________</p>
      </td>
    </tr>
  </table>
  <a href="#" class="no-print" onclick="window.print();">Cetak/Print</a>
</body>
</html>

<?php 
}else{
// jika tidak ada session alihkan user ke halaman login
  header("Location: login.php");
}
?>