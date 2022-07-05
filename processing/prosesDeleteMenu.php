<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }

    if(!$id){

       header("location:../menu.php?alert=1");

    }else {
       echo $query = "DELETE FROM menu WHERE id_menu = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../menu.php?alert=2");

        }
        else {

            header("location:../menu.php?alert=3");

        }
    }



?>
