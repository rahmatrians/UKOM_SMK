
<?php 

	include "fungsi.php";

		$key = $_GET['keyword'];
 		
		$sql 	= $conx->query("SELECT * FROM peminjaman
								INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
								INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
								 WHERE peminjaman.id_akun = '".$_SESSION['id']."' AND nm_brg LIKE '%$key%' ORDER BY tgl_masuk DESC");
		if (mysqli_num_rows($sql) > 0) {
	 		foreach ($sql as $row) {
	?>

		<div class="col l4 m6 s12">
			
		<div class="card-panel r-box">
					
				<div class="col l8 m8 s8">
				<div class="col l12 m12 s12">
					
					<p><b><?= $row['nm_brg'] ?></b></p>


				<?php 
				switch ($stat = $row['status']) {
					case '1':
						$stat = "<p class='left'>Sedang dipinjam</p>";
						break;

					case '2':
						$stat = "<p class='left'>Selesai</p>";
						break;

					case '3':
						$stat = "<p class='left'>Dirusakkan</p>";
						break;
						
					case '4':
						$stat = "<p class='left'>Dihilangkan</p>";
						break;
					
					default:
						$stat = "
									<a class='waves-effect waves-light btn r-delete' href='../prakom_rahmat/batal_pinjam.php?id=" . $row['id_pinjam'] . "'>Batal</a>";

						break;
				}
			 ?>
			
				</div>
				
				<div class="col l5 m5 s12">
					<a class="waves-effect waves-light btn modal-trigger" href="#<?= $row['id_brg'] ?>">Lihat</a>
				</div>

				<div class="col l5 m5 s12">
					<?= $stat ?>
				</div>

				</div>

				<div class="col l3 m3 s3">
					<br>
					<?php 
						if ($row['gambar'] == NULL) {
					 ?>
					
					<img src="images/INVAL-O.png" style="opacity: 0.3;" class="r-gbr-brg">

					<?php 
						}else {
					 ?>

					<img src="img_barang/<?= $row['gambar'] ?>" class="r-gbr-brg">

					<?php 
						}
					 ?>
				</div>

		</div>
			
		</div>

			<?php 
					$sql 	= $conx->query("SELECT * FROM peminjaman
								INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
								INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
								 WHERE peminjaman.id_akun = '".$_SESSION['id']."'");
			 		while ($row = $sql->fetch_array()) {
			 ?>

			  <!-- Modal Structure -->
			  <div id="<?= $row['id_brg'] ?>" class="modal card-panel r-modal">
			  	<div class="col l6 s12">
			  	<div class="card-image r-img-card">
			  		<?php 
						if ($row['gambar'] == NULL) {
					 ?>
					
					<img src="images/INVAL-O.png" style="width: 80px; opacity: 0.3;">
					<img src="img_barang/<?= $row['gambar'] ?>" class="r-img-brg">

					<?php 
						}else {
					 ?>

					<img src="img_barang/<?= $row['gambar'] ?>" class="r-img-brg">

					<?php 
						}
					 ?>
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
			    			<tr>
			    				<th>Tanggal Masuk</th>
			    				<td><h6><?= $row['tgl_masuk'] ?></h6></td>
			    			</tr>
			    			<tr>
			    				<th>Tanggal Kembali</th>
			    				<td><h6><?= $row['tgl_kembali'] ?></h6></td>
			    			</tr>
			    		</thead>
			    	</table>			     
			    <!-- <div class="modal-footer"> -->
			    	<div class="r-brg-btn">

			    	<?php 
				switch ($stat = $row['status']) {
					case '1':
						$stat = 'Sedang Dipinjam';
						break;

					case '2':
						$stat = 'Selesai';

						break;
					
					case '3':
						$stat = "<p class='left'>Dirusakkan</p>";
						break;
						
					case '4':
						$stat = "<p class='left'>Dihilangkan</p>";
						break;
					
					default:
						$stat = 'Dalam Pesanan';
						break;
				}
			 ?>
			
					<h6 class="grey-text"><b><?= $stat ?></b></h6>
			    </div>

			    </div>
			  	</div>
			  </div>
			       
			<?php 
					}
			 ?>

	<?php
 		}
 	}else {
 	 ?>
 	 
 	 	<div class="col l12 card-panel center"><p>Tidak ada barang yang dipinjam</p></div>

	<?php
 	}
 	include "footer.php";
 	 ?>