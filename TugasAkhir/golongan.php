<?php include 'navbar.php'; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
  default:

  // untuk pesan berhasil atau gagal
  if(isset($_GET['e']) && $_GET['e']=='sukses'){
    echo "<script>
          alert('Proses Berhasil...!');
          document.location.href = 'golongan.php';
          </script>";
  }elseif(isset($_GET['e']) && $_GET['e']=='gagal'){
    echo "<script>
          alert('Proses Gagal...!');
          document.location.href = 'golongan.php';
          </script>";
  }
    //kode
    ?>
        <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Golongan</h5><br>
          <div class="col m12 center">
            <a href="golongan.php?view=tambah" class="btn blue left">Tambah Data Golongan</a>
            <table class="highlight centered">
              <thead>
                <tr>
                    <th>No</th>
                    <th width="10px">Kode Golongan</th>
                    <th width="10px">Nama Golongan</th>
                    <th>Tunjangan S/I</th>
                    <th>Tunjangan Anak</th>
                    <th>Uang Makan</th>
                    <th>Uang Lembur</th>
                    <th>Askes</th>
                    <th>Aksi</th>
                </tr>
              </thead>
                <?php 
                include 'koneksi.php';
                  $query = mysqli_query($con, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                $no = 1;

                while($d = mysqli_fetch_array($query)){
                  ?>
                  <tbody>
                    <td><?= $no++; ?></td>
                    <td><?= $d['kode_golongan']; ?></td>
                    <td><?= $d['nama_golongan']; ?></td>
                    <td>Rp.<?= $d['tunjangan_suami_istri']; ?></td>
                    <td>Rp.<?= $d['tunjangan_anak']; ?></td>
                    <td>Rp.<?= $d['uang_makan']; ?></td>
                    <td>Rp.<?= $d['uang_lembur']; ?></td>
                    <td>Rp.<?= $d['askes']; ?></td>
                    <td><a class="btn green btn-small" href="golongan.php?view=edit&id=<?= $d['kode_golongan']; ?>">Edit</a>
                      <a class="btn red btn-small" href="aksi_golongan.php?act=del&id=<?= $d['kode_golongan']; ?>" onclick="return confirm('Ingin menghapus data ini?');">Hapus</a></td>
                  </tbody>

                <?php } ?>
              
            </table>
          </div>
        </div>
<?php
  break;
  case "tambah":
    //membuat kode tambah golongan otomatis

    $simbol = "G";
    $query  = mysqli_query($con, "SELECT max(kode_golongan) AS last FROM golongan WHERE kode_golongan LIKE '$simbol%'");
    $data   = mysqli_fetch_array($query);

    $kodeterakhir   = $data['last'];
    $nomorterakhir  = substr($kodeterakhir, 1, 2);
    $nomorberikut   = $nomorterakhir + 1;
    $kodeberikut    = $simbol.sprintf('%02s', $nomorberikut);

    ?>
      <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Golongan</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Tambah Data Golongan</h5>
                <form action="aksi_golongan.php?act=insert" method="post">
                <div class="input-field">
                  <input type="text" name="kodegolongan" id="kodegolongan" value="<?= $kodeberikut; ?>" readonly>
                  <label for="kodegolongan">Kode Golongan</label>
                </div>
                <div class="input-field">
                  <input type="text" name="namagolongan" id="namagolongan" required class="validate">
                  <label for="namagolongan">Nama Golongan</label>
                </div>
                <div class="input-field">
                  <input type="number" name="tunjangan" id="tunjangan" required class="validate">
                  <label for="tunjangan">Tunjangan S/I</label>
                </div>
                <div class="input-field">
                  <input type="number" name="tunjangananak" id="tunjangananak" required class="validate">
                  <label for="tunjangananak">Tunjangan Anak</label>
                </div>
                <div class="input-field">
                  <input type="number" name="uangmakan" id="uangmakan" required class="validate">
                  <label for="uangmakan">Uang Makan</label>
                </div>
                <div class="input-field">
                  <input type="number" name="uanglembur" id="uanglembur" required class="validate">
                  <label for="uanglembur">Uang Lembur</label>
                </div>
                <div class="input-field">
                  <input type="number" name="askes" id="askes" required class="validate">
                  <label for="askes">ASKES</label>
                </div>
                <button type="submit" name="tambah" class="btn blue darken-1">Tambah</button>
                <a class="btn red" href="golongan.php">Batal</a>
                </form>
                </div>
              </div>
          </div>
        </div>
      </div>
<?php
  break;
  case "edit":
    //kode
  $id = $_GET['id'];
  $query = "SELECT * FROM golongan WHERE kode_golongan = '$id' ";
  $edit = mysqli_query($con, $query);
  $e = mysqli_fetch_array($edit);
?>

    <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Golongan</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Edit Data Golongan</h5>
                <form action="aksi_golongan.php?act=update" method="post">
                <div class="input-field">
                  <input type="hidden" name="kodegolongan" value="<?= $e['kode_golongan']; ?>">
                  <input type="text" name="kodegolongan " id="kodegolongan" autocomplete="off" value="<?= $e['kode_golongan']; ?>" readonly>
                  <label for="kodegolongan">Kode Golongan</label>
                </div>
                <div class="input-field">
                  <input type="text" name="namagolongan" id="namagolongan" autocomplete="off" value="<?= $e['nama_golongan']; ?>" required class="validate">
                  <label for="namagolongan">Nama Golongan</label>
                </div>
                <div class="input-field">
                  <input type="number" name="tunjangan" id="tunjangan" autocomplete="off" value="<?= $e['tunjangan_suami_istri']; ?>" required class="validate">
                  <label for="tunjangan">Tunjangan S/I</label>
                </div>
                <div class="input-field">
                  <input type="number" name="tunjangananak" id="tunjangananak" autocomplete="off" value="<?= $e['tunjangan_anak']; ?>" required class="validate">
                  <label for="tunjangananak">Tunjangan Anak</label>
                </div>
                <div class="input-field">
                  <input type="number" name="uangmakan" id="uangmakan" autocomplete="off" value="<?= $e['uang_makan']; ?>" required class="validate">
                  <label for="uangmakan">Uang Makan</label>
                </div>
                <div class="input-field">
                  <input type="number" name="uanglembur" id="uanglembur" autocomplete="off" value="<?= $e['uang_lembur']; ?>" required class="validate">
                  <label for="uanglembur">Uang Lembur</label>
                </div>
                <div class="input-field">
                  <input type="number" name="askes" id="askes" autocomplete="off" value="<?= $e['askes']; ?>" required class="validate">
                  <label for="askes">ASKES</label>
                </div>
                <button type="submit" class="btn blue darken-1">Simpan</button>
                <a class="btn red" href="golongan.php">Batal</a>
                </form>
                </div>
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