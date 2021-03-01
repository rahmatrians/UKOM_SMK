<?php 

include "fungsi.php";

if (empty($_GET['id'])) {
	header('location: ../ukom_rahmat/peminjaman.php');
}

$id 	= $_GET['id'];

$sql 	= hapus("peminjaman", "id_pinjam", "$id", "peminjaman");