<?php include 'navbar.php'; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
  default:
    //kode
    ?>
      <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Kehadiran Pegawai</h5><br>
          <div class="col m12 center">
            <a href="kehadiran.php?view=tambah" class="btn blue left">Tambah Kehadiran Pegawai</a>

            <form action="" method="get">
              <button type="submit" class="btn green right">Tampilkan</button>    
                 <div class="col m2 s5 right">
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
                <div class="col m2 s5 right">
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
              <div class="row">
                <div class="col m4 s12"><br>
                <strong>Tampil = Bulan : <?= $bulan; ?>, Tahun : <?= $tahun; ?></strong>
                </div>
              </div>
            <table class="highlight centered">
              <thead>
                <tr>
                    <th>No</th>
                    <th width="10px">NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th width="10px">Masuk</th>
                    <th width="10px">Sakit</th>
                    <th width="10px">Izin</th>
                    <th width="10px">Alpha</th>
                    <th width="10px">Lembur</th>
                    <th>Potongan</th>
                    
                </tr>
              </thead>
                <?php 
                include 'koneksi.php';
                $q = "SELECT gaji.*, pegawai.nama_pegawai, pegawai.kode_jabatan, jabatan.nama_jabatan
                      FROM gaji
                      INNER JOIN pegawai ON gaji.nip=pegawai.nip
                      INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                      WHERE gaji.bulan=$bulantahun
                      ORDER BY pegawai.nip ASC
                     ";
                $query = mysqli_query($con, $q);
                $no = 1;

                while($d = mysqli_fetch_array($query)){
                  ?>
                  <tbody>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nip']; ?></td>
                    <td><?= $d['nama_pegawai']; ?></td>
                    <td><?= $d['nama_jabatan']; ?></td>
                    <td><?= $d['masuk']; ?></td>
                    <td><?= $d['sakit']; ?></td>
                    <td><?= $d['izin']; ?></td>
                    <td><?= $d['alpha']; ?></td>
                    <td><?= $d['lembur']; ?>Jam</td>
                    <td>Rp.<?= $d['potongan']; ?></td>
                  </tbody>

                <?php } 
                
                if(mysqli_num_rows($query) > 0){
                  echo "<tr>
                        <td colspan='9' text-align='center'>
                          <a href='kehadiran.php?view=edit&bulan=$bulan&tahun=$tahun' class='btn orange left'>Edit Data Kehadiran</a>
                        </td>
                  </tr>";
                }else{
                  echo "<tr>
                        <td colspan='9' text-align='center'>
                          <p style='color: red; font-style: italic;'>Belum Ada Data Pada Bulan dan Tahun Yang Anda Pilih...</p>
                        </td>
                  </tr>";
                }
                ?>
              
            </table>
          </div>
        </div>

    <?php
  break;
  case "tambah":
    //kode
?>

 <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Kehadiran Pegawai</h5><br>
          <div class="col m12 center">
            <form action="" method="get">
              <input type="hidden" name="view" value="tambah">
              <button type="submit" class="btn green right">Pilih</button>    
                 <div class="col m2 s5 right">
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
                <div class="col m2 s5 right">
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
                <br>
                <?php 
                // menangkap tahun & bulan tombol submit form
                if((isset($_GET['tahun']) && $_GET['tahun'] !='') && (isset($_GET['bulan']) && $_GET['bulan'] !='')){
                  $bulan      = $_GET['bulan'];
                  $tahun      = $_GET['tahun'];
                  $bulantahun = $bulan.$tahun;
                }else{
                  $bulan      = date('m');
                  $tahun      = date('Y');
                  $bulantahun = $bulan.$tahun;
                }
                ?>

              <div class="row">
                <div class="col m4 s12"><br>
                <strong>Tampil = Bulan : <?= $bulan; ?>, Tahun : <?= $tahun; ?></strong>
                </div>
              </div>

          
            <div class="col m12 s12">
              <div class="card-panel">
                <h5>Tambah Data Kehadiran Pegawai</h5>
                <form action="aksi_kehadiran.php?act=insert" method="post">
                  <br>
                   <table class="highlight centered">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th width="10px">NIP</th>
                            <th>Nama Pegawai</th>
                            <th width="10px">Jabatan</th>
                            <th width="10px">Masuk</th>
                            <th width="10px">Sakit</th>
                            <th width="10px">Izin</th>
                            <th width="10px">Alpha</th>
                            <th width="10px">Lembur</th>
                            <th>Potongan</th>
                            
                        </tr>
                      </thead>

                      <?php 
                
                $q = "SELECT pegawai.*, jabatan.nama_jabatan
                      FROM pegawai
                      INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                      WHERE NOT EXISTS 
                      (SELECT * FROM gaji WHERE bulan='$bulantahun' AND pegawai.nip=gaji.nip)
                      ORDER BY pegawai.nip ASC
                     ";
    // memilih semua pegawai, menampilkan nama jabatan dari tabel pegawai. jika data pegawai tidak ada di tabel gaji pada bulan
    // atau tahun yg ditentukan maka ditampilkan
                $query = mysqli_query($con, $q);
                $no = 1;
                $jmlpegawai = mysqli_num_rows($query);

                while($d = mysqli_fetch_array($query)){
                  ?>

                  <input type="hidden" name="bulan[]" value="<?= $bulantahun; ?>">

                  <input type="hidden" name="nip[]" value="<?= $d['nip']; ?>">

                  <tbody>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nip']; ?></td>
                    <td><?= $d['nama_pegawai']; ?></td>
                    <td><?= $d['nama_jabatan']; ?></td>
                    <td>
                      <input type="number" name="masuk[]" value="0" required>
                    </td>
                    <td>
                      <input type="number" name="sakit[]" value="0" required>
                    </td>
                    <td>
                      <input type="number" name="izin[]" value="0" required>
                    </td>
                    <td>
                      <input type="number" name="alpha[]" value="0" required>
                    </td>
                    <td>
                      <input type="number" name="lembur[]" value="0" required>
                    </td>
                    <td>
                      <input type="number" name="potongan[]" value="0" required>
                    </td>
                  </tbody>

                <?php }
                
                if($jmlpegawai > 0){ ?>
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="6">
                      <input type="submit" value="Simpan" class="btn blue">
                      <a href="kehadiran.php" class="btn red">Kembali</a>
                    </td>
                  </tr>
                <?php
                }else{ ?>
                  <tr>
                    <td colspan="10">
                      <p style='color: red; font-style: italic;'>Maaf... Bulan dan tahun yang Anda pilih sudah diproses, silakan pilih bulan dan tahun lainnya...</p>
                    </td>
                  </tr>
      <?php } ?>
                   
                  </table>
                </form>
             </div>
           </div>
          </div>
        </div>
<?php
  break;
  case "edit":
    //kode
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulantahun = $bulan.$tahun;
?>

        <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Kehadiran Pegawai</h5>
          <div class="col m12 s12 center">
            
            <div class="col m12 s12">
              <div class="card-panel">
                <h5>Edit Data Kehadiran</h5>
                  <div class="row">
                    <div class="col m4 s12"><br>
                    <strong>Tampil = Bulan : <?= $bulan; ?>, Tahun : <?= $tahun; ?></strong>
                    </div>
                  </div>
                  <form action="aksi_kehadiran.php?act=update" method="post">
                  <br>
                   <table class="highlight centered">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th width="10px">NIP</th>
                            <th>Nama Pegawai</th>
                            <th width="10px">Jabatan</th>
                            <th width="10px">Masuk</th>
                            <th width="10px">Sakit</th>
                            <th width="10px">Izin</th>
                            <th width="10px">Alpha</th>
                            <th width="10px">Lembur</th>
                            <th>Potongan</th>
                            
                        </tr>
                      </thead>

                      <?php 
                
                $t = "SELECT gaji.*, pegawai.nama_pegawai, jabatan.nama_jabatan
                      FROM gaji
                      INNER JOIN pegawai ON gaji.nip=pegawai.nip
                      INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan
                      WHERE gaji.bulan='$bulantahun'
                      ORDER BY gaji.nip ASC
                      ";
                $query = mysqli_query($con, $t);
                $no = 1;

                while($d = mysqli_fetch_array($query)){
                  ?>

                  <input type="hidden" name="bulan[]" value="<?= $bulantahun; ?>">

                  <input type="hidden" name="nip[]" value="<?= $d['nip']; ?>">

                  <tbody>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nip']; ?></td>
                    <td><?= $d['nama_pegawai']; ?></td>
                    <td><?= $d['nama_jabatan']; ?></td>
                    <td>
                      <input type="number" name="masuk[]" value="<?= $d['masuk']; ?>" required>
                    </td>
                    <td>
                      <input type="number" name="sakit[]" value="<?= $d['sakit']; ?>" required>
                    </td>
                    <td>
                      <input type="number" name="izin[]" value="<?= $d['izin']; ?>" required>
                    </td>
                    <td>
                      <input type="number" name="alpha[]" value="<?= $d['alpha']; ?>" required>
                    </td>
                    <td>
                      <input type="number" name="lembur[]" value="<?= $d['lembur']; ?>" required>
                    </td>
                    <td>
                      <input type="number" name="potongan[]" value="<?= $d['potongan']; ?>" required>
                    </td>
                  </tbody>

                <?php } ?>
                
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="6">
                      <input type="submit" value="Simpan" class="btn blue">
                      <a href="kehadiran.php" class="btn red">Kembali</a>
                    </td>
                  </tr>
                   
                  </table>
                </form>
                
              </div>
          </div>
        </div>
      </div>

<?php
  break;
}
?>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'java.php'; ?>
<?php include 'footer.php';?>