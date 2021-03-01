
<?php 

	include "fungsi.php";

		$key = $_GET['keyword'];
		$id_jns = $_GET['id_jns'];
		$sql = $conx->query("SELECT * FROM barang WHERE id_jenis = '$id_jns' AND nm_brg LIKE '%$key%'");

	while ($row = $sql->fetch_array()) {
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
					$sql2 	= kueri("*","barang");
			 		while ($row2 = $sql2->fetch_array()) {
			 ?>

			  <!-- Modal Structure -->
			  <div id="<?= $row2['id_brg'] ?>" class="modal card-panel r-modal">
			  	<div class="col l6 s12">
			  	<div class="card-image r-img-card">
			  	
			  		<?php if ($row2['gambar'] == NULL): ?>
		          
		          <img src="images/INVAL-O.png" style="opacity: .3;" class="r-img-brg">
							  			
			  		<?php else : ?>
		        
		          <img src="img_barang/<?= $row2['gambar'] ?>" class="r-img-brg">
			  	
			  		<?php endif ?>
		        
		          <!-- <span class="card-title"></span> -->
		        </div>
			  	</div>
			  	<div class="col l6 s12 right">
			    <div class="modal-content">
			      <h4><b><?= $row2['nm_brg'] ?></b></h4>
			      <br>
			      <h6><b>Kondisi</b><br><?= $row2['kondisi'] ?></h6>
			      <h6><b>Sumber Dana</b><br><?= $row2['sumber_dana'] ?></h6>
			      <div class="r-brg-btn">

					<?php 
				 				$tbl 	= $conx->query("SELECT * FROM peminjaman WHERE id_brg = '" . $row2['id_brg'] . "' AND status !=2");
				 				$hitung = mysqli_num_rows($tbl);

				 				$maks 	= $conx->query("SELECT * FROM peminjaman WHERE id_akun = '".$_SESSION['id']."' AND status !=2");
				 				$maks_pmj = mysqli_num_rows($maks);

				 				if ($hitung > 0) {
					?>
				 			
						 			<p>Sedang Dipinjam</p>

					<?php
				 				}elseif($row2['kondisi'] == 'Hilang') {
					?>

									<p>Tidak ada</p>

					<?php
				 				}elseif($row2['kondisi'] == 'Rusak') {
					?>

									<p>Tidak Bisa</p>

					<?php
				 				}elseif($maks_pmj >= 2) {
					?>

				    	 	 	<p>Maksimal Peminjaman <b>2 Kali</b></p>
			  
					<?php
								}else{
					?>

				    	 	 	<a class="waves-effect waves-light btn" href="pros_pinjam.php?brg=<?= $row2['id_brg'] ?>">Buat Pesanan</a>

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
				}
			 ?>


<script>

	$(document).ready(function() {
		$('#searchBox').on('keyup', function() {
			$('#data').load('ls_detail_barang.php?id_jns=<?= $id_jns ?>&keyword=' + $('#searchBox').val());
		});
	});
</script>


			  <?php 

include "footer.php";

  ?>