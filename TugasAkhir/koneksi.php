<?php 
// menyambungkan ke database
$con = mysqli_connect("localhost", "root", "", "penggajian");

// jika koneksi gagal akan tampil pesan
if(!$con){
  echo "Koneksi Gagal............";
}

?>