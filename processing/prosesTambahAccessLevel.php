<?php
    include("connection/koneksi.php");
    if(!empty($_POST["nama_al"])){
        $nama_al = $_POST['nama_al'];
    }
    if(!empty($_POST["fk_id_perusahaan"])){
         $fk_id_perusahaan = $_POST['fk_id_perusahaan'];
    }
    echo $status_al = $_POST['status'];





    if(!$nama_al){

       header("location:../accessLevel.php?alert=1");

    }else {
        $query = "INSERT INTO access_level(nama_al,fk_id_perusahaan, status_al) VALUES
        ('".$nama_al."','".$fk_id_perusahaan."','".$status_al."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../accessLevel.php?alert=2");

        }
        else {

            header("location:../accessLevel.php?alert=3");

        }
    }



?>
