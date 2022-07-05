<?php
    include("connection/koneksi.php");
    if(!empty($_POST["fk_id_lokasi"])){
        $fk_id_lokasi = $_POST['fk_id_lokasi'];
    }
    if(!empty($_POST["nama_barang"])){
        $nama_barang = $_POST['nama_barang'];
    }
    if(!empty($_POST["stock"])){
        $stock = $_POST['stock'];
    }

    echo $status_barang = $_POST['status'];





    if(!$fk_id_lokasi || !$nama_barang || !$stock){

       header("location:../stokBarang.php?alert=1");

    }else {
        $query = "INSERT INTO stock_barang(fk_id_lokasi, nama_barang, stock, status_barang) VALUES
        ('".$fk_id_lokasi."','".$nama_barang."','".$stock."','".$status_barang."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../stokBarang.php?alert=2");

        }
        else {

            header("location:../stokBarang.php?alert=3");

        }
    }



?>
