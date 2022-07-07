<?php
    include("connection/koneksi.php");
    if(!empty($_POST["username"])){
        $username = $_POST['username'];
    }
    if(!empty($_POST["password"])){
        $password = md5($_POST['password']);
    }
    if(!empty($_POST["password"])){
        $password2 = md5($_POST['password2']);
    }
    if(!empty($_POST["fk_id_al"])){
        $fk_id_al = $_POST['fk_id_al'];
    }

    echo $status_user = $_POST['status'];

    if(!$username||!$password||!$password2||!$fk_id_al){

       header("location:../user.php?alert=1");

    }elseif($password != $password2) {
       header("location:../user.php?alert=4");
    }
    else{
        $query = "INSERT INTO user(username, password_user, fk_id_al, status_user) VALUES
        ('".$username."','".$password."','".$fk_id_al."','".$status_user."')";
        $jalan = mysqli_query($connect,$query);
        if($jalan){
            header("location:../user.php?alert=2");
        }
        else {
            header("location:../user.php?alert=3");
        }
    }
?>
