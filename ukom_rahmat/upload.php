<?php

//upload.php

if(isset($_POST["image"]))
{
	$data = $_POST["image"];

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$imageName = time() . '.png';

	$kun = file_put_contents("img_barang/".$imageName, $data);
	
	echo '<img src="img_barang/'.$imageName.'" class="img-thumbnail" style="width: 100px;" />';
	echo "<input type='text' name='gambar-crop' value='".$imageName."'>";
}

?>