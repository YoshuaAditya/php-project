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

    <title>Data Debit Kredit</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Data Debit Kredit</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive" >
                                <table class="table table-bordered" id="user" width="150%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:200px">ID</th>
                                            <th style="width:200px">Perusahaan</th>
                                            <th style="width:200px">Jenis Transaksi</th>
                                            <th style="width:200px">Nama Barang</th>
                                            <?php
                                                if($_SESSION['akses']== 1 || $_SESSION['akses']== 5 ){
                                                   echo  '<th style="width:200px">Nama Proyek</th>';
                                                }
                                            ?>
                                            <th style="width:200px">Kuantitas</th>
                                            <th style="width:200px">Pengeluaran</th>
                                            <th style="width:200px">Pemasukan</th>
                                            <th style="width:200px">Saldo Sebelum Transaksi</th>
                                            <th style="width:200px">Saldo Akhir</th>
                                            <th style="width:200px">Tanggal Transaksi</th>
                                            <th style="width:200px">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                         <td></td>
                                         <th>Perusahaan</th>
                                         <th>Jenis Transaksi</th>
                                         <th>Barang</th>
                                         <?php
                                                if($_SESSION['akses']== 1 || $_SESSION['akses']== 5 ){
                                                   echo  '<th">Nama Proyek</th>';
                                                }
                                            ?>
                                         <td></td>
                                         <th>Pengeluaran</th>
                                         <th>Pemasukan</th>
                                         <th>Saldo Sebelum</th>
                                         <td></td>
                                         <th>Tanggal</th>
                                         <th>Keterangan</th>
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


<script>
    $('#user tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" name="'+title+'" placeholder="Search ' + title + '" />');
    });
    $(document).ready(function(){
        var table=$('#user').DataTable({
            "dom": 'lrtp',
            "processing": true,
            "serverSide": true,
            "ajax":{
                    "url": "ajax/ajax_transaksi.php?action=transaksi",
                    "dataType": "json",
                    "type": "POST"
                    },
            "columns": [
                { "data": "id_transaksi" },
                { "data": "nama_perusahaan" },
                { "data": "nama_jenis" },
                { "data": "nama_transaksi" },
                <?php
                if($_SESSION['akses'] == 1 && $_SESSION['akses'] == 5){
                   echo '{ "data": "nama_projek"},';
                }
                ?>
                
                { "data": "qty" },
                { "data": "pengeluaran" },
                { "data": "pemasukan" },
                { "data": "saldo_before_transakction"},
                { "data": "saldo_akhir"},
                { "data": "tanggal_transaksi" },
                { "data": "keterangan_transaksi"},
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
              }
        });
    });

</script>
</body>

</html>
