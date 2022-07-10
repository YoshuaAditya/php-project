<!DOCTYPE html>

<?php
SESSION_START();
include("processing/connection/koneksi.php");
include("processing/fungsi.php");
checkSession();
$perusahaan = $_GET['prs'] ;
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Transaksi</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Laporan Transaksi</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <form id="form_send"  method ="post" action="processing/formatLaporanExcel.php?prs=<?php echo $perusahaan;?>" enctype="multipart/form-data">

                                    <label for="exampleInputEmail1">Tanggal Awal</label> <br>
                                    <input class="form-control" type="text" id="awal" name="awal" required/> <br>
                                    <input class="form-control" type="text" id="bulanAwal" name="bulanAwal" hidden/>
                                    <label for="exampleInputEmail1">Tanggal Akhir</label> <br>
                                    <input class="form-control" type="text" id="akhir" name="akhir" required/> <br>
                                    <input class="form-control" type="text" id="bulanAkhir" name="bulanAkhir" hidden/>
                                    <input type='submit' class="btn btn-primary" value='submit'>


                                </form>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="js/jquery-ui.js"></script>
    <script>
    $( function() {
      $( "#awal" ).datepicker({ dateFormat: 'd MM yy', altField: "#bulanAwal", altFormat: "yy-mm-dd"});

      $( "#akhir" ).datepicker({ dateFormat: 'd MM yy', altField: "#bulanAkhir", altFormat: "yy-mm-dd"});
    } );
    </script>



</body>

</html>
