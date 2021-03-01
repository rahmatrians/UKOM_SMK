<?php 
session_start();


include "../../koneksi.php";

// if (empty($_SESSION['login'])) {
// 	header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
// 	header('location: ../../ukom_rahmat/');
// }

      $x = 1; 
$id = $_GET['id'];

if ($id == 'pesan') {
	
		$sql_lap = $conx->query("SELECT * FROM peminjaman 
		                INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
		                INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
		                 WHERE status = '0'"); 
		$ttl_pnjm = mysqli_num_rows($sql_lap);
		$judul 	= "Laporan peminjaman <br> dalam pesanan";
		$filename 	= "Laporan peminjaman dalam pesanan";
}

	if ($id == 'pinjam') {
	
		$sql_lap = $conx->query("SELECT * FROM peminjaman 
		                INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
		                INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
		                 WHERE status = '1'"); 
		$ttl_pnjm = mysqli_num_rows($sql_lap);
		$judul 	= "Laporan peminjaman <br> masih pinjaman";
		$filename 	= "Laporan peminjaman masih pinjaman";
}

	if ($id == 'kembali') {
	
		$sql_lap = $conx->query("SELECT * FROM peminjaman 
		                INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
		                INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
		                 WHERE status = '2'"); 
		$ttl_pnjm = mysqli_num_rows($sql_lap);
		$judul 	= "Laporan peminjaman <br> telah selesai";
		$filename 	= "Laporan peminjaman telah selesai";
}


$date = date  ('y-m-d');
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=".$filename.".xls");

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
	        <th>Nama Peminjam</th>
	        <th>Nama Barang</th>
	        <th>Tanggal masuk</th>
	        <th>Tanggal kembali</th>
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
		  <td><?= $row['tgl_kembali'] ?></td>
		</tr>
	<?php 
		}
	 ?>
		<tr style="background: #00B894;">
			<td colspan="2">Total Pinjaman</td>
			<td colspan="3"><center><?= $ttl_pnjm ?> Pinjaman</center></td>
		</tr>
</tbody>
</table>

</div>
</center>