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
  <title>Laporan Data Pegawai</title>
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
  <p>LAPORAN DATA PEGAWAI</p>

  <table border="1" cellpadding="4" cellspacing="0" width="100%">
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama Pegawai</th>
      <th>Jabatan</th>
      <th>Golongan</th>
      <th>Status</th>
      <th>Jumlah Anak</th>
    </tr>

<?php 
$q = "SELECT pegawai.*, golongan.nama_golongan, jabatan.nama_jabatan
      FROM pegawai
      INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
      INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan
      ORDER BY golongan.nama_golongan ASC";
$query = mysqli_query($con, $q);
$no = 1;
while($d = mysqli_fetch_array($query)){ ?>

    <tr>
      <td align="center"><?= $no++; ?></td>
      <td align="center" width="40px"><?= $d['nip']; ?></td>
      <td><?= $d['nama_pegawai']; ?></td>
      <td><?= $d['nama_jabatan']; ?></td>
      <td align="center"><?= $d['nama_golongan']; ?></td>
      <td><?= $d['status']; ?></td>
      <td align="center"><?= $d['jumlah_anak']; ?> Orang</td>
    </tr>
    <?php } ?>
    <?php if(mysqli_num_rows($query) < 1){
      echo "<tr><td colspan='7'><p style='color: red; font-style: italic;'>Belum Ada Data...</p></td></tr>";
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