<?php 

include "../../fungsi.php";

// if (empty($_SESSION['login'])) {
// 	header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
// 	header('location: ../../ukom_rahmat/');
// }

$date = date  ('y-m-d');
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=Laporan total peminjaman barang.xls");

$judul 	= "Laporan total peminjaman Barang";

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	<meta name="viewprot" content="width=device-width, initial-scale=1" charset="utf-8"/>
</head>
<body>

<center>
<div class="container">
	<center><h1 class="center"><?=$judul ?></h1></center>
<table class="striped" border="1">
     <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Nama Jenis</th>
              <th>Total Peminjaman</th>
            </tr>
      </thead>
<tbody>
              <?php 
                  $x = 1;
                  $l_jns = kueri("*, (SELECT COUNT(id_pinjam) FROM peminjaman WHERE barang.id_brg = peminjaman.id_brg) AS ttl_pnj", "barang INNER JOIN jenis ON jenis.id_jenis = barang.id_jenis");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>
		<tr>
			<td><?= $x++ ?></td>
			<td><?= $jns_data['nm_brg'] ?></td>
			<td><?= $jns_data['nm_jenis'] ?></td>
			<td><b><?= $jns_data['ttl_pnj'] ?></b> Kali Dipinjam</td>
		</tr>
	<?php 
		}
	 ?>
</tbody>
</table>

</div>
</center>

