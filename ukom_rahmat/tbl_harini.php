<?php 

	// membuat pagination
	$hitngTtlData 	= kueri("COUNT(*) AS ttl", "peminjaman WHERE peminjaman.tgl_masuk = CURDATE() OR peminjaman.tgl_kembali = CURDATE()");
	$fetchData 			= $hitngTtlData->fetch_array();
	$jmlData		= $fetchData['ttl'];
	$jmlPerhlmn		= 10;
	$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
	$halmnAktif 	= (isset($_GET['hal_ini'])? $_GET['hal_ini']: "1");
	$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;

 ?>

<table class="striped">
	<thead>
		<tr>
			<th>ID Pinjam</th>
			<th>Nama Peminjam</th>
			<th>Nama Barang</th>
			<th>Tanggal Pesan</th>
			<th>Tanggal Kembali</th>
<?php 

	$pj 	= $conx->query("SELECT * FROM peminjaman 
							INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
							INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
							WHERE barang.kondisi = 'Baik' AND peminjaman.tgl_masuk = CURDATE() OR peminjaman.tgl_kembali = CURDATE() ORDER BY status ASC");
	if ($jabatan == "Pengelola") {
						?>
			<th>Aksi</th>
<?php 
}
?>
		</tr>
	</thead>
<tbody>
	<?php 
	while($row = $pj->fetch_array()) {
	?>
	<tr>
		<td><?= $row['id_pinjam'] ?></td>
		<td><a class='sidenav-trigger' data-target='tbl_hariini_<?= $row['id_akun'] ?>'><?= $row['nm_pengguna'] ?></a></td>
		<td><a class='sidenav-trigger' data-target='tbl_hariini_<?= $row['id_brg'] ?>'><?= $row['nm_brg'] ?></a></td>
		<td><?= $row['tgl_masuk'] ?></td>
		<td><?= $row['tgl_kembali'] ?></td>
			<?php 
	if ($jabatan == "Pengelola") {
				switch ($stat = $row['status']) {
					case '0':
						$stat = "<a class='btn' href='?id=" . $row['id_pinjam'] . "&st=" . $row['status'] . "'>Pinjamkan</a>";
						break;

					case '1':
						$stat = "<a class='btn sidenav-trigger' data-target='kondisikuh'>Kembalikan</a>";
						// $stat = "<a class='btn orange' href='?id=" . $row['id_pinjam'] . "&st=" . $row['status'] . "'>Kembali</a>";
						break;
					
					default:
						$stat = "<p>Selesai</p>";
						break;
				}
			 ?>
			 <td><?= $stat ?></td>
	</tr>

<?php 
			}
	if ($jabatan != "Anggota") {
 ?>
<div id="tbl_hariini_<?= $row['id_akun'] ?>" class="sidenav r-detail-pmjm">
	<div class="card-panel">
		<h6 class="pink-text"><b><?= $row['nm_lengkap'] ?></b></h6>
			<br>
		<p class="grey-text"><b>ID Akun</b> <?= $row['id_akun'] ?></p>
		<p class="grey-text"><b>No Telp</b> <?= $row['no_telp'] ?></p>
		<p class="grey-text"><b>Alamat</b> <?= $row['alamat'] ?></p>
	</div>
</div>

<div id="kondisikuh" class="sidenav r-detail-pmjm">
<form action="index.php" method="POST">
<div class="card-panel" style="margin-top: 25vh; height: 250px;">
	<p class="center"><b>Keadaan Barang</b></p>
	<div class="input-field">
		<input type="text" name="id" value="<?= $row['id_pinjam'] ?>" hidden>
	</div>
	<div class="input-field">
		<input type="text" name="brg" value="<?= $row['id_brg'] ?>" hidden>
	</div>
	<div class="input-field">
		<input type="text" name="st" value="<?= $row['status'] ?>" hidden>
	</div>
	<div class="input-field">
		<button type="submit" class="btn" name="kndsBaik">Baik</button>
	</div>
	<div class="input-field">
		<button type="submit" class="btn" name="kndsRusak">Rusak</button>
	</div>
	<div class="input-field">
		<button type="submit" class="btn" name="kndsHilang">Hilang</button>
	</div>
</div>
</form>
</div>

<div id="tbl_hariini_<?= $row['id_brg'] ?>" class="sidenav r-detail-pmjm">
	<div class="card-panel">
		<h6 class="pink-text"><b><?= $row['nm_brg'] ?></b></h6>
		<center>
			<img style="width: 150px;" src="../ukom_rahmat/img_barang/<?= $row['gambar'] ?>">
		</center>
		<p class="grey-text"><b>ID Barang</b> <?= $row['id_brg'] ?></p>
		<p class="grey-text"><b>Kondisi</b> <?= $row['kondisi'] ?></p>
		<p class="grey-text"><b>Sumber Dana</b> <?= $row['sumber_dana'] ?></p>
	</div>
</div>


	<?php
		}
}
	 ?>
</tbody>
</table>

<div class="right">
 <ul class="pagination r-pagination">

<?php if ($halmnAktif > 1) { ?>
 	
 	<li class="waves-effect"><a href="?hal_ini=<?= $halmnAktif - 1 ?>"><i class="material-icons">chevron_left</i></a></li>

<?php } ?>

<?php 
	for ($p = 1; $p <= $rumusPage; $p++) : 
		if ($p == $halmnAktif) :
?>

 	<li class="active"><a href="?hal_ini=<?= $p ?>"><?= $p ?></a></li>

<?php
		else :
?>
 	<li class="waves-effect"><a href="?hal_ini=<?= $p ?>"><?= $p ?></a></li>

<?php
		endif;
	endfor;
 ?>

 
<?php if ($halmnAktif < $rumusPage) { ?>
 	
 	<li class="waves-effect"><a href="?hal_ini=<?= $halmnAktif + 1 ?>"><i class="material-icons">chevron_right</i></a></li>

<?php } ?>

 </ul>
</div>