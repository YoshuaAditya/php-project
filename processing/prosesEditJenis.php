<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["nama_jenis"])){
         $nama_jenis = $_POST['nama_jenis'];
    }
    $status_jenis = $_POST['status_jenis'];

    if(!$nama_jenis){

       header("location:../jenisTransaksi.php?alert=1");

    }else {
       echo $query = "UPDATE jenis_transaksi SET
        nama_jenis= '$nama_jenis' ,
        status_jenis= '$status_jenis' WHERE id_jenis = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../jenisTransaksi.php?alert=2");

        }
        else {

            header("location:../jenisTransaksi.php?alert=3");

        }
    }



?>
