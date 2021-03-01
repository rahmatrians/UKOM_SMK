<?php 

include "header.php";

if ($jabatan != "Pengelola") {
	header('location: ../ukom_rahmat/');
}


	$kd = kodeOtomatis("id_akun","akun_pengguna","A");

	if (isset($_SESSION['alert'])) {
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);
	}

	// membuat pagination
	$hitngTtlData 	= kueri("COUNT(*) AS ttl", "akun_pengguna");
	$fetchData 			= $hitngTtlData->fetch_array();
	$jmlData		= $fetchData['ttl'];
	$jmlPerhlmn		= 10;
	$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
	$halmnAktif 	= (isset($_GET['hal'])? $_GET['hal']: "1");
	$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;

	if (isset($_POST['save'])) {
		var_dump($id_akun 	= $_POST['id_akun'],
		$nm_lengkap 	= $_POST['nm_lengkap'],
		$nm_pengguna 	= $_POST['nm_pengguna'],
		$kata_sandi 	= $_POST['kata_sandi'],
		$kelamin 	= $_POST['kelamin'],
		$no_telp 	= $_POST['no_telp'],
		$alamat 	= $_POST['alamat'],
		$id_jab 	= $_POST['id_jab']);
		$data 	= "'$kd', '$nm_lengkap', '$nm_pengguna', '$kata_sandi', '$kelamin', '$no_telp', '$alamat', '$id_jab'";
		$tabel = "akun_pengguna";
		$sql 	= tambah($tabel, $data, "akun");
	}


	if (isset($_GET['ubah'])) {
		$id_akun = $_GET['ubah'];

		$ubah 	= kueriDimana("*","akun_pengguna","id_akun = '$id_akun'");
	}

	if (isset($_POST['update'])) {
		if (empty($_POST['kata_sandi'])) {
			
		var_dump($id_akun 	= $_POST['id_akun'],
		$nm_lengkap 	= $_POST['nm_lengkap'],
		$nm_pengguna 	= $_POST['nm_pengguna'],
		$kelamin 	= $_POST['kelamin'],
		$no_telp 	= $_POST['no_telp'],
		$alamat 	= $_POST['alamat'],
		$id_jab 	= $_POST['id_jab']);

		$sql 	= $conx->query("UPDATE akun_pengguna SET 
												id_akun 			= '$id_akun',
												nm_lengkap 			= '$nm_lengkap',
												nm_pengguna 		= '$nm_pengguna',
												kelamin 		= '$kelamin',
												no_telp 		= '$no_telp',
												alamat 		= '$alamat',
												id_jab 		= '$id_jab'
								 WHERE id_akun = '$id_akun'");
		}else {
			$id_akun 	= $_POST['id_akun'];
		$nm_lengkap 	= $_POST['nm_lengkap'];
		$nm_pengguna 	= $_POST['nm_pengguna'];
		$kata_sandi 	= md5($_POST['kata_sandi']);
		$kelamin 	= $_POST['kelamin'];
		$no_telp 	= $_POST['no_telp'];
		$alamat 	= $_POST['alamat'];
		$id_jab 	= $_POST['id_jab'];

		$sql 	= $conx->query("UPDATE akun_pengguna SET 
												id_akun 			= '$id_akun',
												nm_lengkap 			= '$nm_lengkap',
												nm_pengguna 		= '$nm_pengguna',
												kata_sandi 		= '$kata_sandi',
												kelamin 		= '$kelamin',
												no_telp 		= '$no_telp',
												alamat 		= '$alamat',
												id_jab 		= '$id_jab'
								 WHERE id_akun = '$id_akun'");
		}

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
		header('location: akun.php');
	}

	if (isset($_GET['hapus'])) {
		$id_akun 	= $_GET['hapus'];

		$sql 	= hapus("akun_pengguna","id_akun",$id_akun, "akun");
	}

 ?>

<div class="row">
	<div class="col l4 s12">
		<div class="card-panel">


 <form action="" method="POST" autocomplete="off">

<div class="input-field">
	<label for="id_akun">ID Akun</label>
	<input type="text" name="id_akun" id="id_akun" value="<?php 
	if(isset($ubah)){
	echo $ubah['id_akun'];
	}else{
		echo $kd;
	} 
	?>" disabled>
	<input type="text" name="id_akun" id="id_akun" value="<?php 
	if(isset($ubah)){
	echo $ubah['id_akun'];
	}else{
		echo $kd;
	} 
	?>" hidden>
</div>

<div class="input-field">
	<label for="nm_lengkap">Nama Lengkap</label>
	<input type="text" name="nm_lengkap" id="nm_lengkap" value="<?php 
	 			if(isset($ubah)){
						echo $ubah['nm_lengkap'];
					}
	?>" required>
</div>

<div class="input-field">
	<label for="nm_pengguna">Nama Pengguna</label>
	<input type="text" name="nm_pengguna" id="nm_pengguna" value="<?php 
	 			if(isset($ubah)){
						echo $ubah['nm_pengguna'];
					}
	?>" required>
</div>

<div class="input-field">
	<label for="kata_sandi">Kata Sandi</label>
	<input type="password" name="kata_sandi" id="kata_sandi" value="" <?php if(isset($ubah)){
						echo "";
					}else{"required";} ?> >
</div>

<div class="input-field">
		<select name="kelamin" id="kelamin">
		<?php 
			if ($_GET['klmn'] == 'Laki-laki') {
		?>

			<option value="Laki-laki" selected>Laki-laki</option>
			<option value="Perempuan">Perempuan</option>
		
		<?php
			}elseif ($_GET['klmn'] == 'Perempuan') {
		?>	

			<option value="Perempuan" selected>Perempuan</option>
			<option value="Laki-laki">Laki-laki</option>
		
		<?php
			}else {
		 ?>

			<option disabled selected></option>
			<option value="Perempuan">Perempuan</option>
			<option value="Laki-laki">Laki-laki</option>

		<?php
			}
		 ?>

		</select>
		<label for="kelamin">Jenis Kelamin</label>
</div>

<div class="input-field">
	<label for="no_telp">Nomor Telepon</label>
	<input type="number" name="no_telp" id="no_telp" value="<?php 
	 			if(isset($ubah)){
						echo $ubah['no_telp'];
					}
	?>" required>
</div>

<div class="input-field">
	
	<label for="alamat">Alamat</label>
	<textarea class="materialize-textarea" name="alamat" id="alamat"><?php if(isset($ubah)){echo $ubah['alamat'];} ?></textarea>
</div>

	
<div class="input-field">
		<select name="id_jab" id="id_jab">
		<option selected></option>
			<?php 
				$jns 	= kueri("*","jabatan");
				foreach ($jns as $row) {
					if (isset($ubah)) {
						if ($row['id_jab'] == $_GET['jbt']) {
		?>

			<option value="<?= $row['id_jab'] ?>" selected><?= $row['nm_jab'] ?></option>
		
		<?php
						}
				}
			 ?>					
			<option value="<?= $row['id_jab'] ?>"><?= $row['nm_jab'] ?></option>
		
		<?php
				}
			 ?>
		</select>
		<label for="id_jab">Jabatan</label>
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

<h4>Data akun</h4>
 <table border="1" class="striped" id="striped">
 	<thead>
	 	<tr>
	 		<th>ID akun</th>
	 		<th>Nama akun</th>
	 		<th>Nama Pengguna</th>
	 		<th>Jenis Kelamin</th>
	 		<th>Nomor Telepon</th>
	 		<th>Alamat</th>
	 		<th>Aksi</th>
	 		<th></th>
	 	</tr>
 	</thead>
<tbody>
 	<?php 
 		$sql 	= $conx->query("SELECT * FROM akun_pengguna ORDER BY id_akun DESC");

 		while ($row = $sql->fetch_array()) {
	?>

	<tr>
 		<td><?= $row['id_akun'] ?></td>
 		<td><?= $row['nm_lengkap'] ?></td>
 		<td><?= $row['nm_pengguna'] ?></td>
 		<td><?= $row['kelamin'] ?></td>
 		<td><?= $row['no_telp'] ?></td>
 		<td><?= $row['alamat'] ?></td>
 		<td><a class="btn orange" href="?ubah=<?= $row['id_akun'] ?>&klmn=<?= $row['kelamin'] ?>&jbt=<?= $row['id_jab'] ?>">Ubah</a></td>
		<td><a class="btn r-delete" href="?hapus=<?= $row['id_akun'] ?>">Hapus</a></td>
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