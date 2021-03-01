<?php 


include "../../fungsi.php";

// if (empty($_SESSION['login'])) {
// 	header('location: ../../ukom_rahmat/masuk.php');
// }


// if ($_SESSION['jabatan'] != "Manajemen") {
// 	header('location: ../../ukom_rahmat/');
// }

$x = 1;

if (isset($_GET['id'])) {

	$id = $_GET['id'];

if ($id == '1') {
		 $sql_pngg = kueri("*", "akun_pengguna WHERE id_jab = '1'");
		 $judul = "Laporan data akun pengelola";
		 $filename = "Laporan data akun pengelola";

}elseif ($id == '2') {
		 $sql_pngg = kueri("*", "akun_pengguna WHERE id_jab = '2'");
		 $judul = "Laporan data akun manajemen";
		 $filename = "Laporan data akun manajemen";

}elseif ($id == '3') {
		 $sql_pngg = kueri("*", "akun_pengguna WHERE id_jab = '3'");
		 $judul = "Laporan data akun anggota";
		 $filename = "Laporan data akun anggota";
}

}else{
		 $sql_pngg = kueri("*", "akun_pengguna");
		 $judul = "Laporan data seluruh akun";
		 $filename = "Laporan data seluruh akun";
}


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
              <th>Nama Lengkap</th>
              <th>Nama Pengguna</th>
              <th>Kelamin</th>
              <th>No Telepon</th>
              <th>Alamat</th>
          </tr>
    </thead>
<tbody>
	<?php 
	$ttl = mysqli_num_rows($sql_pngg	);
	while($row = $sql_pngg->fetch_array()) {
	?>
		<tr>
            <td><?= $x++ ?></td>
            <td><?= $row['nm_lengkap'] ?></td>
            <td><?= $row['nm_pengguna'] ?></td>
            <td><?= $row['kelamin'] ?></td>
            <td><?= $row['no_telp'] ?></td>
            <td><?= $row['alamat'] ?></td>
		</tr>
	<?php 
		}
	 ?>
		<tr style="background: #00B894;">
			<td colspan="5">Total Akun</td>
			<td colspan="1"><center><?= $ttl ?> Akun</center></td>
		</tr>
</tbody>
</table>

</div>
</center>