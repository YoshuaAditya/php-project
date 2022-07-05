<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }

    if(!$id){

       header("location:../stokBarang.php?alert=1");

    }else {
       echo $query = "DELETE FROM stock_barang WHERE id_stock_barang = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../stokBarang.php?alert=2");

        }
        else {

            header("location:../stokBarang.php?alert=3");

        }
    }



?>
