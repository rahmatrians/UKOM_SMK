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
	$hitngTtlData 	= kueri("COUNT(*) AS ttl", "jenis");
	$fetchData 			= $hitngTtlData->fetch_array();
	$jmlData		= $fetchData['ttl'];
	$jmlPerhlmn		= 10;
	$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
	$halmnAktif 	= (isset($_GET['hal'])? $_GET['hal']: "1");
	$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;

	$kd = kodeOtomatis("id_jenis","jenis","J");

	if (isset($_POST['save'])) {
		$nm_jenis 	= ucfirst($_POST['nm_jenis']);
		$data 	= "'$kd', '$nm_jenis'";
		$tabel = "jenis";
		$sql 	= tambah($tabel, $data, "jenis");

		if ($sql) {
			$kd = kodeOtomatis("id_jenis","jenis","J");
		}
	}

	if (isset($_POST['update'])) {
		var_dump($id_jenis 	= $_POST['id_jenis'],
		$nm_jenis 	= $_POST['nm_jenis']);

		$sql 	= $conx->query("UPDATE jenis SET 
												id_jenis 	= '$id_jenis',
												nm_jenis 	= '$nm_jenis'
								 WHERE id_jenis = '$id_jenis'");

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
			header('location: jenis.php');
		}
	}

	if (isset($_GET['ubah'])) {
		$id_jenis = $_GET['ubah'];

		$ubah 	= kueriDimana("*", "jenis", "id_jenis = '$id_jenis'");
	}

	if (isset($_GET['hapus'])) {
		$id_jenis 	= $_GET['hapus'];
		$cekpmj 	= $conx->query("SELECT * FROM barang WHERE id_jenis = '$id_jenis'");
			
		$alert = "
			<script>
				Swal.fire({
				  type: 'error',
				  title: 'Tidak dapat dihapus',
				  text: 'karena telah terisi data barang',
				})
			</script>";

		if (mysqli_num_rows($cekpmj) > 0) {
			
		echo $alert;

		}else {
		
		$sql 	= hapus("jenis","id_jenis",$id_jenis, "jenis");
		$sss = $conx->query("DELETE FROM barang WHERE id_jenis = '$id_jenis'");

		}
	}

 ?>
<div class="row">
<div class="col l4 s12">
<div class="card-panel">
	
 <form action="" method="POST" autocomplete="off">
 		<div class="input-field">
 			<label for="id_jenis">ID Jenis</label>
 			<input type="text" name="id_jenis" value="<?php 

 							if(isset($ubah)) {
 								echo $ubah['id_jenis'];
 							}else{
 								echo $kd;
 							}
 			 ?>" disabled>
 			 <input type="text" name="id_jenis" value="<?php 

 							if(isset($ubah)) {
 								echo $ubah['id_jenis'];
 							}else{
 								echo $kd;
 							}
 			 ?>" hidden>
 		</div>
 		
 		<div class="input-field">
 			<label for="nm_jenis">Nama Jenis</label>
 			<input type="text" name="nm_jenis" id="nm_jenis" value="<?php 
			 			if(isset($ubah)){
								echo $ubah['nm_jenis'];
							}
 			?>" required>
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


<h4>Data Jenis</h4>
 <table class="striped" id="striped">
 	<thead>
	 	<tr>
	 		<th>ID Jenis</th>
	 		<th>Nama Jenis</th>
	 		<th>Aksi</th>
	 		<th></th>
	 	</tr>
 	</thead>
<tbody>

 	<?php 
 		$sql 	= kueri("*","jenis");
 		while ($row = $sql->fetch_array()) {
	?>
	<tr>
 		<td><?= $row['id_jenis'] ?></td>
 		<td><?= $row['nm_jenis'] ?></td>
 		<td><a class="btn orange" href="?ubah=<?= $row['id_jenis'] ?>">Ubah</a></td>
 		<td><a class="btn r-delete hapus" href="?hapus=<?= $row['id_jenis'] ?>">Hapus</a></td>
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
</div>

<?php 

include "footer.php";

 ?>