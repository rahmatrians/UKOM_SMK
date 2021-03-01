<?php 

include "../header.php";

if ($jabatan == "Anggota") {
	header('location: ../ukom_rahmat/');
}elseif ($jabatan == "Pengelola") {
	header('location: ../ukom_rahmat/');
}
 
 ?>

<style>
  .r-search {
    display: none;one;
  }
</style>

    <div class="col l12">
      <ul id="tabs-swipe-demo" class="tabs r-tabs r-tabs-radius">
        <li class="tab col s3"><a class="" href="#jenis">Laporan Jenis</a></li>
        <li class="tab col s3"><a class="<?php 
                                            if(isset($_POST['cari_kdn'])) {
                                              echo "active";
                                            }elseif(isset($_POST['cari_tgl'])) {
                                              echo "active";
                                            }elseif(isset($_POST['refresh'])) {
                                              echo "active";
                                              }else {
                                              echo "";
                                            }
                                           ?>" href="#barang">Laporan Barang</a></li>
        <li class="tab col s3"><a class="<?php 
                                            if(isset($_POST['cariTgl'])) {
                                              echo "active";
                                              }else {
                                              echo "";
                                            }
                                           ?>" href="#pinjam">Laporan Peminjaman</a></li>
        <li class="tab col s3"><a class="" href="#pengguna">Laporan Pengguna</a></li>
      </ul>
    </div>



    <div id="jenis" class="col l12">
      <?php include "laporan_jns.php"; ?>
    </div>

    <div id="barang" class="col l12">
      <?php include "laporan_brg.php"; ?>
    </div>

    <div id="pengguna" class="col l12">
      <?php include "laporan_usr.php"; ?>
    </div>

    <div id="pinjam" class="col l12">
      <?php include "laporan_pmjm.php"; ?>
    </div>


 <?php 

include "../footer.php";

  ?>