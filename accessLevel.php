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

    <title>Data Access Level</title>

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
                <a href="tambahAccessLevel.php"> <button style="float:right; background-color:#4295f5; color:white" class="btn btn-user">Tambah Data</button></a>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Access Level</h1>
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
                          echo "<div class='alert alert-danger alert-dismissable'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                  <h4>  <i class='icon fas fa-exclamation-triangle'></i> Error!</h4>
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
                                            <th>Nama Access Level</th>
                                            <th>Perusahaan</th>
                                            <th>Status Access Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                       <tr>
                                         <td></td>
                                         <th>Access Level</th>
                                         <th>Perusahaan</th>
                                         <td></td>
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
        <form id="form_send" action='processing/prosesEditAccessLevel.php' method ='post'  enctype="multipart/form-data">
          <input type='hidden' name='id' id="id">
          <label for="exampleInputEmail1">Nama Access Level</label>
          <input type='text'class="form-control"  name='nama_al' id="nama_al" > <br>

          <label for="exampleInputEmail1">Perusahaan</label>
          <Select class="form-control" name='fk_id_perusahaan' id="fk_id_perusahaan" >
              <?php
                $query = "SELECT * FROM perusahaan where status_perusahaan ='1'";
                $run = mysqli_query($connect, $query);
                while($output = mysqli_fetch_assoc($run)){
                    $id = $output['id_perusahaan'];
                    $nama = $output['nama_perusahaan'];
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
                    "url": "ajax/ajax_access_level.php?action=accessLevel",
                    "dataType": "json",
                    "type": "POST"
                    },
            "columns": [
                { "data": "id_al" },
                { "data": "nama_al" },
                { "data": "nama_perusahaan" },
                { "data": "status_al" },
                { "data": "aksi"},
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

    function Edit(btn){
        $("#edit").modal('show');
            var id = $(btn).data('id');
            var nama_al = $(btn).data('nama_al');
            var fk_id_perusahaan = $(btn).data('fk_id_perusahaan');
            var status_al = $(btn).data('status');

            $("#id").val(id);
            $("#nama_al").val(nama_al);
            $("#fk_id_perusahaan").val(fk_id_perusahaan);
            $("#status").val(status_al);
    }






</script>
</body>

</html>
