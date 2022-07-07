<?php
    include("connection/koneksi.php");
    if(!empty($_POST["nama_jenis"])){
        $nama_jenis = $_POST['nama_jenis'];
    }
    echo $status_jenis = $_POST['status'];





    if(!$nama_jenis){

       header("location:../jenisTransaksi.php?alert=1");

    }else {
        $query = "INSERT INTO jenis_transaksi(nama_jenis, status_jenis) VALUES
        ('".$nama_jenis."','".$status_jenis."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../jenisTransaksi.php?alert=2");

        }
        else {

            header("location:../jenisTransaksi.php?alert=3");

        }
    }



?>
