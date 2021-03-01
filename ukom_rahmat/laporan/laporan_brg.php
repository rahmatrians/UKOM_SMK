<?php

if (isset($_POST['cari_tgl'])) {
	$tgl1 	= $_POST['tgl1'];
	$tgl2 	= $_POST['tgl2'];

	$pj 	= $conx->query("SELECT * FROM barang WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2'");

}elseif (isset($_POST['cari_kdn'])) {
	$kdn 	= $_POST['kdn'];

	$pj 	= $conx->query("SELECT * FROM barang WHERE kondisi = '$kdn'");

}else {

$pj 	= $conx->query("SELECT * FROM barang");

}
 
 ?>


	<div class="col l4">
	<div class="card-panel">
			<h5 class="center">Cari Berdasarkan Tanggal</h5>
		<form action="" method="POST" autocomplete="off">
			<div class="input-field">
				<label for="tgl1">Tanggal Awal</label>
				<input class="datepicker" type="text" name="tgl1" id="tgl1">
			</div>
				<h6 class="center"><b>Sampai</b></h6>
			<div class="input-field">
				<label for="tgl2">Tanggal Akhir</label>
				<input class="datepicker" type="text" name="tgl2" id="tgl2">
			</div>
			<div class="input-field">
				<button type="submit" class="btn" name="cari_tgl">Cari</button>
			</div>
		</form>
	</div>

	<div class="card-panel">
			<h5 class="center">Cari Keadaan</h5>
		<form action="" method="POST" autocomplete="off">
			<div class="input-field">
				<select name="kdn">
					<option>Baik</option>
					<option>Rusak</option>
					<option>Hilang</option>
				</select>
			</div>
			<div class="input-field">
				<button type="submit" class="btn" name="cari_kdn">Cari</button>
			</div>
		</form>
	</div>
	</div>

	<div class="col l8">
<div class="card-panel">
	<form action="" method="POST" autocomplete="off">
		<h4 class="center"><span><button type="submit" name="refresh" class="btn-floating pulse left"><i class="material-icons">refresh</i></button>
	</form>
						</span>Laporan<span>
							<?php 
							if (isset($_POST['cari_tgl'])) {
							?>

								<a target="blank" href="cetak/excel/data_tgl_beli_barang_excel.php?kode1=<?= $tgl1 ?>&kode2=<?= $tgl2 ?>" class="btn right orange">Ekspor ke Excel</a>
								<a target="blank" href="cetak/pdf/data_tgl_beli_barang_pdf.php?kode1=<?= $tgl1 ?>&kode2=<?= $tgl2 ?>" class="btn right orange">Ekspor ke PDF</a>
							<!-- </span></h4> -->
							
							<?php
							}elseif (isset($_POST['cari_kdn'])) {
							?>

								<a target="blank" href="cetak/excel/data_kondisi_barang_excel.php?knd=<?= $kdn ?>" class="btn right orange">Ekspor ke Excel</a>
								<a target="blank" href="cetak/pdf/data_kondisi_barang_pdf.php?knd=<?= $kdn ?>" class="btn right orange">Ekspor ke PDF</a>
							
							<?php
							}else {
							 ?>


							 <?php
							}
							?>
							</span></h4>
<table class="striped">
	<thead>
		<tr>
			<th>ID Barang</th>
			<th>Nama Barang</th>
			<th>Kondisi</th>
			<th>Sumber Dana</th>
			<th>Tanggal Beli</th>
		</tr>
	</thead>
<tbody>
	<?php 
	while($row = $pj->fetch_array()) {
	?>
	<tr>
		<td><?= $row['id_brg'] ?></td>
		<td><?= $row['nm_brg'] ?></td>
		<td><?= $row['kondisi'] ?></td>
		<td><?= $row['sumber_dana'] ?></td>
		<td><?= $row['tgl_beli'] ?></td>
	<?php 
		}
	 ?>

	<tr>
</tbody>
</table>

</div>
</div>