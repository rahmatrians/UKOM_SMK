<?php 

include "header.php";

if ($jabatan == "Anggota") {
	header('location: ../ukom_rahmat/');
}

	if (isset($_SESSION['alert'])) {
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);
	}

	// membuat pagination
	$hitngTtlData 	= kueri("COUNT(*) AS ttl", "distributor");
	$fetchData 			= $hitngTtlData->fetch_array();
	$jmlData		= $fetchData['ttl'];
	$jmlPerhlmn		= 10;
	$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
	$halmnAktif 	= (isset($_GET['hal'])? $_GET['hal']: "1");
	$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;

	$kd = kodeOtomatis("id_dist","distributor","D");

	if (isset($_POST['save'])) {
		$nm_dist 	= ucfirst($_POST['nm_dist']);
		$telp_dist 	= $_POST['telp_dist'];
		$almt_dist 	= $_POST['almt_dist'];
		$data 	= "'$kd', '$nm_dist', '$telp_dist', '$almt_dist'";
		$tabel = "distributor";
		$sql 	= tambah($tabel, $data, "distributor");

		// if ($sql) {
		// 	$kd = kodeOtomatis("id_dist","distributor","D");
		// }
	}


	if (isset($_GET['ubah'])) {
		$id_dist = $_GET['ubah'];

		$ubah 	= kueriDimana("*","distributor","id_dist = '$id_dist'");
	}

	if (isset($_POST['update'])) {
		$id_dist 	= $_POST['id_dist'];
		$nm_dist 	= $_POST['nm_dist'];
		$telp_dist 	= $_POST['telp_dist'];
		$almt_dist 	= $_POST['almt_dist'];

		$sql 	= $conx->query("UPDATE distributor SET 
												id_dist 	= '$id_dist',
												nm_dist 	= '$nm_dist',
												telp_dist 	= '$telp_dist',
												almt_dist 	= '$almt_dist'
								 WHERE id_dist = '$id_dist'");
		if ($sql) {
			$_SESSION['alert'] = "
				<script>
					new Noty({
						text 			: 'Telah Berhasil Diubah',
						type 			: 'success',
						theme 			: 'nest',
						layout			: 'bottomRight',
						timeout 		: '3000',
						" . $animasi . "
						}).show();
				</script>
			";
		}
		header('location: distributor.php');
	}

	if (isset($_GET['hapus'])) {
		$id_dist 	= $_GET['hapus'];
		

		$sql 	= hapus("distributor","id_dist",$id_dist, "distributor");
	}

 ?>
<div class="row">	
 <div class="col l4 s12">
 <div class="card-panel">
 	
 <form action="" method="POST" autocomplete="off">
	 	<div class="input-field">
	 		<label for="id_dist">ID distributor</label>
 			<input type="text" name="id_dist" id="id_dist" value="<?php 
 			if(isset($ubah)){
						echo $ubah['id_dist'];
						}else{
							echo $kd;
						} 
 			?>" disabled>
 			
 			<input type="text" name="id_dist" id="id_dist" value="<?php 
 			if(isset($ubah)){
						echo $ubah['id_dist'];
						}else{
							echo $kd;
						} 
 			?>" hidden>
	 	</div>

 		<div class="input-field">
	 		<label for="nm_dist">Nama distributor</label>
 			<input type="text" name="nm_dist" id="nm_dist" value="<?php 
			 			if(isset($ubah)){
								echo $ubah['nm_dist'];
							}
 			?>" required>
	 		
	 	</div>

 		<div class="input-field">
			<label for="telp_dist">Telepon distributor</label>
 			<input type="number" name="telp_dist" id="telp_dist" value="<?php 
			 			if(isset($ubah)){
								echo $ubah['telp_dist'];
							}
 			?>" required>	 		
	 	</div>

 		<div class="input-field">
	 		<label for="almt_dist">Alamat distributor</label>
 			<textarea class="materialize-textarea" name="almt_dist" id="almt_dist">
			 				<?php 
					 			if(isset($ubah)){
										echo $ubah['almt_dist'];
							}
 			?>
 			</textarea>
	 	</div>

 		<div class="input-field">
	 		<button class="btn" type="submit" name="<?php 
						if(isset($ubah)){
								echo 'update';
							}else{
								echo 'save';
						} 
 			?>">Simpan</button>
	 	</div> 		
 </form>

 </div>
 </div>

<div class="col l8 s12">
 <div class="card-panel">

<h4>Data Distributor</h4>
 <table class="striped" id="striped">
 	<thead>
	 	<tr>
	 		<th>ID distributor</th>
	 		<th>Nama distributor</th>
	 		<th>Telepon distributor</th>
	 		<th>Alamat distributor</th>
	 		<th>Aksi</th>
	 		<th></th>
	 	</tr>
 	</thead>
 	<tbody>

 	<?php 
 		$sql 	= kueri("*","distributor");
 		while ($row = $sql->fetch_array()) {
	?>

	<tr>
 		<td><?= $row['id_dist'] ?></td>
 		<td><?= $row['nm_dist'] ?></td>
 		<td><?= $row['telp_dist'] ?></td>
 		<td><?= $row['almt_dist'] ?></td>
 		<td><a class="btn orange" href="?ubah=<?= $row['id_dist'] ?>">Ubah</a></td>
 		<td><a class="btn r-delete" href="?hapus=<?= $row['id_dist'] ?>">Hapus</a></td>
 	</tr>

	<?php
 		}
 	 ?>

  	</tbody>
 </table>


	<br>
	<br>

<div class="right">
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
</div>

<?php 

include "footer.php";

 ?>