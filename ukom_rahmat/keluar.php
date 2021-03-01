<?php 

session_start();

include "koneksi.php";

session_unset();
session_destroy();
 header('location: ../ukom_rahmat/masuk.php')

 ?>