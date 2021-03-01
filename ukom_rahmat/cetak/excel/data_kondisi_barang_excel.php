<?php 


include "../../fungsi.php";

// if (empty($_SESSION['login'])) {
// 	header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
// 	header('location: ../../ukom_rahmat/');
// }

	$x = 1; 
	$knd = $_GET['knd'];

	
		$sql_lap 	= $conx->query("SELECT * FROM barang WHERE kondisi = '$knd'"); 
		$ttl = mysqli_num_rows($sql_lap);
		$judul 	= "Laporan kondisi <br> barang ".$knd;
		$filename 	= "Laporan kondisi barang ".$knd;



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
			<th>Nama Barang</th>
			<th>Kondisi</th>
			<th>Sumber Dana</th>
			<th>Tanggal Beli</th>
	      </tr>
    </thead>
<tbody>
	<?php 
	while($row = $sql_lap->fetch_array()) {
	?>
		<tr>
		<td><?= $x++ ?></td>
		<td><?= $row['nm_brg'] ?></td>
		<td><?= $row['kondisi'] ?></td>
		<td><?= $row['sumber_dana'] ?></td>
		<td><?= $row['tgl_beli'] ?></td>
		</tr>
	<?php 
		}
	 ?>
		<tr style="background: #00B894;">
			<td colspan="3">Total Barang</td>
			<td colspan="2"><center><?= $ttl ?> Barang</center></td>
		</tr>
</tbody>
</table>

</div>
</center>