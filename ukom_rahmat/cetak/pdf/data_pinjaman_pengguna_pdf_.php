<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

$id = $_GET['id'];
$nm = $_GET['nm'];

        $judul  = "Laporan Peminjaman <br> dipinjam oleh ".$nm;
        $filename   = "Laporan total peminjaman barang ".$nm;

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
              <th>Nama Barang</th>
            </tr>
            <tbody>';

				$x = 1;
        $sql_lap = kueriDimana2("peminjaman 
                        INNER JOIN barang ON peminjaman.id_brg = barang.id_brg 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun", 
                        "peminjaman.id_akun", $id); 
        $ttl = mysqli_num_rows($sql_lap);
				while ($row = $sql_lap->fetch_array()) {

$data .= 	' <tr>
               <td>'.$x++.'</td>
               <td>'.$row['nm_brg'].'</td>
            </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output($filename.".pdf", 'D');

 ?>