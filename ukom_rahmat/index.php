<?php 

include "header.php";

if (isset($_SESSION['alert'])) {
	echo $_SESSION['alert'];
	unset($_SESSION['alert']);
}

if (isset($_GET['st'])) {
	$id 	= $_GET['id'];
	$st 	= $_GET['st'];

	$sql 	= ubahStatus($id, $st);

}

// membuat pagination
if ($jabatan == 'Anggota') {
	if (isset($_POST['cariData'])) {
		$cariDt = $_POST['cari'];
		$dtJns = "WHERE nm_jenis LIKE '%".$cariDt."%'";
	}else {
		$dtJns 	= "";
	}
$hitngTtlData 	= kueri("COUNT(*) AS ttl", "jenis $dtJns");
$fetchData 		= $hitngTtlData->fetch_array();
$jmlData		= $fetchData['ttl'];
$jmlPerhlmn		= 9;
$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
$halmnAktif 	= (isset($_GET['hal'])? $_GET['hal']: "1");
$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;
}



if (isset($_POST['kndsBaik'])) {
		$id 	= $_POST['id'];
		$st 	= $_POST['st'];
		$brg 	= $_POST['brg'];
		$konds 	= 'Baik';
		$knds 	= $conx->query("UPDATE barang SET kondisi = '$konds' WHERE id_brg = '$brg'");
		
		$sql 	= ubahStatus($id, $st);

}else if (isset($_POST['kndsRusak'])) {
		$id 	= $_POST['id'];
		$st 	= $_POST['st'] + 1;
		$brg 	= $_POST['brg'];
		$konds 	= 'Rusak';
		$knds 	= $conx->query("UPDATE barang SET kondisi = '$konds' WHERE id_brg = '$brg'");
		
		$sql 	= ubahStatus($id, $st);

}else if (isset($_POST['kndsHilang'])) {
		$id 	= $_POST['id'];
		$st 	= $_POST['st'] + 2;
		$brg 	= $_POST['brg'];
		$konds 	= 'Hilang';
		$knds 	= $conx->query("UPDATE barang SET kondisi = '$konds' WHERE id_brg = '$brg'");
		
		$sql 	= ubahStatus($id, $st);
}

$kd = kodeOtomatis("id_pinjam","peminjaman","P");


	if ($jabatan != "Anggota") {
?>


<!-- <div class="container"> -->
<div class="row">
<!-- <div class="col l4">
<div class="card-panel">
	<form action="" method="POST" autocomplete="off">
		
	<div class="input-field">
		<label for="nm_pengguna">ID Peminjam</label>
		<input type="text" name="nm_pengguna" id="id_pengguna" value="<?php echo $kd ?>" disabled>
	</div>
		
	<div class="input-field">
		<input type="text" name="nm_pengguna" id="id_pengguna" value="<?php echo $kd ?>" hidden>
	</div>
	<div class="input-field">
		<label for="nm_pengguna">Nama Peminjam</label>
		<input type="text" name="nm_pengguna" id="nm_pengguna">
	</div>
	<div class="input-field">
		<button type="submit" class="btn">Pinjam</button>
	</div>
	</form>

</div>
</div> -->


<div class="col l12">
<div class="card-panel">
<div class="col l12">
  <ul id="tabs-swipe-demo" class="tabs r-tabs">
    <li class="tab col s3"><a class="<?php 
    									if(isset($_GET['hal_ini'])){
    										echo "active";
    									}else {
    										echo "";
    									}
								     ?>" href="#hariini">Peminjaman hari ini</a></li>
    <li class="tab col s3"><a class="<?php 
    									if(isset($_GET['hal_pe'])){
    										echo "active";
    									}else {
    										echo "";
    									}
								     ?>" href="#dipesan">Sedang Dipesan</a></li>

    <li class="tab col s3"><a class="<?php 
    									if(isset($_POST['kndsBaik'])){
    										echo "active";
    									}elseif (isset($_POST['kndsRusak'])){
    										echo "active";
    									}elseif (isset($_GET['hal_pi'])){
    										echo "active";
    									}else {
    										echo "";
    									}
								     ?>" href="#dipinjam">Sedang Dipinjam</a></li>
    <li class="tab col s3"><a class="<?php 
    									if(isset($_GET['hal_ke'])){
    										echo "active";
    									}else {
    										echo "";
    									}
								     ?>" href="#dikembalikan">Telah Dikembalikan</a></li>
  </ul>
</div>

	<br>
	<br>
	<br>

	<h4>Data Peminjam</h4>

	<div id="dipesan" class="col l12">
		<?php include "tbl_dipesan.php"; ?>
	</div>
	
	<div id="dipinjam" class="col l12">
		<?php include "tbl_dipinjam.php"; ?>
	</div>

	<div id="dikembalikan" class="col l12">
		<?php include "tbl_dikembalikan.php"; ?>
	</div>

	<div id="hariini" class="col l12">
		<?php include "tbl_harini.php"; ?>
	</div>

</div>
</div>
</div>
</div>

<?php
	}
 ?>

<?php 

	if ($jabatan == "Anggota") {
?>

<!-- <div class="container"> -->

	<div class="row" id="data">

<div class="col l12 m12 s12">
	<h5>Jenis</h5>
</div>
 	<?php 
 		$nm_tbl = "jenis";
 		if ($jabatan == 'Anggota') {
							if (isset($_POST['cariData'])) {
								$cariDt = $_POST['cari'];
								$sqlJns = $conx->query("SELECT * FROM jenis WHERE nm_jenis LIKE '%".$cariDt."%'");
							}else {
								$sqlJns 	= kueri("*", $nm_tbl);
							}
		}
 		while ($row = $sqlJns->fetch_array()) {
	?>

		<div class="col l4 m6 s12">
			
		<div class="card-panel r-box">
					
					<div class="col l9 m9 s9">
						<div class="col l12 m12 s12 ">
							<br>
							<p><b><?= $row['nm_jenis'] ?></b></p>
						</div>
						<!-- <div class="col l12 m12 s12 "> -->
							<!-- <img src="images/male.png" style="width: 60px;"> -->
						<!-- </div> -->

					</div>

					<div class="col l3 m3 s3 right">
						<br>
						<br>
						<a class="waves-effect waves-light btn modal-trigger right" href="detail_barang.php?id=<?= $row['id_jenis']  ?>">Cari</a>
					</div>
				
		</div>
			
		</div>


	<?php
		}

	?>

<div class="col l12 m12 s12 center">
 <ul class="pagination r-pagination">

<?php if ($halmnAktif > 1) { ?>
 	
 	<li class="waves-effect"><a href="?hal=<?= $halmnAktif - 1 ?>"><i class="material-icons">chevron_left</i></a></li>

<?php } ?>

<?php 
	for ($p = 1; $p <= $rumusPage; $p++) : 
		if ($p == $halmnAktif) :
?>

 	<li class="active"><a href="?hal=<?= $p ?>"><?= $p ?></a></li>

<?php
		else :
?>
 	<li class="waves-effect"><a href="?hal=<?= $p ?>"><?= $p ?></a></li>

<?php
		endif;
	endfor;
 ?>

 
<?php if ($halmnAktif < $rumusPage) { ?>
 	
 	<li class="waves-effect"><a href="?hal=<?= $halmnAktif + 1 ?>"><i class="material-icons">chevron_right</i></a></li>

<?php } ?>

 </ul>
</div>

	</div>

 	 
</tbody>
</table>
 <!-- </div> -->
<!-- </div> -->

<?php 
	}
 ?>

<!-- ----------------- live Search ------------------------------------ -->

<script>


	$(document).ready(function() {
		$('#searchBox').on('keyup', function() {
			$('#data').load('ls_jenis.php?keyword=' + $('#searchBox').val());
		});
	});
</script>

<?php
include "footer.php";
 ?>