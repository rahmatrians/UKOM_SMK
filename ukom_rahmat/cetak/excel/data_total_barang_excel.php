<?php 

		include "../fungsi.php";

    $id = $_GET['id'];
    $nm = $_GET['nama'];

		$date = date  ('y-m-d');
		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=laporan total ".$nm.".xls");


		$x = 1; 
		$l_jns_ttl = $conx->query("SELECT * FROM barang WHERE id_jenis = '".$id."'");
		$ttl_brg = mysqli_num_rows($l_jns_ttl);

 ?>


<center>

	<h3>Laporan Data Total Barang <br> Berdasarkan jenis <?= $nm ?></h3>

 <table class="striped" border="1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Kondisi</th>
              <th>Sumber Dana</th>
            </tr>
            <tbody>

              <?php 
                  $x = 1;
                  $l_jns = $conx->query("SELECT * FROM barang WHERE id_jenis = '". $id ."'");
                  $ttl = mysqli_num_rows($l_jns);
                  while ($brg_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $brg_data['nm_brg'] ?></td>
                <td><?= $brg_data['kondisi'] ?></td>
                <td><?= $brg_data['sumber_dana'] ?></td>
              </tr>

              <?php } ?>

              <tr style="background: #00B894;">
              	<td colspan="3">Total Barang</td>
              	<td><?= $ttl ?> Barang</td>
              </tr>

            </tbody>
          </thead>
        </table>

</center>