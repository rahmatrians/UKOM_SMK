<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

$tgl1 = $_GET['kode1'];
$tgl2 = $_GET['kode2'];

$data 		= '

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

	<h1 class="judul">Laporan Barang <br> Berdasarkan Tanggal beli <br> '.$tgl1.' sampai '.$tgl2.'
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Tanggal Beli</th>
        <th>Kondisi</th>
        <th>Sumber Dana</th>
      </tr>
    </thead>
    <tbody>';

				$x = 1;
				$pj   = $conx->query("SELECT * FROM barang WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2'");
				while($row = $pj->fetch_array()) {

$data .= 	'<tr>
              <td>'.$x++.'</td>
              <td>'.$row['nm_brg'].'</td>
              <td>'.$row['tgl_beli'].'</td>
              <td>'.$row['kondisi'].'</td>
              <td>'.$row['sumber_dana'].'</td>
          </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Laporan tanggal beli barang.pdf', 'D');

 ?>