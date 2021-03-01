<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

$data 		= '

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

	<h1 class="judul">Laporan Data Jenis
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <!-- <th>Baik</th> -->
              <!-- <th>Hampir Rusak</th> -->
              <!-- <th>Rusak</th> -->
              <th>Total Barang</th>
            </tr>
            <tbody>';

				$x = 1;
				$l_jns = kueri("*,(SELECT COUNT(id_brg) FROM barang WHERE jenis.id_jenis = barang.id_jenis) AS jml_barang", "jenis");
				while ($jns_data = $l_jns->fetch_array()) {

$data .= 	'<tr>
				<td>'.$x++.'</td>
				<td>'.$jns_data["nm_jenis"].'</td>
				<td>'.$jns_data["jml_barang"].' Barang</td>
			</tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Laporan Total Barang Perjenis.pdf', 'D');

 ?>