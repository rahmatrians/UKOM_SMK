<?php
ob_start();

include "fungsi.php";

date_default_timezone_set('Asia/Jakarta');

if (empty($_SESSION['login'])) {
	header('location: ../ukom_rahmat/landing.php');
}

$id 			= $_SESSION['id'];
$nm_lengkap 	= $_SESSION['nm_lengkap'];
$pengguna 		= $_SESSION['pengguna'];
$jabatan 		= $_SESSION['jabatan'];

switch ($jabatan) {
	case '1':
		$jabatan = "Pengelola";
		break;

	case '2':
		$jabatan = "Manajemen";
		break;
	
	default:
		$jabatan = "Anggota";
		break;
}


$angg 	= kueriDimana("count(id_brg) AS id","peminjaman","id_akun = '$id' AND status != 2");

?>


<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	<link rel="stylesheet" type="text/css" href="vendor/css/material-icons.css">
	<link rel="icon" type="image/png" href="vendor/images/INVAL-W.png">
	<link rel="stylesheet" type="text/css" href="vendor/css/materialize.css" media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="vendor/noty/lib/noty.css">
	<link rel="stylesheet" type="text/css" href="vendor/noty/demo/bouncejs/bounce.css">
	<link rel="stylesheet" type="text/css" href="vendor/noty/lib/themes/nest.css">
	<link rel="stylesheet" type="text/css" href="vendor/crop-image/croppie.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css/custom.css">	
	<!-- <link rel="stylesheet" type="text/css" href="dataTable/datatables.css">	 -->
    <script src="vendor/crop-image/jquery.min.js"></script>
	<script type="text/javascript" src="vendor/sweetalert/dist/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="vendor/dataTable/datatables.js"></script>
	<script type="text/javascript" src="vendor/scrollreveal/dist/scrollreveal.js"></script>
	<script type="text/javascript" src="vendor/noty/lib/noty.js"></script>
	<script type="text/javascript" src="vendor/noty/demo/bouncejs/bounce.js"></script>
	<script type="text/javascript" src="vendor/chart/Chart.js"></script>
    <script>
        ScrollReveal({ reset: true });
    </script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
</head>
<body>




<div class="row">
	<nav>
		<div class="nav-wrapper">

				<div class="col l2 s2">
					<a href="" data-target="slide-out" class="sidenav-trigger "><i class="material-icons">menu</i></a>
				</div>

				<div class="col l1">
					<?php if ($jabatan != 'Anggota') {
					?>
					
					<a class="dropdown-trigger" data-target="notif"><i class="material-icons white-text">notifications</i></a>

				<ul id="notif" class="dropdown-content" style="min-width: 300px !important;">
					
					<?php 
						$sql = kueri("*", "riwayat ORDER BY id_riwayat DESC LIMIT 5");
						 	foreach ($sql as $data) {
					 ?>

					<li><a class="grey-text" style="font-size: 12px;" href="">
						<?php if ($data['keterangan'] == 'Barang baru ditambahkan') { ?>

						<i class="grey-text material-icons">done</i>
					
						<?php }elseif ($data['keterangan'] == 'Barang baru dihapuskan') { ?>

						<i class="grey-text material-icons">clear</i>

						<?php }else { ?>

						<i class="grey-text material-icons">autorenew</i>

						<?php } ?>

						<?= $data['keterangan'] ?> <span class="right"><?= $data['id_data'] ?></span></a></li>
					<li class="divider" tabindex="-1"></li>
					
					<?php
						 	}
						} 
					?>
				
				</ul>
				</div>

				<div class="col l7">
					
					<?php 
						if ($jabatan == 'Anggota') {
							if (isset($_GET['cariData'])) {
								$cariDt = $_GET['cariData'];
								$sqlData = kueri("*", "jenis WHERE nm_jenis LIKE '".$cariData."'");
							}
					 ?>
					
					<form autocomplete="off" method="POST" action="">
						<div class="r-search input-field">
							<div class="col l11">
								<input type="text" id="searchBox" class="boxSearch left" placeholder="Search" name="cari">
							</div>
								
							<div class="col l1">
								<button class="btn right" name="cariData" type="submit">Cari</button>
							</div>
						</div>
					</form>
					
					<?php 
						}
					 ?>

				</div>
				<div class="col l2 m4 offset-m2 s6">
					<a href="../ukom_rahmat">
						<div class="col l6">
							<p class="right"><img src="images/INVAL-W.png" style="width: 30px;"></p>
						</div>
						<div class="col l6">
							<h5>PISMA</h5>
						</div>
					</a>
				</div>
				<div class="col l2 offset-m2 m1 s2">
					<a href="" data-target="bbb" class="sidenav-trigger"><i class="material-icons">search</i></a>
				</div>
		</div>
	</nav>
<!-- </div> -->

<br>
<br>
<br>
<br>

<div class="col l2 m1">

<ul id="slide-out" class="sidenav sidenav-fixed">
	<li class="center"><div class="user-view">
		<center>
		<div class="background" style="background: #2C3056;">
			<!-- <img src="images/bg4.jpg"> -->
		</div>
		<a><img class="circle" src="images/male.png"></a>
		</center>
		<a><span class="white-text name"><?= $nm_lengkap ?></span></a>
		<a><span class="teal-text email"><b><?= $jabatan ?></b></span></a>
		<a></a>
	</div></li>


<?php 
if ($jabatan == "Anggota") {
?>
	<li><a href="../ukom_rahmat/" class="waves-effect">Pinjam Barang</a></li>
	<li><a href="../ukom_rahmat/peminjaman.php"><span class="new badge" data-badge-caption="Barang"><?= $angg['id'] ?></span>Keranjang</a></li>



<?php
}
 ?>

<?php
if ($jabatan != "Anggota") {
  ?>

	<li><a href="../ukom_rahmat/dashboard.php" class="waves-effect">Beranda</a></li>
	<li><a href="../ukom_rahmat/" class="waves-effect">Peminjaman</a></li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion transparent">
          <li>
            <a class="collapsible-header" class="waves-effect">Data<i class="material-icons white-text">keyboard_arrow_down</i></a>
            <div class="collapsible-body transparent">
              <ul>
             <?php 
					if ($jabatan == "Pengelola") {
              ?> 	
				
					<li><a href="../ukom_rahmat/akun.php" class="waves-effect"><i class="material-icons"></i>Akun</a></li>

             <?php
	             } 
              ?>

					<li><a href="../ukom_rahmat/barang.php" class="waves-effect"><i class="material-icons"></i>Barang</a></li>
					<li><a href="../ukom_rahmat/distributor.php" class="waves-effect"><i class="material-icons"></i>Distributor</a></a></li>
					<li><a href="../ukom_rahmat/jenis.php" class="waves-effect"><i class="material-icons"></i>jenis</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>

<?php
}
if ($jabatan == "Manajemen") {
  ?>

	<li><a href="../ukom_rahmat/laporan/laporan.php" class="waves-effect">Laporan</a></li>

<?php 
}
 ?>
	<!-- <li><div class="divider"></div></li> -->
	<!-- <li><a class="subheader" href="">adada</a></li> -->

<?php
if ($jabatan == "Anggota") {
  ?>
	<li><a href="../ukom_rahmat/tentang_kami.php" class="waves-effect" href="">Tentang Kami</a></li>
<?php 
}
 ?>
	<li><a href="../ukom_rahmat/keluar.php" class="waves-effect keluar" href="">Keluar</a></li>
<p class="white-text r-copyright">copyright by <br><b class="teal-text"> SMK AL AMANAH</b></p>
</ul>


</div>


<div id="bbb" class="sidenav r-search-input">
	<div class="row">
		<form action="" method="POST" autocomplete="off">
				<div class="card-panel">
			<div class="input-field">
					<input type="text" id="searchBox" name="cari">
			</div>
			<div class="input-field">
					<button type="submit" name="cariData" class="btn">Cari</button>
			</div>
				</div>
		</form>
	</div>
</div>

<div class="col l10 m12 right">