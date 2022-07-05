<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
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
       echo $query = "UPDATE stock_barang SET
        fk_id_lokasi= '$fk_id_lokasi' ,
        nama_barang= '$nama_barang' ,
        stock = '$stock',
        status_barang= '$status_barang'  WHERE id_stock_barang = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../stokBarang.php?alert=2");

        }
        else {

            header("location:../stokBarang.php?alert=3");

        }
    }



?>
