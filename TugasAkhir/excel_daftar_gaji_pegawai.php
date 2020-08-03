<?php 

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=daftar_gaji_pegawai.xls");

include 'koneksi.php';
$bulantahun = $_GET['bulan'].$_GET['tahun'];
?>
<h3>SISTEM INFORMASI<br>PENGGAJIAN KARYAWAN MINI MARKET</h3>
<p>Bulan : <?= $_GET['bulan'].", Tahun : ".$_GET['tahun'];?></p>
<table border="1" cellpadding="4" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Gol</th>
                    <th>Status</th>
                    <th>J. Anak</th>
                    <th>Gaji Pokok</th>
                    <th>Tj. Jabatan</th>
                    <th>Tj. S/I</th>
                    <th>Tj. Anak</th>
                    <th>Uang Makan</th>
                    <th>Uang Lembur</th>
                    <th>Askes</th>
                    <th>Pendapatan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    
                </tr>
              </thead>
                <?php
              
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
                    <td><?= $d['gaji_pokok']; ?></td>
                    <td><?= $d['tunjangan']; ?></td>
                    <td><?= $d['tjsi']; ?></td>
                    <td><?= $d['tjanak']; ?></td>
                    <td><?= $d['uangmakan']; ?></td>
                    <td><?= $d['uanglembur']; ?></td>
                    <td><?= $d['askes']; ?></td>
                    <td><?= $d['pendapatan']; ?></td>
                    <td><?= $d['potongan']; ?></td>
                    <td><?= $d['totalgaji']; ?></td><br>
                  </tbody>
                <?php } ?>
            </table>
