<?php 

include "header.php";

if ($jabatan == "Anggota") {
	header('location: ../ukom_rahmat/');
}

if (isset($_GET['id_b'])) {
	$brg = $_GET['id_b'];
	$knds 	= $conx->query("UPDATE barang SET kondisi = 'Baik' WHERE id_brg = '$brg'");

	$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Telah diperbaiki	',
				type 			: 'success',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";
	header('location: dashboard.php');
}

if (isset($_SESSION['alert'])) {
	echo $_SESSION['alert'];
	unset($_SESSION['alert']);
}

if (isset($_GET['st'])) {
	if ($_GET['st'] == 3) {
		$id 	= $_GET['id_p'];
		$st 	= $_GET['st'] - 2;
		$sql 	= ubahStatus($id, $st);

		$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Telah Terlunasi',
				type 			: 'success',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";
	header('location: dashboard.php');
	
	}elseif ($_GET['st'] == 4) {
		$id 	= $_GET['id_p'];
		$st 	= $_GET['st'] - 3;
		
		$sql 	= ubahStatus($id, $st);

		$_SESSION['alert'] = "
		<script>
			new Noty({
				text 			: 'Telah Terlunasi',
				type 			: 'success',
				theme 			: 'nest',
				layout			: 'bottomRight',
				timeout 		: '3000',
				" . $animasi . "
				}).show();
		</script>
	";
	header('location: dashboard.php');
	}

}

$sqlJns = kueri("COUNT(id_jenis)AS jml_jns", "jenis");
$ttlJns = mysqli_fetch_array($sqlJns);

$sqlBrg = kueri("COUNT(id_brg)AS jml_brg", "barang");
$ttlBrg = mysqli_fetch_array($sqlBrg);

$sqlPmjm = kueri("COUNT(id_pinjam)AS jml_pmjm", "peminjaman");
$ttlPmjm = mysqli_fetch_array($sqlPmjm);

 ?>

 <style>
 	.r-search {
 		display: none;
 	}
 </style>

 <!-- <div class="col l12 m12 s12"> -->

 	<div class="col l4 m6 s12">
	 	<a class="white-text" href="jenis.php">
			<div class="card-panel" style="background-image: linear-gradient(to left, #FFC367, #F7AA59)">
				<div class="col l10"><h5>Total Jenis</h5></div>
				<div class="col l2"><h5><b><?= $ttlJns['jml_jns'] ?></b></h5></div>
	 		</div>
	 	</a>
 	</div>

 	<div class="col l4 m6 s12">
	 	<a class="white-text" href="barang.php">
			<div class="card-panel" style="background-image: linear-gradient(to left, #5BE187, #43C4A6)">
				<div class="col l10"><h5>Total Barang</h5></div>
				<div class="col l2"><h5><b><?= $ttlBrg['jml_brg'] ?></b></h5></div>
	 		</div>
	 	</a>
 	</div>

 	<div class="col l4 m12 s12">
	 	<a class="white-text" href="../ukom_rahmat/">
			<div class="card-panel" style="background-image: linear-gradient(to left, #FA7A89, #F25C6D);">
				<div class="col l10"><h5>Total Peminjaman</h5></div>
				<div class="col l2"><h5><b><?= $ttlPmjm['jml_pmjm'] ?></b></h5></div>
	 		</div>
	 	</a>
 	</div>

 	<div class="col l6 m6 s12">
 	<div class="col l6 m6 s12">
 	<div class="card-panel">
 		<table class="striped">
 				<thead>
 					<tr>
 						<th colspan="2"><center><h6><b>Kondisi barang setelah dipinjam</b></h6></center></th>
 					</tr>
 					<tr>
 						<th>Baik</th>
 						<?php 
 							$sqlBrg1 	= $conx->query("SELECT * FROM barang
 														INNER JOIN peminjaman ON barang.id_brg = peminjaman.id_brg
 														INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
 														 WHERE kondisi = 'Baik' ORDER BY tgl_masuk DESC");
 							$hsl1		= mysqli_num_rows($sqlBrg1);
 						 ?>
 						<td><a href="#brgBaik" class="modal-trigger"><?= $hsl1 ?></a></td>
 					</tr>
 					<tr>
 						<th>Rusak</th>
 						<?php 
 							$sqlBrg2 	= $conx->query("SELECT * FROM barang
 														INNER JOIN peminjaman ON barang.id_brg = peminjaman.id_brg
 														INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
 														 WHERE kondisi = 'Rusak' ORDER BY tgl_masuk DESC");
 							$hsl2		= mysqli_num_rows($sqlBrg2);
 						 ?>
 						<td><a href="#brgRusak" class="modal-trigger"><?= $hsl2 ?></a></td>
 					</tr>
 					<tr>
 						<th>Hilang</th>
 						<?php 
 							$sqlBrg3 	= $conx->query("SELECT * FROM barang
 														INNER JOIN peminjaman ON barang.id_brg = peminjaman.id_brg
 														INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
 														 WHERE kondisi = 'Hilang' ORDER BY tgl_kembali DESC");
 							$hsl3		= mysqli_num_rows($sqlBrg3);
 						 ?>
 						<td><a href="#brgHilang" class="modal-trigger"><?= $hsl3 ?></a></td>
 					</tr>
 				</thead>
 			</table>
 	</div>	
 	</div>	
 	<div class="col l6 m6 s12">
 	<div class="card-panel">
 			<table class="striped">
 				<thead>
 					<tr>
 						<th colspan="2"><center><h6><b>Transaksi peminjaman hari ini</b></h6></center></th>
 					</tr>
 					<tr>
 						<th>Dipesan</th>
 						<?php 
 							$sqlPjm1 	= $conx->query("SELECT * FROM peminjaman WHERE status = '0' AND tgl_masuk = CURDATE()");
 							$hsl1		= mysqli_num_rows($sqlPjm1);
 						 ?>
 						 <td><a href="#psnSkrg" class="modal-trigger"><?= $hsl1 ?></a></td>
 					</tr>
 					<tr>
 						<th>Dipinjam</th>
 						<?php 
 							$sqlPjm2 	= $conx->query("SELECT * FROM peminjaman WHERE status = '1' AND tgl_masuk = CURDATE()");
 							$hsl2		= mysqli_num_rows($sqlPjm2);
 						 ?>
 						 <td><a href="#pjmSkrg" class="modal-trigger"><?= $hsl2 ?></a></td>
 					</tr>
 					<tr>
 						<th>Selesai</th>
 						<?php 
 							$sqlPjm3 	= $conx->query("SELECT * FROM peminjaman WHERE status = '2' AND tgl_kembali = CURDATE()");
 							$hsl3		= mysqli_num_rows($sqlPjm3);
 						 ?>
 						 <td><a href="#selsSkrg" class="modal-trigger"><?= $hsl3 ?></a></td>
 					</tr>
 				</thead>
 			</table>
 	</div>
 		</div>
 	</div>
 	
 	<div class="col l6 m6 s12">
 		<div class="card-panel">
 			<canvas id="myChart"></canvas>
 		</div>
 	</div>

 	<div class="col l12 m12 s12">
 		<div class="card-panel">
 			<div style="overflow: auto; height: 350px;">
 				
 			<h5>Barang Rusak</h5>
			<table>
				<thead>
 			<?php 
 				$brgRusak = kueriDimana2("barang", "kondisi", "Rusak");
 				foreach ($brgRusak as $data) {
 			 ?>

					<tr>
						<th><?= $data['nm_brg'] ?></th>
						<td><a href="?id_b=<?= $data['id_brg'] ?>" class="btn perbaiki">Perbaiki</a></td>
					</tr>

 			<?php 
 				}
 			 ?>

				</thead>
			</table>
 			</div>
	 	</div>
 	</div>
 	
 
 </div>


<!-- ----------------- Modal-modal Transaksi Hari Ini ------------------- -->


 <!-- Modal Structure -->
			  <div id="brgBaik" class="modal card-panel" style="overflow: auto;">
			    <div class="modal-content">
			      	<table class="striped">
			      		<h5 class="center"><b>Kondisi barang pinjaman baik</b></h5>
			      		<br>
			      		<thead>
			      			<tr>
			      				<th>No</th>
			      				<th>Nama Barang</th>
			      				<th>Nama Peminjam</th>
			      				<th>Aksi</th>
			      			</tr>
			      		</thead>
			      		<tbody>

			      			<?php 
			      				$x = 1;
			      				$sqlBaik = $conx->query("SELECT * FROM barang
			      										INNER JOIN peminjaman ON peminjaman.id_brg = barang.id_brg
			      										INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
			      										 WHERE kondisi = 'Baik'");

			      				while ($fetcBaik = $sqlBaik->fetch_array()) {
			      			 ?>
			      			
			      			<tr>
			      				<td><?= $x++ ?></td>
			      				<td><?= $fetcBaik['nm_brg'] ?></td>
			      				<td><?= $fetcBaik['nm_lengkap'] ?></td>
			      				<td>-</td>
			      			</tr>

				      		<?php } ?>

			      		</tbody>
			      	</table>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  </div>



			  <!-- Modal Structure -->
			  <div id="brgRusak" class="modal card-panel r-modal" style="overflow: auto;">
			    <div class="modal-content">
			      	<table class="striped">
			      		<h5 class="center"><b>Barang pinjaman yang rusak</b></h5>
			      		<br>
			      		<thead>
			      			<tr>
			      				<th>No</th>
			      				<th>Nama Barang</th>
			      				<th>Nama Peminjam</th>
			      				<th>Biaya Ganti</th>
			      				<th>Aksi</th>
			      			</tr>
			      		</thead>
			      		<tbody>

			      			<?php 
			      				$x = 1;
			      				$sqlRsk = $conx->query("SELECT * FROM barang
			      										INNER JOIN peminjaman ON peminjaman.id_brg = barang.id_brg
			      										INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
			      										 WHERE kondisi = 'Rusak'");

			      				while ($fetcRsk = $sqlRsk->fetch_array()) {
			      			 ?>
			      			
			      			<tr>
			      				<td><?= $x++ ?></td>
			      				<td><?= $fetcRsk['nm_brg'] ?></td>
			      				<td><?= $fetcRsk['nm_lengkap'] ?></td>
			      				<td><p class="red-text">Rp. <?= number_format($fetcRsk['harga_beli']) ?></p></td>

			      				<?php if ($fetcRsk['status'] == '2') {
			      				?>

				      				<td><p class="grey-text">Telah Lunas</p></td>

			      				<?php
			      				}else {
			      				?>
				      			
				      				<td><a href="?id_p=<?= $fetcRsk['id_pinjam'] ?>&st=<?= $fetcRsk['status'] ?>" class="btn lunasi">Lunasi</a></td>

			      				<?php
			      				} ?>
			      			</tr>	

				      		<?php } ?>

			      		</tbody>
			      	</table>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  </div>
			       


			  <!-- Modal Structure -->
			  <div id="brgHilang" class="modal card-panel r-modal" style="overflow: auto;">
			    <div class="modal-content">
			      	<table class="striped">
			      		<h5 class="center"><b>Barang pinjaman yang hilang</b></h5>
			      		<br>
			      		<thead>
			      			<tr>
			      				<th>No</th>
			      				<th>Nama Barang</th>
			      				<th>Nama Peminjam</th>
			      				<th>Biaya Ganti</th>
			      				<th>Aksi</th>
			      			</tr>
			      		</thead>
			      		<tbody>

			      			<?php 
			      				$x = 1;
			      				$sqlHlng = $conx->query("SELECT * FROM barang
			      										INNER JOIN peminjaman ON peminjaman.id_brg = barang.id_brg
			      										INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
			      										 WHERE kondisi = 'Hilang'");

			      				while ($fetcHilang = $sqlHlng->fetch_array()) {
			      			 ?>
			      			
			      			<tr>
			      				<td><?= $x++ ?></td>
			      				<td><?= $fetcHilang['nm_brg'] ?></td>
			      				<td><?= $fetcHilang['nm_lengkap'] ?></td>
			      				<td><p class="red-text">Rp. <?= number_format($fetcHilang['harga_beli']) ?></p></td>

			      				<?php if ($fetcHilang['status'] == '2') {
			      				?>

				      				<td><p class="grey-text">Telah Lunas</p></td>

			      				<?php
			      				}else {
			      				?>
				      			
				      				<td><a href="?id_p=<?= $fetcHilang['id_pinjam'] ?>&st=<?= $fetcHilang['status'] ?>" class="btn">Lunasi</a></td>

			      				<?php
			      				} ?>

			      			</tr>

				      		<?php } ?>

			      		</tbody>
			      	</table>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  <!-- </div> -->
			  </div>
<!-- ----------------- Akhir Modal-modal Transaksi Hari Ini ------------------- -->


<!-- ----------------- Modal-modal Transaksi Hari Ini ------------------- -->


			  <!-- Modal Structure -->
			  <div id="psnSkrg" class="modal card-panel r-modal" style="overflow: auto;">
			    <div class="modal-content">
			      	<table class="striped">
			      		<h5 class="center"><b>Peminjaman yang dipesan hari Ini</b></h5>
			      		<thead>
			      			<tr>
			      				<th>No</th>
			      				<th>Nama Barang</th>
			      				<th>Nama Peminjam</th>
			      			</tr>
			      		</thead>
			      		<tbody>

			      			<?php 
			      				$x = 1;
			      				$sqlPsn = $conx->query("SELECT * FROM peminjaman
			      										INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
			      										INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
			      										 WHERE tgl_masuk = CURDATE() AND status = '0'");

			      				while ($fetcPesan = $sqlPsn->fetch_array()) {
			      			 ?>
			      			
			      			<tr>
			      				<td><?= $x++ ?></td>
			      				<td><?= $fetcPesan['nm_brg'] ?></td>
			      				<td><?= $fetcPesan['nm_lengkap'] ?></td>
			      			</tr>

				      		<?php } ?>

			      		</tbody>
			      	</table>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  <!-- </div> -->
			  </div>
			       


			  <!-- Modal Structure -->
			  <div id="pjmSkrg" class="modal card-panel r-modal" style="overflow: auto;">
			    <div class="modal-content">
			      	<table class="striped">
			      		<h5 class="center"><b>Peminjaman yang dipinjam hari Ini</b></h5>
			      		<thead>
			      			<tr>
			      				<th>No</th>
			      				<th>Nama Barang</th>
			      				<th>Nama Peminjam</th>
			      			</tr>
			      		</thead>
			      		<tbody>

			      			<?php 
			      				$x = 1;
			      				$sqlPjm = $conx->query("SELECT * FROM peminjaman
			      										INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
			      										INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
			      										 WHERE tgl_masuk = CURDATE() AND status = '1'");

			      				while ($fetcPinjam = $sqlPjm->fetch_array()) {
			      			 ?>
			      			
			      			<tr>
			      				<td><?= $x++ ?></td>
			      				<td><?= $fetcPinjam['nm_brg'] ?></td>
			      				<td><?= $fetcPinjam['nm_lengkap'] ?></td>
			      			</tr>

				      		<?php } ?>

			      		</tbody>
			      	</table>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  <!-- </div> -->
			  </div>
			       

			       
			  <!-- Modal Structure -->
			  <div id="selsSkrg" class="modal card-panel r-modal" style="overflow: auto;">
			    <div class="modal-content">
			      	<table class="striped">
			      		<h5 class="center"><b>Peminjaman yang dikembalikan hari Ini</b></h5>
			      		<thead>

			      			<tr>
			      				<th>No</th>
			      				<th>Nama Barang</th>
			      				<th>Nama Peminjam</th>
			      			</tr>
			      		</thead>
			      		<tbody>

			      			<?php 
			      				$x = 1;
			      				$sqlSels = $conx->query("SELECT * FROM peminjaman
			      										INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
			      										INNER JOIN akun_pengguna ON akun_pengguna.id_akun = peminjaman.id_akun
			      										 WHERE tgl_kembali = CURDATE() AND status = '2'");

			      				while ($fetcSelesai = $sqlSels->fetch_array()) {
			      			 ?>
			      			
			      			<tr>
			      				<td><?= $x++ ?></td>
			      				<td><?= $fetcSelesai['nm_brg'] ?></td>
			      				<td><?= $fetcSelesai['nm_lengkap'] ?></td>
			      			</tr>

				      		<?php } ?>

			      		</tbody>
			      	</table>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  <!-- </div> -->
			  </div>
			       

 <script>
 	let myChart = document.getElementById('myChart').getContext('2d');
 	let massPopChart = new Chart(myChart, {
 		type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
 		data:{
 			labels:[
 			
		<?php 
			for ($x=6; $x > 0; $x--) { 
			$sett 	= mktime(0,0,0,date("n"),date("j")-$x,date("Y"));
			$tgl 	= date("d-M", $sett);
		?>

 						'<?= $tgl ?>',
		
		<?php 
			}
		?>
 			
 						'Hari Ini'
 					],
 			datasets:[{
 				label: 'Jumlah Peminjam',
 				data: [

		<?php 
			for ($z=6; $z > 0; $z--) {
			$sett 		= mktime(0,0,0,date("n"),date("j")-$z,date("Y"));
			$tgl 		= date("Y-m-d", $sett);
			$sqlChart	= $conx->query("SELECT COUNT(id_pinjam) AS jml_pnjm FROM peminjaman WHERE tgl_masuk = '$tgl'");
			$dateAssc 		= mysqli_fetch_assoc($sqlChart);
		 ?>

 						'<?= $dateAssc['jml_pnjm'] ?>',

		<?php
			}
			$dateNow 	= date("Y-m-d");
			$sqlChart2	= $conx->query("SELECT COUNT(id_pinjam) AS jml_pnjm FROM peminjaman WHERE tgl_masuk = '$dateNow'");
			$dateAssc2 		= mysqli_fetch_assoc($sqlChart2);
		?>

 						'<?= $dateAssc2['jml_pnjm'] ?>',
 					],
 				// backgroundColor: 'rgba(102,0,255,.6)'
 				backgroundColor: [
 									'rgba(78,84,200,.75)',
 									// 'rgba(143,43,235,.6)',
 									// 'rgba(132,140,115,.6)',
 									// 'rgba(12,210,35,.6)',
 									// 'rgba(21,130,25,.6)',
 									// 'rgba(122,10,55,.6)'
 								],
 				hoverBorderWidth: 1,
 				hoverBorderColor: 'red'
 			}],
 		},
 		options: {
 			title: {
 				display: true,
 				text: 'Data Statistik Jumlah Peminjam Dalam Seminggu'
 			},
 			legend: {
 				position: 'right',
 				display: false
 			},
 			animation: {
 				animateScale: true
 			}
 		}
 	});
 </script>

 <?php 

include "footer.php";

 ?>