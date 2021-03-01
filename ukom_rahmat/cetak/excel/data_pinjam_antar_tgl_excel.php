<?php 


include "../../fungsi.php";

// if (empty($_SESSION['login'])) {
// 	header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
// 	header('location: ../../ukom_rahmat/');
// }

	$x = 1; 
	$tgl1 = $_GET['tgl1'];
	$tgl2 = $_GET['tgl2'];
	
		$sql_lap = kueri("*", "peminjaman 
                          INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                          INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                        WHERE status != '0' AND tgl_masuk BETWEEN '$tgl1' and '$tgl2' ");
		
		$ttl = mysqli_num_rows($sql_lap);
		$judul 	= "Laporan peminjaman <br> antara tanggal ".$tgl1." sampai ".$tgl2;
		$filename 	= "Laporan peminjaman berdasarkan tanggal";



$date = date  ('y-m-d');
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=".$filename.".xls");

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8"/>
</head>
<body>


<center>
<div class="container">
	<center><h1 class="center"><?=$judul ?></h1></center>
<table class="striped" border="1">
	    <thead>
	      <tr>
              <th>No</th>
              <th>Nama Peminjam</th>
              <th>Nama Barang</th>
              <th>Tanggal Pinjam</th>
	      </tr>
    </thead>
<tbody>
	<?php 
	while($row = $sql_lap->fetch_array()) {
	?>
		<tr>
			<td><?= $x++ ?></td>
	        <td><?= $row['nm_lengkap'] ?></td>
	        <td><?= $row['nm_brg'] ?></td>
	        <td><?= $row['tgl_masuk'] ?></td>
		</tr>
	<?php 
		}
	 ?>
		<tr style="background: #00B894;">
			<td colspan="3">Total Pinjaman</td>
			<td colspan="1"><center><?= $ttl ?> Pinjaman</center></td>
		</tr>
</tbody>
</table>

</div>
</center>