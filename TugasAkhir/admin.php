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
          document.location.href = 'admin.php';
          </script>";
  }elseif(isset($_GET['e']) && $_GET['e']=='gagal'){
    echo "<script>
          alert('Proses Gagal...!');
          document.location.href = 'admin.php';
          </script>";
  }
?>
  
      <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Admin</h5><br>
          <div class="col m12 center">
            <a href="admin.php?view=tambah" class="btn blue left">Tambah Data Admin</a>
            <table class="highlight centered">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <?php
                include 'koneksi.php';
                
                $no = 1;
                // query database tabel user
                $query = mysqli_query($con, "SELECT * FROM user ORDER BY user_admin ASC");
                // tampilkan data looping
                while($data = mysqli_fetch_array($query)){
                  ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $data['user_admin']; ?></td>
                  <td><?= $data['nama_admin']; ?></td>
                  <td><a class="btn green btn-small" href="admin.php?view=edit&id=<?= $data['id_admin']; ?>">Edit</a>
                      <a class="btn red btn-small" href="aksi_admin.php?act=delete&id=<?= $data['id_admin']; ?>" onclick="return confirm('Ingin menghapus data ini?');">Hapus</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
<?php
  break;
  case "tambah":
?>
    <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Admin</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Tambah Data Admin</h5>
                <form action="aksi_admin.php?act=insert" method="post">
                <div class="input-field">
                  <input type="text" name="username" id="username" autocomplete="off" required class="validate">
                  <label for="username">Username</label>
                </div>
                <div class="input-field">
                  <input type="password" name="password" id="password" autocomplete="off" required class="validate">
                  <label for="password">Password</label>
                </div>
                <div class="input-field">
                  <input type="text" name="nama" id="nama" autocomplete="off" required class="validate">
                  <label for="nama">Nama Lengkap</label>
                </div>
                <button type="submit" name="tambah" class="btn blue darken-1">Tambah</button>
                <a class="btn red" href="admin.php">Batal</a>
                </form>
                </div>
              </div>
          </div>
        </div>
      </div>
<?php
  break;
  case "edit":
  $id = $_GET['id'];
  $edit = mysqli_query($con, "SELECT * FROM user WHERE id_admin=$id");
  $e = mysqli_fetch_array($edit);
?>
    <div class="row">
          <h5 class="center light grey-text text-darken-2">Data Admin</h5>
          <div class="col m12 s12 center">
            <div class="col m2"></div>
            <div class="col m8 s12">
              <div class="card-panel">
                <h5>Edit Data Admin</h5>
                <form action="aksi_admin.php?act=update" method="post">
                <input type="hidden" name="idadmin" value="<?= $e['id_admin']; ?>">
                <div class="input-field">
                  <input type="text" name="username" id="username" autocomplete="off" value="<?= $e['user_admin']; ?>" required class="validate">
                  <label for="username">Username</label>
                </div>
                <div class="input-field">
                  <input type="password" name="password" id="password" autocomplete="off" placeholder="Kosongkan Jika Tidak Diganti">
                  <label for="password">Password</label>
                </div>
                <div class="input-field">
                  <input type="text" name="nama" id="nama" autocomplete="off" value="<?= $e['nama_admin']; ?>" required class="validate">
                  <label for="nama">Nama Lengkap</label>
                </div>
                <button type="submit" class="btn blue darken-1">Simpan</button>
                <a class="btn red" href="admin.php">Batal</a>
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'java.php'; ?>
<?php include 'footer.php'; ?>