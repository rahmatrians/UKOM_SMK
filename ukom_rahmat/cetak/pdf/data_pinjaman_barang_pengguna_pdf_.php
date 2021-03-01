<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

$id = $_GET['id'];
$nm = $_GET['nm'];

$data 		= '

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

	<h1 class="judul">Laporan Total Peminjaman Barang <br> '.$nm.' <br> dipinjam oleh pengguna
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
        $sql_lap = kueri("*", "peminjaman 
                    INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                     WHERE id_brg = '$id'"); 
        $ttl = mysqli_num_rows($sql_lap);
        $filename   = "Laporan total peminjaman barang ".$nm;
				while ($row = $sql_lap->fetch_array()) {

$data .= 	' <tr>
               <td>'.$x++.'</td>
               <td>'.$row['nm_lengkap'].'</td>
            </tr>';

              }


$data .=     '</tbody>
          </thead>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output($filename.".pdf", 'D');

 ?>