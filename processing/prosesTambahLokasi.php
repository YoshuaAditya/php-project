<?php
    include("connection/koneksi.php");
    if(!empty($_POST["nama_lokasi"])){
        $nama_lokasi = $_POST['nama_lokasi'];
    }
    echo $status_lokasi = $_POST['status'];





    if(!$nama_lokasi){

       header("location:../lokasi.php?alert=1");

    }else {
        $query = "INSERT INTO lokasi(nama_lokasi, status_lokasi) VALUES
        ('".$nama_lokasi."','".$status_lokasi."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../lokasi.php?alert=2");

        }
        else {

            header("location:../lokasi.php?alert=3");

        }
    }



?>
