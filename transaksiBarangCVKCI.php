<!DOCTYPE html>

<?php
SESSION_START();
include("processing/connection/koneksi.php");
include("processing/fungsi.php");
checkSession();
$transaksi = $_GET['trx'] ;
if ($transaksi == "1"){
    $judul = "Pengeluaran Barang";
}elseif ($transaksi == "2"){
    $judul = "Pemasukan Barang";
}

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data <?php echo $judul; ?></title>

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
                    <h1 class="h3 mb-2 text-gray-800">Tambah <?php echo $judul; ?></h1>
                    <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        }

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Transaksi!</h4>
                                    Mohon dicek ulang data yang diisi!
                                </div>";
                        }
                        elseif ($_GET['alert'] == 2) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                    Transaksi Barang berhasil dilakukan.
                                </div>";
                        }
                        elseif ($_GET['alert'] == 3) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error! Data tidak ditemukan.</h4>
                                    Tidak ada data stok barang pada lokasi di database. Mohon kontak super admin untuk menambahkan stok dan lokasi tersebut.
                                </div>";
                        }
                        elseif ($_GET['alert'] == 4) {
                            echo "<div class='alert alert-success alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error! Stok tidak cukup.</h4>
                                    Pengeluaran barang melebihi stok yang tersedia.
                                </div>";
                        }
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <form id="form_send" action='processing/prosesTransaksiBarangCVKCI.php?trx=<?php echo $transaksi;?>' method ='post'  enctype="multipart/form-data">

                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <Select class="form-control" name='nama_barang' id="nama_barang" required>
                                        <?php
                                            $query = "SELECT nama_barang, fk_id_lokasi FROM stock_barang
                                            inner join lokasi on lokasi.id_lokasi = stock_barang.fk_id_lokasi WHERE nama_lokasi = 'CV KCI'";
                                            $run = mysqli_query($connect, $query);
                                            while($output = mysqli_fetch_assoc($run)){
                                                $nama = $output['nama_barang'];

                                        ?>
                                            <?php echo '<option value="'.$nama. '">';echo $nama; ?> </option>
                                        <?php
                                            }

                                            ?>
                                    </select><br>

                                    <input type='text' name='id_lokasi' id="id_lokasi" value='CV KCI' required hidden>

                                    <label for="exampleInputEmail1">Kuantitas <?php echo $judul; ?></label> <br>
                                    <input type='text' class="form-control" placeholder='100' name='qty' id='qty' required><br>

                                    <label for="exampleInputEmail1">Keterangan</label> <br>
                                    <input type='textarea' class="form-control" name='keterangan' ><br>

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

    <!-- JS filtering input to numbers -->
    <script src="js/filterInput.js"></script>
    <script>
    setInputFilter(document.getElementById("qty"), function(value) {
      return /^-?\d*$/.test(value); });
    </script>


</body>

</html>
