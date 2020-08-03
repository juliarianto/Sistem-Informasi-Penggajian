<?php 

// memulai session
session_start();

// cek apakah ada session login
if(!isset($_SESSION['login'])){

// jika tidak ada alihkan user ke halaman login
  header("Location: login.php");
}

// menghubungkan ke file koneksi
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- My style css -->
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <title>SI PENGGAJIAN KARYAWAN MINIMARKET</title>

  <body class="scollspy" id="home">

    <!-- NAVBAR -->
    <div class="navbar-fixed">
      <nav class="blue darken-4">
        <div class="container">
          <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Penggajian</a>
            <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="./">Home</a></li>
              <li><a href="admin.php">Admin</a></li>
              <li><a href="jabatan.php">Jabatan</a></li>
              <li><a href="golongan.php">Golongan</a></li>
              <li><a href="pegawai.php">Pegawai</a></li>
              <li><a href="kehadiran.php">Kehadiran</a></li>
              <li><a href="penggajian.php">Penggajian</a></li>
              <li><a class="dropdown-trigger" href="" data-target="dropdown1">Laporan</a></li>
                <ul id="dropdown1" class="dropdown-content">
                  <li><a href="cetak_laporan_pegawai.php"  target="_blank">Data Pegawai</a></li>
                  <li><a href="cetak_laporan_golongan.php"  target="_blank">Data Golongan</a></li>
                  <li><a href="cetak_laporan_jabatan.php"  target="_blank">Data Jabatan</a></li>
                  <li><a href="laporan_kehadiran.php">Kehadiran</a></li>
                  <li><a href="laporan_lembur.php">Lembur</a></li>
                  <li><a href="laporan_potongan.php">Potongan Gaji</a></li>
                  <li class="divider" tabindex="-1"></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <!-- SIDE NAV -->
    <nav class="sidenav" id="mobile-nav">
              <li><a href="./">Home</a></li>
              <li><a href="admin.php">Admin</a></li>
              <li><a href="jabatan.php">Jabatan</a></li>
              <li><a href="golongan.php">Golongan</a></li>
              <li><a href="pegawai.php">Pegawai</a></li>
              <li><a href="kehadiran.php">Kehadiran</a></li>
              <li><a href="penggajian.php">Penggajian</a></li>
              <li><a class="dropdown-trigger" href="#" data-target="dropdown2">Laporan</a></li>
                <ul id="dropdown2" class="dropdown-content">
                  <li><a href="cetak_laporan_pegawai.php">Data Pegawai</a></li>
                  <li><a href="cetak_laporan_golongan.php">Data Golongan</a></li>
                  <li><a href="cetak_laporan_jabatan.php">Data Jabatan</a></li>
                  <li><a href="laporan_kehadiran.php">Kehadiran</a></li>
                  <li><a href="laporan_lembur.php">Lembur</a></li>
                  <li><a href="laporan_potongan.php">Potongan Gaji</a></li>
                  <li class="divider" tabindex="-1"></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
      </ul>
    </nav>
    <!-- END NAVBAR -->
