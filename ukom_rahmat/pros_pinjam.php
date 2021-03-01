<?php 

// include 'fungsi.php';
include 'header.php';


if ($jabatan != "Anggota") {
	header('location: ../ukom_rahmat/');
}

$kd 	= kodeOtomatis("id_pinjam","peminjaman","P");

$brg 	= $_GET['brg'];
// $id = $_SESSION['id'],
// $jns 	= $_GET['jns']);

$tglMasuk = date('Y-m-d');

$sql 	= $conx->query("INSERT INTO peminjaman VALUES('$kd','$id','$brg','$tglMasuk','NULL','0 OERDER BY id_pinjam DESC')");
	$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Telah Berhasil dipesan',
				type 			: 'success',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";
header("location: ../ukom_rahmat/peminjaman.php");

 ?>