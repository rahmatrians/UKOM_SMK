</div>


	<script type="text/javascript" src="vendor/materializes/js/materialize.js"></script>
	<script type="text/javascript" src="vendor/crop-image/croppie.js"></script>
				
	<script type="text/javascript">

    	ScrollReveal().reveal('nav', {distance: '100%', origin: 'top', duration: 1000, opacity: null});

	// Ajax Data otomatis tampil
	// var auto_refresh = setInterval(
	// 	function () {
	// 		$('#ajxData').load('tbl_pesan.php').fadeIn('slow');
	// 	}, 1000);

		$(document).ready(function(){
			$('.sidenav').sidenav();
		});

		$(document).ready(function(){
			$('.collapsible').collapsible();
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
			$('.slider').slider();
		});

		$(document).ready(function(){
			$('.parallax').parallax();
		});

		$(document).ready(function(){
			$('.scrollspy').scrollSpy();
		});

		$(document).ready(function(){
			$('.r-kondisi-brg').sidenav({
				edge: 'right'
			});
		});

		$(document).ready(function(){
			$('.r-detail-pmjm').sidenav({
				edge: 'right'
			});
		});

		$(document).ready(function(){
			$('.r-search-input').sidenav({
				edge: 'right'
			});
		});

		$(document).ready(function(){
			$('select').formSelect();
		});

		$(document).ready(function(){
			$('.materialboxed').materialbox();
		});

		$(document).ready(function(){
			$('.modal').modal();
		});

		$(document).ready(function(){
			$('.dropdown-trigger').dropdown();
		});

		$(document).ready(function(){
			$('.tabs').tabs({
				// duration : 300
				// swipeable : 'true'
			});
		});

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

$('.r-delete').on('click', function(e) {
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

$('.batal').on('click', function(e) {
	e.preventDefault();

	var href = $(this).attr('href');

	Swal.fire({
		title: 'Anda yakin ingin dibatalkan?',
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
 
$('.perbaiki').on('click', function(e) {
	e.preventDefault();

	var href = $(this).attr('href');

	Swal.fire({
		title: 'Anda yakin ingin diperbaiki?',
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
  
$('.lunasi').on('click', function(e) {
	e.preventDefault();

	var href = $(this).attr('href');

	Swal.fire({
		title: 'Anda yakin ingin dilunasi?',
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
      size: 'viewport'
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

	</script>
</body>
</html>

<?php 
ob_end_flush();
 ?>