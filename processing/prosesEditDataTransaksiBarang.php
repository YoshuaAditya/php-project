<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["id_lokasi"])){
         $id_lokasi = $_POST['id_lokasi'];
    }
    $keterangan_transaksi = $_POST['keterangan_transaksi'];

    if(!$id_lokasi){

       header("location:../dataTransaksiBarang.php?alert=1");

    }else {
       echo $query = "UPDATE transaksi_bbm SET
        fk_id_lokasi= '$id_lokasi' ,
        keterangan_transaksi= '$keterangan_transaksi' WHERE id_transaksi_bbm = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../dataTransaksiBarang.php?alert=2");

        }
        else {

            header("location:../dataTransaksiBarang.php?alert=3");

        }
    }



?>
