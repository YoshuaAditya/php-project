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

    <title>Data Akses Menu</title>

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
                <a href="tambahAksesMenu.php"> <button style="float:right; background-color:#4295f5; color:white" class="btn btn-user">Tambah Data</button></a>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Akses Menu</h1>
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
                                  <h4>  <i class='icon fa fa-check-circle'></i> Success!</h4>
                                  Terjadi kesalahan pada server silahkan mencoba beberapa saat lagi!
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
                                            <th>Nama Menu</th>
                                            <th>Nama Kategori</th>
                                            <th>Nama Akses Level</th>
                                            <th>Status Akses Menu</th>
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
        <form id="form_send" action='processing/prosesEditAccessMenu.php' method ='post'  enctype="multipart/form-data">
          <input type='hidden' name='id' id="id">
          <label for="exampleInputEmail1">Nama Kategori</label>
          <Select class="form-control" name='fk_id_category' id="fk_id_category" >
              <?php
                $query = "SELECT * FROM kategori_menu where status_category ='1'";
                $run = mysqli_query($connect, $query);
                while($output = mysqli_fetch_assoc($run)){
                    $id = $output['id_category'];
                    $nama = $output['nama_category'];

              ?>
                <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
            <?php
                }

                ?>
          </select><br>

          <label for="exampleInputEmail1">Nama Menu</label> <br>
          <Select class="form-control" name='fk_id_menu' id="fk_id_menu" >
              <?php
                $query = "SELECT * FROM menu where status_menu ='1'";
                $run = mysqli_query($connect, $query);
                while($output = mysqli_fetch_assoc($run)){
                    $id = $output['id_menu'];
                    $nama = $output['nama_menu'];

              ?>
                <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
            <?php
                }

                ?>
          </select><br>

          <label for="exampleInputEmail1">Nama Akses Level</label> <br>
          <Select class="form-control" name='fk_id_al' id="fk_id_al" >
              <?php
                $query = "SELECT * FROM access_level where status_al ='1'";
                $run = mysqli_query($connect, $query);
                while($output = mysqli_fetch_assoc($run)){
                    $id = $output['id_al'];
                    $nama = $output['nama_al'];

              ?>
                <option value=<?php echo $id;?> () > <?php echo $nama; ?> </option>
            <?php
                }

                ?>
          </select><br>

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
  <?php
       include("deleteModal.php");
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
    $(function(){

        $('#user').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                    "url": "ajax/ajax_access_menu.php?action=accessMenu",
                    "dataType": "json",
                    "type": "POST"
                    },
            "columns": [
                { "data": "id_access_menu" },
                { "data": "nama_menu" },
                { "data": "nama_category" },
                { "data": "nama_al" },
                { "data": "status_access_menu" },
                { "data": "aksi"},
            ]
        });
    });

    function Edit(btn){
        $("#edit").modal('show');
            var id = $(btn).data('id');
            var fk_id_category = $(btn).data('fk_id_category');
            var fk_id_menu = $(btn).data('fk_id_menu');
            var fk_id_al = $(btn).data('fk_id_al');
            var status_access_menu = $(btn).data('status');

            $("#id").val(id);
            $("#fk_id_category").val(fk_id_category);
            $("#fk_id_menu").val(fk_id_menu);
            $("#fk_id_al").val(fk_id_al);
            $("#status").val(status_access_menu);
    }
    function Delete(btn){
        $("#delete").modal('show');
            var id = $(btn).data('id');
            $("#id_delete").val(id);
            var form_send_delete=document.getElementById('form_send_delete');
            form_send_delete.action="processing/prosesDeleteAccessMenu.php";
    }





</script>
</body>

</html>
