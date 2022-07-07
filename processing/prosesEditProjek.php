<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["nama_projek"])){
         $nama_projek = $_POST['nama_projek'];
    }
    $status_projek = $_POST['status'];





    if(!$nama_projek){

       header("location:../projek.php?alert=1");

    }else {
       echo $query = "UPDATE projek SET
        nama_projek= '$nama_projek' ,
        status_projek= '$status_projek' WHERE id_projek = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../projek.php?alert=2");

        }
        else {

            header("location:../projek.php?alert=3");

        }
    }



?>
