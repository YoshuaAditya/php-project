<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }

    if(!$id){

       header("location:../lokasi.php?alert=1");

    }else {
       echo $query = "DELETE FROM lokasi WHERE id_lokasi = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../lokasi.php?alert=2");

        }
        else {

            header("location:../lokasi.php?alert=3");

        }
    }



?>
