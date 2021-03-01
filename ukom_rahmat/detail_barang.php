<?php 

include "header.php";

if (empty($_GET['id'])) {
	header('location: ../ukom_rahmat/');
}

$id_jns 	= $_GET['id'];

	// membuat pagination
	if (isset($_POST['cariData'])) {
		$cariDt = $_POST['cari'];
		$dt 			= "AND nm_brg LIKE '%".$cariDt."%'";
	}else {
		$dt 			= "";
	}
	$hitngTtlData 	= kueri("COUNT(*) AS ttl", "barang WHERE id_jenis = '$id_jns' $dt");
	$fetchData 			= $hitngTtlData->fetch_array();
	$jmlData		= $fetchData['ttl'];
	$jmlPerhlmn		= 9;
	$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
	$halmnAktif 	= (isset($_GET['hal'])? $_GET['hal']: "1");
	$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;



 ?>

<!-- <div class="container"> -->
	<div class="row" id="data">

<div class="col l12 m12 s12">
	<h5>Barang</h5>
</div>

 	<?php 
 		if ($jabatan == 'Anggota') {
				if (isset($_POST['cariData'])) {
					$cariDt = $_POST['cari'];
					$sql = kueri("*", "barang WHERE id_jenis = '$id_jns' AND nm_brg LIKE '%".$cariDt."%'");
				}else {
					$sql 	= kueri("*", "barang WHERE id_jenis = '$id_jns'");
				}
		}
		// $sql 	= $conx->query("SELECT * FROM barang WHERE id_jenis = '$id_jns'");
 		foreach ($sql as $row) {
	?>

		<div class="col l4 m6 s12">
			
		<div class="card-panel r-box">
					
				<div class="col l7 m7 s7">
					<p class="r-text-brg"><b><?= $row['nm_brg'] ?></b></p>
					<a class="waves-effect waves-light btn modal-trigger left" href="#<?= $row['id_brg'] ?>">Lihat</a>
					

				</div>

				<div class="col l4 m4 s4 right">
					<br>
					<?php if ($row['gambar'] == NULL): ?>
						<img class="r-gbr-brg" src="images/INVAL-O.png" style="opacity: .3;">
					<?php else : ?>
						<img class="r-gbr-brg" src="img_barang/<?= $row['gambar'] ?>">
					<?php endif ?>
				
				</div>
			
		</div>
			
		</div>

			<?php 
					$sql 	= kueri("*","barang");
			 		while ($row = $sql->fetch_array()) {
			 ?>

			  <!-- Modal Structure -->
			  <div id="<?= $row['id_brg'] ?>" class="modal card-panel r-modal">
			  	<div class="col l6 s12">
			  	<div class="card-image r-img-card">
			  	
			  		<?php if ($row['gambar'] == NULL): ?>
		          
		          <img src="images/INVAL-O.png" style="opacity: .3;" class="r-img-brg">
							  			
			  		<?php else : ?>
		        
		          <img src="img_barang/<?= $row['gambar'] ?>" class="r-img-brg">
			  	
			  		<?php endif ?>
		        
		          <!-- <span class="card-title"></span> -->
		        </div>
			  	</div>
			  	<div class="col l6 s12 right">
			    <div class="modal-content">
			      <table class="striped">
				      <center><h4><b><?= $row['nm_brg'] ?></b></h4></center>
				      <hr>
			    		<thead>
			    			<tr>
			    				<th>Kondisi</th>
			    				<td><h6><?= $row['kondisi'] ?></h6></td>
			    			</tr>
			    			<tr>
			    				<th>Sumber Dana</th>
			    				<td><h6><?= $row['sumber_dana'] ?></h6></td>
			    			</tr>
			    		</thead>
			    	</table>			   
			      <div class="r-brg-btn">

					<?php 
				 				$tbl 	= $conx->query("SELECT * FROM peminjaman WHERE id_brg = '" . $row['id_brg'] . "' AND status !=2");
				 				$hitung = mysqli_num_rows($tbl);

				 				$maks 	= $conx->query("SELECT * FROM peminjaman WHERE id_akun = '$id' AND status !=2");
				 				$maks_pmj = mysqli_num_rows($maks);

				 				if ($hitung > 0) {
					?>
				 			
						 			<p>Sedang Dipinjam</p>

					<?php
				 				}elseif($row['kondisi'] == 'Hilang') {
					?>

									<p>Tidak ada</p>

					<?php
				 				}elseif($row['kondisi'] == 'Rusak') {
					?>

									<p>Tidak Bisa</p>

					<?php
				 				}elseif($maks_pmj >= 2) {
					?>

				    	 	 	<p>Maksimal Peminjaman <b>2 Kali</b></p>
			  
					<?php
								}else{
					?>

				    	 	 	<a class="waves-effect waves-light btn" href="pros_pinjam.php?brg=<?= $row['id_brg'] ?>">Buat Pesanan</a>

					<?php
								}
			      ?>
			  
			      </div>
			    </div>
			    <!-- <div class="modal-footer"> -->
			    <!-- </div> -->
			  	</div>
			  </div>
			       
			<?php 
					}
			 ?>

	<?php
 		}
 	 ?>

<div class="col l12 m12 s12 center">
 <ul class="pagination r-pagination">

<?php if ($halmnAktif > 1) { ?>
 	
 	<li class="waves-effect"><a href="?id=<?= $id_jns ?>&hal=<?= $halmnAktif - 1 ?>"><i class="material-icons">chevron_left</i></a></li>

<?php } ?>

<?php 
	for ($p = 1; $p <= $rumusPage; $p++) : 
		if ($p == $halmnAktif) :
?>

 	<li class="active"><a href="?id=<?= $id_jns ?>&hal=<?= $p ?>"><?= $p ?></a></li>

<?php
		else :
?>
 	<li class="waves-effect"><a href="?id=<?= $id_jns ?>&hal=<?= $p ?>"><?= $p ?></a></li>

<?php
		endif;
	endfor;
 ?>

 
<?php if ($halmnAktif < $rumusPage) { ?>
 	
 	<li class="waves-effect"><a href="?id=<?= $id_jns ?>&hal=<?= $halmnAktif + 1 ?>"><i class="material-icons">chevron_right</i></a></li>

<?php } ?>

 </ul>
</div>


	</div>
<!-- </div> -->

<!-- ----------------- live Search ------------------------------------ -->

<!-- <script>

	$(document).ready(function() {
		$('#searchBox').on('keyup', function() {
			$('#data').load('ls_detail_barang.php?id_jns=<?= $id_jns ?>&keyword=' + $('#searchBox').val());
		});
	});
</script> -->

 <?php 

include "footer.php";

  ?>