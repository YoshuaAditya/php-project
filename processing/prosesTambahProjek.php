<?php
    include("connection/koneksi.php");
    if(!empty($_POST["nama_projek"])){
        $nama_projek = $_POST['nama_projek'];
    }
    echo $status_projek = $_POST['status'];





    if(!$nama_projek){

       header("location:../projek.php?alert=1");

    }else {
        $query = "INSERT INTO projek(nama_projek, status_projek) VALUES
        ('".$nama_projek."','".$status_projek."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../projek.php?alert=2");

        }
        else {

            header("location:../projek.php?alert=3");

        }
    }



?>
