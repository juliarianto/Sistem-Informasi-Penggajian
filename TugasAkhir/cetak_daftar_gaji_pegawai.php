<?php 

session_start();
if(isset($_SESSION['login'])){
  include 'koneksi.php';
  include 'fungsi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Daftar Gaji Pegawai</title>

  <style type="text/css">
    body{
      font-family: Arial;
    }
    @media print{
      .no-print{
        display: none;
      }
    }
    table{
      border-collapse: collapse;
    }
  </style>

</head>
<body>
  <h3 align="center">SISTEM INFORMASI<br>PENGGAJIAN KARYAWAN MINI MARKET</h3>
  <hr>

<?php 
if((isset($_GET['bulan']) && $_GET['bulan'] !='') && (isset($_GET['tahun']) && $_GET['tahun'] !='')){
  $bulan      = $_GET['bulan'];
  $tahun      = $_GET['tahun'];
  $bulantahun = $bulan.$tahun;
  }else{
  $bulan      = date('m');
  $tahun      = date('Y');
  $bulantahun = $bulan.$tahun;
}
?>

<p>Bulan : <?= bulanIndonesia($_GET['bulan']).", Tahun : ".$_GET['tahun'];?></p>


<table border="1" cellpadding="4" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Gol</th>
                    <th>Status</th>
                    <th width="5px">J. Anak</th>
                    <th>Gaji Pokok</th>
                    <th>Tj. Jabatan</th>
                    <th>Tj. S/I</th>
                    <th>Tj. Anak</th>
                    <th>Uang Makan</th>
                    <th>Uang Lembur</th>
                    <th>Askes</th>
                    <th>Pendapatan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    
                </tr>
              </thead>
                <?php
              
                $p = "SELECT pegawai.nip,pegawai.nama_pegawai,jabatan.nama_jabatan,
                             golongan.nama_golongan,pegawai.status,pegawai.jumlah_anak,
                             jabatan.gaji_pokok,jabatan.tunjangan,
                             IF(pegawai.status='Menikah',tunjangan_suami_istri,0) AS tjsi,
                             IF(pegawai.status='Menikah',tunjangan_anak,0) AS tjanak,
                             uang_makan AS uangmakan,
                             gaji.lembur*uang_lembur AS uanglembur,
                             askes,
                             (gaji_pokok+tunjangan+(SELECT tjsi)+(SELECT tjanak)+(SELECT uangmakan)+(SELECT uanglembur)+askes) AS pendapatan,
                             potongan,
                             (SELECT pendapatan)-potongan AS totalgaji
                      FROM pegawai
                      INNER JOIN gaji ON gaji.nip=pegawai.nip
                      INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan
                      INNER JOIN jabatan ON jabatan.kode_jabatan=pegawai.kode_jabatan
                      WHERE gaji.bulan='$bulantahun'
                      ORDER BY pegawai.nip ASC";
                $query = mysqli_query($con, $p);
                $no = 1;

                while($d = mysqli_fetch_array($query)){
                  ?>
                  <tbody>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nip']; ?></td>
                    <td><?= $d['nama_pegawai']; ?></td>
                    <td><?= $d['nama_jabatan']; ?></td>
                    <td><?= $d['nama_golongan']; ?></td>
                    <td><?= $d['status']; ?></td>
                    <td><?= $d['jumlah_anak']; ?></td>
                    <td><?= buatRp($d['gaji_pokok']) ?></td>
                    <td><?= buatRp($d['tunjangan']) ?></td>
                    <td><?= buatRp($d['tjsi']) ?></td>
                    <td><?= buatRp($d['tjanak']) ?></td>
                    <td><?= buatRp($d['uangmakan']) ?></td>
                    <td><?= buatRp($d['uanglembur']) ?></td>
                    <td><?= buatRp($d['askes']) ?></td>
                    <td><?= buatRp($d['pendapatan']) ?></td>
                    <td><?= buatRp($d['potongan']) ?></td>
                    <td><?= buatRp($d['totalgaji']) ?></td>
                  </tbody>
                <?php } ?>
            </table>


            <table width="100%">
              <tr>
                <td></td>
                <td width="200px">
                  <p>Berau, <?= tglIndo(date("Y-m-d")); ?><br>
                     Bendahara,</p>
                     <br>
                     <br>
                     <br>
                     <p>___________________________</p>
                </td>
              </tr>
            </table>

            <a href="#" class="no-print" onclick="window.print();">Cetak/Print</a>
</body>
</html>

<?php 

}else{
  header("Location: login.php");
}

?>