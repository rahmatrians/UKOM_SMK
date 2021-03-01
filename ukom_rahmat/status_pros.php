<?php 

include "fungsi.php";

$id 	= $_GET['id'];
$st 	= $_GET['st'];

$inc 	= $st + 1;

if ($inc == 2) {
	$sql 	= $conx->("UPDATE peminjaman SET
						status 		= '$inc',
						tgl_kembali 	= NOW()
						WHERE id_pinjam = '$id'");
}else{
	$sql 	= $conx->("UPDATE peminjaman SET
					tgl_masuk 	= NOW(),
					status 		= '$inc'
					WHERE id_pinjam = '$id'");
}

 ?>