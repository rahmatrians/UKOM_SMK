<?php 

include "fungsi.php";

if (!empty($_SESSION['login'])) {
	header('location: ../ukom_rahmat/');
}

if (isset($_SESSION['gagal'])) {
	echo $_SESSION['gagal'];
}

if (isset($_SESSION['alert'])) {
	echo $_SESSION['alert'];
	unset($_SESSION['alert']);
}

if (isset($_POST['masuk'])) {
	$nm_pengguna 	= strtolower($_POST['nm_pengguna']);
	$kata_sandi 	= $_POST['kata_sandi'];
	// $sql 			= masuk($nm_pengguna, $kata_sandi);

	$exe 	= $conx->query("SELECT * FROM akun_pengguna WHERE nm_pengguna = '$nm_pengguna'");
	$hitung 	= mysqli_num_rows($exe);

	if ($hitung == 1) {
		$fetch = $exe->fetch_assoc();
		if (md5($kata_sandi) == $fetch['kata_sandi']) {
			$_SESSION['login'] 		= 1;
			$_SESSION['id'] 		= $fetch['id_akun'];
			$_SESSION['nm_lengkap'] 	= $fetch['nm_lengkap'];
			$_SESSION['pengguna'] 	= $fetch['nm_pengguna'];
			$_SESSION['jabatan'] 	= $fetch['id_jab'];
			$_SESSION['alert'] = "
				<script>
					new Noty({
						text 			: 'Halo Selamat datang <b>".$_SESSION['nm_lengkap']."</b>',
						type 			: 'info',
						theme 			: 'nest',
						layout			: 'bottomRight',
						timeout 		: '5000',
						" . $animasi . "
						}).show();
				</script>
			";

			header('location: ../ukom_rahmat/dashboard.php');
		}else {
			header('location: masuk.php');
			$_SESSION['gagal'] 		= "<script>alert('Kata Sandi Salah')</script>";
		}
	}else{
			header('location: masuk.php');
			$_SESSION['gagal'] 		= "<script>alert('Nama Pengguna Salah')</script>";
		}

}

 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>Halaman Masuk</title>
	<link rel="stylesheet" type="text/css" href="vendor/css/material-icons.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="vendor/noty/lib/noty.css">
	<link rel="stylesheet" type="text/css" href="vendor/noty/demo/bouncejs/bounce.css">
	<link rel="stylesheet" type="text/css" href="vendor/noty/lib/themes/nest.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/custom.css">
	<link rel="icon" type="image/png" href="vendor/images/INVAL-W.png">
	<meta name="viewprot" content="width=device-width, initial-scale=1" charset="utf-8"/>
	<script type="text/javascript" src="vendor/materializes/js/materialize.js"></script>
	<script type="text/javascript" src="vendor/jquery.js"></script>
	<script type="text/javascript" src="vendor/noty/lib/noty.js"></script>
	<script type="text/javascript" src="vendor/scrollreveal/dist/scrollreveal.js"></script>
	<script type="text/javascript" src="vendor/noty/demo/bouncejs/bounce.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>

<!-- <div class="r-bg"></div> -->


<div class="container r-cont">
	<div class="row">
		<div class="col l12 m12 s12 card-panel r-panel">

				<div class="col l5 infentoria">
					<br>
					<br>
					<br>
					<a href="landing.php">
						<img src="images/INVAL-W.png" style="width: 80px;">
						<h3 class="center white-text">PISMA</h3>
					</a>
					<h6 style="font-size: 15px !important;" class="center white-text">Meminjam tidak pernah semudah ini</h6>
				</div>

		<div class="col l7 s12">
		<div class="col s12 r-login-form">
				 <form action="" method="POST" autocomplete="off">
				 			<div>
				 				<h3 class="center">AKUN</h3>
				 			</div>
				 			<div class="input-field">
				 				<label for="nm_pengguna">Nama Pengguna</label>
					 			<input style="font-size: 15px !important;" type="text" name="nm_pengguna" id="nm_pengguna" required>
				 			</div>
				 			
				 			<div class="input-field">
					 			<label for="kata_sandi">Kata Sandi</label>
					 			<input style="font-size: 15px !important;" type="password" name="kata_sandi" id="kata_sandi" required>
				 			</div>

				 			<div class="input-field">
					 			<button class=" btn tbl-masuk" type="submit" name="masuk">Masuk</button>
				 			</div>
				 </form>
		</div>
		</div>

		</div>
	</div>
</div>	
 <?php 

	include "footer.php";

  ?>