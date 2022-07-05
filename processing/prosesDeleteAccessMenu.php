<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }

    if(!$id){

       header("location:../accessMenu.php?alert=1");

    }else {
       echo $query = "DELETE FROM access_menu WHERE id_access_menu = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../accessMenu.php?alert=2");

        }
        else {

            header("location:../accessMenu.php?alert=3");

        }
    }



?>
