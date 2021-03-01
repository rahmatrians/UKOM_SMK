<?php 

session_start();

include "koneksi.php";

if (!empty($_SESSION['login'])) {
	header('location: ../ukom_rahmat/');
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>PISMA</title>
	<link rel="stylesheet" type="text/css" href="vendor/css/material-icons.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/materialize.css" media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="vendor/css/custom.css">
	<script type="text/javascript" src="vendor/scrollreveal/dist/scrollreveal.js"></script>
    <script>
        ScrollReveal({ reset: true });
    </script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"/>
	<style>
		.row{
			margin: 0 !important;
			padding: 0 !important;
		}
	</style>
</head>
<body class="r-land-body">

<nav class="r-land-nav">
	<div class="row">
		<div class="col l6 offset-l6">
			<ul class="">
				<div class="col l2 right">
					<li><a href="masuk.php">Login</a></li>
				</div>
				<div class="col l2 right">
					<li><a target="_blank" href="panduan/PANDUAN%20CARA%20LOGIN%20DAN%20MEMINJAM%20BARANG.pdf">Panduan</a></li>
				</div>
			</ul>
		</div>
	</div>
</nav>

<div class="row">

<section>
	<div class="col l12 m12 s12 r-land-first">
		<div class="col l6 m6 s12 r-land-name">
			<div class="col l1 m6 s3 offset-s2 r-land-logo">
				<img src="images/INVAL-W.png">
			</div>
			<div class="col l1 m6 s2 r-land-title">
				<h4 class="white-text">PISMA</h4>
			</div>
			<div class="col l12 m12 s12 r-land-main">
				<p style="font-size: 20px !important;" class="white-text"><b>Aplikasi Web Peminjaman Inventaris Sekolah Digital</b></p>
				<h6 class="white-text">Meminjam tidak pernah semudah ini</h6>
				<br> <br>
				<a href="#sec2" class="btn r-btn-land">Lebih Lanjut</a>
			</div>
		</div>
		<div class="col l6 m6 s12 center r-land-img" style="margin-top: 100px">
			<img src="images/bg5.png">
		</div>
</section>

<section>
	<div class="col l12 m12 s12 white">
<div class="container">
				<br> <br>
				<div class="col l4 m4 s12 r-land-box1 scrollspy" id="sec2">
					<div class="card-panel">
						<center>
							<!-- <img class="r-land-second-img" src="images/INVAL-O.png"> -->
						</center>
						<p class="center">Memudahkan dalam melakukan pendataan barang</p>
				</div>
				</div>
				<div class="col l4 m4 s12 r-land-box2">
					<div class="card-panel">
						<center>
							<!-- <img class="r-land-second-img" src="images/INVAL-O.png"> -->
						</center>
						<p class="center">Memudahkan dalam mencari barang yang ingin dipinjam</p>
				</div>
				</div>
				<div class="col l4 m4 s12 r-land-box3">
					<div class="card-panel">
						<center>
							<!-- <img class="r-land-second-img" src="images/INVAL-O.png"> -->
						</center>
						<p class="center">Sistem Pendataan peminjaman yang sangat akurat</p>
				</div>
				</div>
			</div>
			<div class="col l12 m12 s12 center">
				<br> <br> <br> <br> <br>
				<a href="masuk.php"><button class="btn"><b>Ayo Pinjam</b></button></a>
				<br> <br> <br> <br> <br>
			</div>
	</div>
</section>

</section>
		<footer>
			<div class="col l12 m12 s12 purple r-land-footer">
				<div class="col l6 m6 s12">
					<h6><b>Alamat</b></h6>
					<p>Jl. AMD, Bakti Jaya, Setu, Tangerang</p>
						<br>
					<h6><b>Email</b></h6>
					<p>alamanahedu@yahoo.co.id</p>
				</div>
				<div class="col l6 m6 s12">
					<div class="col l6 s12">
						<h6><b>No Telepon</b></h6>
					</div>
				</div>
				<div class="col l6 m6 s12">
					<div class="col l4 m6 s6">
						<b><p>Rahmat Rians</b>
							<br>
						0808 0990 3237</p>
					</div>

					<div class="col l4 m6 s6">
						<b><p>Riansyah</b>
							<br>
						0888 2110 7887</p>
					</div>
					
					<div class="col l4 m6 s6">
						<b><p>Matrians</b>
							<br>
						0858 1991 7557</p>
					</div>
				</div>
				</div>
			</div>
		</footer>
	</div>


<script src="vendor/crop-image/jquery.min.js"></script>
<script type="text/javascript" src="vendor/materializes/js/materialize.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$('.scrollspy').scrollSpy({
			scrollOffset : 85
		});
	});

	var slideUp = {
	    distance: '20%',
	    delay: 100,
	    origin: 'bottom',
	    opacity: null
	};

	// ScrollReveal().reveal('.slide-up', slideUp);

	// ScrollReveal().reveal('.card-panel', slideUp);
	ScrollReveal().reveal('.r-land-name', {distance: '80%', origin: 'top', duration: 2000, opacity: 0});
	// ScrollReveal().reveal('.r-land-title', {distance: '50%', origin: 'top', duration: 1500, opacity: 0});
	ScrollReveal().reveal('.r-land-img', {distance: '300%', origin: 'bottom', duration: 1500, opacity: 0});
	ScrollReveal().reveal('.r-land-main', {duration: 1500, opacity: 0});
	ScrollReveal().reveal('.btn', {duration: 2000, opacity: 0});
	ScrollReveal().reveal('.r-land-box1', {distance: '30%', origin: 'right', duration: 1500, opacity: 0});
	ScrollReveal().reveal('.r-land-box2', {distance: '30%', origin: 'left', duration: 1500, opacity: 0});
	ScrollReveal().reveal('.r-land-box3', {distance: '30%', origin: 'right', duration: 1500, opacity: 0});
	ScrollReveal().reveal('.r-land-footer', {distance: '30%', origin: 'bottom', duration: 1500, opacity: 0});
</script>