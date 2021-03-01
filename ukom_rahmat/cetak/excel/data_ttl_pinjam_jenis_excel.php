<?php 
session_start();


include "../../koneksi.php";

// if (empty($_SESSION['login'])) {
//  header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
//  header('location: ../../ukom_rahmat/');
// }

$date = date  ('y-m-d');
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=Laporan total peminjaman jenis.xls");

 ?>


<!DOCTYPE html>
<html>
<head>
  <title>PISMA</title>
  <meta name="viewprot" content="width=device-width, initial-scale=1" charset="utf-8"/>
</head>
<body>

        <h1>Laporan total peminjaman <br> berdasarkan jenis</h1>
        <table class="striped" border="1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <th>Total Dipinjam</th>
            </tr>
          </thead>
            <tbody>

              <?php 
                  $x = 1;
                  // $l_jns = $conx->query("SELECT * FROM jenis");
                  $l_jns = $conx->query("SELECT *,(
                                              SELECT COUNT(*) FROM barang WHERE barang.id_jenis = jenis.id_jenis AND NOT EXISTS (
                                                              SELECT 1 FROM peminjaman WHERE peminjaman.id_brg = barang.id_brg AND peminjaman.status != 2
                                                            )
                                                      ) AS jml FROM jenis");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $jns_data['nm_jenis'] ?></td>
                <td><b><?= $jns_data['jml'] ?></b> Kali Dipinjam</td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>

</body>
</html>