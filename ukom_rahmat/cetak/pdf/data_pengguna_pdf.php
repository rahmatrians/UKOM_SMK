<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';


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


$data 		= '

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

	<h1 class="judul">'.$judul.'
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
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
            <tbody>';

				$x = 1;
				$l_jns = $conx->query("SELECT * FROM barang WHERE id_jenis = '$id'");
				$ttl = mysqli_num_rows($l_jns);
				while ($row = $sql_pngg->fetch_array()) {

$data .= 	' <tr>
                <td>'.$x++.'</td>
                <td>'.$row['nm_lengkap'].'</td>
                <td>'.$row['nm_pengguna'].'</td>
                <td>'.$row['kelamin'].'</td>
                <td>'.$row['no_telp'].'</td>
                <td>'.$row['alamat'].'</td>
            </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output($filename.'.pdf', 'D');

 ?>