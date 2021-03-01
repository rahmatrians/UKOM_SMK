<?php

session_start();

include "koneksi.php";
include "animasi.php";

function kodeOtomatis($id, $tabel,$key) {
	global $conx;

	$sql 	= "SELECT max({$id}) AS id FROM {$tabel}";
	$exe 	= $conx->query($sql);
	$fetch 	= $exe->fetch_array();

	$sub 	= substr($fetch['id'], 1);
	$conv 	= (int) $sub;
	$inc 	= $conv + 1;
	$be 	= $key . str_pad($inc, 3, "0", STR_PAD_LEFT);

	return $be;
}

function kueri($kolom, $tabel) {
	global $conx;

	$exe 	= $conx->query("SELECT $kolom FROM $tabel");

	return $exe;
}

function hapus($tabel, $id1, $id2, $link) {
	global $conx;

	$exe 	= $conx->query("DELETE FROM $tabel WHERE $id1 = '$id2'");

	header("location: ../ukom_rahmat/" . $link. ".php");
if ($exe) {
	$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Telah Berhasil Dihapus',
				type 			: 'error',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";
}else{
	$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Gagal! Karena Data telah ada di peminjaman',
				type 			: 'error',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";
}
	// return $exe;
}

function kueriDimana($kolom, $tabel, $dimana) {
	global $conx;

	$exe 	= $conx->query("SELECT $kolom FROM $tabel WHERE $dimana");
	$fetch = mysqli_fetch_array($exe);

	return $fetch;
}

function kueriDimana2($tabel, $id1, $id2) {
	global $conx;

	$exe 	= $conx->query("SELECT * FROM $tabel WHERE $id1 = '$id2'");
	// $fetch = mysqli_fetch_array($exe);

	return $exe;
}

function masuk($nm_pengguna, $kata_sandi) {
	global $conx;

	$exe 	= $conx->query("SELECT * FROM akun_pengguna WHERE nm_pengguna = '$nm_pengguna'");
	$hitung 	= mysqli_num_rows($exe);

	if ($hitung == 1) {
		$fetch = $exe->fetch_assoc();
		if (md5($kata_sandi) == $fetch['kata_sandi']) {
			header('location: ../ukom_rahmat/');
			$_SESSION['login'] 		= 1;
			$_SESSION['id'] 		= $fetch['id_akun'];
			$_SESSION['pengguna'] 	= $fetch['nm_pengguna'];
			$_SESSION['jabatan'] 	= $fetch['id_jab'];
		}else {
			header('location: masuk.php');
			$_SESSION['gagal'] 		= "<script>alert('Kata Sandi Salah')</script>";
		}
	}else{
			header('location: masuk.php');
			$_SESSION['gagal'] 		= "<script>alert('Nama Pengguna Salah')</script>";
		}

	// return $exe;
}

function tambah($tabel, $data, $link) {
	global $conx;
	global $animasi;

	$exe 	= $conx->query("INSERT INTO $tabel VALUES({$data})");

	header("location: ../ukom_rahmat/" . $link. ".php");

	$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Telah Berhasil Ditambahkan',
				type 			: 'success',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";

	// unset($exe);
	// return $exe;
}

function ubahStatus($id, $st) {
	global $conx;

	$inc 	= $st + 1;

	if ($inc != 1) {
		$sql 	= $conx->query("UPDATE peminjaman SET
							status 		= '$inc',
							tgl_kembali 	= NOW()
							WHERE id_pinjam = '$id'");
	}else{
		$sql 	= $conx->query("UPDATE peminjaman SET
						tgl_masuk	= NOW(),
						status 		= '$inc'
						WHERE id_pinjam = '$id'");
	}

	return $sql;
}

// function multiData($tabel) {
// 	global $conx;

// 	$exe 	= $conx->query("SELECT * FROM $tabel");
// 	// $row 	= ;
// 	// var_dump($data = $exe->fetch_array());
// 	while ($data = $exe->fetch_assoc()) {
// 		$row = array($data);
// 	}

// 	return $row;
// }

?>