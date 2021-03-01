<html>  
    <head>  
        <title>Make Price Range Slider using JQuery with PHP Ajax</title>  
		

  <!-- <script type="text/javascript" src="../materializes/js/materialize.js"></script> -->
    <script src="jquery.min.js"></script>  
  <!-- <script type="text/javascript" src="../materializes/jquery/jquery.js"></script> -->
    <script src="bootstrap.min.js"></script>
		<script src="croppie.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/material-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/materialize.css" media="screen,projection"/>
		<!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="../css/custom.css">
		<link rel="stylesheet" href="croppie.css" />
    </head>  
    <body>  
        <div class="container">
          <br />
      <h3 align="center">Image Crop & Upload using JQuery with PHP Ajax</h3>
      <br />
      <br />
			<div class="panel panel-default">
  				<div class="panel-heading">Select Profile Image</div>
  				<div class="panel-body" align="center">
  					<input type="file" name="upload_image" id="upload_image" />
  					<br />
  					<div id="uploaded_image"></div>
  				</div>
  			</div>
  		</div>
    </body>  
</html>

      <div id="uploadimageModal" class="modal r-modal-crop">
        		<button type="button" class="btn btn right" data-dismiss="modal">Close</button>
            <h4 class="modal-title">Upload & Crop Image</h4>
            <div class="row">
              <div class="col l6">
                <div id="image_demo" style="width:350px; margin-top:30px"></div>
              </div>
              <div class="col l6" style="padding-top:30px;">
                <button class="btn btn-success crop_image">Crop & Upload Image</button>
              </div>
            </div>
      </div>

<script>  
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