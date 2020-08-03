<?php include 'navbar.php'; ?>

<div class="row">
          <h5 class="center light grey-text text-darken-2">Laporan Kehadiran Pegawai</h5><br>
          <div class="col m10 center">
            
            <form action="cetak_laporan_kehadiran.php" method="get" target="_blank">
              <button type="submit" class="btn green right">Cetak Laporan</button>    
                 <div class="col m4 s6 right">
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
                <div class="col m4 s6 right">
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
          </div>

<?php include 'java.php'; ?>
<?php include 'footer.php';?>