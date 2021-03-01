<?php 

$kk   = "SELECT *,(SELECT COUNT(id_brg) FROM barang WHERE jenis.id_jenis = barang.id_jenis) AS jml_barang FROM jenis";
$kueri = $conx->query($kk);

if (isset($_POST['cariTgl'])) {
  $tgl1 = $_POST['tgl1'];
  $tgl2 = $_POST['tgl2'];
  
  $cari = "AND tgl_masuk BETWEEN '$tgl1' AND '$tgl2'";

}else {
  $cari = "";
}

  $sqlTbl = kueri("*", "peminjaman 
                          INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                          INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                        WHERE status != '0' ".$cari);

 ?>


<!-- ----------------------------- Awal Box -------------------------------- -->


<div class="col l5 m6 s12">

    <div class="col l12 m12 s12">
      
    <div class="card-panel r-box">
          
        <div class="col l6 m6 s6">
            <h6><b>Laporan Total Peminjaman Jenis</b></h6>
        </div>

        <div class="col l6 m6 s6">
          <br>
          <a class="waves-effect waves-light btn modal-trigger right" href="#laporan_pjm_1">Lihat</a>
        </div>
      
    </div>
      
    </div>


    <div class="col l12 m12 s12">
      
    <div class="card-panel r-box">
          
        <div class="col l6 m6 s6">
            <h6><b>Laporan Total Peminjaman Barang</b></h6>
        </div>

        <div class="col l6 m6 s6">
          <br>
          <a class="waves-effect waves-light btn modal-trigger right" href="#laporan_pmjm_2">Lihat</a>
        </div>
      
    </div>
      
    </div>
    

    <div class="col l12 m12 s12">
    <div class="card-panel r-box">
          
        <div class="col l6 m6 s6">
            <h6><b>Laporan Total Peminjaman Anggota</b></h6>
        </div>

        <div class="col l6 m6 s6">
          <br>
          <a class="waves-effect waves-light btn modal-trigger right" href="#laporan_pmjm_3">Lihat</a>
        </div>
      
    </div>
  </div>

    <div class="col l12 m12 s12">
    <div class="card-panel r-box">
          
        <div class="col l6 m6 s6">
            <h6><b>Laporan Peminjaman Berdasarkan status</b></h6>
        </div>

        <div class="col l6 m6 s6">
          <br>
          <a class="waves-effect waves-light btn modal-trigger right" href="#laporan_pmjm_4">Lihat</a>
        </div>
      
    </div>
  </div>
</div>


<div class="col l7 m6 s12">
    <div class="col l12 m12 s12">
    <div class="card-panel">
        <form method="POST" action="">
          <div class="col l4">
          <br> <br> <br>
          <h6><b>Data Peminjaman</b></h6>
          </div>
          <div class="col l8">
          <div class="input-field col l5">
            <input class="datepicker" type="text" name="tgl1" id="tgl1">
            <label for="tgl1">Tanggal Awal</label>
          </div>
          <div class="input-field col l5">
            <input class="datepicker" type="text" name="tgl2" id="tgl2">
            <label for="tgl2">Tanggal Akhir</label>
          </div>
          <div class="input-field col l2">
            <button class="btn" name="cariTgl">Cari</button>
          </div>
          </div>
        </form>
          <?php 
              if (isset($_POST['cariTgl'])) {
              ?>

                <a target="blank" href="cetak/excel/data_pinjam_antar_tgl_excel.php?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" class="btn right orange">Ekspor ke Excel</a>
                <a target="blank" href="cetak/pdf/data_pinjam_antar_tgl_pdf.php?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" class="btn right orange">Ekspor ke PDF</a>
              <!-- </span></h4> -->
              
              <?php
              }
          ?>
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Peminjam</th>
              <th>Nama Barang</th>
              <th>Tanggal Masuk</th>
            </tr>
          </thead>
          <tbody>
          
          <?php 
            foreach($sqlTbl as $row) {
          ?>
          
              <tr>
                <td><?= $row['id_pinjam'] ?></td>
                <td><?= $row['nm_lengkap'] ?></td>
                <td><?= $row['nm_brg'] ?></td>
                <td><?= $row['tgl_masuk'] ?></td>
              </tr>
          
          <?php
            }
           ?>
          
          </tbody>
        </table>
    </div>
  </div>
</div>


<!-- ----------------------------- Akhir Box -------------------------------- -->



<!-- ----------------------------- Awal Modal 1 -------------------------------- -->


  <div id="laporan_pjm_1" class="modal bottom-sheet r-modal-bottom">
    <div class="container">
    <div class=" card-panel">
      <a class="btn right" target="_blank" href="cetak/excel/data_ttl_pinjam_jenis_excel.php">Ekspor Ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_ttl_pinjam_jenis_pdf.php">Ekspor Ke PDF</a>
      <div class="col l12 m12 s12">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jenis</th>
              <th>Total Dipinjam</th>
            </tr>
            <tbody>

              <?php 
                  $x = 1;
                  // $l_jns = $conx->query("SELECT * FROM jenis");
                  $l_jns = $conx->query("SELECT *,(
                                              SELECT COUNT(*) FROM barang WHERE barang.id_jenis = jenis.id_jenis AND NOT EXISTS (
                                                              SELECT 1 FROM peminjaman WHERE peminjaman.id_brg = barang.id_brg AND peminjaman.status != 2
                                                            )
                                                      ) AS jml FROM jenis");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $jns_data['nm_jenis'] ?></td>
                <td><b><?= $jns_data['jml'] ?></b> Kali Dipinjam</td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>
      </div>
    </div>
    </div>
  </div>


<!-- ----------------------------- Akhir Modal 1 -------------------------------- -->



<!-- ----------------------------- Awal Modal 2 -------------------------------- -->


  <div id="laporan_pmjm_2" class="modal bottom-sheet r-modal-bottom">
    <div class="container">
    <div class=" card-panel">
      <div class="col l12 m12 s12">
        <div class="col l12">
        <a class="btn right" target="_blank" href="cetak/excel/data_total_pinjaman_barang_excel.php">Ekspor ke Excel</a>
        <a class="btn right" target="_blank" href="cetak/pdf/data_total_pinjaman_barang_pdf.php">Ekspor ke PDF</a>
      </div>
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Total Peminjaman</th>
              <th>Aksi</th>
            </tr>
          </thead>
            <tbody>

              <?php 
                  $x = 1;
                  $l_jns = kueri("*, (SELECT COUNT(id_pinjam) FROM peminjaman WHERE barang.id_brg = peminjaman.id_brg) AS ttl_pnj", "barang");
                  while ($jns_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $jns_data['nm_brg'] ?></td>
                <td><b><?= $jns_data['ttl_pnj'] ?></b> Kali Dipinjam</td>
                <td><a class="waves-effect waves-light btn modal-trigger" href="#laporan_pmjm_<?= $jns_data['id_brg'] ?>">Lihat</a></td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>
      </div>
    </div>
    </div>
  </div>


<!-- ----------------------------- Akhir Modal 2 -------------------------------- -->



<!-- ----------------------------- Awal Modal 3 -------------------------------- -->


  <div id="laporan_pmjm_3" class="modal bottom-sheet r-modal-bottom">
    <div class="container">
    <div class=" card-panel">
      <div class="col l12 m12 s12">
        <div class="col l12">
        <a class="btn right" target="_blank" href="cetak/excel/data_total_pinjaman_pengguna_excel.php">Ekspor ke Excel</a>
        <a class="btn right" target="_blank" href="cetak/pdf/data_total_pinjaman_pengguna_pdf.php">Ekspor ke PDF</a>
      </div>
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Peminjam</th>
              <th>Total Pinjaman</th>
              <th>Aksi</th>
            </tr>
          </thead>
            <tbody>

              <?php 
                  $x = 1;
                  $l_jns = kueri("*, (SELECT COUNT(id_pinjam) FROM peminjaman WHERE akun_pengguna.id_akun = peminjaman.id_akun) AS ttl_akn", "akun_pengguna WHERE akun_pengguna.id_jab = '3'");
                  while ($akun_data = $l_jns->fetch_array()) {
               ?>

              <tr>
                <td><?= $x++ ?></td>
                <td><?= $akun_data['nm_lengkap'] ?></td>
                <td><?= $akun_data['ttl_akn'] ?></td>
                <td><a class="waves-effect waves-light btn modal-trigger" href="#laporan_pmjm_<?= $akun_data['id_akun'] ?>">Lihat</a></td>
              </tr>

              <?php } ?>

            </tbody>
          </thead>
        </table>
      </div>
    </div>
    </div>
  </div>


<!-- ----------------------------- Akhir Modal 3 -------------------------------- -->




<!-- ----------------------------- Awal Modal 4 -------------------------------- -->


  <div id="laporan_pmjm_4" class="modal bottom-sheet r-modal-bottom">
    <div class="container">
    <div class=" card-panel">
      <div class="col l12 m12 s12">
        <div class="col l12">
      </div>
        <table class="striped">
          <thead>
            <tr>
              <th>Dipesan</th>
              <th><a class="waves-effect waves-light btn modal-trigger right" href="#lap_pesan">Lihat</a></th>
            </tr>
            <tr>
              <th>Dipinjam</th>
              <th><a class="waves-effect waves-light btn modal-trigger right" href="#lap_pinjam">Lihat</a></th>
            </tr>
            <tr>
              <th>Dikembalikan</th>
              <th><a class="waves-effect waves-light btn modal-trigger right" href="#lap_kembali">Lihat</a></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    </div>
  </div>


<!-- ----------------------------- Akhir Modal 4 -------------------------------- -->



<!-- ----------------------------- Awal Modal 1 didalam Modal 2  -------------------------------- -->


<?php 
    $mdl_jns = kueri("*", "barang");
    while ($mdl_brg = $mdl_jns->fetch_array()) {
?>

<div id="laporan_pmjm_<?= $mdl_brg['id_brg'] ?>" class="modal r-modal-bottom">

  <?php 
      $x = 1; 
      $l_jns_ttl = kueriDimana2("peminjaman 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                    ", "id_brg", $mdl_brg['id_brg']); 
      $ttl_brg = mysqli_num_rows($l_jns_ttl);
   ?>

  <div class="card-panel">
  <div class="col l12">
    <div class="col l12">
      <a class="btn right" target="_blank" href="cetak/excel/data_pinjaman_barang_pengguna_excel_.php?id=<?= $mdl_brg['id_brg'] ?>&nm=<?= $mdl_brg['nm_brg'] ?>">Ekspor ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_pinjaman_barang_pengguna_pdf_.php?id=<?= $mdl_brg['id_brg'] ?>&nm=<?= $mdl_brg['nm_brg'] ?>">Ekspor ke PDF</a>
    </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
          </tr>
        </thead>
        <tbody>

          <?php
              while ($jns_brg = $l_jns_ttl->fetch_array()) {
           ?>

           <tr>
             <td><?= $x++ ?></td>
             <td><?= $jns_brg['nm_lengkap'] ?></td>
           </tr>

         <?php } ?>

        </tbody>
      </table>
  </div>
</div>
</div>

</div>

<?php } ?>


<!-- ----------------------------- Akhir Modal 1 didalam Modal 2 ------------------------------- -->




<!-- ----------------------------- Awal Modal 1 didalam Modal 3  -------------------------------- -->


<?php 
    $mdl_jns = kueri("*", "akun_pengguna");
    while ($mdl_akn = $mdl_jns->fetch_array()) {
?>

<div id="laporan_pmjm_<?= $mdl_akn['id_akun'] ?>" class="modal r-modal-bottom">

  <?php 
      $x = 1; 
      $l_jns_ttl = kueriDimana2("peminjaman 
                        INNER JOIN barang ON peminjaman.id_brg = barang.id_brg 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun", 
                        "peminjaman.id_akun", $mdl_akn['id_akun']); 
      $ttl_brg = mysqli_num_rows($l_jns_ttl);
   ?>

  <div class="card-panel">
  <div class="col l12">
    <div class="col l12">
      <a class="btn right" target="_blank" href="cetak/excel/data_pinjaman_pengguna_excel_.php?id=<?= $mdl_akn['id_akun'] ?>&nm=<?= $mdl_akn['nm_lengkap'] ?>">Ekspor ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_pinjaman_pengguna_pdf_.php?id=<?= $mdl_akn['id_akun'] ?>&nm=<?= $mdl_akn['nm_lengkap'] ?>">Ekspor ke PDF</a>
    </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
          </tr>
        </thead>
        <tbody>

          <?php
              while ($jns_brg = $l_jns_ttl->fetch_array()) {
           ?>

           <tr>
             <td><?= $x++ ?></td>
             <td><?= $jns_brg['nm_brg'] ?></td>
           </tr>

         <?php } ?>

        </tbody>
      </table>
  </div>
</div>
</div>

</div>

<?php } ?>


<!-- ----------------------------- Akhir Modal 1 didalam Modal 3 ------------------------------- -->




<!-- ----------------------------- Awal Modal 1 didalam Modal 4  -------------------------------- -->



<div id="lap_pesan" class="modal r-modal-bottom">

  <?php 
      $x = 1; 
      $l_jns_ttl = $conx->query("SELECT * FROM peminjaman 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                        INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                         WHERE status = '0'"); 
      $ttl_brg = mysqli_num_rows($l_jns_ttl);
   ?>

  <div class="card-panel">
  <div class="col l12">
    <div class="col l12">
      <a class="btn right" target="_blank" href="cetak/excel/data_peminjaman_excel.php?id=pesan">Ekspor ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_peminjaman_pdf.php?id=pesan">Ekspor ke PDF</a>
    </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Kembali</th>
          </tr>
        </thead>
        <tbody>

          <?php
              while ($jns_brg = $l_jns_ttl->fetch_array()) {
           ?>

           <tr>
             <td><?= $x++ ?></td>
             <td><?= $jns_brg['nm_lengkap'] ?></td>
             <td><?= $jns_brg['nm_brg'] ?></td>
             <td><?= $jns_brg['tgl_masuk'] ?></td>
             <td><?= $jns_brg['tgl_kembali'] ?></td>
           </tr>

         <?php } ?>

        </tbody>
      </table>
  </div>
</div>
</div>

</div>



<!-- ----------------------------- Akhir Modal 1 didalam Modal 4 ------------------------------- -->




<!-- ----------------------------- Awal Modal 2 didalam Modal 4  -------------------------------- -->



<div id="lap_pinjam" class="modal r-modal-bottom">

  <?php 
      $x = 1; 
      $l_jns_ttl = $conx->query("SELECT * FROM peminjaman 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                        INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                         WHERE status = '1'"); 
      $ttl_brg = mysqli_num_rows($l_jns_ttl);
   ?>

  <div class="card-panel">
  <div class="col l12">
    <div class="col l12">
      <a class="btn right" target="_blank" href="cetak/excel/data_peminjaman_excel.php?id=pinjam">Ekspor ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_peminjaman_pdf.php?id=pinjam">Ekspor ke PDF</a>
    </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Kembali</th>
          </tr>
        </thead>
        <tbody>

          <?php
              while ($jns_brg = $l_jns_ttl->fetch_array()) {
           ?>

           <tr>
             <td><?= $x++ ?></td>
             <td><?= $jns_brg['nm_lengkap'] ?></td>
             <td><?= $jns_brg['nm_brg'] ?></td>
             <td><?= $jns_brg['tgl_masuk'] ?></td>
             <td><?= $jns_brg['tgl_kembali'] ?></td>
           </tr>

         <?php } ?>

        </tbody>
      </table>
  </div>
</div>
</div>

</div>



<!-- ----------------------------- Akhir Modal 2 didalam Modal 4 ------------------------------- -->



<!-- ----------------------------- Awal Modal 3 didalam Modal 4  -------------------------------- -->



<div id="lap_kembali" class="modal r-modal-bottom">

  <?php 
      $x = 1; 
      $l_jns_ttl = $conx->query("SELECT * FROM peminjaman 
                        INNER JOIN akun_pengguna ON peminjaman.id_akun = akun_pengguna.id_akun
                        INNER JOIN barang ON peminjaman.id_brg = barang.id_brg
                         WHERE status = '2'"); 
      $ttl_brg = mysqli_num_rows($l_jns_ttl);
   ?>

  <div class="card-panel">
  <div class="col l12">
    <div class="col l12">
      <a class="btn right" target="_blank" href="cetak/excel/data_peminjaman_excel.php?id=kembali">Ekspor ke Excel</a>
      <a class="btn right" target="_blank" href="cetak/pdf/data_peminjaman_pdf.php?id=kembali">Ekspor ke PDF</a>
    </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Kembali</th>
          </tr>
        </thead>
        <tbody>

          <?php
              while ($jns_brg = $l_jns_ttl->fetch_array()) {
           ?>

           <tr>
             <td><?= $x++ ?></td>
             <td><?= $jns_brg['nm_lengkap'] ?></td>
             <td><?= $jns_brg['nm_brg'] ?></td>
             <td><?= $jns_brg['tgl_masuk'] ?></td>
             <td><?= $jns_brg['tgl_kembali'] ?></td>
           </tr>

         <?php } ?>

        </tbody>
      </table>
  </div>
</div>
</div>

</div>



<!-- ----------------------------- Akhir Modal 3 didalam Modal 4 ------------------------------- -->