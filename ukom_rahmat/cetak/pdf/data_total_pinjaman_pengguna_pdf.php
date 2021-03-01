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

	<h1 class="judul">Laporan total peminjaman Pengguna
		<div class="border"></div>
	</h1>
		<br>
 <p class="dateNow">'.date("d-M-Y").'</p>
 <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Total Pinjaman</th>
          </tr>
      </thead>
    <tbody>';

                  $x = 1;
                  $l_jns = kueri("*, (SELECT COUNT(id_pinjam) FROM peminjaman WHERE akun_pengguna.id_akun = peminjaman.id_akun) AS ttl_akn", "akun_pengguna WHERE akun_pengguna.id_jab = '3'");
                  while ($akun_data = $l_jns->fetch_array()) {

$data .= 	'   <tr>
                <td>'.$x++.'</td>
                <td>'.$akun_data['nm_lengkap'].'</td>
                <td><b>'.$akun_data['ttl_akn'].'</b> Kali Meminjam</td>
              </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Laporan total peminjaman penguna.pdf', 'D');

 ?>