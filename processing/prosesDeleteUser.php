<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
        $id = $_POST['id'];
    }

    if(!$id){

       header("location:../user.php?alert=1");

    }else {
       echo $query = "DELETE FROM user WHERE id_user = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../user.php?alert=2");

        }
        else {

            header("location:../user.php?alert=3");

        }
    }



?>
