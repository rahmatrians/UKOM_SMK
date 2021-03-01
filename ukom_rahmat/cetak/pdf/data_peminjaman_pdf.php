<?php 

include "../../fungsi.php";
require_once '../../vendor/mpdf/autoload.php';

$id = $_GET['id'];


  if ($id == 'pesan') {
  
    $sql_lap = $conx->query("SELECT * FROM peminjaman 
                    INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                    INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                     WHERE status = '0'"); 
    $ttl_pnjm = mysqli_num_rows($sql_lap);
    $judul  = "Laporan peminjaman <br> dalam pesanan";
    $filename   = "Laporan peminjaman dalam pesanan";
}

  if ($id == 'pinjam') {
  
    $sql_lap = $conx->query("SELECT * FROM peminjaman 
                    INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                    INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                     WHERE status = '1'"); 
    $ttl_pnjm = mysqli_num_rows($sql_lap);
    $judul  = "Laporan peminjaman <br> masih dipinjam";
    $filename   = "Laporan peminjaman masih dipinjam";
}

  if ($id == 'kembali') {
  
    $sql_lap = $conx->query("SELECT * FROM peminjaman 
                    INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                    INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                     WHERE status = '2'"); 
    $ttl_pnjm = mysqli_num_rows($sql_lap);
    $judul  = "Laporan peminjaman <br> telah selesai";
    $filename   = "Laporan peminjaman telah selesai";
}


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
                <th>Tanggal masuk</th>
                <th>Tanggal kembali</th>
              </tr>
          </thead>
          <tbody>';

        $x = 1;
        while($row = $sql_lap->fetch_array()) {

$data .= 	'   <tr>
                <td>'.$x++.'</td>
                <td>'.$row['nm_lengkap'].'</td>
                <td>'.$row['nm_brg'].'</td>
                <td>'.$row['tgl_masuk'].'</td>
                <td>'.$row['tgl_kembali'].'</td>
              </tr>';

              }


$data .=     '</tbody>
    </table>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output($filename.'.pdf', 'D');

 ?>