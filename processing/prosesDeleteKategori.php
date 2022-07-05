<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }

    if(!$id){

       header("location:../kategori_menu.php?alert=1");

    }else {
       echo $query = "DELETE FROM kategori_menu WHERE id_category = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../kategori_menu.php?alert=2");

        }
        else {

            header("location:../kategori_menu.php?alert=3");

        }
    }



?>
