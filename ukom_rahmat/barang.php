<?php

include "header.php";

if ($jabatan == "Anggota") {
	header('location: ../ukom_rahmat/');
}

	$kd = kodeOtomatis("id_brg","barang","B");

	if (isset($_SESSION['alert'])) {
		echo $_SESSION['alert'];
		unset($_SESSION['alert']);
	}

	// membuat pagination
	$hitngTtlData 	= kueri("COUNT(*) AS ttl", "barang");
	$fetchData 			= $hitngTtlData->fetch_array();
	$jmlData		= $fetchData['ttl'];
	$jmlPerhlmn		= 9;
	$rumusPage 		= ceil($jmlData / $jmlPerhlmn);
	$halmnAktif 	= (isset($_GET['hal'])? $_GET['hal']: "1");
	$awalData 		= ($jmlPerhlmn * $halmnAktif)-$jmlPerhlmn;


	if (isset($_POST['save'])) {
		var_dump($nm_brg 	= $_POST['nm_brg'],
		$harga_beli 		= $_POST['harga_beli'],
		$kondisi 			= $_POST['kondisi'],
		$sumber_dana 		= $_POST['sumber_dana'],
		$tgl_beli 			= $_POST['tgl_beli'],
		$id_jenis 			= $_POST['id_jenis'],
		$id_dist 			= $_POST['id_dist'],
		$gambarCrop 		= $_POST['gambar-crop']);
			
		$data 	= "'$kd', '$nm_brg', '$harga_beli', '$kondisi', '$sumber_dana', '$tgl_beli', '$id_jenis', '$id_dist', '$gambarCrop'";
		$tabel = "barang";
		$sql 	= tambah($tabel, $data, "barang");

		// }
	}


	if (isset($_GET['ubah'])) {
		$id_brg = $_GET['ubah'];

		$ubah 	= kueriDimana("*","barang","id_brg = '$id_brg'");
	}

	if (isset($_POST['update'])) {
		$id_brg 		= $_POST['id_brg'];
		$nm_brg 		= $_POST['nm_brg'];
		$harga_beli 	= $_POST['harga_beli'];
		$kondisi 		= $_POST['kondisi'];
		$sumber_dana 	= $_POST['sumber_dana'];
		$tgl_beli	 	= $_POST['tgl_beli'];
		$id_jenis 		= $_POST['id_jenis'];
		$id_dist 		= $_POST['id_dist'];
		var_dump($gambarCrop 	= $_POST['gambar-crop']);
			if (!empty($gambarCrop)) {
				$cek_gbr = kueri("* ", "barang WHERE id_brg = '$id_brg'");
				while ($fetch_gbr = $cek_gbr->fetch_array()) {
					unlink("img_barang/".$fetch_gbr['gambar']);
				}
				$sql 	= $conx->query("UPDATE barang SET 
												id_brg 			= '$id_brg',
												nm_brg 			= '$nm_brg',
												harga_beli 		= '$harga_beli',
												kondisi 		= '$kondisi',
												sumber_dana 	= '$sumber_dana',
												tgl_beli 		= '$tgl_beli',
												id_jenis 		= '$id_jenis',
												id_dist 		= '$id_dist',
												gambar 			= '$gambarCrop'
								 WHERE id_brg = '$id_brg'");
				}
			
			else {
		$sql 	= $conx->query("UPDATE barang SET 
												id_brg 			= '$id_brg',
												nm_brg 			= '$nm_brg',
												harga_beli 		= '$harga_beli',
												kondisi 		= '$kondisi',
												sumber_dana 	= '$sumber_dana',
												tgl_beli 		= '$tgl_beli',
												id_jenis 		= '$id_jenis',
												id_dist 		= '$id_dist'
								 WHERE id_brg = '$id_brg'");
			}
			if ($sql) {
				
			header('location: barang.php');
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
	}

	if (isset($_GET['hapus'])) {
		$id_brg 	= $_GET['hapus'];
		$nm_gbr 	= $_GET['gbr']	;
		$loc 		= "img_barang/".$nm_gbr;
		$cekpmj 	= $conx->query("SELECT * FROM peminjaman WHERE id_brg = '$id_brg'");
		
		$alert = "
			<script>
				Swal.fire({
				  type: 'error',
				  title: 'Tidak dapat dihapus',
				  text: 'karena telah masuk kedalam data peminjaman',
				})
			</script>";

		if (mysqli_num_rows($cekpmj) > 0) {
			
		echo $alert;

		}else {

		$sql 		= hapus("barang","id_brg", $id_brg, "barang");
		$del 		= unlink($loc);

		}
	}

 ?>

 
<div class="row">

	<div class="col l4 s12">
		<div class="card-panel">

 <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">

<div class="input-field">
	<label for="id_brg">ID barang</label>
	<input type="text" name="id_brg" id="id_brg" value="<?php 
	if(isset($ubah)){
	echo $ubah['id_brg'];
	}else{
		echo $kd;
	} 
	?>" disabled>
	<input type="text" name="id_brg" id="id_brg" value="<?php 
	if(isset($ubah)){
	echo $ubah['id_brg'];
	}else{
		echo $kd;
	} 
	?>" hidden>
</div>

<div class="input-field">
	
	<label for="nm_brg">Nama barang</label>
	<textarea class="materialize-textarea" name="nm_brg" id="nm_brg"><?php if(isset($ubah)){echo $ubah['nm_brg'];} ?></textarea>
</div>

<div class="file-field input-field">
	<div class="btn">
		<span>File</span>
		<!-- <input type="file" name="gambar" id="gambar"> -->
		<input type="file" name="upload_image" onchange="validateFileType()" id="upload_image" accept=".png, .jpg, .jpeg" />
	</div>
	<div class="file-path-wrapper">
		<input type="text" class="file-path validate" placeholder="Pilih Gambar">
		<span class="helper-text" data-success="right" data-error="wrong">Pilih file gambar PNG/JPG</span>
	</div>
</div>

<div class="input-field">
	<div id="uploaded_image"></div>		
</div>

<div class="input-field">
	
	<label for="harga_beli">Harga Beli</label>
	<input type="number" name="harga_beli" id="harga_beli" value="<?php 
	 			if(isset($ubah)){
						echo $ubah['harga_beli'];
					}
	?>" required>
</div>

<div class="input-field">
	<select name="kondisi" id="kondisi">
		<!-- <option disbaled selected></option>			 -->
			<?php 
				if(isset($ubah)){
					if ($ubah['kondisi'] == 'Baik') {
			?>

		<option value="Baik" selected>Baik</option>
		<option value="Rusak">Rusak</option>
			<?php 
					}else{
			?>

		<option value="Rusak" selected>Rusak</option>
		<option value="Baik">Baik</option>
					
			<?php
					}
				}else{
			 ?>			

		<option value="" disabled selected></option>
		<option value="Baik">Baik</option>
		<option value="Rusak">Rusak</option>
			
			<?php
				}
			 ?>

	</select>
	<label for="kondisi">Kondisi barang</label>
</div>

<div class="input-field">
	<label for="sumber_dana">Sumber Dana</label>
	<input type="text" name="sumber_dana" id="sumber_dana" value="<?php 
	 			if(isset($ubah)){
						echo $ubah['sumber_dana'];
					}
	?>" required>
</div>

<div class="input-field">
	<label for="tgl_beli">Tanggal Beli</label>
	<input class="datepicker" type="text" name="tgl_beli" id="tgl_beli" value="<?php 
	 			if(isset($ubah)){
						echo $ubah['tgl_beli'];
					}
	?>" required>
</div>

<div class="input-field">
		<select name="id_jenis" id="id_jenis">
			<option disbaled selected></option>
			<?php 
				$jns 	= kueri("*","jenis");
				foreach ($jns as $row) {
					if (isset($ubah)) {
						if ($row['id_jenis'] == $_GET['jns']) {
		?>

			<option value="<?= $row['id_jenis'] ?>" selected><?= $row['nm_jenis'] ?></option>
		
		<?php
						}
				}
			 ?>					
			<option value="<?= $row['id_jenis'] ?>"><?= $row['nm_jenis'] ?></option>
		
		<?php
				}
			 ?>
		</select>
		<label for="id_jenis">Jenis</label>
</div>

	
<div class="input-field">
		<select name="id_dist" id="id_dist">
		<option selected></option>
			<?php 
				$jns 	= kueri("*","distributor");
				foreach ($jns as $row) {
					if (isset($ubah)) {
						if ($row['id_dist'] == $_GET['dist']) {
		?>

			<option value="<?= $row['id_dist'] ?>" selected><?= $row['nm_dist'] ?></option>
		
		<?php
						}
				}
			 ?>					
			<option value="<?= $row['id_dist'] ?>"><?= $row['nm_dist'] ?></option>
		
		<?php
				}
			 ?>
		</select>
		<label for="id_dist">Distributor</label>
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

<!-- ---------------------------- Awal Modal Crop Image ----------------------------------- -->

      <div id="uploadimageModal" class="modal r-modal-crop card-panel">
            <!-- <h4>Upload & Crop Image</h4> -->
              <div class="col l12 r-image-crop">
                <div id="image_demo"></div>
              </div>
              <div class="col l12">
        		<button type="button" class="btn r-delete" style="border-radius: 0px 0px 0px 10px; top: -2px; right: -2px; position: absolute;" data-dismiss="modal">Tutup</button>
                <button class="btn crop_image"  style="border-radius: 0px 0px 10px 0px; top: -2px; left: -2px; position: absolute;">Potong</button>
              </div>
      </div>

<!-- ---------------------------- Akhir Modal Crop Image ----------------------------------- -->
			
		</div>
	</div>


	<div class="col l8 s12">
		<div class="card-panel">

<h4>Data Barang</h4>
 <table class="striped r-table-font" id="striped">
 	<thead>
	 	<tr>
	 		<th class="center">ID barang</th>
	 		<th class="center">Gambar</th>
	 		<th class="center">Nama barang</th>
	 		<th class="center">Harga Beli</th>
	 		<th class="center">Kondisi barang</th>
	 		<th class="center">Sumber Dana</th>
	 		<th class="center">Jenis</th>
	 		<th class="center">Aksi</th>
	 		<th class="center"></th>
	 	</tr>
 	</thead>
<tbody>
 	<?php 
 		$sql 	= $conx->query("SELECT * FROM barang 
						INNER JOIN jenis ON barang.id_jenis = jenis.id_jenis
						INNER JOIN distributor ON barang.id_dist = distributor.id_dist
						ORDER BY id_brg DESC LIMIT $awalData, $jmlPerhlmn");

 		while ($row = $sql->fetch_array()) {
	?>

	<tr>
 		<td><?= $row['id_brg'] ?></td>
 		<td><img class="materialboxed r-img" src="img_barang/<?= $row['gambar'] ?>"></td>
 		<td class="listSearch"><?= $row['nm_brg'] ?></td>
 		<td>Rp.<?= number_format($row['harga_beli']) ?></td>
 		<td><?= $row['kondisi'] ?></td>
 		<td><?= $row['sumber_dana'] ?></td>
 		<td><?= $row['nm_jenis'] ?></td>
 		<td class="center">
 			<a class="btn orange" href="?ubah=<?= $row['id_brg'] ?>&jns=<?= $row['id_jenis'] ?>&dist=<?= $row['id_dist'] ?>">Ubah</a></td>
 			<td><a class="btn r-delete hapus" href="?hapus=<?= $row['id_brg'] ?>&gbr=<?= $row['gambar'] ?>">Hapus</a></td>
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



</div>

<br>

<script type="text/javascript" src="vendor/materializes/js/materialize.js"></script>
<script src="vendor/crop-image/bootstrap.min.js"></script>
<script type="text/javascript" src="vendor/crop-image/croppie.js"></script>

<script>
		function validateFileType(){
        var fileName = document.getElementById("#upload_image").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
        }   
    }
		$(document).ready(function(){
			$('.dropdown-trigger').dropdown();
		});

		var slideUp = {
		    distance: '20%',
		    delay: 100,
		    origin: 'bottom',
		    opacity: null
		};

		// ScrollReveal().reveal('.slide-up', slideUp);

    	// ScrollReveal().reveal('.card-panel', slideUp);
    	ScrollReveal().reveal('nav', {distance: '100%', origin: 'top', duration: 1000, opacity: null});

		$(document).ready(function(){
			$('.sidenav').sidenav();
		});
		
		$(document).ready( function () {
			$('#striped').DataTable({
				"language": {
					"url":"vendor/dataTable/indonesian.json",
					"sEmptyTable":"Tidak ada yang dicari"
				},
				paging: false
			});
		} );

		$(document).ready(function(){
			$('.r-kondisi-brg').sidenav({
				edge: 'right'
			});
		});

		$(document).ready(function(){
		$('.collapsible').collapsible();
		});

		$(document).ready(function(){
			$('.r-detail-pmjm').sidenav({
				edge: 'right'
			});
		});

		$(document).ready(function(){
			$('select').formSelect();
		});

		$(document).ready(function(){
			$('.collapsible').collapsible();
		});

		$(document).ready(function(){
			$('.materialboxed').materialbox();
		});

		$(document).ready(function(){
			$('.tabs').tabs({
				// duration : 300
				// swipeable : 'true'
			});
		});

		// $(document).ready(function(){
		// 	$('#gambar').characterCounter();
		// });

		$(document).ready(function(){
			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd'
			});
		});

		$(document).ready(function($){
			$('.listSearch').each(function(){
					$(this).attr('searchData', $(this).text().toLowerCase());
			});
			$('.boxSearch').on('keyup', function(){
				var dataList = $(this).val().toLowerCase();
				$('.listSearch').each(function(){
					if ($(this).filter('[searchData *= ' + dataList + ']').length > 0 || dataList.lenght < 1) {
						$(this).show();
					}else {
						$(this).hide();
					}
				});
			});
		});

		 
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });


  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'original',
      quality: 1
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
        }
      });
    })
  });

});


//swal
$('.keluar').on('click', function(e) {
	e.preventDefault();

	var href = $(this).attr('href');

	Swal.fire({
		title: 'Anda yakin ingin keluar?',
		type: 'warning',
		confirmButtonColor: '#4D53C5',
		cancelButtonColor: '#F25C6D',
		confirmButtonText: 'Iya',
		showCancelButton: true,
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});

$('.hapus').on('click', function(e) {
	e.preventDefault();

	var href = $(this).attr('href');

	Swal.fire({
		title: 'Anda yakin ingin dihapus?',
		type: 'warning',
		confirmButtonColor: '#4D53C5',
		cancelButtonColor: '#F25C6D',
		confirmButtonText: 'Iya',
		showCancelButton: true,
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});

</script>
</body>
</html>

<?php 
ob_end_flush();
 ?>