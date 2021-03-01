<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

$id = $_GET['id'];
$nm = $_GET['nama'];

$data 		= '

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

	<h1 class="judul">Laporan Data Total Barang <br> Berdasarkan jenis '.$nm.'
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
            </tr>
            <tbody>';

				$x = 1;
				$l_jns = $conx->query("SELECT * FROM barang WHERE id_jenis = '$id'");
				$ttl = mysqli_num_rows($l_jns);
				while ($brg_data = $l_jns->fetch_array()) {

$data .= 	' <tr>
                <td>'.$x++.'</td>
                <td>'.$brg_data['nm_brg'].'</td>
                <td>'.$brg_data['kondisi'].'</td>
                <td>'.$brg_data['sumber_dana'].'</td>
              </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Laporan total '.$nm.'.pdf', 'D');

 ?>