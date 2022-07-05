<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["nama_lokasi"])){
         $nama_lokasi = $_POST['nama_lokasi'];
    }
    $status_lokasi = $_POST['status'];





    if(!$nama_lokasi){

       header("location:../lokasi.php?alert=1");

    }else {
       echo $query = "UPDATE lokasi SET
        nama_lokasi= '$nama_lokasi' ,
        status_lokasi= '$status_lokasi' WHERE id_lokasi = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../lokasi.php?alert=2");

        }
        else {

            header("location:../lokasi.php?alert=3");

        }
    }



?>
