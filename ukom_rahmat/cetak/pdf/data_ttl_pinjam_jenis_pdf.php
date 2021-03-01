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

	<h1 class="judul">Laporan total peminjaman <br> berdasarkan jenis
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Jenis</th>
            <th>Total Dipinjam</th>
          </tr>
        </thead>
    <tbody>';

                  $x = 1;
                  $l_jns = $conx->query("SELECT *,(
                                              SELECT COUNT(*) FROM barang WHERE barang.id_jenis = jenis.id_jenis AND NOT EXISTS (
                                                              SELECT 1 FROM peminjaman WHERE peminjaman.id_brg = barang.id_brg AND peminjaman.status != 2
                                                            )
                                                      ) AS jml FROM jenis");
                  while ($jns_data = $l_jns->fetch_array()) {

$data .= 	'<tr>
                <td>'.$x++.'</td>
                <td>'.$jns_data['nm_jenis'].'</td>
                <td><b>'.$jns_data['jml'].'</b> Kali Dipinjam</td>
              </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Laporan total peminjaman jenis.pdf', 'D');

 ?>