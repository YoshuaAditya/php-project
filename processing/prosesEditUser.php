<?php
    include("connection/koneksi.php");
    if(!empty($_POST["id"])){
         $id = $_POST['id'];
    }
    if(!empty($_POST["username"])){
        $username = $_POST['username'];
    }
    if(!empty($_POST["fk_id_al"])){
        $fk_id_al = $_POST['fk_id_al'];
    }

    echo $status_user = $_POST['status'];

    if(!$id||!$username|!$fk_id_al){

       header("location:../user.php?alert=1");

    }else {
        $query = "UPDATE user SET
         username= '$username' ,
         fk_id_al = '$fk_id_al',
         status_user= '$status_user'  WHERE id_user = '$id'";
        $jalan = mysqli_query($connect,$query);
        if($jalan){

            header("location:../user.php?alert=2");

        }
        else {

            header("location:../user.php?alert=3");

        }
    }



?>
