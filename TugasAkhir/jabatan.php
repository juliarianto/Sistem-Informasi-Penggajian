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
          document.location.href = 'jabatan.php';
          </script>";
  }elseif(isset($_GET['e']) && $_GET['e']=='gagal'){
    echo "<script>
          alert('Proses Gagal...!');
          document.location.href = 'jabatan.php';
          </script>";
  }
    //kode
    ?>
        <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Jabatan</h5><br>
          <div class="col m12 center">
            <a href="jabatan.php?view=tambah" class="btn blue left">Tambah Data Jabatan</a>
            <table class="highlight centered">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jabatan</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan Jabatan</th>
                    <th>Aksi</th>
                </tr>
              </thead>
                <?php 
                include 'koneksi.php';
                  $query = mysqli_query($con, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                $no = 1;

                while($d = mysqli_fetch_array($query)){
                  ?>
                  <tbody>
                    <td><?= $no++; ?></td>
                    <td><?= $d['kode_jabatan']; ?></td>
                    <td><?= $d['nama_jabatan']; ?></td>
                    <td>Rp. <?= $d['gaji_pokok']; ?></td>
                    <td>Rp. <?= $d['tunjangan']; ?></td>
                    <td><a class="btn green btn-small" href="jabatan.php?view=edit&id=<?= $d['kode_jabatan']; ?>">Edit</a>
                      <a class="btn red btn-small" href="aksi_jabatan.php?act=del&id=<?= $d['kode_jabatan']; ?>" onclick="return confirm('Ingin menghapus data ini?');">Hapus</a></td>
                  </tbody>

                <?php } ?>
              
            </table>
          </div>
        </div>
<?php
  break;
  case "tambah":
    //membuat kode tambah jabatan otomatis

    $simbol = "J";
    $query  = mysqli_query($con, "SELECT max(kode_jabatan) AS last FROM jabatan WHERE kode_jabatan LIKE '$simbol%'");
    $data   = mysqli_fetch_array($query);

    $kodeterakhir   = $data['last'];
    $nomorterakhir  = substr($kodeterakhir, 1, 2);
    $nomorberikut   = $nomorterakhir + 1;
    $kodeberikut    = $simbol.sprintf('%02s', $nomorberikut);

    ?>
      <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Jabatan</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Tambah Data Jabatan</h5>
                <form action="aksi_jabatan.php?act=insert" method="post">
                <div class="input-field">
                  <input type="text" name="kodejabatan" id="kodejabatan" value="<?= $kodeberikut; ?>" readonly>
                  <label for="kodejabatan">Kode Jabatan</label>
                </div>
                <div class="input-field">
                  <input type="text" name="namajabatan" id="namajabatan" required class="validate">
                  <label for="namajabatan">Nama Jabatan</label>
                </div>
                <div class="input-field">
                  <input type="text" name="gajipokok" id="gajipokok" required class="validate">
                  <label for="gajipokok">Gaji Pokok</label>
                </div>
                <div class="input-field">
                  <input type="number" name="tunjangan" id="tunjangan" required class="validate">
                  <label for="tunjangan">Tunjangan Jabatan</label>
                </div>
                <button type="submit" name="tambah" class="btn blue darken-1">Tambah</button>
                <a class="btn red" href="jabatan.php">Batal</a>
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
  $edit = mysqli_query($con, "SELECT * FROM jabatan WHERE kode_jabatan='$id'");
  $e = mysqli_fetch_array($edit);
?>

    <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Jabatan</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Edit Data Jabatan</h5>
                <form action="aksi_jabatan.php?act=update" method="post">
                <div class="input-field">
                  <input type="hidden" name="kodejabatan" value="<?= $e['kode_jabatan']; ?>">
                  <input type="text" name="kodejabatan " id="kodejabatan" autocomplete="off" value="<?= $e['kode_jabatan']; ?>" readonly>
                  <label for="kodejabatan">Kode Jabatan</label>
                </div>
                <div class="input-field">
                  <input type="text" name="namajabatan" id="namajabatan" autocomplete="off" value="<?= $e['nama_jabatan']; ?>" required class="validate">
                  <label for="namajabatan">Nama Jabatan</label>
                </div>
                <div class="input-field">
                  <input type="number" name="gajipokok" id="gajipokok" autocomplete="off" value="<?= $e['gaji_pokok']; ?>" required class="validate">
                  <label for="gajipokok">Gaji Pokok</label>
                </div>
                <div class="input-field">
                  <input type="number" name="tunjangan" id="tunjangan" autocomplete="off" value="<?= $e['tunjangan']; ?>" required class="validate">
                  <label for="tunjangan">Tunjangan Jabatan</label>
                </div>
                <button type="submit" class="btn blue darken-1">Simpan</button>
                <a class="btn red" href="jabatan.php">Batal</a>
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