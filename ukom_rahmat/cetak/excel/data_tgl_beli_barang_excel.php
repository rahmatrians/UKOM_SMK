<?php 
session_start();


include "../../koneksi.php";

// if (empty($_SESSION['login'])) {
// 	header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
// 	header('location: ../../ukom_rahmat/');
// }

$date = date  ('y-m-d');
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=Laporan tanggal beli barang.xls");

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	<meta name="viewprot" content="width=device-width, initial-scale=1" charset="utf-8"/>
</head>
<body>


<?php 


if (isset($_GET['kode1'])) {
	$kode1 = $_GET['kode1'];
	$kode2 = $_GET['kode2'];
	$x = 1;
	$judul 	= "Laporan Barang <br> Berdasarkan Tanggal beli <br>".$kode1." sampai ".$kode2;
	$pj 	= $conx->query("SELECT * FROM barang WHERE tgl_beli BETWEEN '$kode1' AND '$kode2'");
	$ttl = mysqli_num_rows($pj);


 ?>

<center>
<div class="container">
	<center><h1 class="center"><?=$judul ?></h1></center>
<table class="striped" border="1">
	    <thead>
	      <tr>
	        <th>No</th>
	        <th>Nama Barang</th>
	        <th>Tanggal Beli</th>
	        <th>Kondisi</th>
	        <th>Sumber Dana</th>
	      </tr>
    </thead>
<tbody>
	<?php 
	while($row = $pj->fetch_array()) {
	?>
		<tr>
		  <td><?= $x++ ?></td>
		  <td><?= $row['nm_brg'] ?></td>
		  <td><?= $row['tgl_beli'] ?></td>
		  <td><?= $row['kondisi'] ?></td>
		  <td><?= $row['sumber_dana'] ?></td>
		</tr>
	<?php 
		}
	 ?>
		<tr style="background: #00B894;">
			<td colspan="2">Total Barang</td>
			<td colspan="3"><center><?= $ttl ?> Barang</center></td>
		</tr>
</tbody>
</table>

</div>
</center>

<?php } ?>