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
header("Content-Disposition: attachment; filename=Laporan total peminjaman pengguna.xls");

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	<meta name="viewprot" content="width=device-width, initial-scale=1" charset="utf-8"/>
</head>
<body>


<?php 
	$judul 	= "Laporan total peminjaman pengguna";

 ?>

<center>
<div class="container">
	<center><h1 class="center"><?=$judul ?></h1></center>
<table class="striped" border="1">
	<thead>
			<tr>
			  <th>No</th>
			  <th>Nama Peminjam</th>
			  <th>Total Pinjaman</th>
			</tr>
	</thead>
<tbody>
	<?php 
		 $x = 1;
          $l_jns = kueri("*, (SELECT COUNT(id_pinjam) FROM peminjaman WHERE akun_pengguna.id_akun = peminjaman.id_akun) AS ttl_akn", "akun_pengguna WHERE akun_pengguna.id_jab = '3'");
          while ($akun_data = $l_jns->fetch_array()) {
	?>
			 <tr>
                <td><?= $x++ ?></td>
                <td><?= $akun_data['nm_lengkap'] ?></td>
                <td><b><?= $akun_data['ttl_akn'] ?></b> Kali Meminjam</td>
              </tr>

	<?php 
		}
	 ?>

</tbody>
</table>

</div>
</center>