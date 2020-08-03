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
          document.location.href = 'pegawai.php';
          </script>";
  }elseif(isset($_GET['e']) && $_GET['e']=='gagal'){
    echo "<script>
          alert('Proses Gagal...!');
          document.location.href = 'pegawai.php';
          </script>";
  }
    //kode
    ?>
        <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Pegawai</h5><br>
          <div class="col m12 center">
            <a href="pegawai.php?view=tambah" class="btn blue left">Tambah Data Pegawai</a>
            <table class="highlight centered">
              <thead>
                <tr>
                    <th>No</th>
                    <th width="10px">NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Golongan</th>
                    <th>Status</th>
                    <th width="10px">Anak</th>
                    <th>Aksi</th>
                </tr>
              </thead>
                <?php 
                include 'koneksi.php';
                // query 3 tabel menggunakan join
                  $q = "SELECT pegawai.*, jabatan.nama_jabatan, golongan.nama_golongan
                               FROM pegawai
                               INNER JOIN jabatan 
                               ON pegawai.kode_jabatan=jabatan.kode_jabatan
                               INNER JOIN golongan 
                               ON pegawai.kode_golongan=golongan.kode_golongan
                               ORDER BY pegawai.nama_pegawai ASC
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
                    <td><?= $d['nama_golongan']; ?></td>
                    <td><?= $d['status']; ?></td>
                    <td><?= $d['jumlah_anak']; ?></td>
                    <td><a class="btn green btn-small" href="pegawai.php?view=edit&id=<?= $d['nip']; ?>">Edit</a>
                      <a class="btn red btn-small" href="aksi_pegawai.php?act=del&id=<?= $d['nip']; ?>" onclick="return confirm('Ingin menghapus data ini?');">Hapus</a></td>
                  </tbody>

                <?php } ?>
              
            </table>
          </div>
        </div>
<?php
  break;
  case "tambah":
    

    ?>
      <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Pegawai</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Tambah Data Pegawai</h5>
                <form action="aksi_pegawai.php?act=insert" method="post">
                <div class="input-field">
                  <input type="text" name="nip" id="nip" required>
                  <label for="nip">NIP</label>
                </div>
                <div class="input-field">
                  <input type="text" name="namapegawai" id="namapegawai" required class="validate">
                  <label for="namapegawai">Nama Pegawai</label>
                </div>
                <div class="">
                    <select name="jabatan">
                      <option value="" disabled selected>Pilih Jabatan</option>
                      <?php $q = mysqli_query($con, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                        while ($j = mysqli_fetch_array($q)){?>
                      <option value="<?= $j['kode_jabatan']; ?>"><?= $j['kode_jabatan']; ?> - <?= $j['nama_jabatan']; ?></option>
                        <?php } ?>
                    </select>
                    <label>Pilih Jabatan</label>
                </div>
                <div class="">
                    <select name="golongan">
                      <option value="" disabled selected>Pilih Golongan</option>
                      <?php $q = mysqli_query($con, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                        while ($g = mysqli_fetch_array($q)){?>
                      <option value="<?= $g['kode_golongan']; ?>"><?= $g['kode_golongan']; ?> - <?= $g['nama_golongan']; ?></option>
                        <?php } ?>
                    </select>
                    <label>Pilih Golongan</label>
                </div>
                <div class="">
                  <select name="status">
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                  </select>
                  <label>Pilih Status</label>
                </div>
                <div class="input-field">
                  <input type="number" name="anak" id="anak" required class="validate">
                  <label for="anak">Jumlah Anak</label>
                </div>
                <button type="submit" name="tambah" class="btn blue darken-1">Tambah</button>
                <a class="btn red" href="pegawai.php">Batal</a>
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
  $query = "SELECT * FROM pegawai WHERE nip = '$id' ";
  $edit = mysqli_query($con, $query);
  $e = mysqli_fetch_array($edit);
?>

    <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Pegawai</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Edit Data Pegawai</h5>
                <form action="aksi_pegawai.php?act=update" method="post">
                <div class="input-field">
                  <input type="text" name="nip" id="nip" readonly value="<?= $e['nip']; ?>">
                  <label for="nip">NIP</label>
                </div>
                <div class="input-field">
                  <input type="text" name="namapegawai" id="namapegawai" required class="validate" value="<?= $e['nama_pegawai']; ?>">
                  <label for="namapegawai">Nama Pegawai</label>
                </div>
                <div class="">
                    <select name="jabatan">
                      <option value="" disabled selected>Pilih Jabatan</option>
                      <?php $q = mysqli_query($con, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                        while ($j = mysqli_fetch_array($q)){

                          // apabila kode jabatan ditabel jabatan sama dengan kode jabatan ditabel pegawai
                          $selected = ($j['kode_jabatan'] == $e['kode_jabatan']) ? ' selected' : '';
                          
                          ?> 
                          <!-- maka akan tampil di option -->
                      <option value="<?= $j['kode_jabatan']; ?>"<?= $selected; ?>><?= $j['kode_jabatan']; ?> - <?= $j['nama_jabatan']; ?></option>
                        <?php } ?>
                    </select>
                    <label>Pilih Jabatan</label>
                </div>
                <div class="">
                    <select name="golongan">
                      <option value="" disabled selected>Pilih Golongan</option>
                      <?php $q = mysqli_query($con, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                        while ($g = mysqli_fetch_array($q)){

                          // apabila kode jabatan ditabel jabatan sama dengan kode jabatan ditabel pegawai
                          $selected = ($g['kode_golongan'] == $e['kode_golongan']) ? ' selected' : '';

                          ?>
                      <option value="<?= $g['kode_golongan']; ?>"<?= $selected; ?>><?= $g['kode_golongan']; ?> - <?= $g['nama_golongan']; ?></option>
                        <?php } ?>
                    </select>
                    <label>Pilih Golongan</label>
                </div>
                <div class="">
                  <select name="status">
                    <option value="<?= $e['status']; ?>"<?= $selected; ?>><?= $e['status']; ?></option>
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                  </select>
                  <label>Pilih Status</label>
                </div>
                <div class="input-field" >
                  <input type="number" name="anak" id="anak" required class="validate" value="<?= $e['jumlah_anak']; ?>">
                  <label for="anak">Jumlah Anak</label>
                </div>
                <button type="submit" name="tambah" class="btn blue darken-1">Simpan</button>
                <a class="btn red" href="pegawai.php">Batal</a>
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