<?php include 'navbar.php'; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
  default:
    //kode
?>

       <div class="row">
         <h5 class="center light grey-text text-darken-2">Data Penggajian Pegawai</h5><br>
           <div class="col m12 center">
            
            <form action="" method="get">
              <button type="submit" class="btn green right">Tampilkan</button>
              <div class="row">
                 <div class="col m2 s6 right">
                    <select name="tahun">
                      <option value="" disabled selected>Tahun</option>
                      <?php $y = date('Y');
                          for($i=2020;$i<$y+1;$i++){
                      ?>
                      <option value="<?= $i; ?>"><?= $i; ?></option>
                          <?php } ?>
                    </select>
                    <label>Tahun</label>
                </div>
                <div class="col m2 s6 right">
                    <select name="bulan">
                      <option value="" disabled selected>Bulan</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                    <label>Bulan</label>
                </div>
                </form>
                <!-- kondisi --> <?php 
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
              </div>
              <div class="row">
                <div class="col m4 s12"><br>
                <strong>Tampil = Bulan : <?= $bulan; ?>, Tahun : <?= $tahun; ?></strong>
                </div>
              </div>
            <table class="highlight">
              <thead>
                <tr>
                    <th>No</th>
                    <th width="10px">NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th width="10px">Gol</th>
                    <th width="10px">Status</th>
                    <th width="10px">Jumlah Anak</th>
                    <th width="10px">Gaji Pokok</th>
                    <th width="10px">Tj. Jabatan</th>
                    <th width="10px">Tj. S/I</th>
                    <th width="10px">Tj. Anak</th>
                    <th width="10px">Uang Makan</th>
                    <th width="10px">Uang Lembur</th>
                    <th width="10px">Askes</th>
                    <th width="10px">Pendapatan</th>
                    <th width="10px">Potongan</th>
                    <th width="10px">Total Gaji</th>
                    
                </tr>
              </thead>
                <?php 
                include 'koneksi.php';
                include 'fungsi.php';
              
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
          </div>
        </div>
        <div class="card-panel">
          <?php 
            if(mysqli_num_rows($query) > 0){
              echo "<center>
                    <a class='waves-effect waves-light blue btn-large' href='cetak_daftar_gaji_pegawai.php?bulan=$bulan&tahun=$tahun' target='_blank'>
                      Print
                    <i class='material-icons'>local_printshop</i>
                    </a>
                    <a class='waves-effect waves-light btn-large' href='excel_daftar_gaji_pegawai.php?bulan=$bulan&tahun=$tahun' target='_blank'>
                      Export ke Excel
                    <i class='material-icons'>play_for_work</i>
                    </a>
                    </center>
              ";
            }
          ?>
        </div>

<?php
  break;
  case "tambah":
    //kode

  break;
  case "edit":
    //kode

  break;
}
?>

</div>
<?php include 'java.php'; ?>
<?php include 'footer.php';?>