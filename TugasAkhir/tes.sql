-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2020 pada 09.54
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_kar` int(11) NOT NULL,
  `kode_kar` varchar(10) NOT NULL,
  `nama_kar` varchar(30) NOT NULL,
  `alamat_kar` varchar(80) NOT NULL,
  `email_kar` varchar(50) NOT NULL,
  `hp_kar` varchar(15) NOT NULL,
  `rek_kar` varchar(30) NOT NULL,
  `gaji_kar` varchar(10) NOT NULL,
  `gol_kar` varchar(10) NOT NULL,
  `tgl_kar` varchar(10) NOT NULL,
  `status_kar` enum('aktif','tidak aktif') NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_kar`, `kode_kar`, `nama_kar`, `alamat_kar`, `email_kar`, `hp_kar`, `rek_kar`, `gaji_kar`, `gol_kar`, `tgl_kar`, `status_kar`, `foto`) VALUES
(1, '001', 'Juli Arianto', 'Jl. M Iswahyudi Gg. Elang', '', '081346555478', '123456789', '1.500.000', 'kasir', '08-07-2020', 'aktif', ''),
(12, '005', 'Muhsin Wawan Azhari', 'Jl. P. Derawan', 'muhsinwawan@gmail.com', '099999999999', '98382937873', '1.000.000', 'kasir', '08-06-2020', 'aktif', 'a.jpg'),
(15, '010', 'Sofia', 'Bulungan', 'sofia@gmail.com', '099999999999', '98382937873', '1.000.000', 'kasir', '24-07-2020', 'aktif', 'abc.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gaji`
--

CREATE TABLE `tb_gaji` (
  `gaji_id` int(11) NOT NULL,
  `kode_kar` varchar(11) NOT NULL,
  `kode_gaji` varchar(5) NOT NULL,
  `nama_kar` varchar(50) NOT NULL,
  `jumlah_gaji` varchar(12) NOT NULL,
  `bulan_transfer` varchar(20) NOT NULL,
  `tgl_transfer` varchar(20) NOT NULL,
  `jam_transfer` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gaji`
--

INSERT INTO `tb_gaji` (`gaji_id`, `kode_kar`, `kode_gaji`, `nama_kar`, `jumlah_gaji`, `bulan_transfer`, `tgl_transfer`, `jam_transfer`) VALUES
(8, '010', 'GJ005', 'Sofia', '2000000', 'Desember', '08-12-2020', '12:30'),
(2, '002', 'GJ002', 'Nasem Ahmed Hidayatulah', '2970576', 'January 2014', '12/01/2014', '02:14:42'),
(3, '003', 'GJ003', 'Reza Priam Krestanto', '2109539', 'January 2014', '12/01/2014', '03:11:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `tgl_daftar` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `user_password`, `tgl_daftar`) VALUES
(11, 'juliarianto', '70f5fb779be1312f0b2bcdcf922576c5', '24-07-2020');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_kar`),
  ADD UNIQUE KEY `kode_kar_2` (`kode_kar`),
  ADD UNIQUE KEY `nama_kar_2` (`nama_kar`),
  ADD KEY `kode_kar` (`kode_kar`),
  ADD KEY `nama_kar` (`nama_kar`);

--
-- Indeks untuk tabel `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD PRIMARY KEY (`gaji_id`),
  ADD UNIQUE KEY `kode_kar_2` (`kode_kar`),
  ADD UNIQUE KEY `nama_kar_2` (`nama_kar`),
  ADD KEY `kode_kar` (`kode_kar`),
  ADD KEY `nama_kar` (`nama_kar`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_kar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_gaji`
--
ALTER TABLE `tb_gaji`
  MODIFY `gaji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
