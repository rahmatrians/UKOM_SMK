<?php 



$kk   = "SELECT *,(SELECT COUNT(id_brg) FROM barang WHERE jenis.id_jenis = barang.id_jenis) AS jml_barang FROM jenis";

$kueri = $conx->query($kk);

 
 ?>


<!-- ----------------------------- Awal Box -------------------------------- -->



    <div class="col l6 m6 s12">
      
    <div class="card-panel r-box">
          
        <div class="col l6 m6 s6">
            <h6><b>Laporan Data Jenis</b></h6>
        </div>

        <div class="col l6 m6 s6">
          <br>
          <a class="waves-effect waves-light btn modal-trigger right" href="#laporan_jns_1">Lihat</a>
        </div>
      
    </div>
      
    </div>


    <div class="col l6 m6 s12">
      
    <div class="card-panel r-box">
          
        <div class="col l6 m6 s6">
            <h6><b>Laporan Total Barang Berdasarkan Jenis</b></h6>
        </div>

        <div class="col l6 m6 s6">
          <br>
          <a class="waves-effect waves-light btn modal-trigger right" href="#laporan_jns_2">Lihat</a>
        </div>
      
    </div>
      
    </div>


<!-- ----------------------------- Akhir Box -------------------------------- -->



<!-- ----------------------------- Awal Modal-1 -------------------------------- -->


  <div id="laporan_jns_1" class="modal bottom-sheet r-modal-bottom">
    <div class="container">
    <div class=" card-panel">
      <a class="btn right" target="_blank" href="cetak/excel/data_jenis_excel.php">Ekspor Ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_total_barang_pdf.php">Ekspor Ke PDF</a>
      <div class="col l12 m12 s12">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <!-- <th>Baik</th> -->
              <!-- <th>Hampir Rusak</th> -->
              <!-- <th>Rusak</th> -->
              <th>Total Barang</th>
            </tr>
            <tbody>

              <?php 
                  $x = 1;
                  $l_jns = kueri("*,(SELECT COUNT(id_brg) FROM barang WHERE jenis.id_jenis = barang.id_jenis) AS jml_barang", "jenis");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $jns_data['nm_jenis'] ?></td>
                <td><?= $jns_data['jml_barang'] ?> Barang</td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>
      </div>
    </div>
    </div>
    </div>


<!-- ----------------------------- Akhir Modal-1 -------------------------------- -->



<!-- ----------------------------- Awal Modal-2 -------------------------------- -->


  <div id="laporan_jns_2" class="modal bottom-sheet r-modal-bottom">
    <div class="container">
    <div class=" card-panel">
      <div class="col l12 m12 s12">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <th>Aksi</th>
            </tr>
            <tbody>

              <?php 
                  $x = 1;
                  $l_jns = kueri("*", "jenis");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $jns_data['nm_jenis'] ?></td>
                <td><a class="waves-effect waves-light btn modal-trigger" href="#<?= $jns_data['id_jenis'] ?>">Lihat</a></td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>
      </div>
    </div>
    </div>
  </div>


<!-- ----------------------------- Akhir Modal-2 -------------------------------- -->



<!-- ----------------------------- Awal Modal didalam Modal -------------------------------- -->


<?php 
    $mdl_jns = kueri("*", "jenis");
    while ($mdl_brg = $mdl_jns->fetch_array()) {
?>

<div id="<?= $mdl_brg['id_jenis'] ?>" class="modal r-modal-bottom">

  <?php 
      $x = 1; 
      $l_jns_ttl = $conx->query("SELECT * FROM barang WHERE id_jenis = '".$mdl_brg['id_jenis']."'");
      $ttl_brg = mysqli_num_rows($l_jns_ttl);
   ?>

  <div class="card-panel">
  <div class="col l12">
    <div class="col l6">
      <div class="btn">Total <b><?= $ttl_brg ?></b> Barang</div>
    </div>
    <div class="col l6">
      <a class="btn right" target="_blank" href="cetak/excel/data_total_barang_excel.php?nama=<?= $mdl_brg['nm_jenis'] ?>&id=<?= $mdl_brg['id_jenis'] ?>">Ekspor ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_jenis_pdf.php?nama=<?= $mdl_brg['nm_jenis'] ?>&id=<?= $mdl_brg['id_jenis'] ?>">Ekspor ke PDF</a>
    </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>kondisi</th>
            <th>Sumber Dana</th>
          </tr>
        </thead>
        <tbody>

          <?php
              while ($jns_brg = $l_jns_ttl->fetch_array()) {
           ?>

           <tr>
             <td><?= $x++ ?></td>
             <td><?= $jns_brg['nm_brg'] ?></td>
             <td><?= $jns_brg['kondisi'] ?></td>
             <td><?= $jns_brg['sumber_dana'] ?></td>
           </tr>

         <?php } ?>

        </tbody>
      </table>
  </div>
</div>
</div>

<?php } ?>


<!-- ----------------------------- Akhir Modal didalam Modal -------------------------------- -->