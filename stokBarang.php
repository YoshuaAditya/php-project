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

    <title>Data Stock Barang</title>

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
                <a href="tambahStokBarang.php"> <button style="float:right; background-color:#4295f5; color:white" class="btn btn-user">Tambah Data</button></a>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Stock Barang</h1>
                    <?php
                        if (empty($_GET['alert'])) {
                            echo "";
                        }

                        elseif ($_GET['alert'] == 1) {
                            echo "<div class='alert alert-danger alert-dismissable'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h4>  <i class='icon fa fa-times-circle'></i> Gagal Melakukan Registrasi!</h4>
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
                          echo "<div class='alert alert-info alert-dismissable'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error!</h4>
                                  Data yang dimasukkan sudah ada di database.
                              </div>";
                      }
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="user" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Lokasi</th>
                                            <th>Perusahaan</th>
                                            <th>Nama Barang</th>
                                            <th>Stock</th>
                                            <th>Status Barang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


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
        <form id="form_send" action='processing/prosesEditStokBarang.php' method ='post'  enctype="multipart/form-data">
          <input type='hidden' name='id' id="id">
          <label for="exampleInputEmail1">Nama Lokasi</label>
          <Select class="form-control" name='fk_id_lokasi' id="fk_id_lokasi" >
              <?php
                $query = "SELECT * FROM lokasi where status_lokasi ='1'";
                $run = mysqli_query($connect, $query);
                while($output = mysqli_fetch_assoc($run)){
                    $id = $output['id_lokasi'];
                    $nama = $output['nama_lokasi'];

              ?>
                <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
            <?php
                }

                ?>
          </select><br>

          <label for="exampleInputEmail1">Perusahaan</label>
          <Select class="form-control" name='fk_id_perusahaan' id="fk_id_perusahaan" >
              <?php
                  $query = "SELECT * FROM perusahaan where status_perusahaan ='1' AND id_perusahaan != '5'";
                  $run = mysqli_query($connect, $query);
                  while($output = mysqli_fetch_assoc($run)){
                      $id = $output['id_perusahaan'];
                      $nama = $output['nama_perusahaan'];

              ?>
                  <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
              <?php
                  }

                  ?>
          </select> <br>

          <label for="exampleInputEmail1">Nama Barang</label> <br>
          <input type='text'class="form-control"  name='nama_barang' id="nama_barang" > <br>

          <label for="exampleInputEmail1">Stock</label> <br>
          <input type='text'class="form-control"  name='stock' id="stock" > <br>

          <label for="exampleInputEmail1">Status</label>
          <Select class="form-control" name="status" id="status" >
          <option value='1'> Aktif </option>
          <option value='0'> Tidak Aktif</option>
          </select><br>
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


<script>
    $(function(){

        $('#user').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                    "url": "ajax/ajax_stok_barang.php?action=stokBarang",
                    "dataType": "json",
                    "type": "POST"
                    },
            "columns": [
                { "data": "id_stock_barang" },
                { "data": "nama_lokasi" },
                { "data": "nama_perusahaan" },
                { "data": "nama_barang" },
                { "data": "stock" },
                { "data": "status_barang" },
                { "data": "aksi"},
            ]
        });
    });

    function Edit(btn){
        $("#edit").modal('show');
            var id = $(btn).data('id');
            var fk_id_lokasi = $(btn).data('fk_id_lokasi');
            var fk_id_perusahaan = $(btn).data('fk_id_perusahaan');
            var nama_barang = $(btn).data('nama_barang');
            var stock = $(btn).data('stock');
            var status_barang = $(btn).data('status');

            $("#id").val(id);
            $("#fk_id_lokasi").val(fk_id_lokasi);
            $("#nama_barang").val(nama_barang);
            $("#stock").val(stock);
            $("#status").val(status_barang);
    }






</script>
</body>

</html>
