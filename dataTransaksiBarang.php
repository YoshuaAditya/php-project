<!DOCTYPE html>

<?php
SESSION_START();
include("processing/connection/koneksi.php");
include("processing/fungsi.php");
checkSession();
checkPage($_SESSION['akses'], basename(__FILE__), $connect);
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Transaksi Barang</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            include("sidebar.php");
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php
            include("header.php");
        ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Transaksi Barang</h1>
                    <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        }

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Edit Gagal!</h4>
                                    Ada Data yang Kosong Mohon Mengisi Semua Data!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 2) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                    Anda Telah Berhasil!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 3) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error! Data tidak ditemukan.</h4>
                                    Tidak ada data stok barang pada lokasi di database. Mohon kontak super admin untuk menambahkan stok dan lokasi tersebut.
                                </div>";
                        }
                        elseif ($_GET['alert'] == 4) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error! Stok tidak cukup.</h4>
                                    Pengeluaran barang melebihi stok yang tersedia.
                                </div>";
                        }
                        elseif ($_GET['alert'] == 5) {
                          echo "<div class='alert alert-danger alert-dismissable'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error! Invalid Quantity.</h4>
                                  Mohon memasukkan angka positif pada input kuantitas barang.
                              </div>";
                        }
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive" >
                                <table class="table table-bordered" id="user" width="150%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:200px">ID</th>
                                            <th style="width:200px">Barang</th>
                                            <th style="width:200px">Perusahaan</th>
                                            <th style="width:200px">Lokasi</th>
                                            <th style="width:200px">Tanggal Transaksi</th>
                                            <th style="width:200px">Pengeluaran Stock</th>
                                            <th style="width:200px">Pemasukan Stock</th>
                                            <th style="width:200px">Stock Sebelumnya</th>
                                            <th style="width:200px">Stock Akhir</th>
                                            <th style="width:200px">Keterangan</th>
                                            <th style="width:200px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                         <td></td>
                                         <th>Barang</th>
                                         <th>Perusahaan</th>
                                         <th>Lokasi</th>
                                         <th>Tanggal</th>
                                         <th>Pengeluaran</th>
                                         <th>Pemasukan</th>
                                         <th>Stock Sebelum</th>
                                         <td></td>
                                         <th>Keterangan</th>
                                         <td></td>
                                       </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include("footer.php");
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
   <?php
        include("logoutModal.php");
   ?>

   <div class="modal fade" id="edit" role="dialog">
       <div class="modal-dialog modal-lg">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body">
           <form id="form_send" action='processing/prosesEditDataTransaksiBarang.php' method ='post'  enctype="multipart/form-data">
             <input type='hidden' name='id' id="id"><input type='hidden' name='fk_id_perusahaan' id="fk_id_perusahaan">
             <input type='hidden' name='tanggal' id="tanggal"><input type='hidden' name='previousBarang' id="previousBarang">
             <input type='hidden' name='previousLokasi' id="previousLokasi"><input type='hidden' name='previousStockBarang' id="previousStockBarang">
             <label for="exampleInputEmail1">Barang</label>
             <Select class="form-control" name='nama_barang' id="nama_barang" required>
                 <?php
                     $prs=getIdPerusahaan($_SESSION['akses'],$connect);
                     $query = "SELECT DISTINCT nama_barang FROM stock_barang where status_barang ='1' AND fk_id_perusahaan = ".$prs;
                     $run = mysqli_query($connect, $query);
                     while($output = mysqli_fetch_assoc($run)){
                         $nama = $output['nama_barang'];
                     echo '<option value="'.$nama. '">';echo $nama; ?> </option>
                 <?php
                     }
                     ?>
             </select><br>

             <label for="exampleInputEmail1">Nama Lokasi</label>
             <Select class="form-control" name='id_lokasi' id="id_lokasi" >
                 <?php
                 if($_SESSION['akses']==4){
                   $query = "SELECT * FROM lokasi where nama_lokasi ='CV KCI'";
                   $run = mysqli_query($connect, $query);
                   while($output = mysqli_fetch_assoc($run)){
                       $id = $output['id_lokasi'];
                       $nama = $output['nama_lokasi'];

                 ?>
                   <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
                 <?php
                    }
                 }
                 else{
                     $query = "SELECT * FROM lokasi where status_lokasi ='1'";
                     $run = mysqli_query($connect, $query);
                     while($output = mysqli_fetch_assoc($run)){
                         $id = $output['id_lokasi'];
                         $nama = $output['nama_lokasi'];

                 ?>
                     <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
                 <?php
                     }
                 }
                 ?>
             </select> <br>

             <label for="exampleInputEmail1" name='pengeluaran'>Pengeluaran Stock</label> <br name='pengeluaran'>
             <input type='text'class="form-control"  name='pengeluaran' id="pengeluaran"> <br name='pengeluaran'>
             <input type='hidden' name='previousPengeluaran' id="previousPengeluaran">

             <label for="exampleInputEmail1" name='pemasukan'>Pemasukan Stock</label> <br name='pemasukan'>
             <input type='text'class="form-control"  name='pemasukan' id="pemasukan"> <br name='pemasukan'>
             <input type='hidden' name='previousPemasukan' id="previousPemasukan">

              <br><label for="exampleInputEmail1">Keterangan</label> <br>
              <input type='text'class="form-control"  name='keterangan_transaksi' id="keterangan_transaksi" > <br>
              <input type='submit' class="btn btn-primary" value='submit'>

             </form>
           </div>
         </div>
       </div>
     </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/filterInput.js"></script>


<script>
    $('#user tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" name="'+title+'" placeholder="Search ' + title + '" />');
    });
    $(document).ready(function(){
        var table=$('#user').DataTable({
            "dom": 'lrtip',
            "processing": true,
            "serverSide": true,
            "ajax":{
                    "url": "ajax/ajax_transaksi_barang.php?action=transaksi",
                    "dataType": "json",
                    "type": "POST"
                    },
            "columns": [
                { "data": "id_transaksi_bbm" },
                { "data": "nama_barang"},
                { "data": "nama_perusahaan" },
                { "data": "nama_lokasi" },
                { "data": "tanggal_transaksi" },
                { "data": "pengeluaran_stock" },
                { "data": "pemasukan_stock" },
                { "data": "stock_sebelumnya"},
                { "data": "stock_akhir"},
                { "data": "keterangan_transaksi"},
                { "data": "action"}
              ],
              "initComplete": function () {
              // Apply the search
              this.api()
                  .columns()
                  .every(function () {
                      var that = this;
                      $('input', this.footer()).on('keyup change clear', function () {
                          if (that.search() !== this.value) {
                              that.search(this.value).draw();
                          }
                      });
                  });
              var akses= <?php echo $_SESSION['akses'];?>;
              if(akses>5)table.column(10).visible(!table.column(10).visible());
              }
        });
    });
    function Edit(btn){
        $("#edit").modal('show');
        var id = $(btn).data('id');
        var fk_id_perusahaan = $(btn).data('fk_id_perusahaan');
        var fk_id_stock_barang = $(btn).data('fk_id_stock_barang');
        var previousStockBarang = $(btn).data('stock_sebelumnya');
        var lokasi = $(btn).data('id_lokasi');
        var tanggal = $(btn).data('tanggal_transaksi');
        var pengeluaran = $(btn).data('pengeluaran');
        var pemasukan = $(btn).data('pemasukan');
        var keterangan = $(btn).data('keterangan_transaksi');

        if(!pengeluaran){
          var elements = document.getElementsByName('pengeluaran');
          for (var i = 0; i<elements.length;i++) {
            elements[i].style.display='none';
          }
          elements = document.getElementsByName('pemasukan');
          for (var i = 0; i<elements.length;i++) {
            elements[i].style.display='block';
          }
        }
        else{
          var elements = document.getElementsByName('pengeluaran');
          for (var i = 0; i<elements.length;i++) {
            elements[i].style.display='block';
          }
          elements = document.getElementsByName('pemasukan');
          for (var i = 0; i<elements.length;i++) {
            elements[i].style.display='none';
          }
        }

        $("#id").val(id);
        $("#fk_id_perusahaan").val(fk_id_perusahaan);
        $("#previousBarang").val(fk_id_stock_barang);
        $("#previousStockBarang").val(previousStockBarang);
        $("#id_lokasi").val(lokasi);
        $("#previousLokasi").val(lokasi);
        $("#pengeluaran").val(pengeluaran);
        $("#previousPengeluaran").val(pengeluaran);
        $("#pemasukan").val(pemasukan);
        $("#previousPemasukan").val(pemasukan);
        $("#tanggal").val(tanggal);
        $("#keterangan_transaksi").val(keterangan);
    }
    setInputFilter(document.getElementById("pengeluaran"), function(value) {
      return /^-?\d*$/.test(value); });

    setInputFilter(document.getElementById("pemasukan"), function(value) {
      return /^-?\d*$/.test(value); });
</script>
</body>

</html>
