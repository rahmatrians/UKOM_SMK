<?php 
	include "../fungsi.php";

	$date = date  ('y-m-d');
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=Laporan Total Barang Perjenis.xls");
 ?>

<h1>Laporan Data Jenis</h1>

 <table class="striped" border="1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <!-- <th>Baik</th> -->
              <!-- <th>Hampir Rusak</th> -->
              <!-- <th>Rusak</th> -->
              <th>Total Barang</th>
            </tr>
            <tbody>

              <?php 
                  $x = 1;
                  $l_jns = kueri("*,(SELECT COUNT(id_brg) FROM barang WHERE jenis.id_jenis = barang.id_jenis) AS jml_barang", "jenis");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $jns_data['nm_jenis'] ?></td>
                <td><?= $jns_data['jml_barang'] ?> Barang</td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>