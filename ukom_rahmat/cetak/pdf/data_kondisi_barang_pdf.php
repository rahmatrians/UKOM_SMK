<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

    $knd = $_GET['knd'];
  
    $sql_lap  = kueri("*", "barang WHERE kondisi = '$knd'"); 
    $ttl = mysqli_num_rows($sql_lap);
    $judul  = "Laporan kondisi <br> barang ".$knd;
    $filename   = "Laporan kondisi barang ".$knd;

$data 		= '

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

	<h1 class="judul">Laporan kondisi <br> barang '.$knd.'
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Kondisi</th>
              <th>Sumber Dana</th>
              <th>Tanggal Beli</th>
            </tr>
            </thead>
            <tbody>';

				$x = 1;
				while ($row = $sql_lap->fetch_array()) {

$data .= 	' <tr>
                <td>'.$x++.'</td>
                <td>'.$row['nm_brg'].'</td>
                <td>'.$row['kondisi'].'</td>
                <td>'.$row['sumber_dana'].'</td>
                <td>'.$row['tgl_beli'].'</td>
              </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output($filename.'.pdf', 'D');

 ?>