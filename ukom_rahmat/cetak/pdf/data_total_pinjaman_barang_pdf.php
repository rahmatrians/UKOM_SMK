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

	<h1 class="judul">Laporan total peminjaman Barang
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
     <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Nama Jenis</th>
              <th>Total Peminjaman</th>
            </tr>
      </thead>
    <tbody>';

                  $x = 1;
                  $l_jns = kueri("*, (SELECT COUNT(id_pinjam) FROM peminjaman WHERE barang.id_brg = peminjaman.id_brg) AS ttl_pnj", "barang INNER JOIN jenis ON jenis.id_jenis = barang.id_jenis");
                  while ($jns_data = $l_jns->fetch_array()) {

$data .= 	'   <tr>
                <td>'.$x++.'</td>
                <td>'.$jns_data['nm_brg'].'</td>
                <td>'.$jns_data['nm_jenis'].'</td>
                <td><b>'.$jns_data['ttl_pnj'].'</b> Kali Dipinjam</td>
              </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Laporan total peminjaman barang.pdf', 'D');

 ?>