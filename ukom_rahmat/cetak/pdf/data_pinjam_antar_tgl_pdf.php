<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

  $tgl1 = $_GET['tgl1'];
  $tgl2 = $_GET['tgl2'];
      
    $sql_lap = kueri("*", "peminjaman 
                          INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                          INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                        WHERE status != '0' AND tgl_masuk BETWEEN '$tgl1' and '$tgl2' ");
    $ttl = mysqli_num_rows($sql_lap);
    $judul  = "Laporan peminjaman barang <br> antara tanggal ".$tgl1." sampai ".$tgl2;
    $filename   = "Laporan peminjaman berdasarkan tanggal";

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
              <th>Nama Peminjam</th>
              <th>Nama Barang</th>
              <th>Tanggal Pinjam</th>
            </tr>
            </thead>
            <tbody>';

				$x = 1;
				while ($row = $sql_lap->fetch_array()) {

$data .= 	' <tr>
                <td>'.$x++.'</td>
                <td>'.$row['nm_lengkap'].'</td>
                <td>'.$row['nm_brg'].'</td>
                <td>'.$row['tgl_masuk'].'</td>
              </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output($filename.'.pdf', 'D');

 ?>