<?php 


include "../../fungsi.php";

('location: ../../ukom_rahmat/');

	$x = 1; 
	$id = $_GET['id'];
	$nm = $_GET['nm'];

	

		$x = 1; 
		$sql_lap = kueriDimana2("peminjaman 
                        INNER JOIN barang ON peminjaman.id_brg = barang.id_brg 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun", 
                        "peminjaman.id_akun", $id); 
		$ttl = mysqli_num_rows($sql_lap);
		$judul 	= "Laporan Peminjaman <br> dipinjam oleh ".$nm;
		$filename 	= "Laporan total peminjaman ".$nm;

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
	<center><h4 class="center"><?=$judul ?></h4></center>
<table class="striped" border="1">
        <thead>
	          <tr>
	            <th>No</th>
	            <th>Nama Barang</th>
	          </tr>
        </thead>
<tbody>
	<?php 
	while($row = $sql_lap->fetch_array()) {
	?>
           <tr>
             <td><?= $x++ ?></td>
             <td><?= $row['nm_brg'] ?></td>
           </tr>
	<?php 
		}
	 ?>
		<tr style="background: #00B894;">
			<td>Total Barang</td>
			<td><center><?= $ttl ?> Barang</center></td>
		</tr>
</tbody>
</table>

</div>
</center>