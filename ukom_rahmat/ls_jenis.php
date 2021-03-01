
<?php 

	include "koneksi.php";

		$key = $_GET['keyword'];
		$sql = $conx->query("SELECT * FROM jenis WHERE nm_jenis LIKE '%$key%'");

	while ($row = $sql->fetch_array()) {
?>

		<div class="col l4 m6 s12">
		<div class="card-panel r-box">
					
					<div class="col l9 m9 s9">
						<br>
						<div class="col l12 m12 s12 ">
							<p><b><?= $row['nm_jenis'] ?></b></p>
						</div><!-- 
						<div class="col l12 m12 s12 ">
							<img src="images/male.png" style="width: 60px;">
						</div> -->

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